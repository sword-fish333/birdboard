<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProjectRequest;
use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{

//    protected function validateRequest(){
//    return    request()->validate([
//            'title'=>'sometimes|required',
//            'description'=>'sometimes|required|max:150',
//            'notes'=>'nullable'
//        ]);
//    }
    public function index(){

        $projects=auth()->user()->projects;

        return view('projects.index',compact('projects'));
    }

    public function store(UpdateProjectRequest $request,Project $project){

       $project= auth()->user()->projects()->create($request->validated());
//        Project::create($attributes);
        return redirect($project->path());
    }

    public function show(Project $project){

        if(auth()->user()->isNot($project->owner)){
            abort(403);
        }
        return view('projects.show',compact('project'));
    }


    public function update(UpdateProjectRequest $request){




        return redirect( $request->save()->path());
    }
    public function create(){
        return view('projects.create');
    }

    public function edit(Project $project){
        return view('projects.edit',compact('project'));
    }

}
