<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker,RefreshDatabase;


    /** @test */
    public function a_project_requires_owner(){
        $this->withExceptionHandling();
        $attributes=factory('App\Project')->raw();

        $this->post('/projects',$attributes)->assertRedirect('login');
    }
    /** @test */
    public function guests_may_not_view_projects(){
//        $attributes=factory('App\Project')->raw(['title'=>'']);

        $this->get('/projects')->assertRedirect('login');
    }

    /** @test */
//    public function guests_may_ot_view_a_project(){
////        $attributes=factory('App\Project')->raw(['title'=>'']);
//
//        $this->get('/projects')->assertRedirect('login');
//    }


    /** @test */
    public function a_user_can_create_a_project(){

        $this->withoutExceptionHandling();
        $this->actingAs(factory(User::class)->create());
        $attributes=[
            'title'=>$this->faker->sentence,
            'description'=>$this->faker->paragraph,
        ];
        $this->get('/projects/create')->assertStatus(200);
        $this->post('/projects',$attributes);

        $this->assertDatabaseHas('projects',[

        ]);
    }
    /** @test */
    public function a_project_requires_a_title(){
        $attributes=factory('App\Project')->raw(['title'=>'']);

        $this->post('/projects',$attributes)->assertSee('title');
    }
    /** @test */
    public function a_project_requires_a_description(){
        $attributes=factory('App\Project')->raw(['description'=>'']);

        $this->post('/projects/{project}',$attributes)->assertSee('description');
    }

    /** @test */
    public function a_user_can_view_a_project(){
        $this->withExceptionHandling();
        $this->be(factory(User::class)->create());
      $project=factory('App\Project')->create(['owner_id'=>auth()->id()]);

    $this->get($project->path())->assertSee($project->title)->assertSee($project->description);

    }
    /** @test */
    public function an_auth_user_can_not_view_projects_of_others(){
        $this->withExceptionHandling();
        $this->be(factory(User::class)->create());
        $project=factory('App\Project')->create();
        $this->get($project->path())->assertStatus(403);
    }

}
