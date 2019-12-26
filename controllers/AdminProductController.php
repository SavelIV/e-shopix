<?php
// include composer autoload
require 'vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;

/**
 * Контроллер AdminProductController
 * Управление товарами в админпанели
 */
class AdminProductController extends AdminBase
{

    /**
     * Action для страницы "Управление товарами"
     */
    public function actionIndex()
    {

        // Получаем список товаров
        $productsList = Product::getProductsList();

        // Подключаем вид
        require_once(ROOT . '/views/admin_product/index.php');
        return true;
    }

    /**
     * Action для страницы "Добавить товар"
     */
    public function actionCreate()
    {
  
        // Получаем список категорий для выпадающего списка
        $categoriesList = Category::getCategoriesListAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['name']) || empty($options['name']) ||
                    !isset($options['code']) || empty($options['code']) ||
                    !isset($options['category_id']) || empty($options['category_id']) ||
                    !isset($options['price']) || empty($options['price']))
                {
                    $errors[] = 'Заполните все поля';
                }
                else if (!preg_match("/^[0-9]+(\.[0-9])?[0-9]?$/",$options['price'])) 
                { 
                    $errors[] = 'Некорректная стоимость (пример: 999.99)'; 
                }
                
            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новый товар
                $id = Product::createProduct($options);

                // Если запись добавлена
                if ($id) {
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папку, дадим новое имя
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "upload/images/products/{$id}.jpg");
                        

// create an image manager instance with favored driver
                        $manager = new ImageManager(array('driver' => 'imagick'));

// to finally create image instances
                        $image = $manager->make($_SERVER['DOCUMENT_ROOT'] . "upload/images/products/{$id}.jpg")->resize(600, 400)->save($_SERVER['DOCUMENT_ROOT'] . "upload/images/products/{$id}.jpg");
                    }
                }

                // Перенаправляем админа на страницу управлениями товарами
                header("Location: /admin/product");
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_product/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать товар"
     */
    public function actionUpdate($id)
    {

        // Получаем список категорий для выпадающего списка
        $categoriesList = Category::getCategoriesListAdmin();

        // Получаем данные о конкретном заказе
        $product = Product::getProductById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];
            
           // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['name']) || empty($options['name']) ||
                    !isset($options['code']) || empty($options['code']) ||
                    !isset($options['category_id']) || empty($options['category_id']) ||
                    !isset($options['price']) || empty($options['price']))
                {
                    $errors[] = 'Заполните все поля';
                }
                else if (!preg_match("/^[0-9]+(\.[0-9])?[0-9]?$/",$options['price'])) 
                { 
                    $errors[] = 'Некорректная стоимость (пример: 999.99)'; 
                }
                
            if ($errors == false) { 
                // Если ошибок нет
                // сохраняем исправления
                $result = Product::updateProductById($id, $options);
                
                // Если запись сохранена
                if ($result) {
                
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
  
                    // Если загружалось, переместим его в нужную папку, дадим новое имя
                    move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "upload/images/products/{$id}.jpg");

// create an image manager instance with favored driver
                        $manager = new ImageManager(array('driver' => 'imagick'));

// to finally create image instances
                        $image = $manager->make($_SERVER['DOCUMENT_ROOT'] . "upload/images/products/{$id}.jpg")->resize(600, 400)->save($_SERVER['DOCUMENT_ROOT'] . "upload/images/products/{$id}.jpg");                    
                    
                    
                }
            }

            // Перенаправляем админа на страницу управлениями товарами
            header("Location: /admin/product");
        }
    }
        // Подключаем вид
        require_once(ROOT . '/views/admin_product/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить товар"
     */
    public function actionDelete($id)
    {
 
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем товар
            Product::deleteProductById($id);

            // Перенаправляем админа на страницу управлениями товарами
            header("Location: /admin/product");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_product/delete.php');
        return true;
    }

}
