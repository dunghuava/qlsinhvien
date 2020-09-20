<?php 
    $text='';
    if (isset($_POST['login'])){
        $masv = $_POST['masv'];
        $pass = $_POST['pass'];
        $pass=md5($pass);
        $idata = $d->o_fet("SELECT * FROM db_sinhvien WHERE ma_sv = '$masv' AND mat_khau='$pass' LIMIT 1");

        if (isset($data[0]['ma_sv'])){
            print_r($idata[0]);
            $_SESSION['muser']=$idata[0];
        }else{
            $text='Sai mã sinh viên / mật khẩu';
        }
    }
?>
<br><br><br><br>
<div class="row">
    <div class="col-md-12">
        <div style="color:red" class="text-center"><p><?=$text?></p></div>
        <form method="post" action="" id="form-login">
            <table>
                <tr>
                    <td class="text-left">
                        <h4>Đăng nhập</h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input name="masv" placeholder="Mã SSV" type="text" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input name="pass" placeholder="Mật khẩu" type="password" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td>
                        <button name="login" type="submit" class="btn btn-danger">Login</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>