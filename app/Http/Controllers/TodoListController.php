<?php
namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function index()
    {
        $todos = TodoList::where('user_id', auth()->id())->get();
        return view('user.todo.list', compact('todos'));
    }

  public function store(Request $request)
{
    $request->validate([
        'task' => 'required|string|max:255',
        'categories' => 'required|string|max:255',
         'reminder' => 'nullable|in:1h,2h,3h',
        // other validation rules...
    ]);

    TodoList::create([
        'user_id' => auth()->id(),
        'categories' => $request->categories,
        'task' => $request->task,
        'due_date' => $request->date,
        'due_time' => $request->time,
        'reminder' => $request->reminder,
        'repeat_daily' => $request->has('repeat_daily'),
        'is_completed' => false,
    ]);
flashy()->success('Todo Created Successfully');
    return redirect()->route('user.todo.list');
}

public function update(Request $request, TodoList $todo)
{
    $request->validate([
        'task' => 'required|string|max:255',
        'categories' => 'required|string|max:255',
        'reminder' => 'nullable|in:1h,2h,3h',
        // other validation rules...
    ]);

    $todo->update([
        'task' => $request->task,
        'categories' => $request->categories,
        'due_date' => $request->date,
        'due_time' => $request->time,
        'reminder' => $request->reminder,
        'repeat_daily' => $request->has('repeat_daily') ? 1 : 0,
        'is_completed' => $request->has('is_completed'),
    ]);

    flashy()->success('Todo Updated Successfully');
    return redirect()->route('user.todo.list');
}



    public function destroy(TodoList $todo)
    {
        $todo->delete();
        flashy()->success('Todo Deleted Successfully');
        return redirect()->route('user.todo.list');
    }
}
