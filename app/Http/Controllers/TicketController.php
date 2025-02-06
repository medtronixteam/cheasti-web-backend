<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function insert(Request $request)
    {
        $Validate = $request->validate([
            'question' => 'required|string|max:255',
            'reply' => 'nullable|string|max:255',

        ]);
        // Create a new ticket
        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'question' => $request->input('question'),
            'reply' => $request->input('reply'),
        ]);
        // return $ticket;

        flashy()->success('✅ Ticket created successfully.', '');
        return redirect()->route('user.ticket');
    }
    public function list()
    {
        $ticketList = Ticket::all();
        return view('user.support.ticket-list', compact('ticketList'));
    }
    public function delete(Request $request)
    {
        $ticket = Ticket::find($request->id);
        if ($ticket) {
            $ticket->delete();
            flashy()->success('✅ Ticket Deleted successfully.', '#');
            return redirect()->back()->with('success', 'Ticket deleted successfully.');
        } else {
            flashy()->success('❌ Ticket Id not found.', '#');
            return redirect()->back()->with('error', 'Ticket not found.');
        }
    }

    public function edit($id){
        $ticket = Ticket::find($id);
        return view('user.support.ticket-edit', compact('ticket'));

    }
    public function update( Request $request, $id){
        $Validate = $request->validate([
            'question' => 'required|string|max:255',
            'reply' => 'nullable|string|max:255',

        ]);
        $ticket = Ticket::find($id);
        if($ticket){
            $ticket->update([
                'question' => $request->input('question'),
                'reply' => $request->input('reply'),
            ]);
            flashy()->success('✅ Ticket Updated successfully.', '#');
            return redirect()->back()->with('success', 'Ticket Updated successfully.');

        }
        else{
            flashy()->success('❌ Ticket Id not found.', '#');
            return redirect()->back()->with('error', 'Ticket Id not found.');
        }


    }
}
