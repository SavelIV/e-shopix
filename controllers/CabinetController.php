<?php

/**
 * Class CabinetController
 * Class for User cabinet manage
 */
class CabinetController extends CabinetBase
{

    /**
     * Action for "User cabinet" page
     */
    public function actionIndex()
    {
        // get user info from DB
        $user = User::getUserById($userId);

        require_once(ROOT . '/views/cabinet/index.php');
        return true;
    }

    /**
     * Action for "User data edit" page
     */
    public function actionEdit()
    {
        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);

        // Заполняем переменные для полей формы
        $name = $user['name'];
//        $password = $user['password'];

        // Флаг результата
        $result = false;

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования
            $name = $_POST['name'];
            $password = $_POST['password'];

            // Флаг ошибок
            $errors = false;

            // Валидируем значения
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            if ($errors == false) {
                // Если ошибок нет хешируем пароль
                $passwordHash = password_hash($_POST["password"],PASSWORD_DEFAULT);
                // Редактируем данные пользователя
                $result = User::edit($userId, $name, $passwordHash);
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/edit.php');
        return true;
    }
    /**
     * Action for "User order history" page
     */
    public function actionHistory()
    {
        // Получаем данные о конкретном заказе
        $ordersList = Order::getOrdersListByUserId($userId);
        
        //Если заказа не было
        if (empty($ordersList)){
            $ordersList = 0;
        }
            require_once(ROOT . '/views/cabinet/history.php');
            return true;
        
    }
    /**
     * Action for "User order view" page
     */
    public function actionView($id)
    {
        // Получаем данные о конкретном заказе
        $order = Order::getOrderById($id);
        
        // Раскодируем строку 'products' в массив
        $productsQuantity = json_decode($order['products'], true);

        // Получаем массив с индентификаторами товаров
        $productsIds = array_keys($productsQuantity);

        // Получаем список товаров в заказе
        $products = Product::getProduсtsByIds($productsIds);

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/view.php');
        return true;
 
    }
    
}
