<?php
	include ("connection.php");
	if ($_SESSION['admin_authed'] != 1 ) {
    header("Location: index.html");
	}
?>
<html>
  <head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ООО "ЛКМ"</title>
    <link rel="stylesheet" href="style/admin.css">
</head>
<body>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<header>
  <div class="block">
    <h1>ЛифтКранМонтаж</h1>
    <a href="index.html">&larr; перейти к сайту сайт</a>
  </div>
</header>

<nav>
  <ul>
    <li><a class="brick services" href="#services"><span class='icon'><img src="img/servicesico.png"></span>Услуги</a></li>
    <li><a class="brick orders" href="#orders"><span class='icon'><img src="img/ordersico.png"></span>Заказы</a></li>
    <li><a class="brick admin" href="#admin"><span class='icon'><img src="img/adminico.png"></span>Администраторы</a></li>
    <li><a class="brick users" href="#user"><span class='icon'><img src="img/userico.png"></span>Пользователи</a></li>
    <li><a class="brick" href="exit.php"><span class='icon'><img src="img/exit.png"></span>Выход</a></li>
  </ul>
</nav>

 <div id="content" class="pages">
    <div name="services" class="brick">
        	<?php if ($_SESSION['admin_authed'] == 1 ) {
        	    if(isset($_POST['add_serv']))
	            {   
	                $serv_name=$_POST['serv_name'];
	                $serv_des=$_POST['serv_des'];
	                $serv_price=$_POST['serv_price'];
	                $serv_img=addslashes(file_get_contents($_FILES['serv_img']['tmp_name']));
			        $request=("INSERT INTO `services` (`service_name`, `service_description`, `service_price`,`service_img`) VALUES ('$serv_name','$serv_des','$serv_price','{$serv_img}')");
		            mysql_query($request);
        	    }
        	    
        	     if(isset($_POST['del_serv']))
                {
		        $id_s=(integer)$_POST['id_s'];
	    	    $query = "DELETE FROM `services` WHERE `id_service` = '$id_s'";
	    	    $delete = mysql_query($query);
	            }
        	    $request_serv = "SELECT `id_service`,`service_name`, `service_description`, `service_price`, `service_img` FROM `services`" ;
                $result_serv = mysql_query($request_serv);
              
                print("<table><caption>Услуги</caption><thead>
                        <tr>
                      <th>Название</th>
                      <th>Описание</th>
                      <th>Цена</th>
                      <th>Изображение</th>
                        </tr>
                      </thead>");
          while($row_serv = mysql_fetch_row($result_serv))
          {
            print("<tr><td>". $row_serv[1]. "</td>");
            print("<td class='descr'>". $row_serv[2]. "</td>");
            print("<td>". $row_serv[3]. "</td>");
			print('<td class="image"><img src="data:image/jpeg;base64,'.base64_encode($row_serv[4]).'" alt="photo">');
			print("<td class='tdcancel'><form action='' method='POST'><input type='hidden' name='id_s' value='".$row_serv[0]."'><input class='cancel' name='del_serv' type='submit' value=''></form></td>
			</tr>");
          }
          print("</table>");}
        	    
        	 ?>
        	<form id='serv_add' method='POST' enctype='multipart/form-data'>
	        <input name='serv_name' type="text" placeholder="Название">
            <input name='serv_des' placeholder="Описание" type="text"/>
            <input name='serv_price' placeholder="Цена" type="text"/><br>
            <label id="load">Загрузка изображения до 2 мб:</label><br>
            <input id="click" name='serv_img' placeholder="Изображение до 2мб" type="file"/><br>
            
            <input name='add_serv' type="submit" value="Добавить"></form>
      </div>
      <div id="orders" class="brick">
          <?php
          if ($_SESSION['admin_authed'] == 1 ) {
            if(isset($_POST['del_order']))
            {
		        $id_o=(integer)$_POST['id_o'];
	    	    $query = "DELETE FROM `orders` WHERE `id_order` = '$id_o'";
	    	    $delete = mysql_query($query);
	        }
          $request_order = "SELECT `id_order`,`order_date`,`order_s_id`,`order_amount`,`order_user_login` FROM `orders`" ;
          $result_order = mysql_query($request_order);
          print("<table><caption>Заказы</caption><thead>
                        <tr>
                      <th>Услуга</th>
                      <th>Дата заказа</th>
                      <th>Количество</th>
                      <th>Пользователь</th>
                        </tr>
                      </thead>");
          while($row = mysql_fetch_row($result_order))
          {
            $for_name=$row[2];
            $request_order_serv="SELECT `service_name` FROM `services` WHERE `id_service` = '$for_name'";
            $result_order_serv=mysql_query($request_order_serv);
            print("<tr><td>". mysql_fetch_row($result_order_serv)[0]. "</td>");
            print("<td>". $row[1]. "</td>");
            print("<td>". $row[3]. "</td>");
            print("<td>". $row[4]. "</td>");
			print("
			<td class='tdcancel'><form action='' method='POST'><input type='hidden' name='id_o' value='".$row[0]."'><input class='cancel' name='del_order' type='submit' value=''></form></td>
			</tr>
			
			");
          }
          print("</table>");}
        ?>
          
          
          
          
          
      </div>
      <div id="admin" class="brick">
        <?php
        	if ($_SESSION['admin_authed'] == 1 ) {
            if(isset($_POST['add_admin']))
	        {          
	                $adm_login=$_POST['adm_login'];
	                $adm_pass=$_POST['adm_pass'];
			        $query = "INSERT INTO `admins`( `admin_login`, `admin_pass`) VALUES ('$adm_login','$adm_pass')";
			        $add_admin = mysql_query($query);
            }
            if(isset($_POST['del']))
            {
		        $id=(integer)$_POST['id'];
	    	    $query = "DELETE FROM `admins` WHERE `id_admin` = '$id'";
	    	    $delete = mysql_query($query);
	        }
          $request_admin = "SELECT `id_admin`,`admin_login`,`admin_pass` FROM `admins`" ;
          $result_admin = mysql_query($request_admin);
          print("<table><caption>Администраторы</caption><thead>
                        <tr>
                      <th>Логин</th>
                      <th>Пароль</th>
                        </tr>
                      </thead>");
          while($row = mysql_fetch_row($result_admin))
          {
            print("<tr><td>". $row[1]. "</td>");
			print("<td>". $row[2]. "</td>
			<td class='tdcancel'><form action='' method='POST'><input type='hidden' name='id' value='".$row[0]."'><input class='cancel' name='del' type='submit' value=''></form></td>
			</tr>
			
			");
          }
          print("</table>");}
        ?>
        <form id="admin_add" action="" method="POST">
        <input name='adm_login' type="text" placeholder="Логин">
        <input name='adm_pass' placeholder="Пароль" type="text"/><br>
        <input name="add_admin" type="submit" value="Добавить">
</form>
     </div>
        
        <div id="user" class="brick">
      
      <?php
      if ($_SESSION['admin_authed'] == 1 ) {
          $request_user = "SELECT `user_name`,`user_login`,`user_pass`,`user_mail` FROM `users`" ;
          $result_user = mysql_query($request_user);
          print("<table><caption>Пользователи</caption><thead>
                        <tr>
                      <th>Фио</th>
                      <th>Логин</th>
                      <th>Пароль</th>
                      <th>Почта</th>
                        </tr>
                      </thead>");
          while($row = mysql_fetch_row($result_user))
          {
            print("<tr><td>". $row[0]. "</td>");
			print("<td>". $row[1]. "</td>");
			print("<td>". $row[2]. "</td>");
			print("<td>". $row[3]. "</td></tr>");
          }
          print("</table>");
      }
        ?>
</div>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
</body>
</html>