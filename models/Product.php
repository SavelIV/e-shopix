<?php

/**
 * Class Product 
 * Model for working with products
 */
class Product {

    // products amount displayed on current page by default
    const SHOW_BY_DEFAULT = 3;

    /**
     * Returns latest products array
     * @param int $count [optional] products amount on current page
     * @return array array with products([product]=>[amount])
     */
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT) {
        $db = Db::getConnection();

        $sql = 'SELECT id, name, price, is_new FROM product '
                . 'WHERE status = "1" ORDER BY id DESC '
                . 'LIMIT :count';

        // use prepared statements
        $result = $db->prepare($sql);
        $result->bindParam(':count', $count, PDO::PARAM_INT);

        // get the result as an associative array (product=>amount)
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $i = 0;
        $productsList = array();
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $productsList;
    }

    /**
     * Returns product list for current category (depending on page number)
     * @param int $categoryId category id
     * @param int $page [optional] current page number
     * @return array array with products
     */
    public static function getProductsListByCategory($categoryId, $page = 1) {
        //products on page
        $limit = Product::SHOW_BY_DEFAULT;
        // offset (for DB query), depending on page number
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $db = Db::getConnection();

        //status=1 - "open for sale products"
        $sql = 'SELECT id, name, price, is_new FROM product '
                . 'WHERE status = "1" AND category_id = :category_id '
                . 'ORDER BY id DESC LIMIT :limit OFFSET :offset';

        $result = $db->prepare($sql);
        $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->execute();

        $i = 0;
        $products = array();
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $products;
    }

    /**
     * Returns product info by id
     * @param integer $id product id
     * @return array array with product info
     */
    public static function getProductById($id) {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM product WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    /**
     * Returns products amount in category
     * @param integer $categoryId category id
     * @return integer products amount in category
     */
    public static function getTotalProductsInCategory($categoryId) {
        $db = Db::getConnection();

        //status=1 - "open for sale products"
        $sql = 'SELECT count(id) AS count FROM product WHERE status="1" AND category_id = :category_id';

        $result = $db->prepare($sql);
        $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $result->execute();

        $row = $result->fetch();
        return $row['count'];
    }

    /**
     * Returns array of products depending on their ids
     * @param array $idsArray array with product ids
     * @return array array with products list
     */
    public static function getProduсtsByIds($idsArray) {
        $db = Db::getConnection();

        // array to string for DB query
        $idsString = implode(',', $idsArray);

        $sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString)";

        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        $products = array();
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }
        return $products;
    }

    /**
     * Returns recommended product list
     * @return array array with rec.products
     */
    public static function getRecommendedProducts() {
        $db = Db::getConnection();

        $result = $db->query('SELECT id, name, price, is_new FROM product '
                . 'WHERE status = "1" AND is_recommended = "1" '
                . 'ORDER BY id DESC');
        $i = 0;
        $productsList = array();
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $productsList;
    }

    /**
     * Returns all products array
     * @return array array with products
     */
    public static function getProductsList() {
        $db = Db::getConnection();

        $result = $db->query('SELECT id, name, price, code FROM product ORDER BY id ASC');
        $productsList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['code'] = $row['code'];
            $productsList[$i]['price'] = $row['price'];
            $i++;
        }
        return $productsList;
    }

    /**
     * Delete product by id
     * @param integer $id product id
     * @return boolean 
     */
    public static function deleteProductById($id) {
        $db = Db::getConnection();

        $sql = 'DELETE FROM product WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Update product by id
     * @param integer $id product id
     * @param array $options product info array
     * @return boolean 
     */
    public static function updateProductById($id, $options) {
        $db = Db::getConnection();

        $sql = "UPDATE product
            SET 
                name = :name, 
                code = :code, 
                price = :price, 
                category_id = :category_id, 
                brand = :brand, 
                availability = :availability, 
                description = :description, 
                is_new = :is_new, 
                is_recommended = :is_recommended, 
                status = :status
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_INT);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Adds new product
     * @param array $options product info array
     * @return mixed added string id or 0
     */
    public static function createProduct($options) {
        $db = Db::getConnection();

        $sql = 'INSERT INTO product '
                . '(name, code, price, category_id, brand, availability,'
                . 'description, is_new, is_recommended, status)'
                . 'VALUES '
                . '(:name, :code, :price, :category_id, :brand, :availability,'
                . ':description, :is_new, :is_recommended, :status)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_INT);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        if ($result->execute()) {
            return $db->lastInsertId();
        }
        return 0;
    }

    /**
     * Returns text about product availability status:
     * 0 - to order, 1 - available
     * @param integer $availability status
     * @return string text
     */
    public static function getAvailabilityText($availability) {
        switch ($availability) {
            case '1':
                return 'В наличии';
                break;
            case '0':
                return 'Под заказ';
                break;
        }
    }

    /**
     * Returns image path
     * @param integer $id product id (image id)
     * @return string path to image
     */
    public static function getImage($id) {
        // empty image (if no images)
        $noImage = 'no-image.jpg';

        // path to images folder
        $path = '/upload/images/products/';

        // path to product image
        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToProductImage)) {

            // if image exist, returns its path
            return $pathToProductImage;
        }

        // return empty image puth
        return $path . $noImage;
    }

}
