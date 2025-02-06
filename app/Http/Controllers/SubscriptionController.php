<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Customer;
use Stripe\Stripe;
use App\Models\PlanRequest;
use App\Models\SubscriptionPlan;
use App\Models\User;



class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        $planName=strtolower($request->plan_name);
        $planNew=SubscriptionPlan::where('name',$planName);
        if($planNew->count()>0){
         $planData=$planNew->first();


        Stripe::setApiKey(env('STRIPE_SECRET'));

        $email = $request->email;
        $paymentMethod = $request->payment_method;
        $plan = $planData->package_id;

        try {
            // Create or retrieve customer
            $customer = Customer::create([
                'email' => $email,
                'payment_method' => $paymentMethod,
                'invoice_settings' => [
                    'default_payment_method' => $paymentMethod,
                ],
            ]);

            // Create subscription
            $subscription = \Stripe\Subscription::create([
                'customer' => $customer->id,
                'items' => [
                    ['price' => $plan],
                ],
                'expand' => ['latest_invoice.payment_intent'],
            ]);

            $hostedInvoiceUrl =isset($subscription->latest_invoice->hosted_invoice_url)? $subscription->latest_invoice->hosted_invoice_url:null;

            // $apiResponse = Http::withHeaders([
            //     'Authorization' => "Bearer " .$request->token_j ,
            // ])->asForm()->post('https://chesti.ihsancrm.com/chesteei/v1/user/subscriptions/add', [
            //     'plan_id' =>$$plan ,
            //     'email' => $request->email,
            // ]);

            // if($apiResponse->failed()):
            //     Log::info("web ai  :".$apiResponse);
            //     $response=['status'=>500,"message"=>"Something Went Wrong Try Later"];
            // else:

            // endif;

            PlanRequest::create([
                'user_id' => auth()->user()->user_id,
                'product_id'=>$planData->product_id,
                'prod_name'=>$planName,
                'currency'=>'USD',
                'bill_interval'=>'monthly',
                'processed'=>0,
                'email'=>$request->email,
                'user_id'=>auth()->user()->user_id,
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'city'=>$request->city,
                'postal_code'=>$request->zip,
            ]);
            User::find(auth()->user()->user_id)->update(['current_plan' => $planName,'is_plan_active' => 1,'plan_active_date' => date('Y-m-d', strtotime('+1 month')),'plan_expire_date' => date('Y-m-d', strtotime('+1 month'))]);
            if ($hostedInvoiceUrl) {
                return redirect($hostedInvoiceUrl);
            } else {
                flashy()->success('Plan has been Active');
                return redirect()->route('user.subscription.manage');
            }


        } catch (\Exception $e) {
            flashy()->error('Error creating subscription: ' . $e->getMessage());
            return back()->with(['message' => 'Error creating subscription: ' . $e->getMessage()]);
        }
    }
    flashy()->error('No Plan Found ');
    return redirect()->back();

    }

   
}
