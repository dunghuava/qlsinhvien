<br>
<section class="form">
    <form class='user-pms' action="" method="post">
        <table class="">
            <tr>
                <th>Mã lớp</th>
                <td>
                    <input type="hidden" id="id">
                    <input id="ma_lop" type="text" class="form-control">
                </td>
                <td>&nbsp;&nbsp;</td>
                <th>Chọn khóa</th>
                <td>
                    <?php 
                        $khoahoc = $d->o_fet("select * from #_khoahoc")
                    ?>
                    <select name="" id="ma_khoahoc" class="form-control">
                        <option value="0">Chọn niên khóa</option>
                        <?php foreach ($khoahoc as $item){ ?>
                            <option value="<?=$item['id']?>"><?=$item['ten_khoahoc']?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Tên lớp</th>
                <td>
                    <input id="ten_lop" type="text" class="form-control">
                </td>
                <td>&nbsp;&nbsp;</td>
                <th>Chọn ngành</th>
                <td>
                    <?php 
                        $nganh = $d->o_fet("select * from #_nganh")
                    ?>
                    <select name="" id="ma_nganh" class="form-control">
                        <option value="0">Chọn ngành</option>
                        <?php foreach ($nganh as $item){ ?>
                            <option value="<?=$item['id']?>"><?=$item['ten_nganh']?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Chọn khoa</th>
                <td>
                    <?php 
                        $khoa = $d->o_fet("select * from #_khoa")
                    ?>
                    <select name="" id="ma_khoa" class="form-control">
                        <option value="0">Chọn khoa</option>
                        <?php foreach ($khoa as $item){ ?>
                            <option value="<?=$item['id']?>"><?=$item['ten_khoa']?></option>
                        <?php } ?>
                    </select>
                </td>
                <td>&nbsp;&nbsp;</td>
                <th>Hệ đào tạo</th>
                <td>
                    <?php 
                        $he = $d->o_fet("select * from #_hedaotao")
                    ?>
                    <select name="" id="ma_he" class="form-control">
                        <option value="0">Chọn hệ đào tạo</option>
                        <?php foreach ($he as $item){ ?>
                            <option value="<?=$item['ma_he']?>"><?=$item['ten_he']?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <tr>
                    <th></th>
                    <td class="02">
                        <button style="width:49%" class="btn btn-danger">Reset</button>
                        <button id="ed" style="width:49%" class="btn btn-primary">Thêm</button>
                    </td>
                </tr>
            </tr>
        </table>
    </form>
    <br>
    <?php 
        $data = $d->o_fet("select a.*,b.ten_khoahoc,c.ten_khoa from #_lop a left join #_khoahoc b on a.ma_khoahoc=b.id left join #_khoa c on a.ma_khoa=c.id order by ten_lop asc ")
    ?>
    <div class="table-overflow">
    <table class="data-table" border>
        <thead>
            <tr>
                <th>ID</th>
                <th>Mã lớp</th>
                <th>Tên lớp</th>
                <th>Tên khoa</th>
                <th>Tên khóa</th>
                <th>Ngày tạo</th>
                <th class='user-pms' style="width:10%">Todo</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($data as $item){
            ?>
                <tr>
                    <td><?=$item['id']?></td>
                    <td><?=$item['ma_lop']?></td>
                    <td><?=$item['ten_lop']?></td>
                    <td><?=$item['ten_khoa']?></td>
                    <td><?=$item['ten_khoahoc']?></td>
                    <td><?=$item['ngay_tao']?></td>
                    <td class='user-pms'>
                        <button onclick="onUpdate(<?=tojson($item)?>)"  class="btn btn-primary user-pms"><span class="pointer fa fa-edit"></span></button>
                        <button onclick="onDelete('<?=$item['id']?>')" class="btn btn-danger user-pms"><span class="pointer fa fa-trash"></span></button>
                    </td>
                </tr>
            <?php 
                } 
            ?>
        </tbody>
    </table>
    </div>
</section>

<script>

    // những hàm này dùng chung cho nhiều trang, đa số các trang đều có cấu trúc như vậy
    // xem chi tiết ở trong file hedaotao.php 
    
    $('form').submit(function (e) { 
        e.preventDefault();
        var id = $('#id').val();
        var payload = {
            'id'    :id,
            'ma_lop':$('#ma_lop').val(),
            'ten_lop':$('#ten_lop').val(),
            'ma_khoa':$('#ma_khoa').val(),
            'ma_khoahoc':$('#ma_khoahoc').val(),
            'ma_nganh':$('#ma_nganh').val(),
            'ma_he':$('#ma_he').val(),
        };
        if (id>0){
            postData('update','db_lop',payload,true);
        }else{
            postData('add','db_lop',payload,true);
        }
    });
    function onDelete(id){
        var payload ={
            'id':id
        };
        if (confirm('Xóa khỏi danh sách ?')){
            postData('delete','db_lop',payload,true);
        }
    }
    function onUpdate(json){
        $('#ed').html('Cập nhật');
        $('#id').val(json.id);
        $('#ma_lop').val(json.ma_lop);
        $('#ten_lop').val(json.ten_lop);
        $('#ma_khoa').val(json.ma_khoa);
        $('#ma_khoahoc').val(json.ma_khoahoc);
        $('#ma_nganh').val(json.ma_nganh);
        $('#ma_he').val(json.ma_he);
    }
</script>