<?php

/**
 * Class User 
 * Model for working with users
 */
class User {

    /**
     * User register 
     * @param string $name user name
     * @param string $email user email
     * @param string $passwordHash user hashed password
     * @return boolean register result
     */
    public static function register($name, $email, $passwordHash) {
        $db = Db::getConnection();

        $sql = 'INSERT INTO user (name, email, password) '
                . 'VALUES (:name, :email, :passwordHash)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':passwordHash', $passwordHash, PDO::PARAM_STR);
        return $result->execute();
    }

    /**
     * User data edit
     * @param integer $id user id
     * @param string $name user name
     * @param string $passwordHash user hashed password
     * @return boolean result
     */
    public static function edit($id, $name, $passwordHash) {
        $db = Db::getConnection();

        $sql = "UPDATE user 
            SET name = :name, password = :password 
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $passwordHash, PDO::PARAM_STR);
        return $result->execute();
    }

    /**
     * Check if user exist in DB (by email and password)
     * @param string $email user email
     * @param string $password user password
     * @return mixed integer user id or false
     */
    public static function checkUserData($email, $password) {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE email = :email ';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();

        // if user exist in DB and passwords  match, returns his id
        if ($email && password_verify($password, $user['password'])) {
            return $user['id'];
        }
        return false;
    }

    /**
     * User authentication
     * @param integer $userId user id
     */
    public static function auth($userId) {
        // authenticate user by id(in session)
        $_SESSION['user'] = $userId;
    }

    /**
     * Returns user id if logged
     * else redirects to login page
     * @return integer user id
     */
    public static function checkLogged() {
        // if session started, return user id from session
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        header("Location: /user/login");
    }

    /**
     * Check if user is guest
     * @return boolean result
     */
    public static function isGuest() {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    /**
     * Checks user name (not less than 2 symbols)
     * @param string $name user name
     * @return boolean result
     */
    public static function checkName($name) {
        if (mb_strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    /**
     * Checks user phone (not less than 7 digits)
     * @param string $phone user phone
     * @return boolean result
     */
    public static function checkPhone($phone) {
        if (preg_match("/^\d{7,}$/", $phone)) {
            return true;
        }
        return false;
    }

    /**
     * Checks user password (not less than 6 symbols)
     * @param string $password user password
     * @return boolean result
     */
    public static function checkPassword($password) {
        if (mb_strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    /**
     * Checks user email
     * @param string $email user email
     * @return boolean result
     */
    public static function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * Checks if email is free
     * @param type $email user email
     * @return boolean result
     */
    public static function checkEmailExists($email) {
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn())
            return true;
        return false;
    }

    /**
     * Returns user info depending of user id
     * @param integer $id <p>user id</p>
     * @return array <p>array with user info from DB</p>
     */
    public static function getUserById($id) {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

}
