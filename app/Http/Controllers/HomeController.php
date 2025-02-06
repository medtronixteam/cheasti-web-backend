<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Note;
use App\Models\Content;
use App\Models\Category;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        return view('home');
    }
    public function dashboard()
    {
        if (auth()->user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    }
    public function dashboardUser()
    {
        $contents = Content::where('user_id', Auth::id())
        ->with('category') // Eager load the category relationship
        ->whereNotNull('scheduled_at')
        ->get();
        $categories = Category::all(); // Fetch all categories

        $notes = Note::where('user_id', Auth::id())->get();
        $todos = TodoList::where('user_id', Auth::id())->get();
        $user = Auth::user();
        $totalNotes = Note::count();
        // Calculate the remaining days
        $remainingDays = null;
        if ($user->plan_expire_date) {
            $remainingDays = Carbon::now()->diffInDays(Carbon::parse($user->plan_expire_date), false);
        }

        return view('user.dashboard', compact('remainingDays','totalNotes','contents', 'categories', 'notes', 'todos'));
    }

    public function content()
    {
        return view('user.dashboard');
    }

    public function brands()
    {
        return view('user.brands');
    }
    public function shortGenerator(){
        return view('user.shortGenerator');
    }
    public function todo()
    {
        return view('user.dashboard');
    }

    public function notes()
    {
        return view('user.dashboard');
    }

    public function invoices()
    {
        return view('user.dashboard');
    }

    public function managers()
    {
        return view('user.dashboard');
    }

    public function platformLinks()
    {
        return view('user.dashboard');
    }

    public function videoEditor()
    {
        $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJmcmVzaCI6ZmFsc2UsImlhdCI6MTcyMDA5NDg2NCwianRpIjoiYWI4OTQ0MmMtMjFiOC00OWY0LTg3ZTAtMGYzNDkzNTM3YjVmIiwidHlwZSI6ImFjY2VzcyIsInN1YiI6MTgsIm5iZiI6MTcyMDA5NDg2NCwiY3NyZiI6ImNjZjVlMWFiLTc1MzMtNGM0Yi1iZDZkLTM5MDJlM2ZjODM2ZSIsImV4cCI6MTcyMDI2NzY2NH0.8Tms7PgZNxoRvKAwjX9CExZfTeX4catvPn9p2Damjj0";
        return view('user.videoEditor1', compact('token'));
    }


    public function settings()
    {
        return view('user.dashboard');
    }

    public function subscription()
    {

        return view('user.subscription.index');
    }

    public function support()
    {
        $Category = Category::all();
        return view('user.support.asked-question', compact('Category'));
    }
    public function category()
    {
        return view('user.support.categories');
    }

    public function ticket()
    {
        return view('user.support.ticket');
    }
    public function ticket_list()
    {
        return view('user.support.ticket-list');
    }
    public function invoice_create()
    {
        return view('user.invoice.create');
    }

    // Method to show the Reminders page
    public function showReminders()
    {
        return view('user.notification.remainder');
    }

    // Method to show the Calendar page
    public function showCalendar()
    {
        $contents = Content::where('user_id', Auth::id())
        ->with('category') // Eager load the category relationship
        ->whereNotNull('scheduled_at')
        ->get();
        $categories = Category::all(); // Fetch all categories

        $notes = Note::where('user_id', Auth::id())->get();
        $todos = TodoList::where('user_id', Auth::id())->get();

        // return $contents;
        return view('user.calendar.index', compact('contents', 'categories', 'notes', 'todos'));
    }
    public function backupCalendar()
    {
        $contents = Content::where('user_id', Auth::id())
        ->with('category') // Eager load the category relationship
        ->whereNotNull('scheduled_at')
        ->get();
        $categories = Category::all(); // Fetch all categories

        // return $contents;
        return view('user.calendar.backup',compact('contents','categories'));
    }

    public function contentEvents(Request $request)
    {
        $events = Content::where('user_id', Auth::id())
            ->whereNotNull('scheduled_at')
            ->get(['video_id', 'title', 'scheduled_at']);

        return response()->json($events);
    }
}
