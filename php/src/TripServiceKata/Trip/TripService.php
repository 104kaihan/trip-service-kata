<?php

namespace TripServiceKata\Trip;

use TripServiceKata\Exception\UserNotLoggedInException;
use TripServiceKata\User\User;
use TripServiceKata\User\UserSessionHelp;

class TripService
{
    /**
     * @var TripDAOHelp
     */
    private $tripDAOHelp;

    public function __construct(TripDAOHelp $tripDAOHelp)
    {
        $this->tripDAOHelp = $tripDAOHelp;
    }

    public function getTripsByUser(User $user, UserSessionHelp $userSessionHelp)
    {
        $loggedUser = $userSessionHelp->getLoggedUser();

        if ($loggedUser !== null) {
            $tripList = [];
            $isFriend = false;
            foreach ($user->getFriends() as $friend) {
                if ($friend == $loggedUser) {
                    $isFriend = true;
                    break;
                }
            }
            if ($isFriend) {
                $tripList = $this->tripDAOHelp->findTripsByUser($user);
            }

            return $tripList;
        }

        throw new UserNotLoggedInException();
    }
}
