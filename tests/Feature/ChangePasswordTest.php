<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;


class ChangePasswordTest extends TestCase
{

    use RefreshDatabase; //refresh database before every single test
    use  DatabaseMigrations;

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

    public function test_that_user_can_change_password(){



        $this->withoutExceptionHandling();  // prevents laravel from covering errors and gives the details of errors

        /*
         * a test in this case  will
         * test that password exist
         * test that password that is given is not the same as the one that exist
         * test that password strength is strong
         * test that password is updated
         */

        //post request to add admin data to database
        $response = $this->put('/change-password', [
            'password'=> 'fakepassword',
        ]);

        //assert that a sucess response was gotten from insert post request above
        $response->assertOk();

    }

    public function test_that_only_authenticated_users_can_change_password(){
        //create acting user
        $this->actingAs(factory(User::class)->create());
        $this->get('/change-password')->assertOk();
    }

    /*
     * check that view exist
     */
    public function test_that_user_can_view_change_password_form()
    {
        $response = $this->get('/change-password');

        $response->assertSuccessful(); //check that route exist
        $response->assertViewIs('user-password-change'); //check that view exist
    }


}
