<?php
$myconfig["mainpage"]=true;
include_once 'myconfig.php';
include_once 'jcart/jcart.inc.php';
$myconfig["title"]="CosmoPizza, КосмоПіца - Піцерія, доставка піци Івано-Франківськ";
include_once 'header.php';
?>
<div id="contenttop" class="default">
<span id="enter"><p class="action"><span style="color:#FF9B4D;">18 січня не працюємо! З Різдвом Христовим!</span></p>
Доставка піци та їжі в Івано-Франківську з піцерії <strong>CosmoPizza</strong>, <strong>КосмоПіца</strong>.<br/>
Замовляйте на сайті або за телефоном <strong>(066) 403-00-99</strong>, <strong>(096) 882-00-99</strong><br/>
Ви можете <strong>замовити піцу</strong>, салати, пасти, напої та інші страви з 10:00 до 21:30.<br/>
Вартість доставки по місту Івано-Франківськ 20 грн.<br/>
При замовленні від 200 грн - <strong>доставка безкоштовна!</strong><br/>
Перегляньте <strong><a title="Акції CosmoPizza, КосмоПіца" href="<? print($myconfig["domen"]);?>actions" style="color:#a96632;">діючі акції</a></strong>. Ціни вказані з упакуванням.<br/>
</span>
</div>
<div id="basket">
<?php $jcart->display_cart();?> 
</div>
<div class="clear"></div>
<div id="content">

<div class="clear"></div><div style="float:both;"><span id="pizza"><p class="chapter">Суперпропозиція</span></p></div>

<div class="product">
<span title="Топ-5 піц"><img class="id_92" src="img/pizza.png" width="100" height="80" /></span><br/>
<div class="name"><span href="" title="Топ-5 піц">Топ-5 піц 30см</span></div>
<div class="desc">5 найбільш популярних піц 30см: тоскана, салямі, неаполітана, верона, гавайська</div>

<div class="prices">
<div class="price3040">
<form method="post" action class="jcart">
	<input type="hidden" name="my_item_id" value="999_30" />
	<input type="hidden" name="my_item_name" value="Топ-5 піц 30см" />
	<input type="hidden" name="my_item_price" value="350" />
	<input type="hidden" name="my_item_qty" value="1" />
	<input type="submit" name="my_add_button" class="my_add_button" value="350 грн" class="button" />
</form>
</div>
</div>
</div>

<?php
error_reporting( E_ERROR );
$link = mysql_connect($myconfig['mysqlhost'], $myconfig['mysqluser'], $myconfig['mysqlpass'])
or die("Не можу підключитись до бази. " . mysql_error());
mysql_select_db($myconfig['mysqlbd']) or die("Не можу підключитись до бази.");
mysql_set_charset("utf8");



$chapters = array(
			array("name"=>"Піца", "tablename"=>"pizza", "sizes"=>"1", "pre"=>"Піца "),
			array("name"=>"Піца вершкова", "tablename"=>"pizzav", "sizes"=>"1", "pre"=>"Піца "),
			array("name"=>"Салати", "tablename"=>"salat", "sizes"=>"0", "pre"=>"Салат "),
			array("name"=>"Пасти", "tablename"=>"pasta", "sizes"=>"0", "pre"=>"Паста "),
			array("name"=>"Гарячі пательні", "tablename"=>"patel", "sizes"=>"0", "pre"=>""),
			array("name"=>"Іншe", "tablename"=>"other", "sizes"=>"0"),
			array("name"=>"Соуси", "tablename"=>"sauce", "sizes"=>"0", "nodesc"=>"1"),
			array("name"=>"Напої", "tablename"=>"drink", "sizes"=>"0", "nodesc"=>"1"));

$myi=0;
foreach ($chapters as $key => $value)
{
if ($value["name"]=="Пасти") {print("<div class=\"clear\"></div><div style=\"float:both;\"><span id=\"more\"><p class=\"chapter\">Інші страви</span></p></div>\n");}
print("<div class=\"clear\"></div><div style=\"float:both;\"><span id=\"".$value["tablename"]."\"><p class=\"chapter\">".$value["name"]."</span></p></div>\n");
$query = "SELECT * FROM `pizza` WHERE `type`='".$value["tablename"]."' ORDER BY `price` ASC";
$res = mysql_query($query);
while($row = mysql_fetch_array($res))
{
$myi++;
//print("<span class=\"name\">".$value["pre"].$row['name']."</span><span class=\"price\">");if ($value["sizes"]) {print($row['price40']);}print("</span><span class=\"price\">".$row['price']."</span><br/>\n");
print('
<div class="product');if ($value['nodesc']==1) {print('small');}print('">
<span title="'.$value["pre"].$row['name'].'"><img class="id_92" src="img/'.$value["tablename"].'.png" width="100" height="80" /></span><br/>
<div class="name"><span href="" title="'.$value["pre"].$row['name'].'">'.$value["pre"].$row['name'].'</span></div>
<div class="desc');if ($value['nodesc']==1) {print('small');}print('">'.$row['desc']);if ($row['weight']>0) {print(', '.$row['weight'].' г');}print('</div>
');
if ($value["sizes"]) {
print('
<div class="prices">
<div class="price3040">
<form method="post" action class="jcart">
	<input type="hidden" name="my_item_id" value="'.$row['id'].'_30" />
	<input type="hidden" name="my_item_name" value="'.$value["pre"].$row['name'].' 30см" />
	<input type="hidden" name="my_item_price" value="'.$row['price'].'" />
	<input type="hidden" name="my_item_qty" value="1" />
	<input type="submit" name="my_add_button" class="my_add_button" value="30см '.$row['price'].' грн" class="button" />
</form>
</div>
<div class="price3040">

<form method="post" action="" class="jcart">
	<input type="hidden" name="my_item_id" value="'.$row['id'].'_40" />
	<input type="hidden" name="my_item_name" value="'.$value["pre"].$row['name'].' 40см" />
	<input type="hidden" name="my_item_price" value="'.$row['price40'].'" />
	<input type="hidden" name="my_item_qty" value="1" />
	<input type="submit" name="my_add_button" class="my_add_button" value="40см '.$row['price40'].' грн" class="button" />
</form></div>

</div>
</div>
');
}
else {
print('<div class="price">'.$row['price'].' грн
<form method="post" action="" class="jcart">
	<input type="hidden" name="my_item_id" value="'.$row['id'].'" />
	<input type="hidden" name="my_item_name" value="'.$value["pre"].$row['name'].'" />
	<input type="hidden" name="my_item_price" value="'.$row['price'].'" />
	<input type="hidden" name="my_item_qty" value="1" />
	<input type="submit" name="my_add_button" class="my_add_button" value="В кошик" class="button" />
</form>
</div>

</div>
');	
}

}
}




mysql_close($link);

?>




<div class="clear"></div>
</div>
<?
include_once 'footer.php';
?>