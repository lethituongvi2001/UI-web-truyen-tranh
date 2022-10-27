<?php include("../view/top.php"); ?>

	<h3>Quản lý người dùng</h3> 
	<br>
	<table class="table table-hover">
		<tr class = "bg-info">
			<th>Email</th>
			<th>Họ tên</th>
			<th>Loại người dùng</th>
			<th>Trạng thái</th>
			<th></th>
		</tr>
		<?php
		foreach($nguoidung as $d):
		?>
				<tr>
					<td><?php echo $d["email"]; ?></td>
					<td><?php echo $d["hoten"]; ?></td>
					<td>
						<?php 
						if($d["loai"]==1) 
							echo "Quản trị"; 
						elseif($d["loai"]==2) 
							echo "Nhân viên"; 
						else
							echo "Khách hàng";
						?>
						
					</td>
					<td>
						<?php 
						if($d["trangthai"]==1) 
							echo "Khả dụng"; 
						else
							echo "Đang khóa";
						?>
					</td>
					<td>
						<?php 
						if($d["loai"]!=1) {
							if($d["trangthai"]==1){
						?>
							<a href="index.php?action=doitrangthai&trangthai=0&id=<?php echo $d["id"]; ?>">Khóa</a>
						<?php
							}
							else{
						?>
								<a href="index.php?action=doitrangthai&trangthai=1&id=<?php echo $d["id"]; ?>">Kích hoạt</a>
						<?php
							}
						}					
						?>
					</td>
				</tr>

		<?php
			
		endforeach;
		?>
	</table>
	<div id="buttonthem">
		<a class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> Thêm người dùng</a>
	</div>
	<br> 
	<div id="formthem">
		<form class="form-inline" method="post">
			<input type="text" class="form-control" name="txtten" placeholder="Nhập người dùng">
			<input type="hidden" name="action" value="them">
			<input type="submit" class="btn btn-warning" value="Thêm">
		</form>
	</div>

	<script>
	$(document).ready(function(){
		$("#formthem").hide();
		$("#buttonthem").click(function(){
			$("#formthem").toggle(1000);
		});
	});
	</script>

<?php include("../view/bottom.php"); ?>
