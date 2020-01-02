<?php

// include composer autoload
require 'vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;

/**
 * AdminProductController
 * Manage products in adminpanel
 */
class AdminProductController extends AdminBase {

    /**
     * Action for page "Manage products"
     */
    public function actionIndex() {

        $productsList = Product::getProductsList();

        require_once(ROOT . '/views/admin_product/index.php');
        return true;
    }

    /**
     * Action for page "Add product"
     */
    public function actionCreate() {

        $categoriesList = Category::getCategoriesListAdmin();

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

            // errors flag
            $errors = false;

            // validate form
            if (!isset($options['name']) || empty($options['name']) ||
                    !isset($options['code']) || empty($options['code']) ||
                    !isset($options['category_id']) || empty($options['category_id']) ||
                    !isset($options['price']) || empty($options['price'])) {
                $errors[] = 'Заполните все поля';
            } else if (!preg_match("/^[0-9]+(\.[0-9])?[0-9]?$/", $options['price'])) {
                $errors[] = 'Некорректная стоимость (пример: 999.99)';
            }

            if ($errors == false) {
                // add new product
                $id = Product::createProduct($options);

                // if add
                if ($id) {
                    // check if image uploaded
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        // if uploaded, move it to needed folder and give needed name
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "upload/images/products/{$id}.jpg");


                        // create an image manager instance with favored driver
                        $manager = new ImageManager(array('driver' => 'imagick'));

                        // resize and save new image with needed params
                        $image = $manager->make($_SERVER['DOCUMENT_ROOT'] . "upload/images/products/{$id}.jpg")->resize(600, 400)->save($_SERVER['DOCUMENT_ROOT'] . "upload/images/products/{$id}.jpg");
                    }
                }

                header("Location: /admin/product");
            }
        }

        require_once(ROOT . '/views/admin_product/create.php');
        return true;
    }

    /**
     * Action for page "Update product"
     */
    public function actionUpdate($id) {

        $categoriesList = Category::getCategoriesListAdmin();

        $product = Product::getProductById($id);

        if (isset($_POST['submit'])) {
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

            // errors flag
            $errors = false;

            // validate form
            if (!isset($options['name']) || empty($options['name']) ||
                    !isset($options['code']) || empty($options['code']) ||
                    !isset($options['category_id']) || empty($options['category_id']) ||
                    !isset($options['price']) || empty($options['price'])) {
                $errors[] = 'Заполните все поля';
            } else if (!preg_match("/^[0-9]+(\.[0-9])?[0-9]?$/", $options['price'])) {
                $errors[] = 'Некорректная стоимость (пример: 999.99)';
            }

            if ($errors == false) {
                $result = Product::updateProductById($id, $options);

                // if updated
                if ($result) {

                    // check if image uploaded
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {

                        // if uploaded, move it to needed folder and give needed name
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "upload/images/products/{$id}.jpg");

                        // create an image manager instance with favored driver
                        $manager = new ImageManager(array('driver' => 'imagick'));

                        // resize and save new image with needed params
                        $image = $manager->make($_SERVER['DOCUMENT_ROOT'] . "upload/images/products/{$id}.jpg")->resize(600, 400)->save($_SERVER['DOCUMENT_ROOT'] . "upload/images/products/{$id}.jpg");
                    }
                }

                header("Location: /admin/product");
            }
        }
        require_once(ROOT . '/views/admin_product/update.php');
        return true;
    }

    /**
     * Action for page "Delete product"
     */
    public function actionDelete($id) {

        if (isset($_POST['submit'])) {
            Product::deleteProductById($id);

            header("Location: /admin/product");
        }

        require_once(ROOT . '/views/admin_product/delete.php');
        return true;
    }

}
