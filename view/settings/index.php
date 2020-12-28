<?php Session::init(); ?>

		<?php 
			if(!(Session::get("user"))){
			
		?>

<?php }else{?>
<div class="container">
	<div class="row">
        
		<div class="col-md-4"></div>
		
		
			
			
		<?php
		
				
		?>
		
		<div class="col-md-4">
			
            <label style = "margin-bottom:10px;margin-top:50px;">Contribute</label>
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addArchiveModalID" id = "playQuestion_id">
				+
			</button>
            <div id = "settings_id"></div>
		</div>
		
		
		<div class="col-md-4"></div>
	</div>
</div>

<?php }; ?>


<!-- add archive modal -->
<div class="modal fade" id="addArchiveModalID" tabindex="-1" role="dialog" aria-labelledby="AddModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header" style = "color:black;">
		<h5><h5>Add a group of questions</h5></h5>
      </div>


      <div class="modal-body" style = "background-color:black;">
	  	<input type = "text" id = "archiveName_id" placeholder="Name" class="form-control">
      </div>

      <div class="modal-footer">
	  <button type="button" class="btn btn-default" id = "saveNewArchive_id">Save</button>
	  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>


    </div>
  </div>
</div>


<!-- Add Modal -->
<div class="modal fade" id="questionModalId" tabindex="-1" role="dialog" aria-labelledby="AddModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="addModalLongTitle">Add Question</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body">
       <input type = "hidden" id = "archiveID_id" class = "form-control" placeholder = "archive name">
       <input type = "hidden" id = "archiveName_id" class = "form-control" placeholder = "archive name">
       <input type = "hidden" id = "categoryArchive_id" class = "form-control" placeholder = "archive name">
	   <br>
	  	<textarea class = "form-control" placeholder = "question" id = "question_id"></textarea>
		  <br>
		  <br><textarea class = "form-control" placeholder = "answer" id = "answer_id"></textarea>
		  <br><textarea class = "form-control" placeholder = "choice A" id = "choicea_id"></textarea>
		  <br><textarea class = "form-control" placeholder = "choice B" id = "choiceb_id"></textarea>
		  <br><textarea class = "form-control" placeholder = "choice C" id = "choicec_id"></textarea>
		  <br><input type = "number" placeholder = "minute/s" id = "minute_id" class = "form-control">
		
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" id = "savedQuestion_id">Save</button>
      </div>


    </div>
  </div>
</div>

<script>
$(document).ready(function(){

    display();

    function display(){
        $.ajax({
			url:'data/home/settings.php',
			method:'POST',
			dataType:'json',
			data:{action:'display'},
            success:function(data){
                $html = "<table class='table table-sm' id ='archiveTbl_id' style='border:1px solid white; text-align:center;'>"+
                "<thead>"+
                "<tr>"+
                "<th style='text-align:center;'>Archive</th>"+
                "<th style='text-align:center;'>Count</th>"+
                "<th style='text-align:center;'>Date Created</th>"+
                "<th style='text-align:center;'>Action</th>"+
                "</tr>"+
                "</thead>"+
                "<tbody>";
                 Object.keys(data).forEach(function(key){
                     $html+="<tr>"+
                     "<td>"+data[key].archive_name+":"+data[key].username+"</td>"+
                     "<td>"+data[key].count+"</td>"+
                     "<td>"+data[key].date_added+"</td>"+
                     "<td>"+
                     "<input type='button' class='btn btn-sm btn-info' value='+'  id = 'playQuestion_id' data-toggle='modal' data-target='#questionModalId'>"+
                     "<input type = 'hidden' id = 'rowValue_id' value='"+data[key].archive_id+"' name = 'rowValueId'>"+
                     "<input type = 'hidden' id = 'rowValue_id' value='"+data[key].user_id+"' name = 'rowValueName'>"+
                     "<input type = 'hidden' id = 'rowValue_id' value='"+data[key].archive_name+"' name = 'rowValueArchive'>"+
                     "</td>"+
                     "</tr>";
                 });
                 $html+="</tbody></table>";
                 $("#settings_id").html($html);
            },
            error:function(xhr,error,status){
                console.log(xhr);
                console.log(error);
                console.log(status);
            }
        });
    }    

    $(document).on('click','#playQuestion_id',function(){
        let tr = $(this).closest('tr');
        let id = tr.find("input[name='rowValueId']").val();
        let name = tr.find("input[name='rowValueName']").val();
        let archiveName = tr.find("input[name='rowValueArchive']").val();
        $("#archiveID_id").val(id);
        $("#archiveName_id").val(name);
        $("#categoryArchive_id").val(archiveName);
        console.log($("#client_id").val());
    });


    $(document).on('click','#savedQuestion_id',function(){
		userID = $("#client_id").val();
        archiveID = $("#archiveID_id").val();
        archiveName = $("#categoryArchive_id").val();

		question = $('#question_id').val();
		answer = $('#answer_id').val();
		choicea = $('#choicea_id').val();
		choiceb = $('#choiceb_id').val();
		choicec = $('#choicec_id').val();
		minute = $('#minute_id').val();

		$.ajax({
			url:'data/home/settings.php',
			method:'POST',
			dataType:"text",
			data:{action:'insert',question:question,answer:answer,choicea:choicea,choiceb:choiceb,choicec:choicec,minute:minute,category:archiveName,archive_id:archiveID,clientID:userID},
			success:function(data){
			
				$('#question_id').val("");
				$('#answer_id').val("");
				$('#choicea_id').val("");
				$('#choiceb_id').val("");
				$('#choicec_id').val("");
				$('#minute_id').val("");
				$("#questionModalId").modal('hide');
				display();
			},
			error:function(xhr,status,error){
				console.log(xhr);
				console.log(status);
				console.log(error);
			}
		});  
	});


    $(document).on('click','#saveNewArchive_id',function(){
		name = $('#archiveName_id').val();
		id = $('#users_id').val();
        clientID = $("#client_id").val();
		console.log(id);
		 $.ajax({
			url:'data/home/settings.php',
			method:'POST',
			dataType:"text",
			data:{action:'create',archive_name:name,user_id:id,clientID:clientID},
			success:function(data){
			
				$('#archiveName_id').val("");
                display();
				$("#addArchiveModalID").modal('hide');
			},
			error:function(xhr,status,error){
				console.log(xhr);
				console.log(status);
				console.log(error);
			}
		});  
	});



});
</script>
