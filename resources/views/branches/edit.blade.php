<h1>Company {{ $branch->company->name  }}</h1>
<h3>Branch {{ $branch->name }}</h3>
<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
</ul>

<form action="{{ route('branches.update', ['branch'=> $branch->id]) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <input type="text" class="form-control" name="name" value="{{ $branch->name }}">
    <input type="text" class="form-control" name="address" value="{{ $branch->address }}">
    <input type="submit" class="form-control" value="Update">
</form>
