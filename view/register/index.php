
<div class="container">
	<div class="row">
		<div class="col-md-4"></div>
		
		<?php Session::init(); ?>

		<?php 
			if((Session::get("user"))){
			
		?>
			
			<?php }else{?>
		<?php
		
				
		?>
		
		<div class="col-md-4">
			
            <label style = "margin-bottom:10px;margin-top:50px;">Register</label><input placeholder="username" type="text" class = "form-control" name="login" id = "usernameRegister_id" style = "margin-bottom:10px;margin-top:5px;"/>
         <input placeholder="password" type="password" class = "form-control" name="password" id = "passwordRegister_id" style = "margin-bottom:10px;"/>
				<div class = "row">
					<div class = "col-md-6">
					<input type = "button" class = "btn btn-info btn-sm btn-block" id = "register_id" value = "save" style = "margin-top:6px;">
					</div>
					<div class = "col-md-6">
						<small>Do you want to log in?</small><a href = "home"><small> Login now</small></a>
					</div>
				</div>
            <small id = "registerResponse_id" style = "color:orange;"></small>
		</div>
		<?php }; ?>
		
		<div class="col-md-4"></div>
	</div>
</div>


<script>
$(document).ready(function(){
    
function accessSessionLogin(action,user){
            $.ajax({
                url:'data/home/session_data.php',
                type:'POST',
                dataType:'text',
                data:{action:action,user:user},
                success:function(data){
                  
                   
                },
                error:function(xhr,status,error){
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        }

        
    $(document).on('click',"#register_id",function(){



username = $("#usernameRegister_id").val();
password = $("#passwordRegister_id").val();


if(username =="" || password ==""){
    $("#registerResponse_id").html("please fill all the textboxes.");
}else{
    console.log(username);
    console.log(password);
    
    $.ajax({
        url:'data/home/register.php',
        type:'POST',
        dataType:'text',
        data:{action:'register',username:username,password:password},
        success:function(data){
            
            $("#registerResponse_id").html(data);

            $("#usernameRegister_id").val("");
            $("#passwordRegister_id").val("");

            if(data == "saved successfully!"){          
                accessSessionLogin('create',username);    
                window.location="dashboard";
            }
        },
        error:function(xhr,status,error){
            console.log(xhr);
            console.log(status);
            console.log(error);
        }
    });

    
}    
});
});
</script>