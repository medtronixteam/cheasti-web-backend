    @extends('layouts.app')

    @section('content')
    <div class="container col-6 mt-5 offset-md-3">
        <h2 class="text-black mb-4">Create Manager</h2>
        <form action="{{ route('user.manager.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mt-2">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" required style="background-color: rgba(242, 242, 242, 1);">
            </div>
            <div class="form-group mt-2">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required style="background-color: rgba(242, 242, 242, 1);">
            </div>
            <div class="form-group mt-2">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required style="background-color: rgba(242, 242, 242, 1);">
            </div>
            <div class="form-group mt-2">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image" name="image" required>
            </div>
            <div class="form-group mt-2">
                <label for="role">Role</label>
                <select class="form-control" id="role" name="role" required style="background-color: rgba(242, 242, 242, 1);">
                    <option value="Manager">Manager</option>
                    <option value="Agent">Agent</option>
                    <option value="User">User</option>
                    <option value="Custom">Custom</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Create</button>
        </form>
    </div>
    @endsection
