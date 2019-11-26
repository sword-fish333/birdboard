@extends('layouts.app')

@section('content')
    <header class="flex items-centered mb-4 py-4">
        <div class="flex justify-between w-full items-end">
<h1 class="text-gray-700"  style="font-size: 32px" >My Projects</h1>
<a href="/projects/create" class="button">Create a project</a>
        </div>
    </header>

    <main class="lg:flex lg:flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6 ">
         @include('projects.card')
            </div>
            @empty
            <div>No projects yet</div>
            @endforelse
    </main>

@endsection