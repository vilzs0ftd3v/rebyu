
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4"></div>
		
		<div class="col-md-4">
			<h5 style = "text-align:center;">Questions</h5>
			
			<div id = "archive_id"></div>
		</div>
		
		<div class="col-md-4"></div>
	</div>
</div>
<!-- questions populate -->
<div data-backdrop="static" data-keyboard="false" show="true" class="modal fade" id="answersModalId" tabindex="-1" role="dialog" aria-labelledby="AddModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header" style = "color:black;">
		<small id = "resultQuestion_id"></small>&nbsp;&nbsp;&nbsp;&nbsp;<small id = "status_id"></small><small id = "timer_id"></small>
      </div>


      <div class="modal-body" style = "background-color:black;">
	   <input type = "hidden" class = "form-control" id = "archiveEdit_id">
	   
	   
	   <div id = "questionsList_id"></div>
      </div>

      <div class="modal-footer">
	  <button type="button" class="btn btn-warning" id = "run_id">Start</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>


    </div>
  </div>
</div>







<script>
    $(document).ready(function(){
		count = "";
		var itemCount = 1;
		var archiveQuestions = {
			question:[],
			answer:[],
			choicea:[],
			choiceb:[],
			choicec:[],
			choiced:[],
			id:[]
		};

		var stat = {
			attempt:0,
			correct:0,
			incorrect:0,
			item:1
		};

		

		var clock;
		var minute = 0;
		var hour = 0;







		$(document).on('click','#check_btn',function(){
			val = $("input:radio[name='choice']:checked").val();
			guess = $("#correctAnswer_id").val();
			incorrect = stat.incorrect;
			correct = stat.correct;
			attempt = stat.attempt+1;
			if(val == guess){
				correct = stat.correct+1;
				$("#resultQuestion_id").html("correct!");
				
			}else{
				incorrect = stat.incorrect+1;
				$("#resultQuestion_id").html("incorrect!");
			}
			
			stat.correct = correct;
			stat.incorrect = incorrect;
			stat.attempt = attempt;
			$("#status_id").html("attempt: "+stat.attempt+" / correct: "+stat.correct+" / incorrect: "+stat.incorrect+" / total: "+((archiveQuestions.question.length)-1));
		
		});

//-----------------------------next questions-----------------------------------------------------
		$(document).on('click','#next_btn',function(){
			
			totalLength = (archiveQuestions.question.length-1);
			$("#status_id").html("attempt: "+stat.attempt+" / correct: "+stat.correct+" / incorrect: "+stat.incorrect+" / total: "+((archiveQuestions.question.length)-1));
			$("#resultQuestion_id").html("");
				
				
				
				
				
				
				//console.log(itemCount+" ID set another question "+totalLength);
				line = "";
				if(itemCount>=totalLength){
					$("#status_id").html("");
					$("#taskList_id").html();
					line += "attempt: "+stat.attempt+" / correct: "+stat.correct+" / mistake: "+stat.incorrect+" / total: "+((archiveQuestions.question.length)-1);
					$("#questionsList_id").html("<br><br><br>&nbsp;"+"&nbsp;&nbsp;Sorry there is no other question found.<br>&nbsp;&nbsp;&nbsp;"+line+"<br><br><br>");
				}else{
					$("#taskList_id").html("");
					itemCount+=1;
					console.log(itemCount+" ID set another question");
					setQuestions(itemCount); 
					
					
				}
			
			
		});

//-----------------------------modal close-----------------------------------------------------
$('#answersModalId').on('hidden.bs.modal',function(){
	itemCount = 1;
	console.log("modal is hidden");
	$('#run_id').prop('disabled',false);
});
$('playQuestion_id').prop('disabled',true);

//-----------------------------set questions-----------------------------------------------------
function setQuestions(x){
			$("#questionList_id").html("");
			$('#run_id').prop('disabled',true);
			if(x>=archiveQuestions.question.length){
				clearInterval(clock); 

				$("#questionsList_id").html("There is no questions to be displayed.");
			}else{
			console.log("populate function:"+x);
			question = "<h5>"+x+". "+archiveQuestions.question[x]+"</h5>";
			choices= "<input type = 'radio' name = 'choice' value='"+archiveQuestions.choicea[x]+"'>&nbsp;"+archiveQuestions.choicea[x]+"<br>";
			choices += "<input type = 'radio' name = 'choice' value='"+archiveQuestions.choiceb[x]+"'>&nbsp;"+archiveQuestions.choiceb[x]+"<br>";
			choices += "<input type = 'radio' name = 'choice' value='"+archiveQuestions.choicec[x]+"'>&nbsp;"+archiveQuestions.choicec[x]+"<br>";
			choices += "<input type = 'radio' name = 'choice' value='"+archiveQuestions.choiced[x]+"'>&nbsp;"+archiveQuestions.choiced[x]+"<br>";
			choices += "<input type = 'hidden' id = 'correctAnswer_id' value='"+archiveQuestions.answer[x]+"'><br>";
			button = "<input type = 'button' value = 'check' class='btn btn-sm btn-info' id = 'check_btn'>&nbsp;<input type = 'button' value = 'next' class='btn btn-sm btn-danger' id = 'next_btn'><div id = 'res_id'></div>";

			$("#questionsList_id").html(question+choices+button);
			
			}
		}
		//--------------------stopwatch --------------------------------
function stopwatch(){
	var ticks = 0; 
			clock = setInterval(function() { 
			ticks++;
			//times = ticks;
			if(ticks == 60){
				minute  = minute+1;
				ticks=0;
			}
			if(minute == 60){
				hour  = hour+1;
				ticks=0;
			}
			$('#timer_id').html("&nbsp;&nbsp;&nbsp;time: "+hour+":"+minute+":"+ticks);
				if (ticks == (items*120)) { 
					clearInterval(clock); 
					//console.log("stop."); 
					
					$('#timer_id').html(" time stop.");
				} 
			}, 1000);
}
//--------------------try or open question --------------------------------
$(document).on("click","#run_id",function(){
			
			$("#status_id").html("");
			id = $("#archiveEdit_id").val();
			//clearInterval(clock); 
			
			items = ((archiveQuestions.question.length)-1);
			setQuestions(1);

			stat.incorrect = 0;
			stat.correct = 0;
			stat.attempt = 0;
			//stopwatch();
			$("#status_id").html("attempt: "+stat.attempt+" / correct: "+stat.correct+" / incorrect: "+stat.incorrect+" / total: "+((archiveQuestions.question.length)-1));

			
			
	
		});
		

//------------------------populate question using ID-------------------------

		function populateQuestions(archive_id){
			
			$("#status_id").html("");
			$("#resultQuestion_id").html("");
			$('#timer_id').html("");
			$("#questionsList_id").html("<br><br><br>&nbsp;&nbsp;&nbsp;Please click the start button to commence this quiz.<br><br><br><br>");
			console.log("populate questionsssssss"+archive_id); 
			archiveQuestions.question = [];
			archiveQuestions.answer = [];
			archiveQuestions.choicea = [];
			archiveQuestions.choiceb = [];
			archiveQuestions.choicec = [];
			archiveQuestions.choiced = [];

			stat.attempt = [];
			stat.correct = [];
			stat.incorrect = [];
			stat.item = [];

			$.ajax({
			url:'data/home/archive.php',
			method:'POST',
			dataType:'json',
			data:{action:'getData',archive_id:archive_id},
			success:function(data){
				
				x = 1;
				
				Object.keys(data).forEach(function(key){
					archiveQuestions.question[x] = data[key].review_question;
					archiveQuestions.answer[x] = data[key].review_answer;
					
					archiveQuestions.id[x] = data[key].review_id;
					
						num = Math.floor(Math.random() * 3); 
					
							if(num==0){
								archiveQuestions.choicea[x] = data[key].review_choicea;
								archiveQuestions.choiceb[x] = data[key].review_choiceb;
								archiveQuestions.choicec[x] = data[key].review_choicec;
								archiveQuestions.choiced[x] = data[key].review_answer;
							
							}
							if(num==1){
								archiveQuestions.choicea[x] = data[key].review_choiceb;
								archiveQuestions.choiceb[x] = data[key].review_choicea;
								archiveQuestions.choicec[x] = data[key].review_answer;
								archiveQuestions.choiced[x] = data[key].review_choicec;
								
								
							}
							if(num==2){
								archiveQuestions.choicea[x] = data[key].review_choicea;
								archiveQuestions.choiceb[x] = data[key].review_answer;
								archiveQuestions.choicec[x] = data[key].review_choiceb;
								archiveQuestions.choiced[x] = data[key].review_choicec;
								
							}
							if(num==3){
								archiveQuestions.choicea[x] = data[key].review_answer;
								archiveQuestions.choiceb[x] = data[key].review_choicea;
								archiveQuestions.choicec[x] = data[key].review_choiceb;
								archiveQuestions.choiced[x] = data[key].review_choicec;
							
							}
					
					
					x++;
					
				});
				//items = x;
				//$("#questionsList_id").html(list);
			},
			error(xhr,error,status){
				console.log(xhr);
				console.log(error);
				console.log(status);
			}
		});
		}
//------------------------call back method-------------------------

		function callBackTryQuestion(i){
			$("#questionsList_id").html("");
			console.log(i+"debuggggg");	
			
			
			populateQuestions(i);
			
		}

		function callBackAdd(i){
			$("#archiveID_id").val(i);
		}
//------------------------call back method end-------------------------

//------------------------start-------------------------
       function populateArchive(){
		   console.log("ready!");
		   list="";
		 $.ajax({
                url:'data/home/archive.php',
                type:'POST',
                dataType:'json',
                data:{action:'display'},
                success:function(data){
					
					list += "<div class='table-responsive'><table class='table'>";
					list += "<thead><tr><th>Archive</th><th>Items</th><th>Date Created</th><th>Action</th></tr></thead><tbody>";
                    Object.keys(data).forEach(function(key){
						list += "<tr><td>"+data[key].archive_name+"</td>";
						list +="<td>"+data[key].count+"</td>";
						list += "<td>"+data[key].date_added+"</td>";
						if(data[key].count == 0){
					    	list += "<td><a href = 'settings'><input type='button' class='btn btn-info btn-sm btn-info' value = '+'></a></td>";
						}else{
							list += "<td><input type='button' class='btn btn-info btn-sm btn-warning' value = 'try' id = 'play_"+data[key].archive_id+"id' data-toggle='modal' data-target='#answersModalId'></td>";
						}
					
						$(document).on('click','#play_'+data[key].archive_id+'id',function(){
							callBackTryQuestion(data[key].archive_id);

						});
						$(document).on('click','#add_'+data[key].archive_id+'id',function(){
							callBackAdd(data[key].archive_id);

						});

					});
					list += "</tbody></table></div>";

					

					$('#archive_id').html(list);
                },
                error:function(xhr,status,error){
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            }); 
	   }
//------------------------end-------------------------
	   populateArchive();

     $(document).on('click','#saved_id',function(){
			
			question = $('#question_id').val();
			answer = $('#answer_id').val();
			choicea = $('#choicea_id').val();
			choiceb = $('#choiceb_id').val();
			choicec = $('#choicec_id').val();
			minute = $('#minute_id').val();
			category = $("#category_id").val();
      archiveID = $("#archiveID_id").val();
		console.log("archive id: "+archiveID);
			 $.ajax({
			url:'data/home/archive.php',
			method:'POST',
			dataType:"text",
			data:{action:'insert',question:question,answer:answer,choicea:choicea,choiceb:choiceb,choicec:choicec,minute:minute,archive_id:archiveID},
			success:function(data){
			
				$('#question_id').val("");
				$('#answer_id').val("");
				$('#choicea_id').val("");
				$('#choiceb_id').val("");
				$('#choicec_id').val("");
				$('#minute_id').val("");
				$("#questionModalId").modal('hide');
				populateArchive();
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
