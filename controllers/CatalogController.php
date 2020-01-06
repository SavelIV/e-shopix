<?php

/**
 * Class CatalogController
 * Class for products catalog manage
 */
class CatalogController {

    /**
     * Action for "Catalog" main page
     */
    public function actionIndex() {
        // categories list for left menu
        $categories = Category::getCategoriesList();

        // latest products list (to show on main page (how much))
        $latestProducts = Product::getLatestProducts(12);

        require_once(ROOT . '/views/catalog/index.php');
        return true;
    }

    /**
     * Action for "Product category" page
     * @param int $categoryId category id
     * @param int $page [optional] current page number
     */
    public function actionCategory($categoryId, $page = 1) {
        // categories list for left menu
        $categories = Category::getCategoriesList();

        // product list for current category
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);

        // products amount in category (for page navigation)
        $total = Product::getTotalProductsInCategory($categoryId);

        // new object Pagination (page navigation)
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT . '/views/catalog/category.php');
        return true;
    }

}
