<!-- HEADER -->
<div id="header">
    <div class="perimeter">
        <div id="title" class="float-left">
            <a href="<?php echo Router::url("/", true) ?>">
                <img src="<?php echo Router::url("/front_file/pqp/resource/logo.png", true) ?>" />
            </a>
        </div>
        <div id="search" class="float-right">
            <input type="text" name="search" placeholder="Masukkan pencarian produk, lalu enter." />
            <!--<div id="cart" onmouseover="$('#cart-content').fadeIn(200);" onmouseout="$('#cart-content').fadeOut(200);">-->
            <div id="cart" onmouseover="$('#cart-content').css('display', 'inline-block');" onmouseout="$('#cart-content').css('display', 'none');">
                <div id="cart-button">
                    <img src="<?php echo Router::url("/front_file/pqp/resource/cart-img.png", true) ?>" />
                    <div>
                        <?php
                        $cart = $this->Session->read("cart");
                        ?>
                        Lihat (<span id="qty"><?php echo count($cart) ?></span>)
                    </div>
                </div>
                <div id="cart-content-container">
                    <div id="cart-content" style="display:none;">
                        <?php
                        if (!empty($cart)) {
                            $total = 0;
                            ?>
                            <div class="title">
                                <div class="title-text">Daftar Belanja Anda</div>
                                <div class="clear"></div>
                            </div>
                            <div id="cart-items">
                                <?php
                                foreach ($cart as $item) {
                                    $price = ClassRegistry::init("Price")->find("first", array("conditions" => array("Price.id" => $item['price_id']), "recursive" => 2));
                                    ?>
                                    <div class="cart-item">
                                        <img class="float-left" src="<?php echo isset($price['Product']["Gallery"][0]['path']) ? $price['Product']["Gallery"][0]['path'] : Router::url(_EMPTY_IMAGE) ?>" />
                                        <div class="cart-item-info float-left">
                                            <div class="cart-item-info-title dark-blue">
                                                <?php echo $price['Product']['name'] ?>
                                            </div>
                                            <div class="cart-item-info-kode red">
                                                Kode Produk : <?php echo $price['Product']['barcode'] ?>
                                            </div>
                                            <?php
                                            if (isset($price['HmPriceAttributeValue'][0]['AttributeValue']['name'])) {
                                                ?>
                                                <div class="cart-item-info-tipe red">
                                                    Tipe Barang : <?php echo $price['HmPriceAttributeValue'][0]['AttributeValue']['name'] ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="cart-item-nominal float-left">
                                            <div class="cart-item-nominal-calculation">
                                                <span>
                                                    <?php echo $item['total_order'] ?> x
                                                </span>
                                                <span>
                                                    <?php
                                                    $hargaAkhir = hargaAkhir($price['Price']['default_price'], $price['Product']['discount'], @$price['Product']['Promotion']['amount'], @$price['Product']['Promotion']['promotion_value_type_id'], @$price['Product']['Promotion']['promotion_condition_id']);
                                                    $total+=$hargaAkhir*$item['total_order'];
                                                    echo $this->Html->Rp($hargaAkhir);
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="cart-item-nominal-delete">
                                                <a class="red-text" href="javascript:void();">
                                                    Hapus
                                                </a>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <table id="cart-calculation">
                                <tr id="cart-calculation-total">
                                    <td class="label red">
                                        Total :
                                    </td>
                                    <td class="dark-blue">
                                        <?php echo $this->Html->Rp($total) ?>
                                    </td>
                                </tr>
                            </table>
                            <div id="cart-button-kasir-container">
                                <div onclick="window.location = '<?php echo Router::url("/kasir", true) ?>';" id="cart-button-kasir" class="button bg-dark-blue bg-after-blue">
                                    Kasir
                                </div>
                            </div>
                        <?php } else {
                            ?>
                            <div class="title">
                                <div class="title-text">Tidak ada barang belanjaan</div>
                                <div class="clear"></div>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
</div>