@extends('layout')

@section('content')
    @error('not_allowed')
    <div class="alert alert-danger" role="alert">
        {{$message}}
    </div>
    @enderror
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{\Illuminate\Support\Facades\Session::get('success')}}
        </div>
    @endif
    @forelse($posts as $post)
        <div class="card" style="margin-bottom: 20px">
            <div class="card-body">
                <h5 class="card-title">{{$post->title}}</h5>
                <p class="card-text">{{$post->description}}</p>
            </div>
            @if(array_key_first($post->tags()->pluck('tag')->toArray()) !== null)
                <div class="card-footer text-muted">
                    <h5>Tags</h5>
                    @foreach($post->tags()->pluck('tag') as $tag)
                        "{{$tag}}"
                    @endforeach
                </div>
            @endif
            <div class="card-footer text-muted">
                {{$post->created_at->diffForHumans()}} by {{$post->user->name}}
            </div>
            @can('delete', $post)
                <a href="{{route('delete',[$post->id])}}" class="btn btn-primary">Delete</a>
                <a href="{{route('update',[$post->id])}}" class="btn btn-primary">Update</a>
            @endcan
        </div>
    @empty
        <p>No Ads.</p>
    @endforelse
    <a href="{{$posts->previousPageUrl()}}" class="btn btn-primary">Previous</a>
    <a href="{{$posts->nextPageUrl()}}" class="btn btn-primary">Next</a>
@endsection
