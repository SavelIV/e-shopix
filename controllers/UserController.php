<?php

/**
 * Class UserController
 * Class for User action manage
 */
class UserController {

    /**
     * Action for "Register" page
     */
    public function actionRegister() {
        //form data
        $name = $email = $password = $result = false;

        // if form submitted
        if (isset($_POST['submit'])) {

            //get form data
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // errors flag
            $errors = false;

            // validation
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            if (User::checkEmailExists($email)) {
                $errors[] = 'Такой email уже используется';
            }

            if ($errors == false) {
                // hash password if no errors
                $passwordHash = password_hash($_POST["password"], PASSWORD_DEFAULT);
                // user register 
                $result = User::register($name, $email, $passwordHash);
            }
        }

        // check if user exist in DB
        $userId = User::checkUserData($email, $password);
        // User authentication (in session)
        User::auth($userId);

        require_once(ROOT . '/views/user/register.php');

        return true;
    }

    /**
     * Action for "Login" page
     */
    public function actionLogin() {
        // form data
        $email = $password = false;

        //if form submitted
        if (isset($_POST['submit'])) {

            // get form data
            $email = $_POST['email'];
            $password = $_POST['password'];

            // errors flag
            $errors = false;

            // check if user exist in DB
            $userId = User::checkUserData($email, $password);

            if ($userId == false) {

                // if no - error
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {

                // if yes - authenticate user (in session)
                User::auth($userId);

                // redirect user to his cabinet
                header("Location: /cabinet");
            }
        }

        require_once(ROOT . '/views/user/login.php');
        return true;
    }

    /**
     * Action for user logout
     */
    public function actionLogout() {

        // delete user data from session
        unset($_SESSION["user"]);

        // redirect user to main page
        header("Location: /");
    }

}
