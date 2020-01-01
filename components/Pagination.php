<?php

/**
 * Class Pagination generate page navigation
 */

class Pagination
{

    /**
     * @param integer $max <p>amount of page links on one page</p>
     */
    private $max = 4;

    /**
     * @param string $index <p>the key for string number (what do we want to see in the URL)</p>
     */
    private $index = 'page-';

    /**
     * @param integer $current_page <p>current page</p>
     */
    private $current_page;

    /**
     * @param integer $total <p>total amount of products</p>
     */
    private $total;

    /**
     * @param integer $limit <p>amount of products on one page</p>
     */
    private $limit;

    /**
     * Class constructor  sets needed params for navigation
     * @param integer $total <p>total amount of products</p>
     * @param integer $currentPage <p>current page number</p>
     * @param integer $limit <p>amount of products on one page</p>
     * @param string $index <p>the key for string number</p>
     */
    public function __construct($total, $currentPage, $limit, $index)
    {
        $this->total = $total;

        $this->limit = $limit;

        $this->index = $index;

        # set total amount of pages
        $this->amount = $this->amount();
        
        # set number of current page
        $this->setCurrentPage($currentPage);
    }

    /**
     * Links output
     * @return string  HTML code with navigation links
     */
    public function get() {
        $links = null;

        # get start/end limits for links range on the page
        $limits = $this->limits();

        $html = '<ul class="pagination">';
        # generate links
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            # if current page - set class active
            if ($page == $this->current_page) {
                $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
                $currentURI = preg_replace('~/page-[0-9]+~', '', $currentURI);
                $links .= '<li class="active"><a href="' . $currentURI . $this->index . $page . '">' . $page . '</a></li>';
            } else {
                # Иначе генерируем ссылку
                $links .= $this->generateHtml($page);
            }
        }

        # Если ссылки создались
        if (!is_null($links)) {
            # Если текущая страница не первая
            if ($this->current_page > 1)
            # Создаём ссылку "На первую"
                $links = $this->generateHtml(1, '&lt;') . $links;

            # Если текущая страница не последняя
            if ($this->current_page < $this->amount)
            # Создаём ссылку "На последнюю"
                $links .= $this->generateHtml($this->amount, '&gt;');
        }

        $html .= $links . '</ul>';

        # Возвращаем html
        return $html;
    }

    /**
     * Для генерации HTML-кода ссылки
     * @param integer $page - номер страницы
     * 
     * @return
     */
    private function generateHtml($page, $text = null)
    {
        # Если текст ссылки не указан
        if (!$text)
        # Указываем, что текст - цифра страницы
            $text = $page;

        $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
        $currentURI = preg_replace('~/page-[0-9]+~', '', $currentURI);
        # Формируем HTML код ссылки и возвращаем
        return  '<li><a href="' . $currentURI . $this->index . $page . '">' . $text . '</a></li>';
    }

    /**
     *  Get left/right limits for links range on the page
     * 
     * @return arr  array with start and end range limit
     */
    private function limits() {
        # get left range limit to start with (to set active page in the center)
        $left = $this->current_page - round($this->max / 2);

        $start = $left > 0 ? $left : 1;

        # get right range limit to end with
        if ($start + $this->max <= $this->amount) {
            $end = $start > 1 ? $start + $this->max : $this->max;
        } else {
            $end = $this->amount;
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }

        return array($start, $end);
    }

    /**
     * Set current page on limit range
     * @param int $currentPage  current page
     * @return int current page (on limit range)
     */
    private function setCurrentPage($currentPage) {
        $this->current_page = $currentPage;

        if ($this->current_page > 0) {
            if ($this->current_page > $this->amount)
                $this->current_page = $this->amount;
        } else
            $this->current_page = 1;

        return $this->current_page;
    }

    /**
     * Return total amount of pages
     * @return string  amount of pages
     */
    private function amount() {
        return ceil($this->total / $this->limit);
    }

}
