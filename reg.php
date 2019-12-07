<?php
	include ("connection.php");
	if(isset($_POST['submit']))
	{  
	    $fio = $_POST['fio'];
	    $mail = $_POST['mail'];
		$pass = $_POST['password'];
		$login = $_POST['login'];
		$enter = mysql_query("SELECT * FROM users WHERE user_login='$login'");
		$res = mysql_fetch_array($enter);
		if(mysql_num_rows($enter) == '0')
		{   
		    $sql="INSERT INTO users(user_name, user_login, user_pass,user_mail) VALUES('$fio','$login', '$pass', '$mail')";
		    $result=mysql_query($sql);
			header("Location: login.php");
		}
		else $error=1;
	}
?>
<html>

<head>
  <meta charset="UTF-8">
  <title>ООО ЛКМ</title>
  
  
  
      <link rel="stylesheet" href="style/login.css">

  
</head>
<body>
        <div class="page">
            <p>Регистрация</p>
                <div class="container2">
                  <div class="right">
        
                    <form action="" method="POST">
                        <div class="form">
                          <label for="login">Ф.И.О</label>
                          <input type="text" id="fio" name="fio">
                          <label for="login">Email</label>
                          <input type="text" id="mail" name="mail">
                          <label for="login">Логин</label>
                          <input type="text" id="login" name="login">
                          <label for="password">Пароль</label>
                          <input type="password" id="password" name="password">
                          <input type="submit" id="submit" name="submit" value="Подтвердить">
                        <?php
                        if($error==1)
		                    {
		                        echo'<label id="error">Пользователь с таким логином уже существует. Выберите другой.</label>';
		                    }
                        ?>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
              
              <script src='https://cdnjs.cloudflare.com/ajax/libs/animejs/2.2.0/anime.min.js'></script>
  </body>
  </html>