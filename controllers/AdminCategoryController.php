<?php

/**
 * AdminCategoryController
 * Manages product categories in adminpanel
 */
class AdminCategoryController extends AdminBase {

    /**
     * 
     * Action for manage categories (main page)
     */
    public function actionIndex() {
        $categoriesList = Category::getCategoriesListAdmin();
        require_once(ROOT . '/views/admin_category/index.php');
        return true;
    }

    /**
     * 
     * Action for category create
     */
    public function actionCreate() {

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];

            // error flags
            $errors = false;

            // form validation
            if (!isset($name) || empty($name)) {
                $errors[] = 'Заполните поля';
            }


            if ($errors == false) {
                Category::createCategory($name, $sortOrder, $status);

                header("Location: /admin/category");
            }
        }

        require_once(ROOT . '/views/admin_category/create.php');
        return true;
    }

    /**
     * 
     * Action for category update
     */
    public function actionUpdate($id) {

        $category = Category::getCategoryById($id);

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];

            Category::updateCategoryById($id, $name, $sortOrder, $status);

            header("Location: /admin/category");
        }

        require_once(ROOT . '/views/admin_category/update.php');
        return true;
    }

    /**
     * Action for category delete
     */
    public function actionDelete($id) {

        if (isset($_POST['submit'])) {
            Category::deleteCategoryById($id);

            header("Location: /admin/category");
        }

        require_once(ROOT . '/views/admin_category/delete.php');
        return true;
    }

}
