<br>
<section class="form">
    <form class='user-pms' action="" method="post">
        <table class="">
            <tr>
                <th>Mã Hệ</th>
                <td>
                    <input type="hidden" id="id">
                    <input value="<?=randId('H')?>" required id="ma_he" type="text" class="form-control text-uppercase">
                </td>
            </tr>
            <tr>
                <th>Tên Hệ</th>
                <td>
                    <input required id="ten_he" type="text" class="form-control">
                </td>
            </tr>
            <tr>
                <tr>
                    <th></th>
                    <td class="02">
                        <button type="reset" style="width:49%" class="btn btn-danger">Reset</button>
                        <button id="ed" style="width:49%" class="btn btn-primary">Thêm</button>
                    </td>
                </tr>
            </tr>
        </table>
    </form>
    <br>
    <?php 
        $data = $d->o_fet("select * from #_hedaotao order by ten_he asc");
    ?>
    <table class="data-table" border>
        <thead>
            <tr>
                <th>ID</th>
                <th>Mã Hệ</th>
                <th>Tên Hệ</th>
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
                    <td><?=$item['ma_he']?></td>
                    <td><?=$item['ten_he']?></td>
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
    // khi bấm thêm thì chạy vào hàm này
    $('form').submit(function (e) {  // hàm số 1
        e.preventDefault();
        var id = $('#id').val(); // lấy id ra 
        var payload = {
            'id'    :id,
            'ma_he' :$('#ma_he').val(),
            'ten_he':$('#ten_he').val(),
        };
        // nếu id >0 tức là sửa 1 cái có sẵn
        if (id>0){
            // chạy vào hàm sửa = (update) cập nhật (sửa)
            postData('update','db_hedaotao',payload,true); // hàm này gọi tới file ajax.php ở trong thư mục model
            //==> muốn xem kĩ hơn thì vào publics/js/app.js để xem code, cũng k có gì hay ho :))
        }else{
            // nếu id ko có thì tức là thêm tạo mới == add (thêm)
            postData('add','db_hedaotao',payload,true); // hàm này gọi tới file ajax.php ở trong thư mục model
        }
    });
    function onDelete(id){ // khi bấm nút xóa
        // xóa danh sách theo ID
        var payload ={
            'id':id
        };
        if (confirm('Xóa khỏi danh sách ?')){
            // gọi hàm xóa = delete
            postData('delete','db_hedaotao',payload,true); // hàm này gọi tới file ajax.php ở trong thư mục model
        }
    }
    function onUpdate(json){ // khi bấm nút chỉnh sửa thì load lại dữ liệu lên ô nhập input để nhìn chõ rõ con mắt
        $('#ed').html('Cập nhật');
        $('#id').val(json.id); // sửa thei id này này
        $('#ma_he').val(json.ma_he);
        $('#ten_he').val(json.ten_he);
    }
</script>