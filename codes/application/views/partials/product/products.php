<?php 
                    if(!empty($products)){
                        foreach($products as $product){
?>
                            <section class="products">
                                <a href="<?= base_url("products/show/{$product['id']}") ?>">
                                    <img src="<?= base_url("{$this->product->img_path}/" . json_decode($product['image'])) ?>" alt="<?= $product['name'] ?>"/>
                                    <p class="product-price">&#8369;<?= $product['price'] ?></p>
                                </a>
                                <p class="product-name"><?= $product['name'] ?></p>
                            </section>
<?php
                        }
                    }
?>
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