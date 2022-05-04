<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;
use App\Models\TrackRequest;
use Auth;
use Symfony\Component\HttpFoundation\Response;



class UserTest extends TestCase
{
    use DatabaseMigrations;
    private $trackreqs;

    public function setup(): void {
        parent::setUp();
        $this->trackreqs = factory(TrackRequest::class)->create();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_see_all_request()
    {
        $this->authenticate(); //we have authenticated user
        $response = $this->get('/api/v1/all-request');
        
        $response->assertStatus(200);
    }


    public function test_authenticated_user_can_store_a_request()
    {
        $this->authenticate(); //we have authenticated user
        
        $response = $this->post('/api/v1/store-request/', $this->trackreqs->toArray() );
    
        $this->assertDatabaseHas('users', $this->trackreqs->toArray() );
    }

    public function test_authenticated_user_can_make_update_a_request()
    {
        $this->authenticate(); 
        $response = $this->post('/api/v1/update-request/', $this->trackreqs->id );
        $response->assertStatus(200);

    }

    public function test_authenticated_user_can_approve_a_delete_request()
    {
        $this->authenticate(); 
        $response = $this->delete('/api/v1/approve-request/'. $this->trackreqs->id );

        $this->assertDatabaseMissing('/api/v1/request/', ['id' => $this->trackreqs->id ]);
        
    }

    public function test_unauthenticated_user_can_not_see_all_request()
    {
        $response = $this->get('/api/v1/all-request');

        $response->assertStatus(Response::HTTP_UNAUTHORIZED); 

    }





}



