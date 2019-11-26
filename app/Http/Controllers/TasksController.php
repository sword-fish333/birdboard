<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function store(Project $project){
        if(auth()->user()->isNot($project->owner)){
            abort(403);
        }
        request()->validate(['body'=>['required']]);
        $task=new Task();
        $task->body=request('body');
        $task->project_id=$project->id;
        $task->save();
//        return true;
//        $project->addTask(request(['body']));

        return redirect($project->path());
    }

    public function update(Project $project, Task $task){
        if(auth()->user()->isNot($project->owner)){
            abort(403);
        }
        $task->update([
            'body'=>request('body'),
            'completed'=>request()->has('completed')
        ]);

        return redirect($project->path());
    }
}
