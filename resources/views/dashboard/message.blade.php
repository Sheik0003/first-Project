@extends('layouts.app')

@section('title', 'Create a New Message')

@section('content')
<div class="container">
    <h3 style="text-align:center; margin-top:40px; margin-bottom:20px;">Create a New Message</h3>

    @if(session('success'))
    <div id="success-message" class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
    <div id="error-message" class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('message.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image"><b>Upload Image: </b></label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>

        <div class="form-group">
            <label for="file"><b>Upload Excel File: </b></label>
            <input type="file" class="form-control" id="file" name="file" required>
        </div>

        <div class="form-group">
            <label for="text"><b>Text: </b></label>
            <input type="text" class="form-control" id="text" name="text" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = document.getElementById('success-message');
        const errorMessage = document.getElementById('error-message');

        if (successMessage) {
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 2500);
        }

        if (errorMessage) {
            setTimeout(() => {
                errorMessage.style.display = 'none';
            }, 2500);
        }
    });
</script>
@endsection