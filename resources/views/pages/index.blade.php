@extends('layout')

@section('content')
    @foreach($posts as $post)

    <h1><a href="{{route('show', $post)}}">{{$post->title}}</a></h1>
    </a></p>@can('update',$post)<td><form action="{{route('edit', $post->id )}}" >
            <input type="submit" value="update" >@csrf</form>
    </td>@endcan @can('delete',$post)<td><form action="{{route('delete', $post )}}" method="post">@method('delete')
            <input type="submit" value="delete" >@csrf</form></td>@endcan
    <p><a href="{{route('post-by-author', $post->user->id)}}">{{$post->user->name}}</a>
    <p>{{$post->created_at->diffforhumans()}}</p>

    <p>{{$post->description}}</p>

@endforeach
    @include('paginate', ['pages' =>$posts])
@endsection

