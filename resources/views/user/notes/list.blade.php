@extends('layouts.app')
@section('title')
Notes

@endsection

@section('content')
<div class="container-fluid" style="padding-left:5px;">
    <div class="row">
        <div class="col-3" >
            @foreach($notes as $folder => $folderNotes)
                <h5 class="text-black fw-bold">{{ $folder }} </h5>
                <ul class="list-group mb-4" id="notes-list-{{ $folder }}">
                    @foreach($folderNotes as $note)
                        <li class="list-group-item" style="border:none;">
                            <a href="#" class="note-link text-black fw-bold" data-id="{{ $note->note_id }}" data-name="{{ $note->note_name }}" data-folder="{{ $note->folder }}" data-note="{{ $note->note }}" data-date="{{ \Carbon\Carbon::parse($note->creation_date)->format('d/m/Y') }}">{{ $note->note_name }}</a>
                            <div class="note-details d-flex" data-id="{{ $note->note_id }}">
                                <p style="display:inline; margin-left: 5px; font-size:14px; color:grey">{{ \Carbon\Carbon::parse($note->creation_date)->format('d/m/Y') }}</p>
                                <p style="display:inline; margin-left: 10px; font-size:14px; white-space:nowrap;" class="note-content text-black">{{ substr($note->note, 0, 20) }}...</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
        <div class="col-1"  ></div>
        <div class="col-8 mt-4" style="border-left: 1px solid #d7d7d7;" id="note-details" >
            @auth
            <button type="button" class="btn btn-primary float-end mb-5" id="create-note-button">Create Note</button>
            @endauth

            <div class="note-detail mt-5" id="note-form" style="display: none;">
                <form id="noteForm" action="{{ route('user.notes.store') }}" method="POST">
                    @csrf
                    <input type="hidden" id="form-method" name="_method" value="POST">
                    <input type="hidden" id="note_id" name="note_id" value="">
                    <div class="mb-5 mt-5">
                        <label for="note_name" class="form-label"><span class="mdi mdi-rename"></span><strong> Name</strong></label>
                        <input type="text" class="form-control border-0 bg-light" id="note_name" name="note_name" value="" required>
                    </div>
                    <div class="mb-5">
                        <label for="note_date" class="form-label pb-1"><span class="mdi mdi-calendar-month-outline "></span> <strong>Date</strong></label>
                        <input type="text" class="form-control border-0 bg-light" id="note_date" name="creation_date" value="{{ now()->format('d/m/Y') }}" readonly>
                    </div>
                    <div class="mb-5">
                        <label for="note_folder" class="form-label pb-1"><span class="mdi mdi-folder"></span><strong> Folder</strong></label>
                        <input type="text" class="form-control border-0 bg-light" id="note_folder" name="folder" value="" required>
                    </div>
                    <div class="mb-5">
                        <label for="note_content" class="form-label pb-1"><span class="mdi mdi-list-box"></span><strong> Note</strong></label>
                        <textarea class="form-control border-0 bg-light" id="note_content" rows="12" name="note" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary float-end mt-4">Save Note</button>
                </form>
            </div>
            <h5 id="select-note-msg" class="text-black" style="display: none;"> </h5>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const noteLinks = document.querySelectorAll('.note-link');
        const noteDetails = document.querySelectorAll('.note-detail');
        const selectNoteMsg = document.getElementById('select-note-msg');
        const createNoteButton = document.getElementById('create-note-button');
        const noteForm = document.getElementById('note-form');
        const formMethod = document.getElementById('form-method');
        const noteIdInput = document.getElementById('note_id');
        const noteNameInput = document.getElementById('note_name');
        const noteFolderInput = document.getElementById('note_folder');
        const noteContentInput = document.getElementById('note_content');
        const noteDateInput = document.getElementById('note_date');

        noteLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const noteId = this.getAttribute('data-id');
                const noteName = this.getAttribute('data-name');
                const noteFolder = this.getAttribute('data-folder');
                const noteContent = this.getAttribute('data-note');
                const noteDate = this.getAttribute('data-date');

                // Set form action and method for editing
                noteForm.querySelector('form').action = `/user/notes/${noteId}`;
                formMethod.value = 'PATCH';
                noteIdInput.value = noteId;
                noteNameInput.value = noteName;
                noteFolderInput.value = noteFolder;
                noteContentInput.value = noteContent;
                noteDateInput.value = noteDate;

                // Hide select note message and other note details
                selectNoteMsg.style.display = 'none';
                noteDetails.forEach(function(detail) {
                    detail.style.display = 'none';
                });

                // Show the note form
                noteForm.style.display = 'block';
            });
        });

        createNoteButton.addEventListener('click', function(e) {
            e.preventDefault();

            // Reset the form for creating a new note
            noteForm.querySelector('form').action = `/user/notes`;
            formMethod.value = 'POST';
            noteIdInput.value = '';
            noteNameInput.value = '';
            noteFolderInput.value = '';
            noteContentInput.value = '';
            noteDateInput.value = '{{ now()->format('d/m/Y') }}';

            // Hide select note message and other note details
            selectNoteMsg.style.display = 'none';
            noteDetails.forEach(function(detail) {
                detail.style.display = 'none';
            });

            // Show the note form
            noteForm.style.display = 'block';
        });

        // Show select note message if no note is selected
        if (!document.querySelector('.note-detail[style="display: block;"]')) {
            selectNoteMsg.style.display = 'block';
        }
    });
</script>
@endsection
