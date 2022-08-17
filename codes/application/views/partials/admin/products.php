        <table class="admin_products_table">
            <thead>
                <tr>
                    <th>Picture</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Inventory Count</th>
                    <th>Quantity Sold</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
<?php
    if(!empty($products)){
        foreach($products as $product){
?>
               <tr>
                    <td><img src="<?= base_url("{$this->product->img_path}/{$product['image']}") ?>" alt="<?= $product['name'] ?>"></td>
                    <td class="product_id"><?= $product['id'] ?></td>
                    <td><?= $product['name'] ?></td>
                    <td><?= $product['inventory'] ?></td>
                    <td><?= $product['sold'] ?></td>
                    <td>
                        <a href="" class="product_edit_link btn-secondary p-2">Edit</a>
                        <a href="" class="product_delete_link btn-warning p-2 ms-1">Delete</a>
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
            <a href="<?= base_url("products/index_html?page=$i") ?>" class="<?= $page == $i ? 'active' : '' ?>"><?= $i ?></a>
<?php
        }    
    }
?>

        </section>