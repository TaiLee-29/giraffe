@extends('layout')

@section('content')
<br><br><br>
    <form action="" method="post">@csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{$post->title}}" >
        </div>
        <div class="input-group">
            <span class="input-group-text">Description</span>
            <textarea class="form-control" name="description"  aria-label="Description" >{{$post->description}}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
