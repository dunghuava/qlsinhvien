<?php 
    $text='';
    if (isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $loai = $_POST['loai'];
        if ($loai==0){
            $password=md5($password);
            $udata = $d->o_fet("SELECT * FROM db_quanly WHERE `username` = '$username' AND `password`='$password' LIMIT 1");
            if (!empty($udata)){
                $_SESSION['udata']=$udata[0];
                echo "<script>location.href='sinhvien'</script>";
            }else{
                $text='Sai mã tên đăng nhập hoặc mật khẩu';
            }
        }else{
            $_SESSION['udata']='sinhvien';
            echo "<script>location.href='sinhvien'</script>";
        }
    }
?>
<br><br>
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
                        <input name="username" placeholder="Mã SSV" type="text" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input name="password" placeholder="Mật khẩu" type="password" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td>
                       <select name="loai" id="loai" class="form-control">
                            <option value="0">Đăng nhập với người quản lý</option>
                            <option value="1">Đăng nhập với sinh viên</option>
                       </select>
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