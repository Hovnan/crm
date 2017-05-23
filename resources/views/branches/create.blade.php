<h1>Create new Branch {{ $user->roles()->first()->slug }}</h1>
<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
</ul>

<form action="{{route('branches.store')}}" method="post">
    {{ csrf_field() }}
    <select class="form-control" name="company">
        @foreach($user->companies as $compan)
            <option value="{{ $compan->id }}">{{ $compan->name }}</option>
        @endforeach
    </select>
    <input type="text" name="name">
    <input type="text" name="address">
    <input type="submit" name="Create Branches">
</form>
