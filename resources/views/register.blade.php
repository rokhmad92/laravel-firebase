@extends('app')

@section('content')
    <form action="" method="post" id="form">
        @csrf
        <input type="email" placeholder="email" name="email">
        <input type="password" placeholder="password" name="password">
        <button type="submit">Masuk</button>
    </form>
    <br><br>
    <a href="/">masuk</a>
@endsection
