
    <table class="admin_orders_table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Name</th>
                <th>Date</th>
                <th>Billing Address</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
<?php
        if(!empty($orders)){
            foreach($orders as $order){
?>
            <tr>
                <td><a href="<?= base_url("orders/show/{$order['id']}") ?>"><?= $order['id'] ?></a></td>
                <td><?= $order['name'] ?></td>
                <td><?= $order['date'] ?></td>
                <td><?= $order['address'] ?></td>
                <td>&#8369;<?= $order['total'] ?></td>
                <td>
                    <form action="<?= base_url("orders/ajax_update/{$order['id']}") ?>" method="post" class="order_status">
                        <input type="hidden" class='csrf' name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                        <select name="status">
                            <option <?= $order['status'] == 1 ? 'selected' : '' ?> value="1">Order in process</option>
                            <option <?= $order['status'] == 2 ? 'selected' : '' ?> value="2">Shipped</option>
                            <option <?= $order['status'] == 3 ? 'selected' : '' ?> value="3">Cancelled</option>
                        </select>
                    </form>
                </td>
            </tr>
<?php
            }
        }
?>
        </tbody>
    </table>


    <section class="pagination">
<?php 
        if(!empty($link_count)){
            for($i = 1; $i <= $link_count; $i++){
?>
            <a href="<?= base_url("orders/index_html?page=$i") ?>" class="<?= $page == $i ? 'active' : '' ?>"><?= $i ?></a>
<?php
            }    
        }
?>

    </section>


