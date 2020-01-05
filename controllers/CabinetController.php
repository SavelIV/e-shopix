<?php

/**
 * Class CabinetController
 * Class for User cabinet manage
 */
class CabinetController {
   
    /**
     * Action for "User cabinet" page
     */
    public function actionIndex() {
        
        // check if user is logged
        $userId = User::checkLogged();
        
        // get user info from DB
        $user = User::getUserById($userId);

        require_once(ROOT . '/views/cabinet/index.php');
        return true;
    }

    /**
     * Action for "User data edit" page
     */
    public function actionEdit() {
        
        // check if user is logged
        $userId = User::checkLogged();
        // get user info from DB
        $user = User::getUserById($userId);

        $name = $user['name'];
        // result flag
        $result = false;

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $password = $_POST['password'];

            // errors flag
            $errors = false;

            // validate form
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            if ($errors == false) {
                // hash password if no errors
                $passwordHash = password_hash($_POST["password"], PASSWORD_DEFAULT);
                // edit user data
                $result = User::edit($userId, $name, $passwordHash);
            }
        }

        require_once(ROOT . '/views/cabinet/edit.php');
        return true;
    }

    /**
     * Action for "User order history" page
     */
    public function actionHistory() {
        
        // check if user is logged
        $userId = User::checkLogged();
        // get values of user order
        $ordersList = Order::getOrdersListByUserId($userId);

        //if no orders
        if (empty($ordersList)) {
            $ordersList = 0;
        }
        require_once(ROOT . '/views/cabinet/history.php');
        return true;
    }

    /**
     * Action for "User order view" page
     */
    public function actionView($id) {
        
        // check if user is logged
        $userId = User::checkLogged();
        // get values of user order
        $order = Order::getOrderById($id);

        // decode string "products" into array
        $productsQuantity = json_decode($order['products'], true);

        // get array of products ID
        $productsIds = array_keys($productsQuantity);

        // get list of products in order
        $products = Product::getProduсtsByIds($productsIds);

        require_once(ROOT . '/views/cabinet/view.php');
        return true;
    }

}
