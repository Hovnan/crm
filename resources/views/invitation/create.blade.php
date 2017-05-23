@extends('layouts.header')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <form action="{{ route('register.store') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="email" value="{{ $user->email }}">
                <input type="hidden" name="role" value="{{ $user->role }}">
                <input type="hidden" name="parent" value="{{ $user->user_id }}">
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd" name="password_confirmation">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
    @stop