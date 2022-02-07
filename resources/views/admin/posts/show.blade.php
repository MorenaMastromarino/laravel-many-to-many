@extends('layouts.admin')

@section('content')
<div class="container">
  <h1>{{$post->title}}</h1>

  @if ($post->category)
    <h4>Categoria: {{$post->category->name}}</h4>
  @endif

  @forelse ($post->tags as $tag)
    <span class="badge bg-primary text-light">{{ $tag->name }}</span>
  @empty
    -
  @endforelse

  <p>{{$post->content}}</p>

  <div class="row">
    <a class="btn btn-info mr-3" href="{{route('admin.posts.edit', $post)}}">EDIT</a>
    <form onsubmit="return confirm('Vuoi eliminare il post {{$post->title}}?')"
       action="{{route('admin.posts.destroy', $post)}}" method="POST">
      @csrf
      @method('DELETE')
        <button type="submit" class="btn btn-danger">DELETE</button>
    </form>

  </div>
  <a href="{{ route('admin.posts.index') }}">Torna all'elenco</a>
</div>
@endsection


@section('title')
  | {{$post->title}}
@endsection
