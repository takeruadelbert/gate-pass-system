<div id="sidebar" class="float-left">
    <?php
    $cs = ClassRegistry::init("CustomerService")->find("all");
    if (!empty($cs)) {
        ?>
        <div class="wrapper">
            <table id="customer-service">
                <tr>
                    <th colspan="3">Customer Service</th>
                </tr>
                <?php
                foreach ($cs as $cs_user) {
                    ?>
                    <tr>
                        <td><?php echo $cs_user['CustomerService']['name'] ?></td>
                        <td>:</td>
                        <td>
                            <a href="ymsgr:SendIM?<?php echo $cs_user['CustomerService']['ym_username'] ?>">
                                <img border="0" src="http://opi.yahoo.com/online?u=<?php echo $cs_user['CustomerService']['ym_username'] ?>&m=g&t=1" alt="offline"/></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
        <?php
    }
    ?>
    <?php if ($memberData) { ?>
        <div id="member-area" class="wrapper">
            <div class="title">
                <img src="<?php echo Router::url("/front_file/pqp/resource/bgmodule.png", true) ?>" />
                <div class="title-text">Member Area</div>
                <div class="clear"></div>
            </div>
            <a class="red-block" href="<?php echo Router::url("/profil") ?>">Profil Anda</a>
            <a class="red-block" href="javascript:void();">Data Pesanan Anda</a>
            <a class="red-block" href="<?php echo Router::url("/konfirmasi") ?>">Form Konfimasi Pembayaran</a>
        </div>
    <?php } ?>
    <div id="kategori-produk" class="wrapper">
        <div class="title">
            <img src="<?php echo Router::url("/front_file/pqp/resource/bgmodule.png", true) ?>" />
            <div class="title-text">Kategori Produk</div>
            <div class="clear"></div>
        </div>
        <ul>
            <?php
            foreach ($categories as $category) {
                $seoname = seoUrl($category['ProductCategory']['name']);
                ?>
                <li>
                    <a class="blue-text" href="<?php echo Router::url("/produk-kami/{$category['ProductCategory']['id']}/{$seoname}", true) ?>"><?php echo $category['ProductCategory']['name'] ?></a>
                    <?php
                    $childs = ClassRegistry::init("ProductCategory")->find("all", array("conditions" => array("ProductCategory.parent_id" => $category['ProductCategory']['id']), "order" => array("ProductCategory.ordering_number asc")));
                    if (!empty($childs)) {
                        ?>
                        <a class="drop-down" onclick="expandMenu($(this));"></a>
                        <ul style="display:none">
                            <?php
                            foreach ($childs as $child) {
                                $seoname = seoUrl($child['ProductCategory']['name']);
                                ?>
                                <li>
                                    <a class="red-text" href="<?php echo Router::url("/produk-kami/{$child['ProductCategory']['id']}/{$seoname}", true) ?>"><?php echo $child['ProductCategory']['name'] ?></a>
                                    <?php
                                    $childs2 = ClassRegistry::init("ProductCategory")->find("all", array("conditions" => array("ProductCategory.parent_id" => $child['ProductCategory']['id']), "order" => array("ProductCategory.ordering_number asc")));
                                    if (!empty($childs2)) {
                                        ?>
                                        <a class="drop-down" onclick="expandMenu($(this));"></a>
                                        <ul style="display:none">
                                            <?php
                                            foreach ($childs2 as $child2) {
                                                 $seoname = seoUrl($child2['ProductCategory']['name']);
                                                ?>
                                                <li>
                                                    <a class="black-text" href="<?php echo Router::url("/produk-kami/{$child2['ProductCategory']['id']}/{$seoname}", true) ?>"><?php echo $child2['ProductCategory']['name'] ?></a>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                        <?php
                                    }
                                    ?>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    }
                    ?>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
    <div id="statistik-pengunjung" class="wrapper">
        <div class="title">
            <img src="<?php echo Router::url("/front_file/pqp/resource/bgmodule.png", true) ?>" />
            <div class="title-text">Statistik Pengunjung</div>
            <div class="clear"></div>
        </div>
        <table>
            <tr>
                <td class="left">Hari Ini</td>
                <td class="right">9</td>
            </tr>
            <tr>
                <td class="left">Kemarin</td>
                <td class="right">99</td>
            </tr>
            <tr>
                <td class="left">Keseluruhan</td>
                <td class="right">9999</td>
            </tr>
        </table>
        <div class="wrapper">
            Saat ini Tidak Ada Pengunjung dan 1 member yang sedang online.
        </div>
    </div>
</div>