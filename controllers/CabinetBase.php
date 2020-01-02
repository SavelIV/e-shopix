<?php

/**
 * Abstract class CabinetBase
 * contains common logic for Cabinet controller
 */
abstract class CabinetBase {
     /**
     * Checks if user is logged
     * @return integer User ID
     */
    public function __construct() {
        $userId = User::checkLogged();

        if ($userId) {
            return $userId;
        }
    }
}
