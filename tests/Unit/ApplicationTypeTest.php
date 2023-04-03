<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Services\LoanService;
use App\Repositories\LoanRepository;

class ApplicationTypeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_group_member_application()
    {

        $this->assertTrue(LoanService::isGroupMemberApplication('REQ-5134794'));

    }
}
