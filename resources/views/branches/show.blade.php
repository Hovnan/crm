@extends('layouts.master')
@section('content')
<h1>Branch {{ $branch->name }}</h1>
<h3>Branches Company name is {{ $branch->company->name }}</h3>
<h1>Branch </h1>
<p><a class="btn btn-danger" href="{{ route('branches.edit', ['branch'=> $branch->id]) }}">Edit</a></p>
<p><a href="#">Delete</a></p>
<a href="{{ route('branches.edit', ['branch'=> $branch->id]) }}">Invite Adim</a>
<ul>
    <h3>Admin list</h3>
@foreach($branch->users as $user)
    <li>{{ $user->first_name . ' ' . $user->last_name . ' (' . $user->roles()->first()->slug . ')' }}</li>
@endforeach
</ul>
    @stop
