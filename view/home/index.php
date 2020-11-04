
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
			
            <label style = "margin-bottom:10px;margin-top:50px;">Login</label><input placeholder="username" type="text" class = "form-control" name="login" id = "username_id" style = "margin-bottom:10px;margin-top:5px;"/>
         <input placeholder="password" type="password" class = "form-control" name="password" id = "password_id" style = "margin-bottom:10px;"/>
				<div class = "row">
					<div class = "col-md-6">
					<input type = "button" class = "btn btn-info btn-sm btn-block" id = "login_id" value = "login" style = "margin-top:6px;">
					</div>
					<div class = "col-md-6">
						<small>Do you want to try?</small><a href = "register"><small> Sign up now</small></a>
					</div>
				</div>
            <small id = "loginResponse_id" style = "color:orange;"></small>
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

        
    $(document).on('click',"#login_id",function(){



username = $("#username_id").val();
password = $("#password_id").val();


if(username =="" || password ==""){
    $("#loginResponse_id").html("please fill all the textboxes.");
}else{
    console.log(username);
    console.log(password);
    
    $.ajax({
        url:'data/home/login.php',
        type:'POST',
        dataType:'text',
        data:{action:'login',username:username,password:password},
        success:function(data){
            
            $("#loginResponse_id").html(data);

            $("#username_id").val("");
            $("#password_id").val("");

            if(data == "login successfully!"){          
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