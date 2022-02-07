@extends('layouts.admin')

@section('content')
<div class="container">
  @if (session('deleted'))
    <div class="alert alert-success" role="alert">
      {{session('deleted')}}
    </div>
  @endif

  <h1>Elenco post</h1>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Titolo</th>
        <th scope="col">Categoria</th>
        <th scope="col">Tag</th>
        <th scope="col" colspan="3">Azioni</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($posts as $post)
        <tr>
          <th scope="row">{{$post->id}}</th>
          <td>{{$post->title}}</td>
          <td>
            @if ($post->category)
              {{$post->category->name}}
            @else
              -
            @endif
          </td>
          <td>
            @forelse ($post->tags as $tag)
            <span class="badge bg-primary text-light">{{ $tag->name }}</span>
            @empty
              -
            @endforelse
          </td>
          <td><a class="btn btn-success" href="{{route('admin.posts.show', $post)}}">SHOW</a></td>
          <td><a class="btn btn-info" href="{{route('admin.posts.edit', $post)}}">EDIT</a></td>
          <td>
            <form onsubmit="return confirm('Vuoi eliminare il post {{$post->title}}?')" action="{{route('admin.posts.destroy', $post)}}" method="POST">
              @csrf
              @method('DELETE')
                <button type="submit" class="btn btn-danger">DELETE</button>
            </form>
          </td>
        </tr>
        
      @endforeach
      
    </tbody>
  </table>

  {{$posts->links()}}

  <div>
    @foreach ($categories as $category)
      <h2>{{$category->name}}</h2>
      <ul>
        @foreach ($category->posts as $post)
          <li><a href="{{route('admin.posts.show', $post)}}">{{$post->title}}</a></li>
        @endforeach
      </ul>
    @endforeach
  </div>
</div>
@endsection

@section('title')
  | Elenco post
@endsection