<div id="qgismap"></div> 
<!-- đây là cái số 1 (chính nó) -->

<script>
   $(document).ready(function () {
      onSearch(); // khi bấm vào trang thì sẽ tự động load hàm này ra đẻ tải bản đồ
   });
   function onSearch(){ // hàm này dùng để tìm kiếm sinh viên ở trên bản đồ , tìm theo mã sv, lớp, khoa
      var masv_s=$('#masv_s').val();
      var ma_nganh_s=$('#ma_nganh_s').val();
      var ma_khoa_s=$('#ma_khoa_s').val();
      $.ajax({
        type: "post",
        url:  "models/ajax.php", // cũng gọi tới file model/ajax.php thôi :)) 
        data: {'getmap':'get','masv_s':masv_s,'ma_nganh_s':ma_nganh_s,'ma_khoa_s':ma_khoa_s},
        success: function (response) {
            $('#qgismap').html(response); // khi tải xong bản đồ thì lắp bản đồ vào cái số 1 ✌✌✌ nhìn lên dòng đầu tiên
        }
      });
   }
</script>