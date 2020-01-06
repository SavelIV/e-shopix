<?php

/**
 * Class Cart
 * Model for working with cart
 */
class Cart {

    /**
     * Add product in cart (session)
     * @param integer $id product id
     * @return integer products in cart amount
     */
    public static function addProduct($id) {
        // $id - integer type
        $id = intval($id);
        // empty array for products in cart
        $productsInCart = array();
        // if is product in cart (in session)
        if (isset($_SESSION['products'])) {
            // put them in array
            $productsInCart = $_SESSION['products'];
        }
        // if there is same product in cart 
        if (array_key_exists($id, $productsInCart)) {
            // increase its quantity
            $productsInCart[$id] ++;
        } else {
            // if no, add this product with quantity=1
            $productsInCart[$id] = 1;
        }
        // put products in cart array in session
        $_SESSION['products'] = $productsInCart;
        // return products in cart amount
        return self::countItems();
    }

    /**
     * Get total amount of products in cart (in session)
     * @return int total amount of products in cart
     */
    public static function countItems() {

        // if is array with products in cart in session
        if (isset($_SESSION['products'])) {

            // return products amount

            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count = $count + $quantity;
            }
            return $count;
        } else {
            // if no products, return 0
            return 0;
        }
    }

    /**
     * Return id and amount of products in cart,
     * if no products - return false
     * @return mixed boolean or array
     */
    public static function getProducts() {
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }

    /**
     * Get total price of products in cart
     * @param array $products array with products info
     * @return integer total price of products in cart
     */
    public static function getTotalPrice($products) {
        // get array with ids and amount of products in cart
        $productsInCart = self::getProducts();
        // count total price
        $total = 0;
        if ($productsInCart) {
            foreach ($products as $item) {
                $total += $item['price'] * $productsInCart[$item['id']];
            }
        }
        return $total;
    }

    /**
     * Clear cart
     */
    public static function clear() {
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }
    }

    /**
     * Delete product (by id) from cart
     * @param integer $id product id
     */
    public static function deleteProduct($id) {

        // get array with ids and amount of products in cart
        $productsInCart = self::getProducts();

        // delete products (each by one)
        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id] --;
        }
        if ($productsInCart[$id] <= 0) {
            unset($productsInCart[$id]);
        }
        $_SESSION['products'] = $productsInCart;
        return self::countItems();
    }

}
