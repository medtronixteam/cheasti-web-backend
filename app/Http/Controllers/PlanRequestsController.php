<?php

namespace App\Http\Controllers;
use App\Models\SubscriptionPlan;
use App\Models\PlanRequest;
use App\Models\User;
use Illuminate\Http\Request;

class PlanRequestsController extends Controller
{
    public function planSubscribe($plan)  {
        if(auth()->user()->is_plan_active==1){
            return redirect()->route('user.subscription.manage');
        }
        return view('user.subscription.pricing_plan', ['planName' => $plan]);
    }
  public function manage()
    {
        $plans = SubscriptionPlan::all();
        return view('admin.subscription.manage', compact('plans'));
    }

   public function update(Request $request, $plan = null)
{
    // If $plan is null, it means we are handling form submission
    if ($plan === null) {
        $planId = $request->input('planId');
        $plan = SubscriptionPlan::findOrFail($planId);
    } else {
        $plan = SubscriptionPlan::findOrFail($plan);
    }

    // Update the plan attributes
    $plan->update([
        'price' => $request->input('price'),
        'description' => $request->input('description'),
        'invoices' => $request->input('invoices', 0),
        'notes' => $request->input('notes', 0),
        'planner_scheduler' => $request->input('planner_scheduler', 0),
        'editor_software' => $request->input('editor_software', 0),
        'auto_content' => $request->input('auto_content', 0),
        'multiple_platform_link' => $request->input('multiple_platform_link', 0),
        'automation_cloud_data' => $request->input('automation_cloud_data', 0),
        'auto_scheduler' => $request->input('auto_scheduler', 0),
        'admin_owner' => $request->input('admin_owner', 0),
        'automation' => $request->input('automation', 0),
        'package_id' => $request->input('package_id')
    ]);

    // Flash message
    flashy()->success('Plan updated successfully');

    // Redirect based on request method
    if ($request->isMethod('POST')) {
        return redirect()->route('admin.subscription.manage');
    }

    // If $plan is provided, we are rendering the manage view
    $plans = SubscriptionPlan::all();
    return view('admin.subscription.manage', compact('plans'));
}
  public function adminindex()
    {
        $transactions = PlanRequest::with('user')->get();
        return view('admin.transactions.index', compact('transactions'));
    }

    public function adminedit($id)
    {
        $transaction = PlanRequest::findOrFail($id);
        return view('admin.transactions.edit', compact('transaction'));
    }

    public function adminupdate(Request $request, $id)
    {
        $transaction = PlanRequest::findOrFail($id);
        $transaction->update($request->all());
        flashy()->success('Transaction updated successfully.');
        return redirect()->route('admin.transactions.index');
    }

    public function adminshow($id)
    {
        $transaction = PlanRequest::findOrFail($id);
        return view('admin.transactions.show', compact('transaction'));
    }

    public function admindestroy($id)
    {
        $transaction = PlanRequest::findOrFail($id);
        $transaction->delete();
        flashy()->success('Transaction deleted successfully.');
        return redirect()->route('admin.transactions.index');
    }

}
