<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Admin;
use Faker\Generator as Faker;

class CreateAdminTest extends TestCase
{
//./vendor/bin/phpunit --filter test_that_an_admin_can_be_added

    use RefreshDatabase; //refresh database before every single test

    use  DatabaseMigrations;


    protected $faker;

    /**
     * Set up the test
     */
    /*
    public function setUp()
    {
        parent::setUp();
        $this->faker = Faker::create();
    } */

    /**
     * Reset the migrations
     */
    /*
    public function tearDown()
    {
        $this->artisan('migrate:reset');
        parent::tearDown();
    }  */

    /** @test */
    public function test_that_an_admin_can_be_added(){

         $this->withoutExceptionHandling();  // prevents laravel from covering errors and gives the details of errors

         //$faker= new Faker();

          //post request to add admin data to database
         $response = $this->post('/admin/store', [
                'employee_id'=> 'hshshshs',//$faker->uuid,
                'employee_first_name' =>'Anoma',
                'employee_last_name'  => 'helNjiks',//$faker->name,
                'employee_email'  => 'njs@yh.cm',//$faker->email,
                'employee_password'  => 'XYSSX',//$faker->password,
                'employee_role'  => 1, //$faker->numberBetween(0,4),
                'employee_phone_number'  => '929-29-22',//$faker->phoneNumber,
                'employee_address'  => 'Aberdeen',//$faker->address,
                'employee_status'  =>  1,//$faker->numberBetween(0,5),
                'employee_position' => "CEO",

             ]);

         //assert that a sucess response was gotten from insert post request above
         $response->assertOk();

         //after data is added we expected the database to have a record of the user
         $this->assertCount(1, Admin::all()); //assert that one employee exist after the post


     }
}
