<?php

declare(strict_types=1);

namespace BotMaker\UserBundle\Service;

use BotMaker\UserBundle\Model\User;

class UserService
{
    public function getUserById(): User
    {
        return new User();
    }

}