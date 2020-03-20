<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title_page; ?> - Mediplus </title>
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
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="<?php echo base_url('resource_admin/'); ?>images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('resource_admin/'); ?>bower_components/bootstrap/css/bootstrap.min.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('resource_admin/'); ?>icon/feather/css/feather.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('resource_admin/'); ?>icon/icofont/css/icofont.css">
    <!-- Data Table Css -->
     <link rel="stylesheet" type="text/css" href="<?php echo base_url('resource_admin/'); ?>bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('resource_admin/'); ?>pages/data-table/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('resource_admin/'); ?>bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
    
    <!-- Master.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('resource_admin/'); ?>css/master.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('resource_admin/'); ?>css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('resource_admin/'); ?>css/jquery.mCustomScrollbar.css">
</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader ">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu hidden" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu"></i>
                        </a>
                        <a href="#">
                            <div class="menu-logo">
                                
                            </div>
                        </a>
                        
                    </div>

                    <div class="navbar-container container-fluid">
                        
                        <ul class="nav-right">
                            
                            
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        
                                        <span><?php echo $nama_lengkap; ?></span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        
                                        
                                            <a href="<?php echo site_url('admin/login_asisten/logout'); ?>">
                                        <li>
                                                <i class="feather icon-log-out"></i> Logout
                                        </li>
                                            </a>
                                    </ul>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!--Side Navbar-->
            <!-- Sidebar inner chat end-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="pcoded-navigatio-lavel">Mediplus Navigation</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="<?php echo site_url('admin/asisten/dashboard'); ?>">
                                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                        <span class="pcoded-mtext">Dashboard Antrian</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url('admin/asisten/jadwal_dokter_asisten'); ?>" >
                                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                        <span class="pcoded-mtext">Manajemen Jadwal &amp; Dokter</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url('admin/asisten/rekam_medis_asisten'); ?>" >
                                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                        <span class="pcoded-mtext">Rekam Medis Pasien</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url('admin/asisten/transaksi_asisten'); ?>" >
                                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                        <span class="pcoded-mtext">Transaksi</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="<?php echo site_url('admin/asisten/chat'); ?>">
                                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                        <span class="pcoded-mtext">Chat</span>
                                    </a>
                                </li>
                                <!--<li class="">
                                    <a href="<?php echo site_url('admin/asisten/biaya_pasien_asisten'); ?>" >
                                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                        <span class="pcoded-mtext">Manajemen Biaya Pasien</span>
                                    </a>
                                </li>-->
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="feather icon-sidebar"></i></span>
                                        <span class="pcoded-mtext">Notifikasi Pasien</span>
                                        <span class="pcoded-badge label label-warning hidden">NEW</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class=" ">
                                            <a href="<?php echo site_url('admin/asisten/notifikasi_asisten'); ?>" >
                                                <span class="pcoded-mtext">Pasien Berlangganan</span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="<?php echo site_url('admin/asisten/notifikasi_asisten_antrian'); ?>" >
                                                <span class="pcoded-mtext">Antrian Pasien</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                
                                <li class="">
                                    <a href="<?php echo site_url('admin/asisten/pasien_dokter_asisten'); ?>" >
                                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                        <span class="pcoded-mtext">Manajemen Pasien</span>
                                    </a>
                                </li>
                                
                                
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>