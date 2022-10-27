<?php
class MATHANG{
    // khai báo các thuộc tính - SV tự bổ sung
    

    // Lấy danh sách
    public function laymathang(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM mathang";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetchAll();
            rsort($result); // sắp xếp giảm thay cho order by desc
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
	    // Lấy danh sách mặt hàng thuộc 1 danh mục
    public function laymathangtheodanhmuc($danhmuc_id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM mathang WHERE danhmuc_id=:madm" ;
            $cmd = $dbcon->prepare($sql);
			$cmd->bindValue(":madm",$danhmuc_id);
            $cmd->execute();
            $result = $cmd->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Lấy mặt hàng theo id
    public function laymathangtheoid($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM mathang WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            $result = $cmd->fetch();             
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Cập nhật lượt xem
    public function tangluotxem($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "UPDATE mathang SET luotxem=luotxem+1 WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $id);
            $result = $cmd->execute();            
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
	
	// Thêm mới
    public function themmathang($tenmathang,$mota,$giagoc,$giaban,$soluongton,$danhmuc_id,$hinhanh){
        $dbcon = DATABASE::connect();
        try{
            $sql = "INSERT INTO mathang(tenmathang,mota,giagoc,giaban,soluongton,danhmuc_id,hinhanh,luotxem,luotmua) 
				VALUES(:tenmathang,:mota,:giagoc,:giaban,:soluongton,:danhmuc_id,:hinhanh,0,0)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tenmathang", $tenmathang);
			$cmd->bindValue(":mota", $mota);
			$cmd->bindValue(":giagoc", $giagoc);
			$cmd->bindValue(":giaban", $giaban);
			$cmd->bindValue(":soluongton", $soluongton);
			$cmd->bindValue(":danhmuc_id", $danhmuc_id);
			$cmd->bindValue(":hinhanh", $hinhanh);
            $result = $cmd->execute();            
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Xóa 
    public function xoamathang($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "DELETE FROM mathang WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $id);
            $result = $cmd->execute();            
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Cập nhật 
    public function suamathang($id, $tenmathang,$mota,$giagoc,$giaban,$soluongton,$danhmuc_id,$hinhanh,$luotxem,$luotmua){
        $dbcon = DATABASE::connect();
        try{
            $sql = "UPDATE mathang SET tenmathang=:tenmathang,
										mota=:mota,
										giagoc=:giagoc,
										giaban=:giaban,
										soluongton=:soluongton,
										danhmuc_id=:danhmuc_id,
										hinhanh=:hinhanh,
										luotxem=:luotxem,
										luotmua=:luotmua
										WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tenmathang", $tenmathang);
			$cmd->bindValue(":mota", $mota);
			$cmd->bindValue(":giagoc", $giagoc);
			$cmd->bindValue(":giaban", $giaban);
			$cmd->bindValue(":soluongton", $soluongton);
			$cmd->bindValue(":danhmuc_id", $danhmuc_id);
			$cmd->bindValue(":hinhanh", $hinhanh);
			$cmd->bindValue(":luotxem", $luotxem);
			$cmd->bindValue(":luotmua", $luotmua);
            $cmd->bindValue(":id", $id);
            $result = $cmd->execute();            
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
