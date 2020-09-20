<br>
<section class="form">
    <form class='user-pms' action="" method="post">
        <table class="">
            <tr>
                <th>Mã Khoa</th>
                <td>
                    <input type="hidden" id="id">
                    <input id="ma_khoa" type="text" class="form-control">
                </td>
            </tr>
            <tr>
                <th>Tên khoa</th>
                <td>
                    <input id="ten_khoa" type="text" class="form-control">
                </td>
            </tr>
            <tr>
                <tr>
                    <th></th>
                    <td class="02">
                        <button style="width:49%" class="btn btn-danger">Reset</button>
                        <button id="ed" style="width:49%" class="btn btn-primary">Thêm khoa</button>
                    </td>
                </tr>
            </tr>
        </table>
    </form>
    <br>
    <?php 
        $data = $d->o_fet("select * from #_khoa order by ten_khoa asc");
    ?>
    <table class="data-table" border>
        <thead>
            <tr>
                <th>ID</th>
                <th>Mã khoa</th>
                <th>Tên khoa</th>
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
                    <td><?=$item['ma_khoa']?></td>
                    <td><?=$item['ten_khoa']?></td>
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
            'id'      :id,
            'ma_khoa' :$('#ma_khoa').val(),
            'ten_khoa':$('#ten_khoa').val(),
        };
        if (id>0){
            postData('update','db_khoa',payload,true); // gọi hàm sửa
        }else{
            postData('add','db_khoa',payload,true); // gọi hàm xóa
        }
    });
    function onDelete(id){
        var payload ={
            'id':id
        };
        if (confirm('Xóa khỏi danh sách ?')){
            postData('delete','db_khoa',payload,true);
        }
    }
    function onUpdate(json){
        $('#ed').html('Cập nhật');
        $('#id').val(json.id);
        $('#ma_khoa').val(json.ma_khoa);
        $('#ten_khoa').val(json.ten_khoa);
    }
</script>