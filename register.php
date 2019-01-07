<?php 
require_once("includes/connection.php");
include("includes/header.php"); 

 /* ----------- обработка формы ----------- */
if(isset($_POST["register"])){
	if(!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['age']) && !empty($_POST['phone']) && !empty($_POST['username']) && !empty($_POST['password'])) {
		$full_name = htmlspecialchars($_POST['full_name']);
		$email = htmlspecialchars($_POST['email']);
		$age = htmlspecialchars($_POST['age']);
		$phone = htmlspecialchars($_POST['phone']);
		$username = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']); // тут можно закодировать пароль кодировкой md5 
		$query = mysqli_query($con, "SELECT * FROM usertbl WHERE username='".$username."'");
		$numrows = mysqli_num_rows($query);
			if($numrows == 0){
				$sql = "INSERT INTO usertbl (full_name, email, age, phone, username, password) VALUES('$full_name','$email', '$age', '$phone', '$username', '$password')";
				$result = mysqli_query($con, $sql);
				if($result){
					//Подтверждение создания нового пользователя
					$info = "Пользователь успешно создан, войдите в систему через форму входа!";
				} else {
					$message = "Неверный ввод данных! Повторите ввод";
				}
			} else {
				$message = "Пользователь с таким именем уже существует! Попробуйте другое имя!";
			}
	} else {
		$message = "Заполните пожалуйста все поля!";
	}
}

	/* ----------- вывод сообщений ----------- */ 
if (!empty($message)) {
	echo "<p class=\"error\">" . "Ошибка: ". $message . "</p>";
}

if (!empty($info)){
	echo "<p class=\"info\">" . $info . "</p>";
}
	/* Тут можно добавить отправку сообщения на указанную почту пользователя */ 

?>
	<div class="container mregister">
		<div id="login">
			<h1>Регистрация</h1>
			<form action="register.php" id="registerform" method="post"name="registerform">
				<p><label for="user_login">Полное имя<br>
				<input class="input" id="full_name" name="full_name" size="32" type="text" value=""></label></p>
				<p><label for="user_mail">E-mail<br>
				<input class="input" id="email" name="email" size="32" type="email" value=""></label></p>
				<p><label for="user_age">Ваш возраст<br>
				<input class="input" id="age" name="age" size="32" type="number" value=""></label></p>
				<p><label for="user_phone">Контактный номер телефона в формате 30771112233<br>
				<input class="input" id="phone" name="phone" size="32" pattern="[0-9]{,12}" type="tel" value=""></label></p>
				<!--Можно добавить правила относительно длинны и значений имя пользователя и пароля-->
				<p><label for="user_name">Имя пользователя<br>
				<input class="input" id="username" name="username" size="20" type="text" value=""></label></p>
				<p><label for="user_pass">Пароль<br>
				<input class="input" id="password" name="password" size="32" type="password" value="">
				</label></p>
				<p class="submit"><input class="button" id="register" name="register" type="submit" value="Зарегистрироваться"></p>
				<p class="regtext">Уже зарегистрированы? <a href= "index.php">Войдите в систему</a>!</p>
			</form>
		</div>
	</div>
<?php
include("includes/footer.php");
?>