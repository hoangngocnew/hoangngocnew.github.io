<?php
if(!defined('TEMPLATE')){
	die('Ban khong du quyen truy cap');
}
?>
<!DOCTYPE html>


<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Vietpro Mobile Shop - Administrator</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">


</head>

<body>
	<?php
	if(isset($_POST['sbm'])){
		$user_mail = $_POST['user_mail'];
		$user_pass = $_POST['user_pass'];
	
		$sql = "SELECT * FROM user WHERE user_mail = '$user_mail'";
		$query = mysqli_query($connect,$sql);
		$nums =	mysqli_num_rows($query);
		if($nums<1){
			$error ="<div class='alert alert-danger'>Tài khoản không tồn tại !</div>";
		}
		else{
		$row = mysqli_fetch_array($query);
		$id = $row['user_id'];
		$cookie_name = 'count-'.$id;
		if($user_pass!=$row['user_pass']){
			$error ="<div class='alert alert-danger'>Mật khẩu không khớp !</div>";
			if(isset($_COOKIE[$cookie_name])){
				$newvalue = $_COOKIE[$cookie_name];
				$newvalue++;
				setcookie($cookie_name,$newvalue,time() +60, "/");
				if($newvalue == 3){
					$error = "<div class='alert alert-danger'>Bạn đăng nhập sai quá 3 lần quy định, tài khoản sẽ bị khóa 1 phút !</div>";
				}
				echo $newvalue;
			}else{
				setcookie($cookie_name,1,time() +60, "/");
			}
		}
		if(isset($_COOKIE[$cookie_name]) && $_COOKIE[$cookie_name] >= 3){
			$error = "<div class='alert alert-danger'>Bạn đăng nhập sai quá 3 lần quy định, tài khoản sẽ bị khóa 1 phút !</div>";
		}
		if(((isset($_COOKIE[$cookie_name]) && $_COOKIE[$cookie_name] <3) || empty($_COOKIE[$cookie_name])) && empty($error)){
			$_SESSION['user_mail'] = $user_mail;
			$_SESSION['user_pass'] = $user_pass;
			header('location:index.php');
		}
		}
		
		



		// $query = mysqli_query($connect, $sql);
		// $num = mysqli_num_rows($query);
		// if($num>0){
		// 	$_SESSION['user_mail'] = $user_mail;
		// 	$_SESSION['user_pass'] = $user_pass;
		// 	header('location:index.php');

		// }
		// else{
		// 	$error ="<div class='alert alert-danger'>Tài khoản không hợp lệ !</div>";
		// }
	}
	?>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Mobile Shop - Administrator</div>
				<div class="panel-body">
					<?php
					if(isset($error)){
						echo $error;
						// echo $_COOKIE[$cookie_name];
						// print_r($_COOKIE);
					}
					?>
					<form role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="user_mail" type="email" autofocus required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Mật khẩu" name="user_pass" type="password" value="" required>
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Nhớ tài khoản
								</label>
							</div>
							<button type="submit" class="btn btn-primary" name="sbm" >Đăng nhập</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
</body>

</html>
