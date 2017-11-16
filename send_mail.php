<?php
//print_r($_POST);die;
$email_array = explode(',',$_POST['selected']);
		foreach($email_array as $e_address){	
			$to = $e_address;
			$subject = $_POST['subject'];
			$message = $_POST['markupStr'];
			$headers = "From : codebridgeinc.com";
			echo $to.','.$subject.','.$message.','.$headers.'<br>';
		}
			//echo $to.','.$subject.','.$message.','.$headers; die;
			  /* if(mail($to, $subject, $message)){
				print_r ('email_sent');
			  } */
//print_r($email_array);