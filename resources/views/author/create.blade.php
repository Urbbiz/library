

@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Create New Author</div>

               <div class="card-body">
                 <form method="POST" action="{{route('author.store')}}">
                    <div class="form-group">
                        <label>Name: </label>
                        <input type="text" class="form-control" name="author_name" value="{{old('author_name')}}">
                        <small class="form-text text-muted">Please enter new author name.</small>
                    </div>
                    
                    <div class="form-group">
                        <label>Surname: </label>
                        <input type="text" class="form-control" name="author_surname" value="{{old('author_surname')}}" >
                        <small class="form-text text-muted">Please enter new author surname.</small>
                    </div>
                     @csrf
                     <button class="btn btn-primary" type="submit">ADD</button>
                  </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
