<h1>Companie List</h1>
<p><a href="">Edit</a></p>
<p><a href="">Delete</a></p>
<ul>
@foreach($user->companies as $company)
    <li><a href="{{ route('companies.show', ['id'=> $company->id]) }}">{{ $company->name }}</a></li>
@endforeach
</ul>
<hr>

<form action="/companies" method="post">
    {{ csrf_field() }}
    <input type="text" name="name">
    <input type="submit" name="Create companies">
</form>

<h3>Set Admin</h3>
<form action="" method="post">
    {{ csrf_field() }}
    <input type="text" name="admin_email">
    <input type="submit" name="Create companies">
</form>
