<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\forgetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class LoginController extends Controller
{
    public function index()
    {

        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('login');
    }

    public function authenticate(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            flashy()->success('Login Successfully ...', '#');
            return redirect()->route('dashboard');
        }
        flashy()->error('Invalid Username or Password ', '#');
        return back()->with('error', 'Invalid Username or Password');
    }

    public function authenticatebyApi(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        try {
            $postData = [
                'email' => $request->email,
                'password' => $request->password,
            ];
            $response = Http::asForm()->post('https://chesti.ihsancrm.com//chesteei/v1/user/login', $postData);
            if ($response->failed() and $response->status() != 200) :
                //flashy()->error('Invalid Username or Password '.$response->status(), '#');
                return back()->with('error', 'Invalid Username or Password');

            else :

                $user = User::where('email',$request->email);
                if ($user->count() > 0) :
                    $user->update([
                        'jwt_key' => $response->json('token'),
                    ]);
                    Auth::login($user->first());
                    flashy()->success('Login Successfully ...', '#');
                    $request->session()->regenerate();
                    return redirect()->route('dashboard');
                else :
                    flashy()->error('Invalid Username or Password ', '#');
                    return back()->with('error', 'Invalid Username or Password');

                endif;
            endif;
        } catch (\Exception $e) {

            return back()->with('error', 'Invalid Username or Password');

            return redirect()->back();
        }
        // if (Auth::attempt($credentials)) {


        // }

    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been log out!');
    }

    public function register()
    {
        return view('register');
    }

    public function registerUser(Request $request)
    {

        // Validate the incoming request data
        $validatedData = $request->validate([
            "password" => ['required', 'min:8', 'confirmed'],
            "first_name" => ['required', 'string', 'max:15'],
            "last_name" => ['required'],
            "email" => ['required',  'unique:users,email']
            //'email:rfc,dns',confirmed
        ]);

        // Hash the password
        $validatedData["password"] = Hash::make($validatedData["password"]);


        $milliseconds = Carbon::now()->timestamp * 1000;

        $user = User::create([
            "first_name" =>  $validatedData["first_name"],
            "user_id" => $milliseconds . str_replace(['.', '$' . ',', '.', ' '], '',  $validatedData["first_name"]),
            "last_name" =>  $validatedData["last_name"],
            "password" =>  $validatedData["password"],
            "email" =>  $validatedData["email"],
            "phone" =>  $request->phone,
            "role" =>  'user',
        ]);

        // Log in the user
        Auth::login($user);

        // Redirect the user after registration
        flashy()->success('Account has been Created. You are now logged in.');
        return redirect('dashboard')->with('success', 'Registered Successful!');
    }
    public function registerUserByApi(Request $request)
    {

        // Validate the incoming request data
        $validatedData = $request->validate([
            "password" => ['required', 'min:8', 'confirmed'],
            "first_name" => ['required', 'string', 'max:15'],
            "last_name" => ['required'],
            "email" => ['required',  'unique:users,email']
            //'email:rfc,dns',confirmed
        ]);


        try {
            $postData = [
                "first_name" =>  $validatedData["first_name"],
                "last_name" =>  $validatedData["last_name"],
                "password" =>  $validatedData["password"],
                "email" =>  $validatedData["email"],
                "phone" =>  $request->phone,
                "role" =>  'user',
            ];
            $response = Http::asForm()->post('https://chesti.ihsancrm.com//chesteei/v1/user/signup', $postData);
            if ($response->failed() and $response->status() != 200) :
                //flashy()->error('Invalid Username or Password '.$response->status(), '#');
                return back()->with('error', 'Something Went Wrong ');

            else :
                $validatedData["password"] = Hash::make($validatedData["password"]);
                $user = User::create([
                    "first_name" =>  $validatedData["first_name"],
                    "last_name" =>  $validatedData["last_name"],
                    "password" =>  $validatedData["password"],
                    "email" =>  $validatedData["email"],
                    "phone" =>  $request->phone,
                    "role" =>  'user',
                ]);
                $user = User::where('email', $validatedData["email"]);
                if ($user->count() > 0) :
                    $user->update([
                        'jwt_key' => $response->json('token'),
                    ]);

                    Auth::login($user->first());
                endif;

                flashy()->success('Account has been Created. You are now logged in.');
                return redirect('dashboard')->with('success', 'Registered Successful!');



            endif;
        } catch (\Exception $e) {

            return back()->with('error', 'Something Went Wrong ');

            return redirect()->back();
        }
    }

    public function resetPassword1($key)
    {
        return view('reset-password', ['key' => $key]);
    }
    public function resetPasswordCh(Request $request)
    {
        $validatedData = $request->validate([
            "password" => ['required', 'confirmed', 'min:3'],
        ]);

        if ($validatedData) {
            $User = User::find(base64_decode($request->key));
            if ($User) {
                $User->update(['password' => Hash::make($validatedData["password"])]);
                flashy()->info('Password has been Updated!', '#');
            } else {

                flashy()->error('Invalid User Id', '#');
            }
        }
        return back()->with('error', 'Password has been not Updated!');
    }



    public function edit()
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to the login page if not authenticated
        }

        $user = Auth::user(); // Get the authenticated user
        return view('profile.edit', compact('user'));
    }


    public function update(Request $request)
    {
        $user = Auth::user(); // Get the authenticated user

        $user->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'phone' => $request->input('phone'),
        ]);
        flashy()->success('Profile updated successfully');
        return redirect()->back();
    }


    public function resetPassword(Request $request)
    {
        $user = Auth::user(); // Get the authenticated user

        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $newPassword = $request->password;

        if ($newPassword !== $request->password_confirmation) {
            // If passwords don't match, return with an error message
            flashy()->error('Passwords do not match.');
            return redirect()->back()->withInput();
        }

        try {
            $user->update([
                'password' => Hash::make($newPassword),
            ]);
            flashy()->success('Password has been reset successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            // If any other issue occurs during the password update, return with an error message
            flashy()->error('Failed to reset password. Please try again later.');
            return redirect()->back()->withInput();
        }
    }

    public function reset_password_email()
    {
        return view('validate-email');
    }
    public function resetPasswordView($token)
    {

        try {
            // Decrypt the user ID
            $userId = base64_decode($token);

            $user = User::find($userId);

            if (!$user) {
                abort(404); // User not found, show 404 page
            }

            return view('forget-password', ['user' => $user]);
        }
         catch (DecryptException $e) {
            abort(404); // Token is invalid, show 404 page
        }
    }
    public function resetPasswordLink(Request $request)
    {
        $validatedData = $request->validate([
            "email" => ['required', 'email']
        ]);


        $toEmail = $request->email;
        $user = User::where('email', $toEmail)->first();
        // $userId=$user->user_id;
        if ($user) {
            // $encryptedUserId = Crypt::encrypt($user->user_id);
            $encryptedUserId = base64_encode($user->user_id);

            Mail::to($toEmail)->send(new forgetPassword($toEmail, $encryptedUserId));
            flashy()->success('A reset password link has been sent to your email.');
            return back()->with('success', 'A reset password link has been sent to your email.');
        } else {
            flashy()->error('error: Please enter your email');
            return back()->with('error', 'Email Do not exist');
        }
    }

    public function changePassword(Request $request, $id)
    {
        $validatedData = $request->validate([
            "password" => ['required', 'confirmed', 'min:3'],
            // "email" => ['required', 'email']
        ]);
        $decodedUserId = base64_decode($id);

        if ($validatedData) {
            $user = User::find($decodedUserId);
            if ($user) {
                $user->update(['password' => Hash::make($validatedData["password"])]);
                return back()->with('success', 'Password has been Updated!');
            } else {

                flashy()->error('Invalid User Id', '#');
                return back()->with('error', 'Password has not been Updated!');
            }
        }
    }
}
