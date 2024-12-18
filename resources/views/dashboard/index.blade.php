@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container mt-5">
        <h3 style="text-align: center;">Settings Page</h3>
        @if(session('success'))
            <div id="success-message" class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('app-settings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="appname"><b>App Name : </b></label>
                <input type="text" id="appname" name="appname" class="form-control" required autocomplete="off">
            </div>
            <div class="form-group">
                <label for="whatsapp_key"><b>WhatsApp Key : </b></label>
                <input type="text" id="whatsapp_key" name="whatsapp_key" class="form-control" required autocomplete="off">
            </div>
            <div class="form-group">
                <label for="logo"><b>Logo : </b></label>
                <input type="file" id="logo" name="logo" class="form-control-file" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 2500); 
            }
        });
    </script>
@endsection