<?php

declare(strict_types=1);

namespace TripServiceKata\User;

class UserSessionHelp
{
    /**
     * @return User|null
     */
    public function getLoggedUser()
    {
        return UserSession::getInstance()->getLoggedUser();
    }
}
