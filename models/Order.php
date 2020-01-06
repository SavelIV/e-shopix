<?php

/**
 * Class Order
 * Model for working with orders
 */
class Order {

    /**
     * Saves order 
     * @param string $userName user name
     * @param string $userPhone user phone
     * @param string $userComment user comment
     * @param integer $userId user id
     * @param array $products array with products
     * @return boolean result
     */
    public static function save($userName, $userPhone, $userComment, $userId, $products) {
        $db = Db::getConnection();

        $sql = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products)'
                . 'VALUES (:user_name, :user_phone, :user_comment, :user_id, :products)';

        $products = json_encode($products);

        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':products', $products, PDO::PARAM_STR);

        return $result->execute();
    }

    /**
     * Returns orders list
     * @return array orders list
     */
    public static function getOrdersList() {
        $db = Db::getConnection();

        $result = $db->query('SELECT id, user_name, user_phone, date, status FROM product_order ORDER BY id DESC');
        $ordersList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $ordersList[$i]['id'] = $row['id'];
            $ordersList[$i]['user_name'] = $row['user_name'];
            $ordersList[$i]['user_phone'] = $row['user_phone'];
            $ordersList[$i]['date'] = $row['date'];
            $ordersList[$i]['status'] = $row['status'];
            $i++;
        }
        return $ordersList;
    }

    /**
     * Returns text about product order status:
     * 1 - New order, 2 - In processing, 3 - Delivering, 4 - Close</i>
     * @param integer $status status
     * @return string text
     */
    public static function getStatusText($status) {
        switch ($status) {
            case '1':
                return 'Новый заказ';
                break;
            case '2':
                return 'В обработке';
                break;
            case '3':
                return 'Доставляется';
                break;
            case '4':
                return 'Закрыт';
                break;
        }
    }

    /**
     * Returns orders list of user (by user_id)
     * @param integer $userId user id
     * @return array array with orders list
     */
    public static function getOrdersListByUserId($userId) {
        $db = Db::getConnection();

        $sql = 'SELECT id, user_name, user_phone, user_comment, date, products, status FROM product_order '
                . 'WHERE user_id = :user_id '
                . 'ORDER BY id DESC';

        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->execute();

        $i = 0;
        $ordersList = array();
        while ($row = $result->fetch()) {
            $ordersList[$i]['id'] = $row['id'];
            $ordersList[$i]['user_name'] = $row['user_name'];
            $ordersList[$i]['user_phone'] = $row['user_phone'];
            $ordersList[$i]['user_comment'] = $row['user_comment'];
            $ordersList[$i]['date'] = $row['date'];
            $ordersList[$i]['products'] = $row['products'];
            $ordersList[$i]['status'] = $row['status'];
            $i++;
        }
        return $ordersList;
    }

    /**
     * Returns order (by order_id) 
     * @param integer $id order id
     * @return array array with order info
     */
    public static function getOrderById($id) {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM product_order WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    /**
     * Delete order (by order_id)
     * @param integer $id order id
     * @return boolean result
     */
    public static function deleteOrderById($id) {
        $db = Db::getConnection();

        $sql = 'DELETE FROM product_order WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Update order (by order_id)
     * @param integer $id order id
     * @param string $userName user name
     * @param string $userPhone user phone
     * @param string $userComment user comment
     * @param string $date order date
     * @param integer $status status(on "1", off "0")
     * @return boolean result
     */
    public static function updateOrderById($id, $userName, $userPhone, $userComment, $date, $status) {
        $db = Db::getConnection();

        $sql = "UPDATE product_order
            SET 
                user_name = :user_name, 
                user_phone = :user_phone, 
                user_comment = :user_comment, 
                date = :date, 
                status = :status 
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':date', $date, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }

}
