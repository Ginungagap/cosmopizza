<html>
<head>
<title><? print($myconfig["title"]);?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style/style.css?1" />
<link type="text/css" href="jcart/css/jcart.css?1" rel="stylesheet" media="screen, projection" />
<script type="text/javascript" src="jcart/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="jcart/js/jcart.js"></script>
<script type="text/javascript" src="script/script.js?1"></script>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1744292529219105'); // Insert your pixel ID here.
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1744292529219105&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->
</head>
<body>
<div id="container">
<div id="header">
<span id="dost">Доставка піци</span><span id="dostif">в Івано-Франківську</span>
<span id="tel"><a href="tel:+380664030099">(066) 403-00-99</a><br/><a href="tel:+380968820099">(096) 882-00-99</a></span>
<span id="time"><img src="img/time261.png" width="26"/></a>10-22</span>
<a id="logo" title="Головна CosmoPizza, КосмоПіца" href="<? print($myconfig["domen"]);?>"><img src="img/logo200.png" width="200"/></a>
<span id="pizzeria">Піцерія КосмоПіца</span>
<span id="adr"><span id="adr2">м. Івано-Франківськ</span><br/><strong>вул. Незалежності 99</strong><br/><span id="adr3">біля кінотеатру Космос</span></span>
<span id="social"><a href="https://fb.com/cosmopizzaif" target="blank"><img src="img/fb.png"/></a><a href="https://instagram.com/cosmopizzaif" target="blank"><img src="img/insta.png"/></a><span>#cosmopizzaif</span></span>
</div>
<div class="clear"></div>
<div id="menutop" class="default">
<ul>
	<li><a href="<? print($myconfig["domenmenu"]);?>#pizza">Піца</a></li>
	<li><a href="<? print($myconfig["domenmenu"]);?>#salat">Салати</a></li>
	<li><a href="<? print($myconfig["domenmenu"]);?>#more">Інші страви</a></li>
	<li><a href="<? print($myconfig["domenmenu"]);?>#drink">Напої</a></li>
	<li><a href="<? print($myconfig["domenmenu"]);?>actions">Акції</a></li>
	<li><a href="<? print($myconfig["domenmenu"]);?>delivery">Доставка</a></li>
	<li><a href="<? print($myconfig["domenmenu"]);?>pizzeria">Піцерія</a></li>
</ul>
	<a href="<? print($myconfig["domenmenu"]);?>#basket" id="cartlink">Кошик <span id="lcart"><span id="cartp"></span></span></a>
	<?php #$jcart->display_cart();?> 
</div>
<div id="aftermenu"></div>
