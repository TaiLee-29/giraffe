@extends('layout')

@section('content')


        <h1>{{$post->title}}</h1></a></p><td><form action="{{route('edit', $post->id )}}" >
                <input type="submit" value="update" >@csrf</form>
        </td><td><form action="{{route('delete', $post )}}" method="post">@method('delete')
                <input type="submit" value="delete" >@csrf</form></td>
        <p><a href="{{route('post-by-author', $post->user->id)}}">{{$post->user->name}}</a>
        <p>{{$post->created_at->diffforhumans()}}</p>

        <p>{{$post->description}}</p>

    <br><br>
        <form action="{{route('index')}}" >
            <input type="submit" value="list" >@csrf</form>


@endsection
