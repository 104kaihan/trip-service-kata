<?php

namespace TripServiceKata\Trip;

use TripServiceKata\Exception\UserNotLoggedInException;
use TripServiceKata\User\User;
use TripServiceKata\User\UserSessionHelp;

class TripService
{
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
                $tripList = TripDAO::findTripsByUser($user);
            }

            return $tripList;
        } else {
            throw new UserNotLoggedInException();
        }
    }
}
