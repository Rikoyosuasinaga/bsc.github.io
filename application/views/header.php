<!DOCTYPE html>
<html lang="en">


<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta name="google-site-verification" content="vZ6v2LBbVz1TaNR1LYgn622ciIIaruR02hOWEkyArs0" />
    <title><?= mainweb('nama') ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Favicons -->
    <link href="<?= base_url() ?>assets/front/img/gallery/banner.png" rel="icon">
    <!-- Google Fonts -->
    <!--
	<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyCMSVUmRbqoHEFSBQ_reQXjqfvna-zuPHE&callback=initMap"></script>
	-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Orienta' rel='stylesheet'>
    <!-- Bootstrap CSS File -->
    <link href="<?= base_url() ?>assets/front/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Libraries CSS Files -->
    <link href="<?= base_url() ?>assets/front/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/front/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/front/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/front/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/front/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/admin/css/bootstrap-material-datetimepicker.css" type="text/css" rel="stylesheet" media="screen,projection">
    <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/moment-with-locales.min.js"></script>
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Main Stylesheet File -->
    <link href="<?= base_url() ?>assets/front/css/style.css" rel="stylesheet">
    <script src="<?= base_url() ?>assets/front/lib/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/files/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url() ?>assets/files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?= base_url() ?>assets/files/assets/pages/data-table/js/jszip.min.js"></script>
        <script src="<?= base_url() ?>assets/files/assets/pages/data-table/js/pdfmake.min.js"></script>
        <script src="<?= base_url() ?>assets/files/assets/pages/data-table/js/vfs_fonts.js"></script>
        <script src="<?= base_url() ?>assets/files/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="<?= base_url() ?>assets/files/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="<?= base_url() ?>assets/files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url() ?>assets/files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url() ?>assets/files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        
</head>

<body>
    <!--==========================
  Header
  ============================-->
    <header id="header" class="fixed-top">
        <div class="container">
            <div class="logo float-left">
                <a href="<?= site_url() ?>#intro" class="scrollto"><img src="<?= base_url() ?>logo/<?= mainweb('logo') ?>" alt="" class="img-fluid"></a>
            </div>
            <nav class="main-nav float-right d-none d-lg-block">
                <ul>
                    <li class="active"><a href="<?= site_url() ?>#intro">Home</a></li>
                    <li><a href="<?= site_url() ?>lapangan">Lapangan</a></li>
                    <li class="drop-down"><a href="#">Info</a>
                        <ul>
                            <li><a href="<?= site_url() ?>jadwal">Jadwal</a></li>
                            <li><a href="<?= site_url() ?>#gallery">Galeri</a></li>
                            <li><a href="<?= site_url() ?>#video">Video</a></li>
                            <li><a href="<?= site_url() ?>#about">About Us</a></li>
                            <li><a href="<?= site_url() ?>#testimonials">Merchandise</a></li>
                        </ul>
                    </li>
                    <?php if($this->session->userdata('username_')==''){ ?>
                    <li><a href="<?= site_url() ?>user">Login</a></li>
                    <?php }else{ ?>
                    <li><a href="<?= site_url() ?>riwayat">Riwayat</a></li>
                    <li><a href="<?= site_url() ?>user/logout">Logout</a></li>
                    <?php } ?>
                </ul>
                
            </nav><!-- .main-nav -->
        </div>
    </header>