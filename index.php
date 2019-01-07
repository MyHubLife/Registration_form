<?php 
session_start();

require_once("includes/connection.php");
include("includes/header.php"); 

if(isset($_SESSION["session_username"])){
	header("Location: welcome_page.php");
}
 /* ----------- обработка формы ----------- */
if(isset($_POST["login"])){
	if(!empty($_POST['username']) && !empty($_POST['password'])) {
		$username = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);
		$query = mysqli_query($con, "SELECT * FROM usertbl WHERE username='".$username."' AND password='".$password."' LIMIT 1");
		$numrows = mysqli_num_rows($query);
		if($numrows!=0){
			while($row = mysqli_fetch_assoc($query)){
				$dbusername = $row['username'];
				$dbpassword = $row['password'];
			}
			if($username == $dbusername && $password == $dbpassword){
				$_SESSION['session_username']=$username;	 
				header("Location: welcome_page.php");
			}
		} else {
			$message = "Неверный логин или пароль! Повторите ввод.";
			//echo  "Неверный логин или пароль!";
		}
	} else {
		$message = "Заполните пожалуйста все поля!";
	}
}
 /* ----------- вывод сообщений об ошибке ----------- */
if (!empty($message)) {
	echo "<p class=\"error\">" . "Ошибка: ". $message . "</p>";
}
?>
	<div class="container mlogin">
		<div id="login">
			<h1>Вход</h1>
			<form action="" id="loginform" method="post" name="loginform">
				<p><label for="user_login">Имя опльзователя<br>
				<input class="input" id="username" name="username" size="20" type="text" value=""></label></p>
				<p><label for="user_pass">Пароль<br>
				<input class="input" id="password" name="password" size="20" type="password" value=""></label></p>
				<p class="submit"><input class="button" name="login" type="submit" value="Войти"></p>
				<p class="regtext">Еще не зарегистрированы? <a href="register.php">Регистрация</a>!</p>
			</form>
		</div>
	</div>
<?php 
include("includes/footer.php");
?>
	