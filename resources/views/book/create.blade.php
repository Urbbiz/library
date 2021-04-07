


@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Add new Book</div>
               <div class="card-body">
                <form method="POST" action="{{route('book.store')}}">
                <div class="form-group">
                        <label>Title: </label>
                        <input type="text" class="form-control" name="book_title" value="{{old('book_title')}}">
                        <small class="form-text text-muted">Please enter book title.</small>
                    </div>
                    <div class="form-group">
                        <label>ISBN: </label>
                        <input type="text" class="form-control" name="book_isbn"  value="{{old('book_isbn')}}">
                        <small class="form-text text-muted">Please enter ISBN.</small>
                    </div>
                    <div class="form-group">
                        <label>Pages </label>
                        <input type="text" class="form-control" name="book_pages" value="{{old('book_pages')}}">
                        <small class="form-text text-muted">Please enter pages count.</small>
                    </div>
                    <div class="form-group">
                        <label>About </label>
                        <textarea name="book_about" value="{{old('book_about')}}" id="summernote"> </textarea>
                        <small class="form-text text-muted">About this book.</small>
                    </div>
                    <div class="form-group">
                        <label>Author: </label>
                        <select name="author_id">
                            @foreach ($authors as $author)
                                <option value="{{$author->id}}">{{$author->name}} {{$author->surname}}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Please please select author name.</small>
                    </div>

                    @csrf
                    <button class="btn btn-primary" type="submit">ADD</button>
                    </form>

               </div>
           </div>
       </div>
   </div>
</div>

<script>
$(document).ready(function() {
   $('#summernote').summernote();
 });
</script>

@endsection
