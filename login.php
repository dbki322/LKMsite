<?php
	include ("connection.php");
	if(isset($_POST['submit']))
	{  
		$pass = $_POST['password'];
		$login = $_POST['login'];
		$enter = mysql_query("SELECT * FROM users WHERE user_login='$login' AND user_pass='$pass'");
		$res = mysql_fetch_array($enter);
		if(mysql_num_rows($enter) != '0')
		{      
		    $_SESSION['user_id'] = $res['id_user'];
			$_SESSION['user_login'] = $res['user_login'];
			$_SESSION['user_pass'] = $res['user_pass'];
			$_SESSION['user_authed'] = 1;
			header("Location: services.php");
		}
	}
?>
<html>

<head>
  <meta charset="UTF-8">
  <title>ООО ЛКМ</title>
  
  
  
      <link rel="stylesheet" href="style/login.css">

  
</head>
<body>
    
           <div class="page"><p>Вход в аккаунт</p>
                <div class="container">
                  <div class="right">
                    <svg viewBox="0 0 320 300">
                      <defs>
                        <linearGradient
                                        inkscape:collect="always"
                                        id="linearGradient"
                                        x1="13"
                                        y1="193.49992"
                                        x2="307"
                                        y2="193.49992"
                                        gradientUnits="userSpaceOnUse">
                          <stop
                                style="stop-color:#ff00ff;"
                                offset="0"
                                id="stop876" />
                          <stop
                                style="stop-color:#ff0000;"
                                offset="1"
                                id="stop878" />
                        </linearGradient>
                      </defs>
                      <path d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
                    </svg>
                    <form action="" method="POST">
                        <div class="form">
                            
                          <label for="login">Логин</label>
                          <input type="text" id="login" name="login" autocomplete="username email">
                          <label for="password">Пароль</label>
                          <input type="password" id="password" name="password" autocomplete="new-password">
                          <input type="submit" id="submit" name="submit" value="Подтвердить">
                        <?php
                        if(mysql_num_rows($enter) == '0')
		                    {
		                        echo'<label id="error">Ошибка!Пользователь не найден.</label>';
		                    }
                        ?>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
              
              <script src="js/login.js"></script> 
              <script src='https://cdnjs.cloudflare.com/ajax/libs/animejs/2.2.0/anime.min.js'></script>
  </body>
  </html>