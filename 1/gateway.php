<?php

# jCart v1.3.5
# http://conceptlogic.com/jcart/
# http://jcart.info

# Этот файл вызывается, когда любая кнопка на странице оформления заказа (оформление, обновление, очистка или удаление) нажата

# Include jcart before session start
include_once dirname(__FILE__) . '/jcart/jcart.inc.php';
$config = $jcart->config;

# The update and empty buttons are displayed when javascript is disabled
# Re-display the cart if the visitor has clicked either button
if (isset($_POST['jcartUpdateCart']) || isset($_POST['jcartEmpty']))
{

	# Update the cart
	if (isset($_POST['jcartUpdateCart']) && $_POST['jcartUpdateCart'])
	{
		if ($jcart->update_cart() !== true)
			$_SESSION['quantityError'] = true;
	}

	# Empty the cart
	if (isset($_POST['jcartEmpty']) && $_POST['jcartEmpty'])
		$jcart->empty_cart();

	# Редирект на страницу оформления заказа
	header('Location: ' . $config['sitelink'] . $config['checkoutPath']);
	die;
}
# The visitor has clicked the PayPal checkout button
else
{

	////////////////////////////////////////////////////////////////////////////
	/*

	A malicious visitor may try to change item prices before checking out.

	Here you can add PHP code that validates the submitted prices against
	your database or validates against hard-coded prices.

	The cart data has already been sanitized and is available thru the
	$jcart->get_contents() method. For example:

	foreach ($jcart->get_contents() as $item) {
		$itemId	    = $item['id'];
		$itemName	= $item['name'];
		$itemPrice	= $item['price'];
		$itemQty	= $item['qty'];
	}

	*/
	////////////////////////////////////////////////////////////////////////////

	# For now we assume prices are valid
	$validPrices = true;

/*	if($config['database']['enabled'] == true)
	{
		include_once dirname(__FILE__) . '/modules/M_DB.inc.php';
		$mDB = M_DB::Instance();
		foreach($jcart->get_contents() as $item)
		{
			$code = (isset($config['unique'])) ? strtok($item['id'], '_') : $item['id'];
			$bd_item = $mDB->GetItemByCode('product', $code);
			if($bd_item['price'] != $item['price'])
				$validPrices = false;
			elseif($item['discount'] != 0 && ($bd_item['discount'] != $item['discount']))
				$validPrices = false;
		}
	}
*/
	////////////////////////////////////////////////////////////////////////////

	# If the submitted prices are not valid, exit the script with an error message
	if ($validPrices !== true)
	{
		$redirect_url = $config['sitelink'] . $config['checkoutPath'];
		echo '
	<!DOCTYPE HTML PUBLIC  "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
	<html>
		<head>
			<title>'.$config['text']['checkoutError'].'</title>
			<meta http-equiv="Content-Type" content="text/html; charset=' . $config['encoding'] . '">
			<meta http-equiv="refresh" content="5; url=' . $redirect_url . '">
		</head>
		<body>
		' . $config['text']['checkoutError'] . '
		</body>
	</html>';
		die;
	}

	# Price validation is complete
	# Send cart contents to PayPal using their upload method, for details see: http://j.mp/h7seqw
	elseif ($validPrices === true) {
		# Paypal count starts at one instead of zero
		$count = 1;
		
		# Build the query string
		$queryString  = $order_items = $order_sum = '';

		$currencySymbol = $jcart->currencySymbol($config['currencyCode']);

		$subtotal = $jcart->get_subtotal();

		$user['discount'] = null;

		# Выборка данных из БД и расчёт скидки
		if (($config['auth']['enabled'] == true || isset($config['discounts'])) && is_file(dirname(__FILE__) . '/modules/M_Users.inc.php'))
		{
			include_once dirname(__FILE__) . '/modules/M_Users.inc.php';
			$mUsers = M_Users::Instance();

			# Проверка авторизации.
			if (!isset($_SESSION['id_user']) && isset($_COOKIE['email']) && isset($_COOKIE['password']))
			{
				$mUsers->Login($_COOKIE['email'], $_COOKIE['password']);
			}

			if (isset($_SESSION['id_user']))
			{
				$user = $mUsers->GetLastOrder($_SESSION['id_user']);

				if (isset($config['discounts']))
					$user += $mUsers->CountDiscount($subtotal + $user['sum'], $config['discounts']);
			}
		}

		if (isset($config['discounts']) && !isset($user['discount']))
			$user = $mUsers->CountDiscount($subtotal, $config['discounts']);
		
		if (!isset($user['discount']))
			$user['discount'] = 0;
		
		foreach ($jcart->get_contents() as $item)
		{
			if ($item['price'] == '0.00')
				$delayed_order = true;

			$order_items[] = array(
				'id' => $item['id'],
				'product' => $item['name'],
				'price' => number_format($item['price'], $config['priceFormat']['decimals'], $config['priceFormat']['dec_point'], $config['priceFormat']['thousands_sep']),
				'discount' => max($user['discount'], $item['discount']),
				'real_price' => number_format($item['price'] * (1 - max($user['discount'], $item['discount']) / 100), $config['priceFormat']['decimals'], $config['priceFormat']['dec_point'], $config['priceFormat']['thousands_sep']),
				'quantity' => $item['qty'],
				'unit' => $item['unit'],
				'color' => $item['color'],
				'size' => $item['size'],
				'param' => $item['param'],
				'subtotal' => number_format($item['subtotal'], $config['priceFormat']['decimals'], $config['priceFormat']['dec_point'], $config['priceFormat']['thousands_sep'])
				);

			$order_sum += $item['subtotal'];

			# Increment the counter
			++$count;
		}

		$order_sum = number_format($order_sum, $config['priceFormat']['decimals'], $config['priceFormat']['dec_point'], $config['priceFormat']['thousands_sep']);

		if (is_file(dirname(__FILE__) . '/jcart/modules/C_Main.inc.php'))
		{
			# Подключение основного модуля (остальные внутри него)
			include_once dirname(__FILE__) . '/jcart/modules/C_Main.inc.php';
		}
		else
		{
			echo '
			<!DOCTYPE html>
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta charset="utf-8" />
				<title>Обработка заказа не работает</title>
				
			</head>
			<body>
				<h3>Обработка заказа в ознакомительной версии не работает</h3>
				<p>Приобретите рабочий модуль на <a href="http://jcart.info/order.html">официальном сайте</a>, загрузите файлы в папку jCart и корзина заработает на полную мощность.</p>
				<p><strong>Сумма заказа:</strong> ' . $order_sum . ' ' . $currencySymbol . '</p>
				<p><strong>Элементы заказа в виде массива:</strong> <br>';
				echo var_dump($order_items);
				echo '</p>
			</body>
			</html>';
		}

		# Если заказ отправлен, отправляем покупателя на результирующую страничку
		if (isset($sent))
		{
			$redirect_url = $config['sitelink'] . $config['returnUrl'];
			header('Location: ' . $config['sitelink'] . "confirm");
			echo $newmess;
			# Выводим редирект
			echo '<meta http-equiv="refresh" content="3; url=' . $redirect_url . '">
					</body>
				</html>';

			# Empty the cart
			$jcart->empty_cart();
			unset($_SESSION['order_tmp']);
		}
	}
}