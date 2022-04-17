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
        $tripList = [];
        $loggedUser = $userSessionHelp->getLoggedUser();
        $isFriend = false;
        if ($loggedUser != null) {
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
        } else {
            throw new UserNotLoggedInException();
        }
    }
}
