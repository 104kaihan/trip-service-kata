<?php

namespace Test\TripServiceKata\Trip;

use PHPUnit\Framework\TestCase;
use TripServiceKata\Trip\TripService;

class TripServiceTest extends TestCase
{
    /**
     * @var TripService
     */
    private $target;

    protected function setUp()
    {
        $this->target = new TripService;
    }

    public function testShould_Throw_Exception_When_User_Is_Not_LoggedIn()
    {
        $this->fail('This test has not been implemented yet.');
    }

    public function testShould_Not_Return_Trips_When_Logged_User_Are_Not_Friend()
    {
    }

    public function testShould_Return_Trips_When_Logged_User_Are_Friend()
    {

    }
}
