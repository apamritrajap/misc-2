<?php
session_start();
include_once("../includes/constants.php");
//include_once(APP_GEN_FUNCTION_PATH ."GeneralFunction.php");
//$objGeneralFunction = new GeneralFunctions(); 
//echo 'hi';
//monthly
	$conn = new mysqli('localhost','root','','db_accounting');
	$sql = "select * from admin";
	$data = [];
		$select = $conn->query($sql);
		while( $fetch = $select->fetch_assoc() ){
			$data[] = $fetch;
		}
		
	//echo "<pre>";print_r($helloMail);die;
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
                          
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                 <th><i class="icon_profile"></i><input type="checkbox" class="select_all" id="selectall"></th>
                                 <th><i class="icon_calendar"></i> Date</th>
                                 <th><i class="icon_mail_alt"></i> Email</th>
                                 <th><i class="icon_pin_alt"></i> City</th>
                                 <th><i class="icon_mobile"></i> Mobile</th>
                                 <th><i class="icon_cogs"></i><button class="btn btn-primary" id="send_send"  data-toggle="modal" data-target="#modalForm">Send</button></th>
                              </tr>
							  <?php
								foreach($data as $users){
							  ?>
                              <tr>
                                 <td><input value="<?php echo $users['email']; ?>" type="checkbox" class="single_select case"></td>
                                 <td><?php echo $users['id']; ?></td>
                                 <td><?php echo $users['username']; ?></td>
                                 <td><?php echo $users['email']; ?></td>
                                 <td>
                                  <div class="btn-group">
                                      <a class="btn btn-primary" href="#"><i class="icon_plus_alt2"></i></a>
                                  </div>
                                  </td>
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
			 </section>
			 </section>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>		 
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
		$("#send_send").click(function() {
			if($('input:checkbox:checked').length < 1){
				alert("Please at least one of the checkbox");
				return false;
			}
		});
//get value class checked
	$("#send_mail").click(function() {
		var message = $('#inputMessage').val();//cus
		if($.trim(message) == ''){
			alert("Please type some custom message  !!!");
			return false;
		}
	    var chkArray = [];
		
		/* look for all checkboes that have a class 'case' attached to it and check if it was checked */
		$(".case:checked").each(function() {
			chkArray.push($(this).val());
		});
		
		/* we join the array separated by the comma */
		var selected;
		selected = chkArray.join(',') ;
		var message = $('#inputMessage').val();
		
		/* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
		if(selected.length > 1){
			//alert("You have selected " + selected);	
			$.ajax({
			  method: "POST",
			  url: "send_mail.php",
			  data: { selected,message }
			})
			  .done(function( msg ) {
				alert( msg );
			  });
		}else{
			alert("Please at least one of the checkbox");	
		}
	});
	
});	
</script>			 
			 