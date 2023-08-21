@extends('app')

@section('content')
    <form action="" method="post">
        @csrf
        <input type="email" placeholder="email" name="email">
        <input type="password" placeholder="password" name="password">
        <button type="submit">Masuk</button>
    </form>
    <br><br>
    <a href="/register">Register</a>
@endsection
