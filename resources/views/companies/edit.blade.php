<h1>Company {{ $company->name  }}</h1>
<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
</ul>

<form action="{{ route('companies.update', ['company'=> $company->id]) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <input type="text" class="form-control" name="name" value="{{ $company->name }}">
    <input type="text" class="form-control" name="domain" value="{{ $company->domain }}">
    <input type="submit" class="form-control" value="Update">
</form>
