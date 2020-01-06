<?php include ROOT . '/views/layouts/header.php'; ?>

<section class="section-inner">
    <div class="container">
        <h4>Список заказов</h4>
        <br/>
        <?php if ($ordersList != 0): ?>
            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID заказа</th>
                    <th>Имя покупателя</th>
                    <th>Телефон покупателя</th>
                    <th>Комментарий покупателя</th>
                    <th>Дата оформления</th>
                    <th>Товары</th>
                    <th>Статус</th>
                </tr>
                <?php foreach ($ordersList as $order): ?>
                    <tr>
                        <td>
                            <a href="/cabinet/view/<?php echo $order['id']; ?>">
                                <?php echo $order['id']; ?>
                            </a>
                        </td>
                        <td><?php echo $order['user_name']; ?></td>
                        <td><?php echo $order['user_phone']; ?></td>
                        <td><?php echo wordwrap($order['user_comment'], 90, "<br>", true); ?></td>
                        <td><?php echo $order['date']; ?></td>
                        <td><?php echo $order['products']; ?></td>
                        <td><?php echo Order::getStatusText($order['status']); ?></td>    
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Заказов пока нет (:</p>
        <?php endif; ?>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>


