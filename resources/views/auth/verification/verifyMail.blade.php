@extends('layouts.app')

@section('content')

    <h2>Mail confirmation</h2>

    <form method="POST" action="/confirmation/{{ $token }}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="email">Please confirm your e-mail address:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>


        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>

@endsection