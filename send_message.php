<?php
//print_r($_POST);die;
/* $email_array = explode(',',$_POST['selected']);
		foreach($email_array as $e_address){	
			$to = $e_address;
			$subject = $_POST['subject'];
			$message = $_POST['markupStr'];
			$headers = "From : codebridgeinc.com";
			echo $to.','.$subject.','.$message.','.$headers.'<br>';
		} */
			//echo $to.','.$subject.','.$message.','.$headers; die;
			  /* if(mail($to, $subject, $message)){
				print_r ('email_sent');
			  } */
//print_r($email_array);
?>
<?php
//extract data from the post
//set POST variables
$url = 'http://domain.com/get-post.php';
$fields = array(
	/* 'lname' => urlencode($_POST['last_name']),
	'fname' => urlencode($_POST['first_name']),
	'title' => urlencode($_POST['title']),
	'company' => urlencode($_POST['institution']),
	'age' => urlencode($_POST['age']),
	'email' => urlencode($_POST['email']), */
	'message' => urlencode($_POST['markupStr']),
	'phone' => urlencode($_POST['selected'])
);

//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);

    ?>