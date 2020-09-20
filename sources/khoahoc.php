<br>
<section class="form">
    <form class='user-pms' action="" method="post">
        <table class="">
            <tr>
                <th>Mã Khóa học</th>
                <td>
                    <input type="hidden" id="id">
                    <input value="<?=randId('KH')?>" id="ma_khoahoc" type="text" class="form-control">
                </td>
            </tr>
            <tr>
                <th>Tên khóa học</th>
                <td>
                    <input id="ten_khoahoc" type="text" class="form-control">
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
        $data = $d->o_fet("select * from #_khoahoc order by ten_khoahoc asc");
    ?>
    <table class="data-table" border>
        <thead>
            <tr>
                <th>ID</th>
                <th>Mã khóa học</th>
                <th>Tên khóa học</th>
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
                    <td><?=$item['ma_khoahoc']?></td>
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
</section>
<script>

    // những hàm này dùng chung cho nhiều trang, đa số các trang đều có cấu trúc như vậy
    // xem chi tiết ở trong file hedaotao.php 
    
    $('form').submit(function (e) { 
        e.preventDefault();
        var id = $('#id').val();
        var payload = {
            'id'         :id,
            'ma_khoahoc' :$('#ma_khoahoc').val(),
            'ten_khoahoc':$('#ten_khoahoc').val(),
        };
        if (id>0){
            postData('update','db_khoahoc',payload,true);
        }else{
            postData('add','db_khoahoc',payload,true);
        }
    });
    function onDelete(id){
        var payload ={
            'id':id
        };
        if (confirm('Xóa khỏi danh sách ?')){
            postData('delete','db_khoahoc',payload,true);
        }
    }
    function onUpdate(json){
        $('#ed').html('Cập nhật');
        $('#id').val(json.id);
        $('#ma_khoahoc').val(json.ma_khoahoc);
        $('#ten_khoahoc').val(json.ten_khoahoc);
    }
</script>