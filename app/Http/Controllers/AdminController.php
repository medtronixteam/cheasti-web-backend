<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Category;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use App\Models\PlanRequest;
use Illuminate\Support\Facades\DB; // Import DB facade

class AdminController extends Controller
{
    function dashboard() {
        $basicPlanCount = User::where('is_plan_active', true)
            ->where('current_plan', 'basic')
            ->count();

        $proPlanCount = User::where('is_plan_active', true)
            ->where('current_plan', 'pro')
            ->count();

    $enterprisePlanCount = User::where('is_plan_active', true)
        ->where('current_plan', 'enterprise')
        ->count();
        $subcriptionUsers = User::where('role', 'user')
        ->where('is_plan_active', true)
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
        $unSubcriptionUsers = User::where('role', 'user')
        ->where('is_plan_active', false)
        ->orderBy('created_at', 'desc')
        ->get();
        $totalUsers = User::where('role', 'user')->count();

        $totalPlanCount =  $basicPlanCount + $proPlanCount+ $enterprisePlanCount ;
        return view('admin.dashboard', compact('basicPlanCount', 'proPlanCount', 'enterprisePlanCount','totalPlanCount','subcriptionUsers', 'unSubcriptionUsers', 'totalUsers'));
    }

    public function creatorsActive()
    {
        $activeUsers = User::where('status', 'active')->where('role', 'user')->get();
        return view('admin.creators.active', compact('activeUsers'));
    }

    public function creatorsInActive()
    {
        $inactiveUsers = User::where('status', 'inactive')->where('role', 'user')->get();
        return view('admin.creators.inactive', compact('inactiveUsers'));
    }

    public function disableCreator($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = 'inactive';
            $user->save();
        }
        flashy()->success('User disabled successfully');
        return redirect()->route('admin.creators.active');
    }
    public function enableCreator($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = 'active';
            $user->save();
        }
        flashy()->success('User enabled successfully');
        return redirect()->route('admin.creators.inactive');
    }

    public function deleteCreator($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
        }
        flashy()->success('User deleted successfully');
        return redirect()->route('admin.creators.inactive');
    }
     public function viewCreator($id)
    {
        // Fetch the user
        $user = DB::table('users')->where('user_id', $id)->first();

        if (!$user) {
            return redirect()->route('admin.creators.active')->with('status', 'User not found.');
        }

        // Fetch transactions for the user
        $transactions = DB::table('plan_requests')
                            ->where('user_id', $user->user_id) // Assuming 'user_id' in 'plan_requests' table corresponds to 'user_id' in 'users' table
                            ->get();

        return view('admin.creators.view', compact('user', 'transactions'));
    }
    function transactionsAll()
    {
        return view('admin.transactions.index');
    }
    function tickets()
    {
        $tickets = Ticket::paginate(10);  // Paginate tickets
        return view('admin.tickets.list', compact('tickets'));
    }
    function ticketsRespond($ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);
        return view('admin.tickets.respond', compact('ticket'));
    }
    // Save the response to a ticket
    public function saveResponse(Request $request, $ticketId)
    {
        $request->validate([
            'reply' => 'required|string|max:255',
            'status' => 'required|in:Open,Closed',
        ]);

        $ticket = Ticket::findOrFail($ticketId);
        $ticket->update([
            'reply' => $request->input('reply'),
            'status' => $request->input('status'),
        ]);

         return redirect()->route('admin.tickets.list')->with('success', 'Response saved successfully.');
     }
    function categories() {
        $categories = FaqCategory::with('children')->whereNull('parent_id')->get();
        $categoriesAll = FaqCategory::all();
        return view('admin.categories', compact('categories','categoriesAll'));
    }
}
