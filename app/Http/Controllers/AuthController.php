<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {

        return Socialite::driver('google')->scopes(['openid', 'profile', 'email'])->redirectUrl(env('GOOGLE_REDIRECT_URL')."google/callback")->redirect();
    }

    public function redirectToGoogleLogin()
    {
        return Socialite::driver('google')->redirectUrl(env('GOOGLE_REDIRECT_URL')."login/google/callback")->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google') ->redirectUrl(env('GOOGLE_REDIRECT_URL')."google/callback")->user();

            $postData = [
                'access_token' => $user->token,
                'refresh_token' => ($user->refreshToken=="")?"N/A":$user->refreshToken,
                'expiration_time' => now()->addSeconds($user->expiresIn),
            ];

            $response = Http::asForm()->withHeaders(['Authorization' => 'Bearer '.$user->token])->post('https://chesti.ihsancrm.com/chesteei/v1/linkaccount/youtube/db', $postData);
            $responseData = $response->json();
            if ($response->failed()) {
                flashy()->error($response->status().$responseData['msg'], '#');
                return redirect()->route('user.platformlink.list');
            } else {

                User::find(auth()->user()->user_id)->update([
                    'jwt_key' => $responseData['token'],
                ]);
                flashy()->success('Youtube Account has been Linked ', '#');
                return redirect()->route('user.platformlink.list');
            }

        } catch (\Throwable $e) {
            flashy()->error($e->getMessage(), '#');
            return redirect()->route('user.platformlink.list');

        }

    }

    public function handleGoogleCallbackLogin()
    {
        try {
            $user = Socialite::driver('google') ->redirectUrl(env('GOOGLE_REDIRECT_URL')."login/google/callback")->user();
            $finduser = User::where('email', $user->email)->where('login_type', 'Google')->first();
            if ($finduser) {
                Auth::login($finduser);
                flashy()->success('Login Successfully ...', '#');
                return redirect()->route('dashboard');
            }else{
                if(User::where('email', $user->email)->first()){
                    flashy()->error('Email already Registered  ...', '#');
                    return redirect()->route('login')->with('error', 'Email already Registered');
                }



            $postData = [
                'link_email' => $user->email,
                'name' => $user->name,

            ];
        User::updateOrCreate([
            'email'   =>$user->email,
        ],[
            'first_name'   =>$user->name,
            "password" =>  Hash::make($user->email),
            "phone" => '',
            "role" =>  'user',
            'login_type' => 'Google',
        ]);
            $response = Http::asForm()->post('https://chesti.ihsancrm.com/chesteei/v1/user/andorid_google', $postData);

            if ($response->failed()) {
                flashy()->error($response->status().' Something Went Wrong ', '#');
                return redirect()->route('login')->with('error', $response->status().'Something Went Wrong in api');
            } else {
                $responseData = $response->json();
                $userData=User::where('email', $user->email)->first();
                Auth::login($userData);
                User::where('email', $user->email)->update([
                    'jwt_key' => $responseData['token'],
                ]);
                flashy()->success('Acount has been Created ', '#');
                return redirect()->route('dashboard');
            }
        }
        } catch (\Throwable $e) {
            flashy()->error(' Something Went Wrong ', '#');
            return redirect()->route('login')->with('error',$e->getMessage().' Something Went Wrong');
        }

    }


}
