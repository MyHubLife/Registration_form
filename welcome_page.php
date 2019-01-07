<?php

session_start();

if(!isset($_SESSION["session_username"])){
	header("location: index.php");
	}else{
	require_once("includes/connection.php"); 
	include("includes/header.php"); 
	
	$query = mysqli_query($con, "SELECT * FROM usertbl WHERE username = '".$_SESSION['session_username']."'");
	$numrows = mysqli_num_rows($query);
		if($numrows!=0){
			while($row = mysqli_fetch_assoc($query)){
				$full_name = $row['full_name'];
				$email = $row['email'];
				$age = $row['age'];
				$phone = $row['phone'];
			}
		};
?>

		<div id="welcome">
			<h2>Добро пожаловать, <span><?php echo $_SESSION['session_username'];?>!</span></h2>
			<?php
				echo "<p>Полное имя: ". $full_name ."</p>";
				echo "<p>E-mail: ". $email ."</p>";
				echo "<p>Возраст: ". $age ."</p>";
				echo "<p>Телефон: ". $phone ."</p>";
			?>
			<p><a href="logout.php">Выйти</a></p>
		</div>

<?php 		
	include("includes/footer.php");
	};
?>