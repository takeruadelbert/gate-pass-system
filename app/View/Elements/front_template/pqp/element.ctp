<div id="popup-wrapper" style="display:none;">
    <div id="popup-background"></div>
    <div id="popup-container">
        <div class="centering-table">
            <div class="centering-table-cell">
                <div id="popup">
                    <div class="cart-item">
                        <img class="float-left" id="confirmation_image" src="<?php echo Router::url(_EMPTY_IMAGE) ?>" />
                        <div class="float-left">
                            <div >
                                <span id="confirmation_amount">n</span> x <span id="confirmation_name">name</span>
                            </div>
                            <div>
                                Telah ditambahkan pada Keranjang Belanja Anda.
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="actions">
                        <a class="float-right button bg-blue bg-after-red" href="<?php echo Router::url("/kasir", true) ?>">Proses</a>
                        <a class="float-right button bg-orange bg-after-red" onclick="location.reload();">Lanjut Berbelanja</a>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="hover" style="display:none;">
    <div class="text">
        Promo berakhir:
    </div>
    <div class="counter">
        <div class="day counter-section">
            <div class="number">99</div>
            <div class="text">days</div>
        </div>
        <div class="hour counter-section">
            <div class="number">9</div>
            <div class="text">hours</div>
        </div>
        <div class="minute counter-section">
            <div class="number">9</div>
            <div class="text">minutes</div>
        </div>
        <div class="second counter-section">
            <div class="number">9</div>
            <div class="text">seconds</div>
        </div>
    </div>
</div>