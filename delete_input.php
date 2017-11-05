<?php
$conn = new mysqli('localhost','root','','testing_1');
if(!empty($_POST['user'])){
	$user = $_POST['user'];
}
$qry = "delete from image where id = '$user'";
if($done = $conn->query($qry)){
echo 'input_deleted';
}
 

?>