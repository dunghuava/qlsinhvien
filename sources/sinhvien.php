<br>
<style>
    form table{
        width:100%;
    }
</style>
<section class="form">
    <form action="" method="post">
        <table class="">
            <tr>
                <th>Mã sinh viên</th>
                <td>
                    <input type="hidden" id="id">
                    <input type="hidden" id="_lat">
                    <input type="hidden" id="_lng">
                    <input id="ma_sv" type="text" class="form-control">
                </td>
                <td>&nbsp;&nbsp;</td>
                <th>Quê quán</th>
                <td>
                    <?php 
                        $province = $d->o_fet("select * from #_province")
                    ?>
                    <select name="" id="que_quan" class="form-control">
                        <option value="0">Quê quán</option>
                        <?php foreach ($province as $item){ ?>
                            <option value="<?=$item['province_name']?>"><?=$item['province_name']?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Họ tên</th>
                <td>
                    <input id="ho_ten" type="text" class="form-control">
                </td>
                <td>&nbsp;&nbsp;</td>
                <th>Dân tộc</th>
                <td>
                    <input id="dan_toc" type="text" class="form-control">
                </td>
            </tr>
            <tr>
                <th>Ngày sinh</th>
                <td>
                    <input id="ngay_sinh" type="date" data-date-format="DD MMMM YYYY" class="form-control">
                </td>
                <td>&nbsp;&nbsp;</td>
                <th>Tôn giáo</th>
                <td>
                    <input id="ton_giao" type="text" class="form-control">
                </td>
            </tr>
            <tr>
                <th>Điện thoại</th>
                <td>
                    <input id="dien_thoai" type="phone" class="form-control">
                </td>
                <td>&nbsp;&nbsp;</td>
                <th>Họ tên cha</th>
                <td>
                    <input id="hoten_cha" type="text" class="form-control">
                </td>
            </tr>
            <tr>
                <th>Giới tính</th>
                <td>
                    <select name="" id="gioi_tinh" class="form-control">
                        <option value="0">Nam</option>
                        <option value="1">Nữ</option>
                    </select>
                </td>
                <td>&nbsp;&nbsp;</td>
                <th>Họ tên mẹ</th>
                <td>
                    <input id="hoten_me" type="text" class="form-control">
                </td>
            </tr>
            <tr>
                <th>Địa chỉ</th>
                <td>
                    <input onFocus="geolocate()" id="dia_chi" type="text" class="form-control">
                </td>
                <td>&nbsp;&nbsp;</td>
                <th>Chọn lớp</th>
                <td>
                    <?php 
                        $lop = $d->o_fet("select * from #_lop")
                    ?>
                    <select name="" id="ma_lop" class="form-control">
                        <option value="0">Chọn lớp</option>
                        <?php foreach ($lop as $item){ ?>
                            <option value="<?=$item['id']?>"><?=$item['ten_lop']?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Nơi sinh</th>
                <td>
                    <select name="" id="noi_sinh" class="form-control">
                        <option value="0">Nơi sinh</option>
                        <?php foreach ($province as $item){ ?>
                            <option value="<?=$item['province_name']?>"><?=$item['province_name']?></option>
                        <?php } ?>
                    </select>
                </td>
                <th></th>
                <td></td>
                <td class="02">
                    <button style="width:49%" class="btn btn-danger">Reset</button>
                    <button id="ed" style="width:49%" class="btn btn-primary">Thêm</button>
                </td>
            </tr>
        </table>
    </form>
    <br>
    <?php 
        $data = $d->o_fet("select a.*,b.dia_chi,b.trang_thai,b._lat,b._lng,b.id as svid from #_sinhvien a inner join #_sinhvien_vitri b on a.id=b.sinhvien_id order by ho_ten asc");
    ?>
    <table class="data-table" border <?=$lasinhvien ? 'hidden':''?>>
        <thead>
            <tr>
                <th>ID</th>
                <th>Mã SV</th>
                <th>Họ tên</th>
                <th>Ngày sinh</th>
                <th style="width:15%">Tình trạng</th>
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
                    <td><?=$item['ma_sv']?></td>
                    <td><?=$item['ho_ten']?></td>
                    <td><?=$item['ngay_sinh']?></td>
                    <td class="text-center">
                       <select onchange="onChange(<?=$item['svid']?>,this)" class="form-control">
                            <option <?=$item['trang_thai']==1 ? 'selected':''?> value="1">✔ Đã duyệt</option>
                            <option <?=$item['trang_thai']==0 ? 'selected':''?> value="0">✖ Chưa duyệt</option>
                       </select>
                    </td>
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

<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjwJQRCuf970OLe6UuBiMvg_DyYW2PL6Y&callback=initAutocomplete&libraries=places&v=weekly" defer></script>
<script>

    // những hàm này dùng chung cho nhiều trang, đa số các trang đều có cấu trúc như vậy
    // xem chi tiết ở trong file hedaotao.php 
    // riêng file sinh viên này thì hơi khác một xíu
    function onChange(id,me){ // hàm này để thay đổi trạng thái đã duyệt / chưa duyệt của sinh viên
        var payload ={
            'id'        :id,
            'trang_thai':me.value
        };
        postData('update','db_sinhvien_vitri',payload,false); // gọi qua model/ajax.php
    }
    $('form').submit(function (e) { 
        e.preventDefault();
        var id = $('#id').val();
        var payload = {
            'id'         :id,
            'ma_sv'      :$('#ma_sv').val(),
            'ho_ten'     :$('#ho_ten').val(),
            'ngay_sinh'  :$('#ngay_sinh').val(),
            'gioi_tinh'  :$('#gioi_tinh').val(),
            'dien_thoai' :$('#dien_thoai').val(),
            'dia_chi'    :$('#dia_chi').val(),
            'noi_sinh'   :$('#noi_sinh').val(),
            'que_quan'   :$('#que_quan').val(),
            'dan_toc'    :$('#dan_toc').val(),
            'ton_giao'   :$('#ton_giao').val(),
            'hoten_cha'  :$('#hoten_cha').val(),
            'hoten_me'   :$('#hoten_me').val(),
            'quyen'      :$('#quyen').val(),
            'ma_lop'     :$('#ma_lop').val(),
            '_lat'       :$('#_lat').val(),
            '_lng'       :$('#_lng').val(),
        };
        if (id>0){
            postData('update','db_sinhvien',payload,true); // lại vào file ajax tiếp
        }else{
            postData('add','db_sinhvien',payload,true); // luôn luôn chạy vào file ajax.php
        }
    });
    function onDelete(id){
        var payload ={
            'id':id
        };
        if (confirm('Xóa khỏi danh sách ?')){
            postData('delete','db_sinhvien',payload,true);
        }
    }
    // lấy thông tin ra để hiển thị ok
    function onUpdate(json){
        $('#ed').html('Cập nhật');
        $('#id').val(json.id);
        $('#ma_sv').val(json.ma_sv);
        $('#ho_ten').val(json.ho_ten);
        $('#ngay_sinh').val(json.ngay_sinh);
        $('#dien_thoai').val(json.dien_thoai);
        $('#gioi_tinh').val(json.gioi_tinh);
        $('#dia_chi').val(json.dia_chi);
        $('#noi_sinh').val(json.noi_sinh);
        $('#que_quan').val(json.que_quan);
        $('#dan_toc').val(json.dan_toc);
        $('#ton_giao').val(json.ton_giao);
        $('#hoten_cha').val(json.hoten_cha);
        $('#hoten_me').val(json.hoten_me);
        $('#quyen').val(json.quyen);
        $('#ma_lop').val(json.ma_lop);
        $('#_lat').val(json._lat);
        $('#_lng').val(json._lng);
    }
</script>
<script>
      // hàm này là để khi m gõ địa chỉ nó sẽ hiện ra danh sách địa chỉ bao gồm tên đường, số nhà, quận, huyện, ko cần hiểu vì đây là của google
      "use strict";
      let placeSearch;
      let qgis_address;
      function initAutocomplete() {
          qgis_address = new google.maps.places.Autocomplete(
          document.getElementById("dia_chi"),
          {
            types: ["geocode"]
          }
        ); 
        qgis_address.setFields(["address_component","geometry"]);
        qgis_address.addListener("place_changed", fillInAddress);
      }
      function fillInAddress() {
        const place = qgis_address.getPlace();
        document.getElementById('_lat').value=place.geometry.location.lat();
        document.getElementById('_lng').value=place.geometry.location.lng();
      }
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(position => {
            const geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            const circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            qgis_address.setBounds(circle.getBounds());
          });
        }
      }
    </script>