<br>
<section class="form">
    <form action="" method="post">
        <table class="">
            <tr>
                <th>Mã ngành</th>
                <td>
                    <input type="hidden" id="id">
                    <input value="<?=randId('D')?>" id="ma_nganh" type="text" class="form-control">
                </td>
            </tr>
            <tr>
                <th>Tên ngành</th>
                <td>
                    <input id="ten_nganh" type="text" class="form-control">
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
        $data = $d->o_fet("select a.*,b.ten_khoa from #_nganh a inner join #_khoa b on a.ma_khoa=b.id order by ten_nganh asc");
    ?>
    <table class="data-table" border>
        <thead>
            <tr>
                <th>ID</th>
                <th>Mã ngành</th>
                <th>Tên ngành</th>
                <th>Khoa</th>
                <th>Ngày tạo</th>
                <th>Todo</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($data as $item){
            ?>
                <tr>
                    <td><?=$item['id']?></td>
                    <td><?=$item['ma_nganh']?></td>
                    <td><?=$item['ten_nganh']?></td>
                    <td><?=$item['ten_khoa']?></td>
                    <td><?=$item['ngay_tao']?></td>
                    <td>
                        <button onclick="onUpdate(<?=tojson($item)?>)"  class="btn btn-primary"><span class="pointer fa fa-edit"></span></button>
                        <button onclick="onDelete('<?=$item['id']?>')" class="btn btn-danger"><span class="pointer fa fa-trash"></span></button>
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
            'id'       :id,
            'ma_nganh' :$('#ma_nganh').val(),
            'ten_nganh':$('#ten_nganh').val(),
            'ma_khoa'  :$('#ma_khoa').val(),
        };
        if (id>0){
            postData('update','db_nganh',payload,true);
        }else{
            postData('add','db_nganh',payload,true);

        }
    });
    function onDelete(id){
        var payload ={
            'id':id
        };
        if (confirm('Xóa khỏi danh sách ?')){
            postData('delete','db_nganh',payload,true);
        }
    }
    function onUpdate(json){
        $('#ed').html('Cập nhật');
        $('#id').val(json.id);
        $('#ma_nganh').val(json.ma_nganh);
        $('#ten_nganh').val(json.ten_nganh);
        $('#ma_khoa').val(json.ma_khoa);
    }
</script>