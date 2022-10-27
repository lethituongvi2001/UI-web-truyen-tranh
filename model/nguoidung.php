<?php
class NGUOIDUNG{
	//Kiểm tra người dùng, trả về TRUE nếu hợp lệ
    public function kiemtranguoidunghople($email, $matkhau){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM nguoidung WHERE email=:email AND matkhau=:matkhau AND trangthai=1";
            $cmd = $dbcon->prepare($sql);
			$cmd->bindValue(":email", $email);
			$cmd->bindValue(":matkhau", md5($matkhau));
            $cmd->execute();
            $result = ($cmd->rowCount()==1);
			$cmd->closeCursor();
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    //Lấy thông tin 1 người dùng
    public function laythongtinnguoidung($email){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM nguoidung WHERE email=:email";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":email", $email);
            $cmd -> execute();
			$result	 = $cmd->fetch();
			$cmd->closeCursor();			
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
	
	//Lấy thông tin toàn bộ người dùng
    public function laytatcanguoidung(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM nguoidung";
            $cmd = $dbcon->prepare($sql);
     
            $cmd -> execute();
			$result	 = $cmd->fetchAll();
			
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
	//Cập nhật hồ sơ người dùng
    public function capnhathosonguoidung($email, $sodienthoai, $hoten, $hinhanh){
        $dbcon = DATABASE::connect();
        try{
            $sql = "UPDATE nguoidung SET sodienthoai=:sodienthoai, 
										 hoten=:hoten, 
										 hinhanh=:hinhanh 
										 WHERE email=:email";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":email", $email);
			$cmd->bindValue(":sodienthoai", $sodienthoai);
			$cmd->bindValue(":hoten", $hoten);
			$cmd->bindValue(":hinhanh", $hinhanh);
            
			$result	 = $cmd -> execute();			
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
	
	//Cập nhật mật khẩu người dùng
    public function doimatkhau($email, $matkhau){
        $dbcon = DATABASE::connect();
        try{
            $sql = "UPDATE nguoidung SET matkhau=:matkhau WHERE email=:email";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":email", $email);
			$cmd->bindValue(":matkhau", md5($matkhau));			
            
			$result	 = $cmd -> execute();			
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
	
	//Cập nhật trạng thái người dùng (0: khóa; 1: kích hoạt)
    public function doitrangthai($id, $trangthai){
        $dbcon = DATABASE::connect();
        try{
            $sql = "UPDATE nguoidung SET trangthai=:trangthai WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":trangthai", $trangthai);
			$cmd->bindValue(":id", $id);			
            
			$result	 = $cmd -> execute();			
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}
?>
