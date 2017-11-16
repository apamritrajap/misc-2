<?php
session_start();
include_once("../includes/constants.php");
//change = 169 / 234/ 224
	$conn = new mysqli('localhost','root','','db_accounting');
	$sql = "select * from admin";
	$data = [];
		$select = $conn->query($sql);
		while( $fetch = $select->fetch_assoc() ){
			$data[] = $fetch;
		}
		
	//echo "<pre>";print_r($data);die;
include_once 'header.php';	
?>
<!--main content start-->
<section id="main-content">
  <section class="wrapper">            
	  <!--overview start-->
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header"><i class="fa fa-laptop"></i> Monthly Payment Chart</h3>
			<ol class="breadcrumb">
				<li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
				<li><i class="fa fa-laptop"></i>Payment Chart</li>						  	
			</ol>
		</div>
	</div>
	<div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Advanced Table
                          </header>
                          
                          <table class="table table-striped table-advance table-hover" id="table_id">
                           <tbody>
                              <tr>
                                 <th><i class="icon_profile"></i><input type="checkbox" class="select_all both_class" id="selectall"></th>
                                 <th><i class="icon_calendar"></i> Date</th>
                                 <th><i class="icon_mail_alt"></i> Email</th>
                                 <th><i class="icon_pin_alt"></i> City</th>
                                 <th><i class="icon_mobile"></i> contact</th>
                                 <th>
									<i class="icon_cogs"></i><button class="btn btn-primary btn_sub" id="send_send"  data-toggle="modal" data-target="#modalForm" disabled>Send</button>
								 
									<i class="icon_cogs"></i><button class="btn btn-primary btn_sub" id="send_msg"  data-toggle="modal" data-target="#modalFormMsg" disabled>message</button>
								</th>
                              </tr>
							  <?php
								foreach($data as $users){
							  ?>
                              <tr>
                                 <td><input value="<?php echo $users['email']; ?>" type="checkbox" class="single_select case both_class"></td>
                                 <td><?php echo $users['id']; ?></td>
                                 <td><?php echo $users['username']; ?></td>
                                 <td class="subject"><?php echo $users['email']; ?></td>
                                 <td class="subject_con"><?php echo $users['contact']; ?></td>
                              </tr>
								<?php } ?>
                                                            
                           </tbody>
                        </table>
                      </section>
                  </div>
              </div>
<!-- modal -->
<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Contact Form</h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form">
					<div class="form-group">
                        <label for="inputName">Subject</label>
                        <input type="text" class="form-control" id="inputName" placeholder="Subject"/>
                    </div>                  
                    <div class="form-group">
						<div id="summernote"><p>Hello Summernote</p></div>
                    </div>
                </form>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitBtn" id="send_mail">SUBMIT</button>
            </div>
        </div>
    </div>
</div>

<!-- modal modal msg -->
<div class="modal fade" id="modalFormMsg" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Message For Users</h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form">
<!--                     <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" class="form-control" id="inputName" placeholder="Enter your name"/>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Enter your email"/>
                    </div> -->
                    <div class="form-group">
                        <label for="inputMessage">Message</label>
                        <textarea class="form-control" id="inputMessage" placeholder="Enter your message"></textarea>
						<!-- <div id="summernote"><p>Hello Summernote</p></div> -->
                    </div>
                </form>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitBtn" id="send_msg_msg">SUBMIT</button>
            </div>
        </div>
    </div>
</div>
<div id="check"></div>
			 </section>
			 </section>
			 <!--
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
			 -->
	<script src="editor/summer_bootstr.js"></script>		
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
  <script src="editor/summer.js"></script>
<script>
$(document).ready(function() {
        
$('#summernote').summernote({
  height: 300,                 // set editor height
  minHeight: null,             // set minimum height of editor
  maxHeight: null,             // set maximum height of editor
  focus: true                  // set focus to editable area after initializing summernote
});


});		
/* if ($('.both_class:checked')) {
    $("#send_send").removeAttr("disabled");
    $("#send_msg").removeAttr("disabled");
  } else {
    $("#send_msg").attr("disabled", true);
    $("#send_send").attr("disabled", true);
  }
}); */
  </script>  
<script>
$(document).ready(function() {//alert('hello');
    $('#selectall').on('click',function(){
        if(this.checked){
            $('.case').each(function(){
                this.checked = true;
            });
        }else{
             $('.case').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.case').on('click',function(){
        if($('.case:checked').length == $('.case').length){
            $('#selectall').prop('checked',true);
        }else{
            $('#selectall').prop('checked',false);
        }
    });
//send mail button on click
		/* $("#send_send").click(function() {
			if($('input:checkbox:checked').length < 1){
				alert("Please at least one of the checkbox");
				return false;
			}
		}); */
//get value class checked
$('#send_mail').on('click', function(){
	var markupStr = $('#summernote').summernote('code');
	var subject = $('#inputName').val();
	
	alert(markupStr);
		    var chkArray = [];
		
		/* look for all checkboes that have a class 'case' attached to it and check if it was checked */
		$(".case:checked").each(function() {
			//chkArray.push($(this).val());  //change here
			var findtd = $(this).closest('tr').find('.subject').text();
			chkArray.push($.trim(findtd));
		});
		
		/* we join the array separated by the comma */
		var selected;
		selected = chkArray.join(',') ;
		
		alert(selected);
		/* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
	if(selected.length > 1){
		$.ajax({
			  method: "POST",
			  url: "send_mail.php",
			  data: { markupStr,selected,subject }
			})
			  .done(function( msg ) {
				//console.log( msg );
				$('#check').html(msg);
			  });
	}else{
			alert("Please at least one of the checkbox");	
		}	  

});		
// message

$('#send_msg_msg').on('click', function(){
	var markupStr = $('#inputMessage').val();
	var chkArray = [];
	$(".case:checked").each(function() {
		//chkArray.push($(this).val());  //change here
		var findtd = $(this).closest('tr').find('.subject_con').text();
		chkArray.push($.trim(findtd));
	});	
		
	var selected;
	selected = chkArray.join(',') ;
	if(selected.length > 1){
		$.ajax({
			  method: "POST",
			  url: "send_message.php",
			  data: { markupStr,selected }
			})
			  .done(function( msg ) {
				//console.log( msg );
				$('#check').html(msg);
			  });
	}else{
			alert("Please at least one of the checkbox");	
		}

});		


	
});	
</script>			 
			 