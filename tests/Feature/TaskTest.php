<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;


    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function a_project_can_have_tasks(){
        $this->withExceptionHandling();
        $this->signIn();
        $project=factory('App\Project')->create(['owner_id'=>auth()->user()->id]);

        $this->post($project->path().'/tasks',['body'=>'Lorem ipsum']);

        $this->get($project->path())->assertSee('Lorem ipsum');
    }

    public function only_owner_can_add_tasks(){

        $this->signIn();
        $project=factory('App\Project')->create();
        $this->post($project->path().'/tasks')->assertStatus(403);

    }
    /** @test */
    public function only_owner_can_update(){
        $this->withExceptionHandling();
//        $this->singIn();

        $project=factory(Project::class)->create();
        $task=$project->addTask('task task');
        $this->patch($project->path().'/tasks'. $task->id,['body'=>'update'])->assertStatus(403);

    }
}

