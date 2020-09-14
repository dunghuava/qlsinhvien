<br>
<section class="form">
    <form action="" method="post">
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
                <th style="width:10%">Todo</th>
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
    $('form').submit(function (e) { 
        e.preventDefault();
        var id = $('#id').val();
        var payload = {
            'id'    :id,
            'ma_he' :$('#ma_he').val(),
            'ten_he':$('#ten_he').val(),
        };
        if (id>0){
            postData('update','db_hedaotao',payload,true);
        }else{
            postData('add','db_hedaotao',payload,true);
        }
    });
    function onDelete(id){
        var payload ={
            'id':id
        };
        if (confirm('Xóa khỏi danh sách ?')){
            postData('delete','db_hedaotao',payload,true);
        }
    }
    function onUpdate(json){
        $('#ed').html('Cập nhật');
        $('#id').val(json.id);
        $('#ma_he').val(json.ma_he);
        $('#ten_he').val(json.ten_he);
    }
</script>