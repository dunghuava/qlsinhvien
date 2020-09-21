<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sinh viên</title>
    <base id="uri" href="<?=base_url()?>">
    <link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?=base_url('publics/font-awesome/css/font-awesome.css')?>">
    <link rel="stylesheet" href="<?=base_url('publics/bootstrap/css/bootstrap.css')?>">
    <script src="<?=base_url('publics/js/jquery.js')?>"></script>
    <script src="<?=base_url('publics/bootstrap/js/bootstrap.js')?>"></script>
    <link rel="stylesheet" href="<?=base_url('publics/css/app.css?v='.time())?>">
    
    <?php 
        $lasinhvien=false;
        if ($udata=='sinhvien'){
            $lasinhvien=true;
        } 
    ?>

</head>
<body class="container app">
    <header>
        <div class="banner-top">
            <div class="row">
                <div class="col-md-2">
                    <div class="text-center">
                        <img src="<?=base_url('publics/images/logo.png')?>" alt="" class="logo">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="text-center title-banner">
                        <h2>PHẦN MỀM QUẢN LÝ SINH VIÊN</h2>
                    </div>
                </div>
            </div>
        </div>
        <nav class="nav-top">
            <ul>
                <li><a href=""><span class="fa fa-home"></span>&nbsp;Trang chủ</a></li>
                <li><a href="<?=base_url('map')?>"><span class="fa fa-users"></span>&nbsp;Bản đồ sinh viên</a></li>
                <li><a href=""><span class="fa fa-info"></span>&nbsp;Giới thiệu</a></li>
                <li style="float:right;border-right:0px;"><a href="<?=base_url('logout')?>"><span class="fa fa-sign-out"></span>&nbsp;Đăng xuất</a></li>
            </ul>
        </nav>
    </header>
    <div id="backtotop"><span class="fa fa-angle-up"></span></div>
    <div id="spinner" hidden>&nbsp;Đang tải...</div>

    <!-- Ở ĐÂY KHÔNG CÓ GÌ CA< GIAO DIỆN THÔI -->
    