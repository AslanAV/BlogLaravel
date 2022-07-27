@extends('layout')

@section('title', 'Edit Post')

@section('content')

    <form method="post" action="{{ route('update-post', $post->id) }}">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                   aria-describedby="title" value="{{ $post->title}}">
            <div class="invalid-feedback">
                @error('title') {{ $message }} @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Example textarea</label>
                <textarea class="form-control" id="content" rows="3" name="content">{{ $post->content}}</textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Edit</button>
    </form>

@endsection