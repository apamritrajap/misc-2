<?php
$message = $_POST['smsmessage'];
				
$mobileno = $tomobile;
				
				$url="http://enterprise.smsgupshup.com/GatewayAPI/rest?method=SendMessage&send_to=".$mobileNo."&msg=".urlencode($sendsmsmsg)."&overide_dnd=FALSE&userid=2000168292&auth_scheme=plain&password=Hb6FZsGTN&v=1.0&format=text&mask=gymsof";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$curl_scraped_page = curl_exec($ch);
curl_close($ch);