<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_admin_can_access_admin_log_in(){

        $this->withoutExceptionHandling();  // prevents laravel from covering errors and gives the details of errors

        //test that you can access route and see admin login
        $response = $this->get('/admin');

        $response->assertStatus(200);

    }

    public function test_that_admin_can_log_in(){

        $this->withoutExceptionHandling();  // prevents laravel from covering errors and gives the details of errors

        //test that you can access route and see admin login
        //$response = $this->post('/admin');

        //post request to add admin data to database
        $response = $this->post('/admin', [
            'employee_id'=> 'hshshshs',
            'employee_first_name' =>'Anoma',
            'employee_last_name'  => 'helNjiks',
        ]);

        //assert that a sucess response was gotten from insert post request above
        $response->assertOk();

        $response->assertStatus(200);

    }

}
