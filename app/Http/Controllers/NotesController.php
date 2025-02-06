<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    public function index()
    {
        $notes = Note::where('user_id', Auth::id())->get()->groupBy('folder');
        return view('user.notes.list', compact('notes'));
    }


     public function store(Request $request)
    {
        $request->validate([
            'note_name' => 'required|string|max:255',
            'folder' => 'required|string|max:255',
            'note' => 'required|string',
        ]);

        $note = new Note;
        if ($request->has('note_id') && $request->note_id) {
            $note = Note::find($request->note_id);
            if (!$note || $note->user_id !== Auth::id()) {
                return redirect()->route('user.notes.list')->with('error', 'Note not found or unauthorized.');
            }
        } else {
            $note->user_id = auth()->id();
            $note->creation_date = now();
        }

        $note->note_name = $request->note_name;
        $note->folder = $request->folder;
        $note->note = $request->note;
        $note->save();

        $message = $request->note_id ? 'Note Updated Successfully' : 'Note Created Successfully';
        flashy()->success($message);
        return redirect()->route('user.notes.list')->with('success', $message);
    }

    public function show($note_id)
    {
        $note = Note::find($note_id);
        if ($note) {
            return response()->json([
                'note_name' => $note->note_name,
                'creation_date' => $note->creation_date->format('d/m/Y'),
                'folder' => $note->folder,
                'note' => $note->note,
            ]);
        } else {
            return response()->json(['error' => 'Note not found'], 404);
        }
    }

    public function update(Request $request, $note_id)
    {
        $note = Note::find($note_id);
        if ($note) {
            $note->note_name = $request->note_name;
            $note->folder = $request->folder;
            $note->note = $request->note;
            $note->save();
        flashy()->success('Note Updated Successfully');
            return redirect()->route('user.notes.list')->with('success', 'Note updated successfully.');
        } else {
            flashy()->error('Unable to Update note try again');
            return redirect()->route('user.notes.list')->with('error', 'Note not found.');
        }
    }
}
