
<?php
    if(!empty($categories)){
        foreach($categories as $category){
?>
            <li class="product_category_edit_delete_section">
                <form class="form_product_category_edit" action="<?= base_url('categories/update') ?>" method="post">
                    <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                    <input class="product_category_id" type="hidden" name="category_id" value="<?= $category['id'] ?>"/>
                    <input class="product_category_text_input" name="category_name" readonly type="text" value="<?= $category['name'] ?>"/>
                </form>
                <div class="product_category_btn">
                    <div class="waiting_icon"><img src="../../../assets/img/ajax-loading-icon.gif" alt="waiting icon"></div>
                    <i class="bi bi-pencil-fill btn_product_category_edit"></i>
                    <i class="bi bi-trash btn_product_category_delete"></i>
                </div>
            </li>
<?php
        }
    }

?>
