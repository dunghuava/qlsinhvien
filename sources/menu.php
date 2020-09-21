<?php 
    $page = 'sinhvien';
    if (isset($_GET['page'])){
        $page = $_GET['page'];
    }
    // TRANG DANH SÁCH MENU
?>
<style>
    .parent-menu_s p{
        margin:4px 0px;
    }
</style>
<section class="menu-area">
    <h3 class="title-area"><span class="fa fa-bars"></span>&nbsp;Quản lý</h3>
    <ul class="parent-menu">
        <li <?=$lasinhvien ? 'hidden':''?> <?=$page=='hedaotao' ? 'class="active"':''?>><a href="<?=base_url('hedaotao')?>">Hệ đào tạo</a></li>
        <li <?=$lasinhvien ? 'hidden':''?> <?=$page=='khoahoc' ? 'class="active"':''?>><a href="<?=base_url('khoahoc')?>">Khóa học</a></li>
        <li <?=$lasinhvien ? 'hidden':''?> <?=$page=='khoa' ? 'class="active"':''?>><a href="<?=base_url('khoa')?>">Khoa</a></li>
        <li <?=$lasinhvien ? 'hidden':''?> <?=$page=='nganhhoc' ? 'class="active"':''?>><a href="<?=base_url('nganhhoc')?>">Ngành học</a></li>
        <li <?=$lasinhvien ? 'hidden':''?> <?=$page=='lop' ? 'class="active"':''?>><a href="<?=base_url('lop')?>">Lớp học</a></li>
        <li <?=$page=='sinhvien' ? 'class="active"':''?>><a href="<?=base_url('sinhvien')?>">Sinh viên</a></li>
    </ul>
</section>
<section class="menu-area">
    <h3 class="title-area"><span class="fa fa-cog"></span>&nbsp;
        <a style="color:white" class="no-link" href="<?=base_url('map')?>">Bản đồ sinh viên</a>
    </h3>
    <ul class="parent-menu_s">
        <p>
            <input id="masv_s" type="text" class="form-control" placeholder="Nhập vào MSSV">
        </p>
        <p>
        <?php 
            $nganh = $d->o_fet("select * from #_nganh")
        ?>
        <select name="" id="ma_nganh_s" class="form-control">
            <option value="0">Chọn ngành</option>
            <?php foreach ($nganh as $item){ ?>
                <option value="<?=$item['id']?>"><?=$item['ten_nganh']?></option>
            <?php } ?>
        </select>
        </p>
        <p>
            <?php 
                $khoa = $d->o_fet("select * from #_khoa")
            ?>
            <select name="" id="ma_khoa_s" class="form-control">
                <option value="0">Chọn khoa</option>
                <?php foreach ($khoa as $item){ ?>
                    <option value="<?=$item['id']?>"><?=$item['ten_khoa']?></option>
                <?php } ?>
            </select>
        </p>
        <p>
          <button onclick="onSearch()" class="btn btn-danger btn-block text-left">
            Tìm kiếm
          </button>
        </p>
    </ul>
</section>