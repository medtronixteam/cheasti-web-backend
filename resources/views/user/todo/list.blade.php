@extends('layouts.app')
@section('title')
Todo

@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 d-none d-md-block sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <h5 class="text-black">Categories</h5>
                    @foreach(['Today', 'Personal', 'Road Trip', 'House', 'Work'] as $category)
                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle text-black d-flex justify-content-between align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span><i class="mdi mdi-bell-outline"></i> {{ $category }} </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                @foreach($todos->where('categories', $category) as $todo)
                                <a class="dropdown-item d-block" href="#">{{ $todo->task }}</a>
                                @endforeach
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-9 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h2 class="text-black">To do List</h2>
                <button class="btn btn-primary" id="showFormBtn">Create New To do</button>
            </div>

            <ul class="list-group mb-3">
                @foreach($todos as $todo)
                <li class="d-flex justify-content-between align-items-center todo-item my-2">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="form-check-input" id="todo{{ $todo->todo_id }}" {{ $todo->is_completed ? 'checked' : '' }}>
                        <label class="custom-control-label text-black" for="todo{{ $todo->todo_id }}">{{ $todo->task }}</label>
                        <br><small class="text-muted">{{ $todo->due_date ? \Carbon\Carbon::parse($todo->due_date)->format('m/d/y') : '' }}{{ $todo->due_time ? ', ' . \Carbon\Carbon::parse($todo->due_time)->format('g:i A') : '' }}</small>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-outline-secondary custom-button edit-button" data-id="{{ $todo->todo_id }}" data-task="{{ $todo->task }}" data-categories="{{ $todo->categories }}" data-due_date="{{ $todo->due_date }}" data-due_time="{{ $todo->due_time }}" data-reminder="{{ $todo->reminder }}" data-repeat_daily="{{ $todo->repeat_daily }}"><span class="mdi mdi-file-edit-outline"></span></button>
                        <form method="POST" action="{{ route('user.todos.destroy', $todo->todo_id) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger custom-button"><span class="mdi mdi-trash-can-outline"></span></button>
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
        </main>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal" id="todoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background:white;">
            <div class="modal-header">
                <h5 class="modal-title text-black">Edit To do</h5>
            </div>
            <div class="modal-body">
                <form id="todoForm" method="POST" action="">
                    @csrf
                    <input type="hidden" id="todoId" name="todo_id" value="">
                    <input type="hidden" name="_method" value="patch">

                    <div class="form-group mt-2">
                        <label for="taskInput">Task:</label>
                        <input type="text" class="form-control" id="taskInput" name="task" placeholder="Enter task">
                    </div>
                    <div class="form-group mt-2">
                        <label for="categorySelect">Category:</label>
                        <select class="form-control" id="categorySelect" name="categories">
                            @foreach(['Today', 'Personal', 'Road Trip', 'House', 'Work'] as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form row mt-3">
                        <div class="form-group col-md-4">
                            <input type="checkbox" class="form-check-input" id="dateCheckbox">
                            <label for="dateInput">Date:</label>
                            <input type="date" class="form-control" id="dateInput" name="date" style="background: transparent;margin-top:5px;">
                        </div>
                        <div class="form-group col-md-4">
                            <input type="checkbox" class="form-check-input" id="timeCheckbox">
                            <label for="timeInput">Time:</label>
                            <input type="time" class="form-control" id="timeInput" name="time" style="background: transparent;margin-top:5px;">
                        </div>
                        <div class="form-group col-md-4">
                            <input type="checkbox" class="form-check-input" id="reminderSelectCheckbox">
                            <label for="reminderSelect">Reminder:</label>
                            <select class="form-control" id="reminderSelect" name="reminder" style="background: transparent; margin-top:5px;">
                                <option value="">None</option>
                                <option value="1h">1 hour before</option>
                                <option value="2h">2 hours before</option>
                                <option value="3h">3 hours before</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-check mt-3">
                        <input type="checkbox" class="form-check-input" id="repeatDailyCheck" name="repeat_daily">
                        <label for="repeatDailyCheck">Repeat Daily</label>
                    </div>
                    <div class="col-12 d-flex justify-content-end px-4">
                        <button type="button" class="btn btn-secondary mx-2" id="cancelBtn">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- create modal -->
<div class="modal" id="todoModal2" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background:white;">
            <div class="modal-header">
                <h5 class="modal-title text-black">New To do</h5>
            </div>
            <div class="modal-body">
                <form id="todoForm2" method="POST" action="{{ route('user.todos.store') }}">
                    @csrf
                    <input type="hidden" id="todoId2" name="todo_id" value="">
                    <input type="hidden" name="_method" value="POST">

                    <div class="form-group mt-2">
                        <label for="taskInput2">Task:</label>
                        <input type="text" class="form-control" id="taskInput2" name="task" placeholder="Enter task">
                    </div>
                    <div class="form-group mt-2">
                        <label for="categorySelect2">Category:</label>
                        <select class="form-control" id="categorySelect2" name="categories">
                            @foreach(['Today', 'Personal', 'Road Trip', 'House', 'Work'] as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form row mt-3">
                        <div class="form-group col-md-4">
                            <input type="checkbox" class="form-check-input" id="dateCheckbox2">
                            <label for="dateInput2">Date:</label>
                            <input type="date" class="form-control" id="dateInput2" name="date" style="background: transparent;margin-top:5px;">
                        </div>
                        <div class="form-group col-md-4">
                            <input type="checkbox" class="form-check-input" id="timeCheckbox2">
                            <label for="timeInput2">Time:</label>
                            <input type="time" class="form-control" id="timeInput2" name="time" style="background: transparent;margin-top:5px;">
                        </div>
                        <div class="form-group col-md-4">
                            <input type="checkbox" class="form-check-input" id="reminderSelectCheckbox2">
                            <label for="reminderSelect2">Reminder:</label>
                            <select class="form-control" id="reminderSelect2" name="reminder" style="background: transparent; margin-top:5px;">
                                <option value="">None</option>
                                <option value="1h">1 hour before</option>
                                <option value="2h">2 hours before</option>
                                <option value="3h">3 hours before</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-check mt-3">
                        <input type="checkbox" class="form-check-input" id="repeatDailyCheck2" name="repeat_daily">
                        <label for="repeatDailyCheck2">Repeat Daily</label>
                    </div>
                    <div class="col-12 d-flex justify-content-end px-4">
                        <button type="button" class="btn btn-secondary mx-2" id="cancelBtn2">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const cancelBtn = document.getElementById('cancelBtn');
    const editButtons = document.querySelectorAll('.edit-button');
    const todoModal = document.getElementById('todoModal');
    const todoForm = document.getElementById('todoForm');

    cancelBtn.addEventListener('click', function() {
        $('#todoModal').modal('hide');
    });

    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const todoId = this.dataset.id;
            document.getElementById('todoId').value = todoId;
            document.getElementById('taskInput').value = this.dataset.task;
            document.getElementById('categorySelect').value = this.dataset.categories;
            document.getElementById('dateInput').value = this.dataset.due_date;
            document.getElementById('timeInput').value = this.dataset.due_time;
            document.getElementById('reminderSelect').value = this.dataset.reminder;
            document.getElementById('repeatDailyCheck').checked = this.dataset.repeat_daily == 1;

            // Set the action and method for the form dynamically
            document.querySelector('input[name="_method"]').value = 'PATCH';
            todoForm.action = "{{ route('user.todos.update', '') }}" + '/' + todoId;
            $('#todoModal').modal('show');
        });
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const showFormBtn = document.getElementById('showFormBtn');
    const todoModal2 = document.getElementById('todoModal2');
    const todoForm2 = document.getElementById('todoForm2');

    showFormBtn.addEventListener('click', function() {
        todoForm2.reset();
        document.querySelector('input[name="_method"]').value = 'POST';
        todoForm2.action = "{{ route('user.todos.store') }}";
        $('#todoModal2').modal('show');
    });
});
</script>




@endsection
