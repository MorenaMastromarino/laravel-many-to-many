@extends('layouts.admin')

@section('content')
<div class="container">
  <h1>Edit post</h1>
  @if ($errors->any())
    <div class="alert alert-danger" role="alert">
     <ul>
       @foreach ($errors->all() as $error)
        <li>
          {{$error}}
        </li>
       @endforeach
     </ul>
    </div>
  @endif

  <form action="{{route('admin.posts.update', $post)}}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="title" class="form-label">Titolo</label>
      <input type="text" value="{{old('title', $post->title)}}"
        class="form-control @error('title') is-invalid @enderror" 
        id="title" name="title" placeholder="titolo"
      >
      @error('title')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="content" class="form-label">Contenuto</label>
      <textarea class="form-control @error('content') is-invalid @enderror" 
        id="content" name="content" rows="3"
      >{{old('content', $post->content)}}</textarea>

      @error('content')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="category_id" class="form-label">Categoria</label>
      <select name="category_id" id="category_id" class="form-control">
        <option value="">Seleziona la categoria</option>
        @foreach ($categories as $category)
          <option @if ($category->id == old('category_id', $post->category_id)) selected @endif value="{{$category->id}}">
            {{$category->name}}
          </option>            
        @endforeach

      </select>
    </div>

    <div class="mb-3">
      <h5>Tags</h5>
      @foreach ($tags as $tag)
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" 
          name="tags[]" id="tag{{ $loop->iteration }}" value="{{ $tag->id }}"
          @if(! $errors->any() && $post->tags->contains($tag->id))
            checked
          @elseif ($errors->any() && in_array($tag->id, old('tags', [])))
            checked
          @endif>

          <label class="form-check-label" for="tag{{ $loop->iteration }}">
            {{ $tag->name }}
          </label>
        </div>
      @endforeach
 
    </div>

    <button type="submit" class="btn btn-success">EDIT</button>
    <button type="reset" class="btn btn-secondary">RESET</button>
  </form>
  
</div>
@endsection

@section('title')
  | {{$post->title}}
@endsection