<?php 
	require("../../model/database.php");
	require("../../model/nguoidung.php");

	$isLogin = isset($_SESSION["nguoidung"]);
	//Xét xem có thao tác nào được chọn
	if(isset($_REQUEST["action"])){
		$action = $_REQUEST["action"];
	}
	elseif($isLogin == FALSE){
		$action = "dangnhap";
	}
	else{
		$action="xem";
	}

	$nd = new NGUOIDUNG();

	switch($action){
		case "dangnhap":             
			include("loginform.php");
			break;
		
		case "xem":              
			include("main.php");
			break;
			
		case "xldangnhap":
			$email = $_POST["txtemail"];
			$matkhau = $_POST["txtmatkhau"];
			if($nd->kiemtranguoidunghople($email, $matkhau) == TRUE){
				$_SESSION["nguoidung"]=$nd->laythongtinnguoidung($email);
				include("main.php");
			}
			else{
				include("loginform.php");
			}
			break;	
		
		case "doimatkhau":
			$email = $_POST["txtemail"];
			$matkhau = $_POST["txtmatkhau"];
			$nd->doimatkhau($email, $matkhau);
			include("main.php");
			break;
			
		case "capnhathoso":
			$email = $_POST["txtemail"];
			$sodienthoai = $_POST["txtdienthoai"];
			$hoten = $_POST["txthoten"];
			$hinhanh = $_POST["txthinhanh"];
			if($_FILES["fhinh"]["name"] != ""){
				$hinhanh = basename($_FILES["fhinh"]["name"]);
				move_uploaded_file($_FILES["fhinh"]["tmp_name"], "../images/" . $hinhanh);
			}
			//Cập nhật hồ sơ
			$nd->capnhathosonguoidung($email, $sodienthoai, $hoten, $hinhanh);
			$_SESSION["nguoidung"] = $nd->laythongtinnguoidung($email);
			include("main.php");
			break;
			
		case "dangxuat":
			unset($_SESSION["nguoidung"]);
			include("loginform.php");
			break;
			
		default:
			break;
	}
?>
