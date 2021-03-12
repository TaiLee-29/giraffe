@extends('layout')

@section('content')

    <form action="" method="post">
        @csrf
        <label for="name">Username:</label>
        <input type="name" name="name" id="name">
         <br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password">

         <input type="submit" value="Login">
    </form>

@endsection
