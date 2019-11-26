<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
    @test
     */

    public function has_projects()
    {
        $user=factory(User::class)->create();

        $this->assertInstanceOf(Collection::class,$user->projects);
    }
}
