<?php

namespace Test\TripServiceKata\Trip;

use PHPUnit\Framework\TestCase;
use TripServiceKata\Exception\UserNotLoggedInException;
use TripServiceKata\Trip\Trip;
use TripServiceKata\Trip\TripDAOHelp;
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
        $this->target = new TripService(new TripDAOHelp());
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

    public function testShould_Not_Return_Trips_When_Logged_User_Are_Not_Friend()
    {
        $expected = [];

        $mockUserSession = $this->createMock(UserSessionHelp::class);
        $mockUserSession->method('getLoggedUser')
            ->willReturn(new User('Logged_one'));

        $someOne = new User('Some_one');
        $someOne->addFriend(new User('aFriend'));
        $someOne->addTrip(new Trip());
        $actual = $this->target->getTripsByUser($someOne, $mockUserSession);

        $this->assertSame($expected, $actual);
    }

    public function testShould_Return_Trips_When_Logged_User_Are_Friend()
    {
        $expected = 1;

        $mockUserSession = $this->createMock(UserSessionHelp::class);
        $mockUserSession->method('getLoggedUser')
            ->willReturn($loggedOne = new User('Logged_one'));

        $someOne = new User('Some_one');
        $someOne->addFriend(new User('aFriend'));
        $someOne->addFriend($loggedOne);
        $someOne->addTrip(new Trip());

        $mockTripDAO = $this->createMock(TripDAOHelp::class);
        $mockTripDAO->method('findTripsByUser')
            ->willReturn($someOne->getTrips());

        $target = new TripService($mockTripDAO);
        $actual = $target->getTripsByUser($someOne, $mockUserSession);

        $this->assertSame($expected, count($actual));
    }
}
