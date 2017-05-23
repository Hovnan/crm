@extends('layouts.master')
@section('content')
<h3>{{ $company->name }}</h3>
<a href="{{ route('companies.edit', ['company'=> $company->id]) }}">Edit Company</a>
<ul>
    @foreach($company->branches as $branch)

        <li><a href="{{ route('branches.show', ['branch'=> $branch->id]) }}">{{ $branch->name }} </a><button class="btn btn-success">Attach admin</button> <button class="btn btn-primary">Attach Manager</button></li>

    @endforeach
</ul>
    @stop