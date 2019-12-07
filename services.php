<?php
	include ("connection.php");
	 if(isset($_POST['buy_serv']))
	        { 
	            $col=$_POST['quantity'];
	            if($col=="")
	                {$col=1;}
	            $user_id=$_SESSION['user_id'];
	            $id_s= (integer)$_POST['id_s'];
		        $query = "INSERT INTO `basket`( `basket_user_id`, `basket_s_id`, `basket_s_amount`) VALUES ('$user_id','$id_s','$col')";
		        mysql_query($query);  }
?>
<!DOCTYPE html>
<html lang="en">
  <head> 

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ООО "ЛКМ"</title>
    <link rel="stylesheet" href="style/shop.css">
</head>
<body>

  <ul class="sidenav menu">
    <li><a href="index.html"><img src="img/logo.png"></a></li>
    <?php 
    if ($_SESSION['user_authed'] != 1 ) {
        echo('
    <li><a href="reg.php">Регистрация</a></li>
    <li><a href="login.php">Вход</a></li>
       ');} ?>
    <li><a href="contacts.php">Контакты</a></li>
    <?php 
    if ($_SESSION['user_authed'] == 1 ) {
        echo('<li><a href="exit.php">Выйти</a></li>
    <li><a href="basket.php"><img src="img/basket.png" width="80%" height="80%"></a></li>
       ');} ?>
  </ul>
  <div id="contener">
      <div id="title" title="Shop"><a href="">Наши услуги:</a></div>
    <div class="slash-h"></div>
    
    <div id="card-contener">
        <?php
        $request_serv = "SELECT `id_service`,`service_name`, `service_description`, `service_price`, `service_img` FROM `services`" ;
        $result_serv = mysql_query($request_serv);
        while($row_serv = mysql_fetch_row($result_serv))
        {
        echo('<form id="serv_buy" method="POST" ><div class="card grey">
        <a>
        <img src="data:image/jpeg;base64,'.base64_encode($row_serv[4]).'" width=460 height=400">
        </a>
        <div class="overlay"><h3>'. $row_serv[1]. '</h3><p class="p-product">'. $row_serv[2]. '</p><p class="share">
          </a><a ></a></p><div class="buy-info"><p class="price">Цена за услугу/час: '. $row_serv[3]. ' рублей</p>');
          if ($_SESSION['user_authed'] == 1 ) {
        echo('
    <a><p class="buy"><input placeholder="Введите кол-во" type="text" name="quantity" ><input type="hidden" name="id_s" value="'.$row_serv[0].'"><input name="buy_serv" type="submit" value="Купить"></p></a>');}
    echo('
          </div></div>
      </div></form>
        ');
        }
        ?>
      
    
    </div>
  </div>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TimelineLite.min.js'></script>
        <script  src="js/index.js"></script>
  </body>
  </html>