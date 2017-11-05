<?php

$conn = new mysqli('localhost','root','','testing_1');

	if(isset($_POST['flyer_info'])){
		$pdf = $_FILES['flyerpdf'];
		$image = $_FILES['flyerimage'];
		
		if($pdf['name'] != ''){//print_r($pdf);print_r($image);die;
			//pdf
			$file_name = $pdf['name'];
			$name_img = time().uniqid(rand()).'.'.$file_name;
			
			$file_size = $pdf['size'];
			$file_tmp = $pdf['tmp_name'];
			$file_type = $pdf['type'];
			
			//image
			$file_name_1 = $image['name'];
			$name_img_1 = time().uniqid(rand()).'.'.$file_name_1;

			$file_size_1 = $image['size'];
			$file_tmp_1 = $image['tmp_name'];
			$file_type_1 = $image['type'];
			
			move_uploaded_file($file_tmp,"uploads/".$name_img);
			move_uploaded_file($file_tmp_1,"uploads/".$name_img_1);
			
			$insert = "insert into image (pdf_name,image_name) values('".$name_img."','".$name_img_1."')";
			$done = $conn->query($insert);
			
		}	
		
	}
?>
<!DOCTYPE html>
<html>
<head>
<title> upload </title>
<script src="js/jquery3.js">//https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js</script>
</head>
<body>
<form role="form" class="form-horizontal" method="post" id="" enctype= "multipart/form-data">	
	<div class="form-group">
		<label class="control-label col-sm-3" for="Image">Flyer Pdf</label>
		<div class="col-sm-9">
			<input type="file" class="filestyle" data-buttonText="Select a File" name="flyerpdf" id="flyerimage" required>
		</div>	
	</div>
	<div class="form-group">
		<label class="control-label col-sm-3" for="Image">Flyer Image</label>
		<div class="col-sm-9">
			<input type="file" class="filestyle" data-buttonText="Select a File" name="flyerimage" id="flyerimage_1" required>
		</div>	
	</div>
	<button type="submit" class="btn btn-primary  col-md-5  col-sm-5 " name="flyer_info" id="flyer_info" value="flyer_info">Add </button>
</form>
<div>
	<?php
		$fetch_img = "select id,image_name,pdf_name from image";//echo $fetch_img;die;
		$fetch = $conn->query($fetch_img);
		while($result = $fetch->fetch_assoc()){
			$data[] = $result;
	?>	
	<td>
		<a href="uploads/<?php echo $result['pdf_name']; ?>" target="_blank">click to see</a>
		<img src="uploads/<?php echo $result['image_name']; ?>" height="100px" width="100px" alt="no image">
		<button class="btn btn-warning btn-circle" onclick="return confirm('Are you sure?')"  alt="delete" title="delete" id='delete_flyer' value="<?php echo $result['id']; ?>"><i class="fa fa-trash-o"></i>del</button>
	</td>
	<?php } ?>

</div>
	
<script>
$(document).ready(function(){

$('#flyerimage').on( 'change', function() {
   myfile= $( this ).val();
   var ext = myfile.split('.').pop();
   if(ext !== "pdf"){
       alert('please upload pdf files');
	   $('#flyerimage').val('');
	   return false;
   }
});

		$("#delete_flyer").on('click', function(){
				
				var user_id = $("#delete_flyer").val();
				//alert(user_id);
		 $.ajax({
				 method: "POST", 
				 url:"delete_input.php",
				 data: {user:user_id}
			 })
			 .done(function(data){
				 //alert(data);
				  if($.trim(data == 'input_deleted'))
				 {
					 window.location.reload();
					
				 }else{
					 alert(data);
				 }
				
			 });
		});


   // $("#add_flyer").validationEngine();
	//alert('hello');
	/* $('#flyerimage').bind('change', function() {
		if((this.files[0].size) > 3097153){
			alert('unable to upload image(max-size 3 mb) !!! please select other image');
			$('#flyerimage').val('');
			//$('#flyer_info').attr('disabled',true);
			return false;
		}
	}); */
/* 	$("#flyer_info").click(function(){
		if($('#add_flyer').find('input[type=checkbox]:checked').length == 0)
		{
			alert('Please select at least one Sprache checkbox');
			return false;
		}
	}); */
});
</script>	
</body>
</html>