<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Black &amp; White Administrator</title>
  <!-- plugins:css -->
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('admin/'); ?>font/iconsmind-s/css/iconsminds.css">
  <link rel="stylesheet" href="<?php echo base_url('admin/'); ?>font/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="<?php echo base_url('admin/'); ?>css/vendor/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('admin/'); ?>css/vendor/bootstrap-float-label.min.css">
  <link rel="stylesheet" href="<?php echo base_url('admin/'); ?>css/main.css">
  <link rel="stylesheet" href="<?php echo base_url('admin/'); ?>css/dore.light.blue.min.css" />
  <!-- End plugin css for this page -->
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo base_url('assets/'); ?>image/logo/logo_black.ico" />
</head>

<body class="background show-spinner">
    <div class="fixed-background"></div>
    <main>
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                    <div class="card-block auth-card">
                      <div class="row">

                        <div class="position-relative image-side col-md-5">

                            <p class=" text-white h2">BLACK &amp; WHITE BARBERSHOP</p>

                            <p class="white mb-0">
                                Please use your credentials to login.
                            </p>
              <?php if (isset($err_msg)): ?>
                <br>
                <div class="alert alert-danger alert-dismissible fade show rounded mb-0" role="alert">
                    <span><i class="iconsminds-danger"></i></span> <?php echo $err_msg; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              <?php endif; ?>
                        </div>
                        <div class="form-side col-md-7">
                            <a href="">
                                <span class="logo-single" ></span>
                            </a>
                            <h6 class="mb-4">Login</h6>
              <form class="pt-3" action="<?php echo site_url('admin/login/do_login') ?>" method="post">
                <div class="form-group">
                  <!--<label for="exampleInputEmail">Username</label>-->
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="iconsminds-user text-primary"></i>
                      </span>
                    </div>
                    <input type="text" class=" form-control form-control-lg border-left-0" id="username" name="username"placeholder="Username">
                  </div>
                </div>
                <div class="form-group">
                  <!--<label for="exampleInputPassword">Password</label>-->
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="iconsminds-password text-primary"></i>
                      </span>
                    </div>
                    <input type="password" class="form-control form-control-lg border-left-0" id="password" name="password" placeholder="Password">
                  </div>
                </div>
                <div class="my-3">
                  <button type="submit"class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="">LOGIN</button>
                </div>
              </form>
                        </div>
                        
<div class="col-lg-6 d-flex flex-row">
  <p class="text-white font-weight-medium text-left flex-grow align-self-end">Copyright &copy; 2019  All rights reserved.</p>
</div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript" src="<?php echo base_url('admin/'); ?>js/vendor/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url('admin/'); ?>js/vendor/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url('admin/'); ?>js/vendor/bootstrap-notify.min.js"></script>
    <script src="<?php echo base_url('admin/'); ?>js/vendor/mousetrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('admin/'); ?>js/vendor/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('admin/'); ?>js/dore.script.js"></script>
    <script type="text/javascript" src="<?php echo base_url('admin/'); ?>js/scripts.single.theme.js"></script>
</body>

</html>
