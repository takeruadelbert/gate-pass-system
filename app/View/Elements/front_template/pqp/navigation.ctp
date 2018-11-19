<!-- NAVIGATION -->
<div id="navigation">
    <div class="perimeter">
        <div class="menuitem <?php echo $url==""?"current":"" ?>">
            <a href="<?php echo Router::url("/")?>">Home</a>
        </div>
        <div class="separator"></div>
        <div class="menuitem <?php echo $url=="tentang-kami"?"current":"" ?>">
            <a href="<?php echo Router::url("/tentang-kami")?>">Tentang Kami</a>
        </div>
        <div class="separator"></div>
        <div class="menuitem <?php echo $url=="produk-kami"?"current":"" ?>">
            <a href="<?php echo Router::url("/produk-kami")?>">Produk Kami</a>
        </div>
        <div class="separator"></div>
        <div class="menuitem <?php echo $url=="news"?"current":"" ?>">
            <a href="<?php echo Router::url("/berita")?>">Parahyangan News</a>
        </div>
        <div class="separator"></div>
        <div class="menuitem <?php echo $url=="informasi"?"current":"" ?>">
            <a href="<?php echo Router::url("/informasi")?>">Informasi</a>
        </div>
        <div class="separator"></div>
        <div class="menuitem <?php echo $url=="hubungi-kami"?"current":"" ?>">
            <a href="<?php echo Router::url("/hubungi-kami")?>">Hubungi Kami</a>
        </div>
        <div class="clear"></div>
    </div>
</div>