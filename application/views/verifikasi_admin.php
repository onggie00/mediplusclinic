<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mediplus Admin Panel </title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="Onggie Danny" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="..\files\assets\images\favicon.ico" type="image/x-icon">
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" href="<?php echo base_url('resource_admin/'); ?>bower_components/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('resource_admin/'); ?>icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('resource_admin/'); ?>icon/icofont/css/icofont.css">
    <!-- Master.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('resource_admin/'); ?>/css/master.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('resource_admin/'); ?>/css/style.css">
</head>

<body class="fix-menu">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    
                        <form class="md-float-material form-material" action="<?php echo site_url('admin/login/check_code'); ?>" method="post">
                            <div class="text-center">
                                <img src="<?php echo base_url('resource_admin/'); ?>/images/admin/logo.png" alt="logo.png">
                            </div>
                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center">Login Administrator</h3>
                                            <h5 class="text-center">Silahkan Cek Nomor Telepon anda, Kemudian Masukkan Kode Verifikasi Yang Dikirim Melalui SMS</h5>
                                        </div>
                                        <div class="col-md-12">
                                            <?php if (isset($err_msg)): ?>
                                                <br>
                                                <div class="alert alert-danger icons-alert mb-0" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <i class="icofont icofont-close-line-circled"></i>
                                                    </button>
                                                    <p> <?php echo $err_msg; ?> </p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input style="text-transform:uppercase;" type="text" name="code" class="form-control" required placeholder="ASD676">
                                        <span class="form-bar"></span>
                                    </div>
                                    
                                    <div class="row m-t-30">
                                        <div class="col-md-12">
                                            <button type="submit" name="btn_login" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Confirm</button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <p class="text-inverse text-left m-b-0">Terima Kasih.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- end of form -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>

    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="<?php echo base_url('resource_admin/'); ?>bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('resource_admin/'); ?>bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('resource_admin/'); ?>bower_components/popper.js\js\popper.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('resource_admin/'); ?>bower_components/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?php echo base_url('resource_admin/'); ?>bower_components/jquery-slimscroll/js\jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="<?php echo base_url('resource_admin/'); ?>bower_components/modernizr/js/modernizr.js"></script>
    <script type="text/javascript" src="<?php echo base_url('resource_admin/'); ?>bower_components/modernizr/js/css-scrollbars.js"></script>
    <!-- i18next.min.js -->
    <script type="text/javascript" src="<?php echo base_url('resource_admin/'); ?>bower_components/i18next/js/i18next.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('resource_admin/'); ?>bower_components/i18next-xhr-backend\js/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('resource_admin/'); ?>bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('resource_admin/'); ?>bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('resource_admin/'); ?>js/common-pages.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  //gtag('js', new Date());

  //gtag('config', 'UA-23581568-13');
</script>
</body>

</html>
