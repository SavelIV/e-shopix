<?php

/**
 * Class SiteController
 * site main pages
 */
class SiteController {

    /**
     * Action for "index" site page 
     */
    public function actionIndex() {
        // categories for left menu
        $categories = Category::getCategoriesList();

        // latest products (amount if not default)
        $latestProducts = Product::getLatestProducts(9);

        // products list for slider
        $sliderProducts = Product::getRecommendedProducts();

        require_once(ROOT . '/views/site/index.php');
        return true;
    }

    /**
     * Action for "contact" site page 
     */
    public function actionContact() {

        $userEmail = $userText = $result = false;

        if (isset($_POST['submit'])) {

            // get form data if submitted
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];

            // errors flag
            $errors = false;

            // validation
            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный email';
            }

            if ($errors == false) {

                // send verification email to admin (and user?) 
                $adminEmail = '';
                $message = "Текст: {$userText}. От: {$userEmail}";
                //max 60 simbols
                $message = wordwrap($message, 60, "\r\n");
                $subject = 'Письмо с сайта "E-shopix"';
//              $result = mail($adminEmail, $subject, $message);
                $result = true;
            }
        }

        require_once(ROOT . '/views/site/contact.php');
        return true;
    }

    /**
     * AAction for "about" site page
     */
    public function actionAbout() {
        require_once(ROOT . '/views/site/about.php');
        return true;
    }

}
