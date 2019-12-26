<?php

/**
 * The abstract class AdminBase contains common logic for admin panel controllers
 */
abstract class AdminBase
{

    /**
     * Checks if user is an admin
     * @return boolean
     */
    public function __construct()
    {
        $userId = User::checkLogged();

        $user = User::getUserById($userId);

        if ($user['role'] == 'admin') {
            return true;
        }

        die('Access denied');
    }

}
