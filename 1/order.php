<?php
include_once 'jcart/jcart.inc.php';
$myconfig["title"]="Замовлення - CosmoPizza, КосмоПіца - Піцерія, доставка піци Івано-Франківськ";
include_once 'myconfig.php';
include_once 'header.php';
?>
<div id="contentorder">
		<div id="jcart"><?php $jcart->display_cart(); ?></div>
	<!-- #content-->

<div class="clear"></div>
</div>
<?
include_once 'footer.php';
?>