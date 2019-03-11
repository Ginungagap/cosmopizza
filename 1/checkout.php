<?php

# jCart v1.3.5
# http://conceptlogic.com/jcart/
# http://jcart.info

# Демонстрация работы jCart

# Обязательно вставьте include jcart.inc.php перед вызовом session_start()
include_once 'jcart/jcart.inc.php';

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<title>Демонстрация jCart – удобная корзина товаров для вашего интернет-магазина</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen, projection" />

	<link type="text/css" href="<?= $jcart->config['sitelink'] . $jcart->config['jcartPath'] ?>css/jcart.css" media="screen, projection" rel="stylesheet" />
	<script type="text/javascript" src="<?= $jcart->config['sitelink'] . $jcart->config['jcartPath'] ?>js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="<?= $jcart->config['sitelink'] . $jcart->config['jcartPath'] ?>js/jcart.min.js"></script>

</head>
<body>
<div id="wrapper">

	<header id="header">
		<a href="<?= $jcart->config['sitelink'] ?>index.php" title="На главную страницу"><h2>Демонстрация работы jCart</h2></a>
	</header><!-- #header-->

	<article id="content">
		<h1>jCart – удобная корзина товаров для вашего интернет-магазина</h1>

		<div id="jcart"><?php $jcart->display_cart(); ?></div>
	</article><!-- #content-->

	<footer id="footer">
		<a href="http://jcart.info" title="Официальный сайт jCart">jCart</a> © <?= date('Y') ?>
	</footer><!-- #footer -->

</div><!-- #wrapper -->
</body>
</html>