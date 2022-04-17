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
            $isFriend = $this->isFriend($user, $loggedUser);

            return $isFriend ? $this->tripDAOHelp->findTripsByUser($user) : [];
        }

        throw new UserNotLoggedInException();
    }

    /**
     * @param User $user
     * @param User $loggedUser
     *
     * @return bool
     */
    public function isFriend(User $user, User $loggedUser): bool
    {
        $isFriend = false;
        foreach ($user->getFriends() as $friend) {
            if ($friend == $loggedUser) {
                $isFriend = true;
                break;
            }
        }

        return $isFriend;
    }
}
