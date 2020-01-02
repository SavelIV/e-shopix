<?php

/**
 * AdminOrderController
 * Manage orders in adminpanel
 */
class AdminOrderController extends AdminBase {

    /**
     * Action for page "Manage orders"
     */
    public function actionIndex() {

        $ordersList = Order::getOrdersList();

        require_once(ROOT . '/views/admin_order/index.php');
        return true;
    }

    /**
     * Action for page "Update order"
     */
    public function actionUpdate($id) {

        $order = Order::getOrderById($id);

        if (isset($_POST['submit'])) {
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            $date = $_POST['date'];
            $status = $_POST['status'];

            Order::updateOrderById($id, $userName, $userPhone, $userComment, $date, $status);

            header("Location: /admin/order/view/$id");
        }

        require_once(ROOT . '/views/admin_order/update.php');
        return true;
    }

    /**
     * Action for page "View order by admin"
     */
    public function actionView($id) {

        $order = Order::getOrderById($id);

        // decode string 'products' to array
        $productsQuantity = json_decode($order['products'], true);

        $productsIds = array_keys($productsQuantity);

        $products = Product::getProduсtsByIds($productsIds);

        require_once(ROOT . '/views/admin_order/view.php');
        return true;
    }

    /**
     * Action for page "Delete order"
     */
    public function actionDelete($id) {

        if (isset($_POST['submit'])) {
            Order::deleteOrderById($id);

            header("Location: /admin/order");
        }

        require_once(ROOT . '/views/admin_order/delete.php');
        return true;
    }

}
