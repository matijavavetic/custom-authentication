@extends('layouts.app')

@section('content')

    <h2>Reset password</h2>

    <form method="POST" action="/password/reset/{{$token}}">
        @csrf

        <div class="form-group">
            <label for="password">New password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm new password:</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Reset password</button>
        </div>

        @include('partials.formerrors')

    </form>

@endsection