<?php
    include ('database.php');
    include ('../config.php');


    $d       = new database ($config);

    if (isset($_POST['getmap'])){
        $and ="";
        $masv_s = $_POST['masv_s'];
        $ma_nganh_s = $_POST['ma_nganh_s'];
        if ($masv_s>0){
            $and.=" and a.ma_sv= $masv_s";
        }
        if ($ma_nganh_s>0){
            $and.=" and e.ma_nganh= $ma_nganh_s";
        }
        $json = $d->o_fet("select a.ma_sv,b.ho_ten,b.dia_chi,c.ten_lop,d.ten_khoa,e.ten_nganh,_lat,_lng from #_sinhvien_vitri a 
                           inner join #_sinhvien b on a.sinhvien_id=b.id 
                           left join #_lop c on a.ma_lop=c.id 
                           left join #_khoa d on c.ma_khoa=d.id left join #_nganh e on d.id=e.ma_khoa where a.trang_thai=1 $and ");
        include ('../sources/qgismap.php');
        return;
    }

    $data    = $_POST['data'];
    $type    = $data['type'];
    $table   = $data['table'];
    $payload = $data['payload'];

    if ($type=='add' && $table=='db_sinhvien'){
        $table_sv_vitri = array(
            'ma_sv'         =>$payload['ma_sv'],
            'ma_lop'        =>$payload['ma_lop'],
            'trang_thai'    =>0,
            '_lat'          =>$payload['_lat'],
            '_lng'          =>$payload['_lng'],
            'ngay_tao'      =>timestamp()
        );
        unset($payload['_lat']);
        unset($payload['_lng']);
        $payload['ngay_tao']=timestamp();
        $d->setTable($table);
        $sinhvien_id = $d->insert($payload);
        $table_sv_vitri['sinhvien_id']=$sinhvien_id;
        $d->setTable('db_sinhvien_vitri');
        $d->insert($table_sv_vitri);

        return;
    }
    if ($type=='update' && $table=='db_sinhvien'){
        $table_sv_vitri = array(
            'ma_sv'         =>$payload['ma_sv'],
            'ma_lop'        =>$payload['ma_lop'],
            'trang_thai'    =>0,
            '_lat'          =>$payload['_lat'],
            '_lng'          =>$payload['_lng'],
            'ngay_tao'      =>timestamp()
        );
        unset($payload['_lat']);
        unset($payload['_lng']);
        $d->setTable($table);
        $d->setWhere(['id'=>$payload['id']]);
        $d->update($payload);
        ///
        $d->reset();
        ///
        $d->setTable('db_sinhvien_vitri');
        $d->setWhere(['sinhvien_id'=>$payload['id']]);
        $d->update($table_sv_vitri);

        return;
    }

    if ($type == 'add'){
        $payload['ngay_tao']=timestamp();
        $d->setTable($table);
        $d->insert($payload);
    }
    else if ($type == 'delete'){
        $d->setTable($table);
        $d->setWhere($payload);
        $d->delete();
    }
    else if ($type == 'update'){
        $payload['ngay_tao']=timestamp();
        $d->setTable($table);
        $d->setWhere(['id'=>$payload['id']]);
        $d->update($payload);
    }