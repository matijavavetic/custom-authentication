@extends('layouts.app')
@section('content')

    <h2>Lost password</h2>

    <form method="POST" action="/password/email">
        @csrf

        <div class="form-group">
            <label for="email">Enter your e-mail address:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Send</button>
        </div>

    </form>

    @include('partials.formerrors')

@endsection