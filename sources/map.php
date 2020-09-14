<div id="qgismap"></div>

<script>
   $(document).ready(function () {
      onSearch();
   });
   function onSearch(){
      var masv_s=$('#masv_s').val();
      var ma_nganh_s=$('#ma_nganh_s').val();
      $.ajax({
        type: "post",
        url:  "models/ajax.php",
        data: {'getmap':'get','masv_s':masv_s,'ma_nganh_s':ma_nganh_s},
        success: function (response) {
            $('#qgismap').html(response);
        }
      });
   }
</script>