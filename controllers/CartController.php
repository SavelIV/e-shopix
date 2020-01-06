<?php

/**
 * Class CartController
 * Class for cart manage
 */
class CartController {
    /**
     * Action for add product in cart by synchronous request
     * @param integer $id product id
     */
//    public function actionAdd($id)
//    {
//        // add product in cart
//        Cart::addProduct($id);
//
//        // return user on his page
//        $referrer = $_SERVER['HTTP_REFERER'];
//        header("Location: $referrer");
//    }

    /**
     * Action for add product in cart by asynchronous request(ajax)
     * @param integer $id product id
     */
    public function actionAddAjax($id) {
        // add product in cart and output result in cart brackets: products in cart amount
        echo Cart::addProduct($id);
        return true;
    }

    /**
     * Action for delete product from cart
     * @param integer $id product id
     */
    public function actionDelete($id) {
        Cart::deleteProduct($id);
        header("Location: /cart");
    }

    /**
     * Action for "Cart" main page
     */
    public function actionIndex() {
        // categories list for left menu
        $categories = Category::getCategoriesList();

        // get id and amount of products in cart
        $productsInCart = Cart::getProducts();

        // if is products, get all products info
        if ($productsInCart) {

            // get array with products id
            $productsIds = array_keys($productsInCart);

            // get array with all products info
            $products = Product::getProduсtsByIds($productsIds);

            // get all products total price
            $totalPrice = Cart::getTotalPrice($products);
        }

        require_once(ROOT . '/views/cart/index.php');
        return true;
    }

    /**
     * Action for "Cart checkout" page
     */
    public function actionCheckout() {
        // get id and amount of products in cart      
        $productsInCart = Cart::getProducts();

        // if no products, return user on main page
        if ($productsInCart == false) {
            header("Location: /");
        }

        // categories list for left menu
        $categories = Category::getCategoriesList();

        // get total price
        $productsIds = array_keys($productsInCart);
        $products = Product::getProduсtsByIds($productsIds);
        $totalPrice = Cart::getTotalPrice($products);

        // total amount of products in cart
        $totalQuantity = Cart::countItems();

        $userName = $userPhone = $userComment = false;

        // success checkout status
        $result = false;

        // if user is not guest
        if (!User::isGuest()) {

            // get user info from DB
            $userId = User::checkLogged();
            $user = User::getUserById($userId);
            $userName = $user['name'];
        } else {
            // if user is guest
            $userId = false;
        }

        if (isset($_POST['submit'])) {

            // get form data
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];

            // errors flag
            $errors = false;

            // validation
            if (!User::checkName($userName)) {
                $errors[] = 'Имя не менее 2-х символов';
            }
            if (!User::checkPhone($userPhone)) {
                $errors[] = 'Неправильный телефон';
            }


            if ($errors == false) {

                // save order in DB if no errors 
                $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);

                if ($result) {

                    // send verification email to admin (and user?)                
                    $adminEmail = '';
                    //max 60 simbols
                    $message = wordwrap($userComment, 60, "\r\n");
                    $subject = 'Новый заказ с сайта "E-shopix"';
//                  mail($adminEmail, $subject, $message);
                    // clear cart
                    Cart::clear();
                }
            }
        }
        require_once(ROOT . '/views/cart/checkout.php');
        return true;
    }

}
