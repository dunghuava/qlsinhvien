<?php
    // đây mới là file quan trọng
    //😢😢😢

    include ('database.php'); // kéo file databse về thì mới chạy dc hàm này
    include ('../config.php'); // cái này nữa


    $d = new database ($config); // tạo một db mới , ko cần hiểu gì đau đầu

    if (isset($_POST['getmap'])){ // hàm này để lấy ra dữ liệu cho bản đồ này ml // nó là của file map.php gọi lên
        $and =""; 
        $masv_s = $_POST['masv_s']; // tìm kiếm theo mã số sinh viên
        $ma_nganh_s = $_POST['ma_nganh_s']; // tìm kiếm theo mã ngành sinh viên
        if ($masv_s>0){
            $and.=" and a.ma_sv= $masv_s";
        }
        if ($ma_nganh_s>0){
            $and.=" and e.ma_nganh= $ma_nganh_s";
        }
        // cái này là sql để tìm sinh viên // ko hiểu cũng được vì nó vốn dĩ đã vậy r :)) như lúc m sinh ra thì m đã đéo mặc quần áo r cũng có ai cười m đâu :))
        // $json là cái biến để đựng danh sách sinh viên
        $json = $d->o_fet("select a.ma_sv,b.ho_ten,a.dia_chi,c.ten_lop,d.ten_khoa,e.ten_nganh,_lat,_lng from #_sinhvien_vitri a 
                           inner join #_sinhvien b on a.sinhvien_id=b.id 
                           left join #_lop c on a.ma_lop=c.id 
                           left join #_khoa d on c.ma_khoa=d.id left join #_nganh e on d.id=e.ma_khoa where a.trang_thai=1 $and ");
        include ('../sources/qgismap.php'); // đây là cái bản đồ 
        return; // tới đây là hết
    }

    $data    = $_POST['data'];
    $type    = $data['type'];
    $table   = $data['table'];
    $payload = $data['payload'];

    // hàm này dùng đê thêm sinh viên
    if ($type=='add' && $table=='db_sinhvien'){
        $table_sv_vitri = array(
            'ma_sv'         =>$payload['ma_sv'],
            'ma_lop'        =>$payload['ma_lop'],
            'trang_thai'    =>0,
            '_lat'          =>$payload['_lat'],
            '_lng'          =>$payload['_lng'],
            'dia_chi'       =>$payload['dia_chi'],
            'ngay_tao'      =>timestamp()
        );
        unset($payload['_lat']);
        unset($payload['_lng']);
        unset($payload['dia_chi']);

        $payload['ngay_tao']=timestamp();
        $d->setTable($table); 
        $sinhvien_id = $d->insert($payload); // thêm vào bảng db_sinhvien bảng 1
        $table_sv_vitri['sinhvien_id']=$sinhvien_id; // lấy id ra
        $d->setTable('db_sinhvien_vitri'); // thêm vào bảng 2
        $d->insert($table_sv_vitri); // thêm vào bảng db_sinhvieb_vitri

        return;
    }
    // end thêm sinh viên
    // sửa sinh viên
    if ($type=='update' && $table=='db_sinhvien'){
        $table_sv_vitri = array(
            'ma_sv'         =>$payload['ma_sv'],
            'ma_lop'        =>$payload['ma_lop'],
            'trang_thai'    =>0,
            '_lat'          =>$payload['_lat'],
            '_lng'          =>$payload['_lng'],
            'dia_chi'       =>$payload['dia_chi'],
            'ngay_tao'      =>timestamp()
        );
        unset($payload['_lat']);
        unset($payload['_lng']);
        unset($payload['dia_chi']);

        $d->setTable($table);
        $d->setWhere(['id'=>$payload['id']]); // sửa bảng db_sinhvien
        $d->update($payload);
        ///
        $d->reset();
        ///
        $d->setTable('db_sinhvien_vitri'); // sửa bảng db_sinhvien_vitri
        $d->setWhere(['sinhvien_id'=>$payload['id']]);
        $d->update($table_sv_vitri);

        return; // sửa sinh viên
    }




     // các hàm dươới này là dùng chung khi thêm,xóa,sửa khoa,lop,nganh,hedaotao // đều  dùng chung hết
    if ($type == 'add'){ // hàm này dùng để thêm
        $payload['ngay_tao']=timestamp();
        $d->setTable($table);
        $d->insert($payload);
    }
    else if ($type == 'delete'){ // hàm này dùng để xóa
        $d->setTable($table);
        $d->setWhere($payload);
        $d->delete();
    }
    else if ($type == 'update'){ // hàm này dùng để sửa, cập nhật
        $payload['ngay_tao']=timestamp();
        $d->setTable($table);
        $d->setWhere(['id'=>$payload['id']]);
        $d->update($payload);
    }