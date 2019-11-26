@extends('layouts.app')
@section('content')
    <h1>Create a project</h1>
<form action="/projects" method="post" class="container">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" >
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Salveaza</button>
            <a href="/projects">Cancel</a>
        </div>
    </div>
</form>

@endsection