<?php
include_once 'jcart/jcart.inc.php';
$myconfig["title"]="Піцерія КосмоПіца - CosmoPizza, КосмоПіца - Піцерія, доставка піци Івано-Франківськ";
include_once 'myconfig.php';
include_once 'header.php';
?>
<div id="content">
<p class="chapter">Замовлення відправлено</p>
<p>Дякуємо за замовлення. Очікуйте дзвінок від адміністратора. Смачного!</p>
</div>
<!-- Event snippet for замовлення conversion page -->
<script>
  gtag('event', 'conversion', {
      'send_to': 'AW-866429101/GeiWCI7ap3kQrdGSnQM',
      'value': 2.0,
      'currency': 'UAH',
      'transaction_id': ''
  });
</script>
<?
include_once 'footer.php';
?>