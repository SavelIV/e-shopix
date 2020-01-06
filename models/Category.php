<?php

/**
 * Class Category 
 * Model for working with product categories
 */
class Category {

    /**
     * Returns categories array for left menu 
     * @return array categories array
     */
    public static function getCategoriesList() {
        $db = Db::getConnection();

        $result = $db->query('SELECT id, name FROM category WHERE status = "1" ORDER BY sort_order, name ASC');

        $i = 0;
        $categoryList = array();
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }
        return $categoryList;
    }

    /**
     * Returns total categories array for admin panel
     * (with all categories)
     * @return array categories info array
     */
    public static function getCategoriesListAdmin() {
        $db = Db::getConnection();

        $result = $db->query('SELECT id, name, sort_order, status FROM category ORDER BY sort_order ASC');

        $categoryList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['sort_order'] = $row['sort_order'];
            $categoryList[$i]['status'] = $row['status'];
            $i++;
        }
        return $categoryList;
    }

    /**
     * Deletes category by id
     * @param integer $id category id
     * @return boolean result
     */
    public static function deleteCategoryById($id) {
        $db = Db::getConnection();

        $sql = 'DELETE FROM category WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Updates category by id
     * @param integer $id category id
     * @param string $name category name
     * @param integer $sortOrder category sort order id
     * @param integer $status category status(on "1", off "0")
     * @return boolean result
     */
    public static function updateCategoryById($id, $name, $sortOrder, $status) {
        $db = Db::getConnection();

        $sql = "UPDATE category
            SET 
                name = :name, 
                sort_order = :sort_order, 
                status = :status
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Returns category by id
     * @param integer $id category id
     * @return array category info array
     */
    public static function getCategoryById($id) {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM category WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    /**
     * Returns text about category status:
     * 0 - hidden, 1 - displayed
     * @param integer $status status
     * @return string text
     */
    public static function getStatusText($status) {
        switch ($status) {
            case '1':
                return 'Отображается';
                break;
            case '0':
                return 'Скрыта';
                break;
        }
    }

    /**
     * Adds new category 
     * @param string $name category name
     * @param integer $sortOrder category sort order id
     * @param integer $status status(on "1", off "0")
     * @return boolean result
     */
    public static function createCategory($name, $sortOrder, $status) {
        $db = Db::getConnection();

        $sql = 'INSERT INTO category (name, sort_order, status) '
                . 'VALUES (:name, :sort_order, :status)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }

}
