<?php
	include ("connection.php");
	$ok_buy=0;
	$full=0;
    if ($_SESSION['user_authed'] != 1 ) {
       header("Location: services.php");
       }
    if(isset($_POST['del_basket']))
	        { 
	            $del_id=$_POST['id_basket_s'];
	            $query = "DELETE FROM `basket` WHERE `id_basket` = '$del_id'";
	    	    $delete = mysql_query($query); }   
	    	    
	 	if(isset($_POST['order']))
	{
		$login=$_SESSION['user_login'];
		$user_id=$_SESSION['user_id'];
		$date=date("Y-m-d");
		$query = "INSERT INTO `orders`(`order_s_id`,`order_date`, `order_amount`,`order_user_login` ) SELECT `basket_s_id`,  '$date' ,`basket_s_amount`, '$login' FROM `basket` WHERE `basket_user_id`='$user_id'";
		$addorder = mysql_query($query);
		$query = "DELETE FROM `basket` WHERE `basket_user_id`='$user_id'";
		$delbasket = mysql_query($query);
		$ok_buy=1;
	}   	    
?>
<!DOCTYPE html>
<html lang="en">
  <head> 

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ООО "ЛКМ"</title>
    <link rel="stylesheet" href="style/basket.css">
</head>
<body>

  <ul class="sidenav menu">
    <li><a href="index.html"><img src="img/logo.png"></a></li>
    <li><a href="contacts.php">Контакты</a></li>
    <?php 
    if ($_SESSION['user_authed'] == 1 ) {
        echo('<li><a href="exit.php">Выйти</a></li>
    <li><a href="services.php">Услуги</a></li>
       ');} ?>
  </ul>
  <div id="contener"><div id="title" title="Shop"><a href="">Ваша корзина</a></div>
    <div class="slash-h"></div>
    
    <div id="card-contener">
        <?php
        $userbasket=$_SESSION['user_id'];
        $request = "SELECT `id_basket`,`basket_s_id`,`basket_s_amount` FROM `basket` WHERE `basket_user_id`='$userbasket'";
        $result = mysql_query($request);
        $totalcost=0;
        while($row = mysql_fetch_row($result))
		{
		$full=1;
		$id_serv = $row[1];
		$request2 = "SELECT `service_name`,`service_description`,`service_price`,`service_img` FROM `services` WHERE `id_service`='$id_serv'";
        $result2 = mysql_query($request2);
		$row2 = mysql_fetch_row($result2);
		$cost_all=$row[2] * $row2[2];
		$totalcost=$totalcost+$cost_all;
        echo('<form method="POST" ><div class="card grey">
        <a>
        <img src="data:image/jpeg;base64,'.base64_encode($row2[3]).'" width=460 height=400">
        </a>
        <div class="overlay"><h3>'. $row2[0]. '</h3><p class="p-product">'. $row2[1]. '</p><p class="share">
          </a><a ></a></p><div class="buy-info"><p class="price">Количество:'.$row[2].' Цена за услугу/час: '. $row2[2]. ' рублей. Общая цена: '. $cost_all.' рублей.</p>');
        echo('
        <a><p class="buy"><input type="hidden" name="id_basket_s" value="'.$row[0].'"><input name="del_basket" type="submit" value="Удалить из корзины"></p></a>');
    echo('
          </div></div>
      </div></form>
        ');
        }
        ?>
    </div><?php
    
    if($ok_buy!=0){echo('<h1>Спасибо за заказ! С вами скоро свяжутся.</h1>');}
    if($full!=0){
  echo('<br><br><br>
  <div id="end">
  <h1>Общая цена корзины составляет: '.$totalcost.' рублей. </h1>
  <form method="POST"><input name="order" type="submit" value="Заказать" class="buy_but"></form>
  </div>
  
  ');}
  ?>
  </div>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TimelineLite.min.js'></script>
        <script  src="js/index.js"></script>
  </body>
  </html>