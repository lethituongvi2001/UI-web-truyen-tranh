<?php 
	if(!isset($_SESSION["nguoidung"])) header("location:../ktnguoidung");
	require("../../model/database.php");
	require("../../model/nguoidung.php");

	//Xét xem có thao tác nào được chọn
	if(isset($_REQUEST["action"])){
		$action = $_REQUEST["action"];
	}
	else{
		$action="xem";
	}

	$nd = new NGUOIDUNG();

	switch($action){
		case "xem":
			$nguoidung=$nd->laytatcanguoidung();    
			include("main.php");
			break;
			
		case "doitrangthai":
			$nd->doitrangthai($_GET["id"], $_GET["trangthai"]);
			$nguoidung = $nd->laytatcanguoidung();
			include("main.php");
			break;
		
		default:
			break;
	}
?>
