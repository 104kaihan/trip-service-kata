<?php

namespace TripServiceKata\Trip;

use TripServiceKata\User\User;

class TripDAOHelp
{
    /**
     * @param User $user
     *
     * @return Trip[]
     */
    public function findTripsByUser(User $user)
    {
        return TripDAO::findTripsByUser($user);
    }
}
