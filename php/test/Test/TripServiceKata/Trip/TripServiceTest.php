<?php

namespace Test\TripServiceKata\Trip;

use PHPUnit\Framework\TestCase;
use TripServiceKata\Exception\UserNotLoggedInException;
use TripServiceKata\Trip\TripService;
use TripServiceKata\User\User;
use TripServiceKata\User\UserSessionHelp;

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
        $this->expectException(UserNotLoggedInException::class);

        $mockUserSession = $this->createMock(UserSessionHelp::class);
        $mockUserSession->method('getLoggedUser')
            ->willReturn(null);

        $someOne = new User('Some_one');
        $this->target->getTripsByUser($someOne, $mockUserSession);
    }

//    public function testShould_Not_Return_Trips_When_Logged_User_Are_Not_Friend()
//    {
//    }
//
//    public function testShould_Return_Trips_When_Logged_User_Are_Friend()
//    {
//
//    }
}
