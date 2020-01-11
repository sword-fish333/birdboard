<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model

{
    public static function boot(){
        parent::boot();

        static::created(function($project){

        });
        
    }
    protected $table='projects';
    protected $guarded=[];

    public function path(){
        return '/projects/'.$this->id;
    }

    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }
//    public function addTask($body){
//        $task=new Task();
//        $task->body=$body;
//        $task->project_id=$this->id;
//        $task->save();
//        return true;
////            $this->tasks->create(compact('body'));
//    }

public function activity(){
        return $this->hasMany(Activity::class);
}
}
