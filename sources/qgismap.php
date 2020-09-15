<style>
    .md9{
        padding:4px;
    }
    .gmnoprint{
      display:none !important;
    }
    .marker-p p{
      margin:2px 0px;
      font-weight:bold;
      text-transform: capitalize;
    }
    .marker-p p span{
      width:50px;
      float:left;
    }
</style>
<div id="map" style="width:100%;height:500px"></div>
<script>
  var locations   = <?=!empty($json) ? json_encode($json):'[{"_lat":"0","_lng":"0"}]'?>;
  var qgismap = null;
  var marker = null;
  var infowindow = null;
  var cr_content=0;
  function initMap(){
    qgismap = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        center: new google.maps.LatLng(locations[0]._lat, locations[0]._lng),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
      setTimeout(() => {
        qgismap.setZoom(10);  
      }, 2000);
      infowindow = new google.maps.InfoWindow();
      var i;
      for (i = 0; i < locations.length; i++) {  
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(locations[i]._lat, locations[i]._lng),
          icon:'<?=base_url('publics/marker.png')?>',
          map: qgismap
        });
        google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
          return function() {
            var content='<div class="marker-p">';
                content+='<p><span>Mã SV</span>:&nbsp;'+locations[i].ma_sv+'</p>';
                content+='<p><span>Họ Tên</span>:&nbsp;'+locations[i].ho_ten+'</p>';
                content+='<p><span>Lớp</span>:&nbsp;'+locations[i].ten_lop+'</p>';
                content+='<p><span>Ngành</span>:&nbsp;'+locations[i].ten_nganh+'</p>';
                content+='<p><span>Khoa</span>:&nbsp;'+locations[i].ten_khoa+'</p>';
                content+='<p><span>Địa Chỉ</span>:&nbsp;'+locations[i].dia_chi+'</p>';
                content+='</div>';
                infowindow.setContent(content);
                infowindow.open(qgismap, marker);
          }
        })(marker, i));
        google.maps.event.addListener(marker, 'mouseout', function() {
            infowindow.close();
        });
      }
  }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjwJQRCuf970OLe6UuBiMvg_DyYW2PL6Y&callback=initMap&libraries=drawing,places"></script>
