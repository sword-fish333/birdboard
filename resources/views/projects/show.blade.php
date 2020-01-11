@extends('layouts.app')
@section('content')
    <header class="lg:flex items-center mb-4 py-4">
        <div class="flex justify-between w-full items-end">
            <p class="text-gray-700"  style="font-size: 28px" ><a href="/projects">My Projects</a> / {{$project->title}}</p>

            {{--<a href="/projects/create" class="button">Create a project</a>--}}
        </div>
        <a href="{{$project->path().'/edit'}}" class="button text-center" style="width: 100px">Edit Project</a>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-8">
                <div class="mb-6">
            <h2 class="text-gray-700"  style="font-size: 18px" >Tasks</h2>
                    @foreach($project->tasks as $task)
                <div class="card my-3">
                    <form action="{{$task->path()}}" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="flex">
                        <input type="text" value="{{$task->body}}" name="body" class="w-full" style="color: {{$task->completed ? 'gray' : ''}}">
                        <input type="checkbox" name="completed" onchange="this.form.submit()" {{$task->completed ? 'checked' : ''}}>
                        </div>
                    </form>
                </div>

                        @endforeach
                    <form action="{{$project->path().'/tasks'}}" method="post">
                        @csrf
                        <div class="card my-3"><input type="text" placeholder="Begin adding tasks..." class="w-full" name="body"></div>
                    </form>
                </div>
                <div class="mb-8">
                <h2 class="text-gray-700"  style="font-size: 18px" >General notes</h2>
                    <form action="{{$project->path()}}" method="post">
                        @csrf
                        @method('patch')
        <textarea class="card w-full" name="notes" style="min-height: 200px;">{{$project->notes}}</textarea>
                        <button type="submit" class="button">Submit</button>
                    </form>

                    @if ($errors->any())
                        <div class="field mt-6">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm " style="color: red">{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
            </div>
            </div>
<div class="lg:w-1/4 px-3 mt-6">
    @include('projects.card')

</div>
        </div>
    </main>


@endsection