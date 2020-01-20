<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
        <title>STN - Login</title>
        <?php
        $this->Template->import(array("application.js"));
        ?>
    </head>
    <body>
    <body class="fixed-header   ">
        <!-- START PAGE-CONTAINER -->
        <div class="login-wrapper ">
            <!-- START Login Background Pic Wrapper-->
            <div class="bg-pic">
                <!-- START Background Pic-->
                <img src="<?php echo Router::url("/template/pages-ace/assets/img/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg", true) ?>" data-src="<?php echo Router::url("/template/pages-ace/assets/img/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg", true) ?>" data-src-retina="<?php echo Router::url("/template/pages-ace/assets/img/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg", true) ?>" alt="" class="lazy">
                <!-- END Background Pic-->
                <!-- START Background Caption-->
                <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
                    <h2 class="semi-bold text-white">
                        Pages make it easy to enjoy what matters the most in the life</h2>
                    <p class="small">
                        images Displayed are solely for representation purposes only, All work copyright of respective owner, otherwise © 2013-2014 REVOX.
                    </p>
                </div>
                <!-- END Background Caption-->
            </div>
            <!-- END Login Background Pic Wrapper-->
            <!-- START Login Right Container-->
            <div class="login-container bg-white">
                <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
                    <img src="<?php echo Router::url("/template/pages-ace/assets/img/logo.png", true) ?>" alt="logo" data-src="<?php echo Router::url("/template/pages-ace/assets/img/logo.png", true) ?>" data-src-retina="<?php echo Router::url("/template/pages-ace/assets/img/logo_2x.png", true) ?>" width="78" height="22">
                    <p class="p-t-35">Sign into your pages account</p>
                    <!-- START Login Form -->
                    
                        <?php
                            echo $this->fetch("content");
                        ?>
                    <!--<form id="form-login" class="p-t-15" role="form" action="/stn_cake_base/admin">-->
                        <!-- START Form Control-->
                        <!--
                        <div class="form-group form-group-default">
                            <label>Login</label>
                            <div class="controls">
                                <input type="text" name="username" placeholder="User Name" class="form-control" required>
                            </div>
                        </div>
                        -->
                        <!-- END Form Control-->
                        <!-- START Form Control-->
                        <!--
                        <div class="form-group form-group-default">
                            <label>Password</label>
                            <div class="controls">
                                <input type="password" class="form-control" name="password" placeholder="Credentials" required>
                            </div>
                        </div>
                        -->
                        <!-- START Form Control-->
                        <div class="row">
                            <div class="col-md-6 no-padding">
                                <div class="checkbox ">
                                    <input type="checkbox" value="1" id="checkbox1">
                                    <label for="checkbox1">Keep Me Signed in</label>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="#" class="text-info small">Help? Contact Support</a>
                            </div>
                        </div>
                        <!-- END Form Control-->
                        <!--<button class="btn btn-primary btn-cons m-t-10" type="submit">Sign in</button>-->
                    <!--</form>-->
                    <!--END Login Form-->
                    <div class="pull-bottom sm-pull-bottom">
                        <div class="m-b-30 p-r-80 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix">
                            <div class="col-sm-3 col-md-2 no-padding">
                                <img alt="" class="m-t-5" data-src="<?php echo Router::url("/template/pages-ace/assets/img/pages_icon.png", true) ?>" data-src-retina="<?php echo Router::url("/template/pages-ace/assets/img/pages_icon_2x.png", true) ?>" height="60" src="<?php echo Router::url("/template/pages-ace/assets/img/pages_icon.png", true) ?>" width="60">
                            </div>
                            <div class="col-sm-9 no-padding m-t-10">
                                <p><small>
                                        Create a pages account. If you have a facebook account, log into it for this process. Sign in with <a href="#" class="text-info">Facebook</a> or <a href="#" class="text-info">Google</a></small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Login Right Container-->
        </div>
       
        <!-- END PAGE CONTAINER -->
        <script>
            $(function ()
            {
                $('#form-login').validate()
            })
        </script>
    </body>
</body>
</html>