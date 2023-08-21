@extends('app')

@section('content')
    <p>kirim notif</p>
    <br>
    <form action="" method="post">
        @csrf
        <input type="text" placeholder="title" name="title">
        <input type="text" placeholder="isinya" name="isi">
        <button type="submit">Kirim</button>
    </form>
    <br><br>
@endsection
