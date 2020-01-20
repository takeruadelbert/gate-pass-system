<!-- BANNER -->
<div id="banner">
    <div class="perimeter center">
        <a href="javascript:void();" class="float-left"><img src="<?php echo Router::url("/front_file/pqp/resource/contact.png", true) ?>" /></a>

        <?php
        if (!$memberData) {
            ?>
            <div id="login-show" class="float-right">
                <a href="javascript:void();"><img src="<?php echo Router::url("/front_file/pqp/resource/member.png", true) ?>" /></a>
                <div id="login-container">
                    <div id="login-box" style="display:none;">
                        <form id="login_form">
                            <table>
                                <tr>
                                    <td>
                                        <form>
                                            <table>
                                                <tr>
                                                    <td>username</td>
                                                    <td>:</td>
                                                    <td>
                                                        <input id="login_username" type="text" name="username" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>password</td>
                                                    <td>:</td>
                                                    <td>
                                                        <input id="login_password" type="password" name="password" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <input type="submit" class="button bg-red bg-after-light-red" name="login" value="login" id="login_button" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <div id="toggle-login-error" class="hidden error-message float-right">
                                                            Email Atau Password Salah!
                                                        </div>
                                                        <div class="float-left">
                                                            <a class="blue-link" href="<?php echo Router::url("/lupa-password", true) ?>" >
                                                                Lupa Password
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </td>
                                    <td style="vertical-align:top;"><a href="javascript:void();" id="login-exit" class="bg-red bg-after-light-red">X</a></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
            <a href="<?php echo Router::url("/register") ?>" class="float-right"><img src="<?php echo Router::url("/front_file/pqp/resource/membership.png", true) ?>" /></a>
            <?php
        } else {
            ?>
            <div id="login-show" class="float-right left">
                <div><a href="<?php echo Router::url("/profil", true) ?>" class="red-text"><?php echo $memberData['User']['username'] ?></a></div>
                <div><a href="<?php echo Router::url("/member/logout", true) ?>" class="blue-text">Logout</a></div>
            </div>
        <?php }
        ?>
        <a href="javascript:void();" class="float-right"><img src="<?php echo Router::url("/front_file/pqp/resource/konsul.png", true) ?>" /></a>
        <a href="<?php echo Router::url('/konfirmasi')?>" class="float-right"><img src="<?php echo Router::url("/front_file/pqp/resource/payment.png", true) ?>" /></a>
        <div class="clear"></div>
    </div>
</div>