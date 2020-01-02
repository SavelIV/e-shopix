<?php

/**
 * AdminController
 * Main page in adminpanel
 */
class AdminController extends AdminBase {

    /**
     * Action for start page
     */
    public function actionIndex() {

        require_once(ROOT . '/views/admin/index.php');
        return true;
    }

}
