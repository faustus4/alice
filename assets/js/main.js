$(document).ready(function() {


	var questions = [];

    var t = $('#lessonListTable').DataTable();

    var q = $('#quizListTable').DataTable();
    $('#activityListTable').DataTable();
    $('#quizResultListTable').DataTable();

    fetchLessons();
    fetchQuizzes();

    function fetchLessons(){
    	var counter = 1;
    	$.get( "controllers/getLessons.php", function( data ) {
		  $.each(JSON.parse(data), function(key, val){

		  	t.row.add( [
	            val.lessonId,
	            val.lessonName,
	            val.lessonDescription,
	            val.dateUpdated,
	            '<a href="assets/js/ViewerJS/#../../../lessons/'+val.fileName+'" target="_blank"><button class="btn btn-success btn-sm"><i class="fa fa-eye"></i> View</button></a>    <button class="btn btn-info btn-sm editLessonBtn" data-target="#updateLessonModal" data-toggle="modal"><i class="fa fa-edit"></i> Edit</button>'
	        ] ).draw( false );
		  })

		  $(".editLessonBtn").click(function(){
	        	$("#updateLessonModal input[name='lessonId']").val($(this).parent().siblings(":eq(0)").text());
	        	$("#updateLessonModal input[name='lessonName']").val($(this).parent().siblings(":eq(1)").text());
	        	$("#updateLessonModal input[name='lessonDescription']").val($(this).parent().siblings(":eq(2)").text());
	        })

		});
    }

    function fetchQuizzes(){
      var counter = 1;
      $.get( "controllers/getQuizzes.php", function( data ) {
      
      $.each(JSON.parse(data), function(key, val){
        console.log(val)
        q.row.add( [
              val.quizId,
              val.quizName,
              val.dateUpdated,
              '<a href="assets/js/ViewerJS/#../../../lessons/'+1+'" target="_blank"><button class="btn btn-success btn-sm"><i class="fa fa-eye"></i> View</button></a>    <button class="btn btn-info btn-sm editLessonBtn" data-target="#updateLessonModal" data-toggle="modal"><i class="fa fa-edit"></i> Edit</button>'
          ] ).draw( false );
      })
    });
    }

    

	$('#studentListTable').DataTable();
    $(".subject-activity").click(function(){
    	$(".subject-activity").removeClass("sub-active");
    	$(this).addClass("sub-active");
    })

    $("#quizToggleView").click(function(){
    	$("#quizzesSection").show();
    	$("#lessonSection").hide();
    	$("#activitiesSection").hide();
    	$("#quizzesResultSection").hide();
    })

    $("#lessonToggleView").click(function(){
    	$("#quizzesSection").hide();
    	$("#lessonSection").show();
    	$("#activitiesSection").hide();
    	$("#quizzesResultSection").hide();
    })

    $("#activityToggleView").click(function(){
    	$("#quizzesSection").hide();
    	$("#lessonSection").hide();
    	$("#activitiesSection").show();
    	$("#quizzesResultSection").hide();
    })

    $("#quizzesResultToggleView").click(function(){
    	$("#quizzesSection").hide();
    	$("#lessonSection").hide();
    	$("#activitiesSection").hide();
    	$("#quizzesResultSection").show();
    })

    $("#subjectNavList li").click(function(){
    	$("#subjectNavList li a").removeClass("active");
    	$(this).children("a").addClass("active");
    })

	$("#multipleChoiceInput").show();
	$("#answerTypeMultipleChoice").show();
	$("#answerTypeText").hide();
	$("#answerTypeTrueOrFalse").hide();
	$("#answerTypeEnumeration").hide();

	function changeQuestionType(type){
		if(type == 'multipleChoice'){
    		$("#multipleChoiceInput").show();
    		$("#answerTypeMultipleChoice").show();

    		$("#answerTypeText").hide();
    		$("#answerTypeText input").val("");
    		$("#answerTypeTrueOrFalse").hide();
    		$("#answerTypeTrueOrFalse input").prop("checked",false);
    		$("#answerTypeEnumeration").hide();
    		$("#answerTypeEnumeration textarea").val("");
    	} else if (type == 'fillInTheBlank' || type == 'identification'){
			$("#answerTypeText").show();
			$("#answerTypeText input").val("");
    		$("#answerTypeTrueOrFalse").hide();
    		$("#answerTypeTrueOrFalse input").prop("checked",false);
			$("#answerTypeEnumeration").hide();
    		$("#multipleChoiceInput").hide();
    		$("#multipleChoiceInput input").val("");
    		$("#answerTypeMultipleChoice").hide();
    		$("#answerTypeMultipleChoice input").prop("checked",false)
    		$("#answerTypeEnumeration textarea").val("");
    	} else if (type == 'enumeration'){
    		$("#answerTypeEnumeration").show();

    		$("#answerTypeText").hide();
    		$("#answerTypeText input").val("");
    		$("#answerTypeTrueOrFalse").hide();
    		$("#answerTypeTrueOrFalse input").prop("checked",false);
    		$("#multipleChoiceInput").hide();
    		$("#multipleChoiceInput input").val("");
    		$("#answerTypeMultipleChoice").hide();
    		$("#answerTypeMultipleChoice input").prop("checked",false)
    	} else if (type == 'trueOrFalse'){
    		$("#answerTypeTrueOrFalse").show()
    		
    		$("#answerTypeText").hide();
    		$("#answerTypeText input").val("");
			$("#answerTypeEnumeration").hide();
    		$("#multipleChoiceInput").hide();
    		$("#multipleChoiceInput input").val("");
    		$("#answerTypeMultipleChoice").hide();
    		$("#answerTypeMultipleChoice input").prop("checked",false);
    		$("#answerTypeEnumeration textarea").val("");
    	}
	}

    $("#questionType").change(function(){
    	changeQuestionType($(this).val())
    })

    $("#addQuestionSubmit").click(function(){
    	var questionType = $("#questionType").val();
    	var question = $("#question").val();
    	var answer = "";
    	var a = "";
    	var b = "";
    	var c = "";
    	var d = "";
    	var questionItem;

    	if (questionType == 'multipleChoice')
    	{
    		a = $("#multipleChoiceA").val();
    		b = $("#multipleChoiceB").val();
    		c = $("#multipleChoiceC").val();
    		d = $("#multipleChoiceD").val();
    		answer = $("#answerTypeMultipleChoice input:checked").val();

    		if (a.trim() == "" || b.trim() == "" || c.trim() == "" || d.trim() == "")
    		{
    			alert("Please complete the quiz item form");
    			return;
    		}
    	}

    	if (questionType == 'trueOrFalse')
    	{
    		answer = $("#answerTypeTrueOrFalse input:checked").val();
    	}

    	if (questionType == 'fillInTheBlank' ||  questionType == 'identification')
    	{
    		answer = $("#answerTypeText input").val();
    	}

    	if (questionType == 'enumeration')
    	{
    		answer = $("#answerTypeEnumeration textarea").val();
    	}

    	if(answer == undefined || answer.trim() == "" || question.trim() == "")
    	{
			alert("Please complete the quiz item form");
			return;
    	}

    	questionItem = {
    		"type" : questionType,
    		"question" : question,
    		"choices" : [a,b,c,d],
    		"answer" : answer
    	}

    	if($("#hiddenQuestionKey").val() == "") {
			questions.push(questionItem);
    	} else {
    		questions[$("#hiddenQuestionKey").val()] = questionItem;
    	}
    	

    	$("#hiddenQuestionKey").val("");
    	$("#addQuestionSubmit").text("Add Question");

    	$("#question").val("");
    	$("#questionType").val("multipleChoice");
  		$("#multipleChoiceInput").show();
  		$("#multipleChoiceInput input").val("");
  		$("#answerTypeMultipleChoice").show();
  		$("#answerTypeMultipleChoice input").prop("checked",false);

  		$("#answerTypeText").hide();
  		$("#answerTypeText input").val("");
  		$("#answerTypeTrueOrFalse").hide();
  		$("#answerTypeTrueOrFalse input").prop("checked",false);
  		$("#answerTypeEnumeration").hide();
  		$("#answerTypeEnumeration textarea").val("");

    	renderQuizTable(questions);
    })



   	function renderQuizTable(data){
      $("textarea[name='quizItems']").val(JSON.stringify(data));
   		var quizHtml = "";
   		var quizCount = 0;
   		var instruction ="";
   		$("#quizContainer").empty();
   		$.each(data,function(key, value){
   			if(value.type=='fillInTheBlank')
   			{
   				instruction = "Fill in the blank"
   			}
   			if(value.type=='multipleChoice')
   			{
   				instruction = "Multiple choice"
   			}
   			if(value.type=='trueOrFalse')
   			{
   				instruction = "True or false"
   			}
   			if(value.type=='enumeration')
   			{
   				instruction = "Enumerate"
   			}
   			if(value.type=='identification')
   			{
   				instruction = "Identification"
   			}

   			quizCount++;

   			quizHtml += "<div><b>" +quizCount+".</b> "+ value.question+"<span class='small' style='color:gray'>    <i>"+instruction+"</i></span>&nbsp;&nbsp;<span class='small' style='color:gray'><a href='#' class='editItem' data='"+key+"'>edit</a> | <a href='#' class='deleteItem' data='"+key+"'>delete</a></span></div><br/>"
   			if(value.type=='multipleChoice')
   			{
   				quizHtml += "<div> A. "+value.choices[0]+"</div>"
   				quizHtml += "<div> B. "+value.choices[1]+"</div>"
   				quizHtml += "<div> C. "+value.choices[2]+"</div>"
   				quizHtml += "<div> D. "+value.choices[3]+"</div><br/>"
   			}
   			quizHtml += "<div><b>Answer: " +value.answer+"</b></div><br/>"
   		})

   		$("#quizContainer").append(quizHtml);

   		$(".deleteItem").click(function(){
   			if($("#hiddenQuestionKey").val() != "")
   			{
   				alert("A quiz item is being edited. Please finish it first before you can delete.")
   				return
   			}
			questions.splice($(this).attr('data'),1)
			renderQuizTable(questions);
		})

		$(".editItem").click(function(){
			var keyItem = $(this).attr('data')
			editQuestion(keyItem);
		})
   	}

   	function editQuestion(key)
   	{
   		var type = questions[key].type;
   		var answer = questions[key].answer;
		changeQuestionType(type);
		$("#questionType").val(type);
		$("#question").val(questions[key].question);

		if(type == 'multipleChoice'){
			$("#multipleChoiceA").val(questions[key].choices[0]);
    		$("#multipleChoiceB").val(questions[key].choices[1]);
    		$("#multipleChoiceC").val(questions[key].choices[2]);
    		$("#multipleChoiceD").val(questions[key].choices[3]);

    		$("#answerTypeMultipleChoice input[value='"+answer+"']").prop("checked",true);
		} else if (type == 'identification' || type == 'fillInTheBlank'){
			$("#answerTypeText input").val(answer);
		} else if (type == 'trueOrFalse'){
			$("#answerTypeTrueOrFalse input[value='"+answer+"']").prop("checked",true);
		} else if (type == 'enumeration'){
			$("#answerTypeEnumeration textarea").val(answer);
		}

		$("#hiddenQuestionKey").val(key);
		$("#addQuestionSubmit").text("Update Question");

		/*$("#multipleChoiceInput").show();
		$("#multipleChoiceInput input").val("");
		$("#answerTypeMultipleChoice").show();
		$("#answerTypeMultipleChoice input").prop("checked",false);

		$("#answerTypeText").hide();
		$("#answerTypeText input").val("");
		$("#answerTypeTrueOrFalse").hide();
		$("#answerTypeTrueOrFalse input").prop("checked",false);
		$("#answerTypeEnumeration").hide();
		$("#answerTypeEnumeration textarea").val("");*/

   	}


   	$("#topBarMenu li").click(function(){
   		$("#topBarMenu li").removeClass("active");
   		$(this).addClass("active");
   	})

   	$("#subjectMenu").click(function(){
   		$("#subjectMenuContent").show();
   		$("#studentMenuContent").hide();
   	});

   	$("#studentMenu").click(function(){
   		$("#subjectMenuContent").hide();
   		$("#studentMenuContent").show();
   	});


    var currentUrl = window.location.href;
    if (currentUrl.substr(currentUrl.length -5, 5) == '#quiz') {
      console.log("hey")
      $("#quizToggleView").click();
      $("#quizToggleView .subject-activity").click();
    }

} );