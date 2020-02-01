$(document).ready(function() {

  if($("#globalStudentId").val() != null){
    $(".restrictedAccess").hide();
    localStorage.setItem("topMenu","#subjects");
  }

	var questions = [];

    var t = $('#lessonListTable').DataTable();

    var q = $('#quizListTable').DataTable();
    var activityTable = $('#activityListTable').DataTable();

    $('#studentListTable thead tr').clone(true).appendTo( '#studentListTable thead' );
    $('#studentListTable thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="filter '+title+'" style="width:100%"/> ' );

        $( 'input', this ).on( 'keyup change', function () {
            if ( studentsTable.column(i).search() !== this.value ) {
                studentsTable
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );

    var studentsTable = $('#studentListTable').DataTable({
      orderCellsTop: true,
      fixedHeader: true
    });


  $('#quizResultListTable thead tr').clone(true).appendTo( '#quizResultListTable thead' );
    $('#quizResultListTable thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="filter '+title+'" style="width:100%"/> ' );

        $( 'input', this ).on( 'keyup change', function () {
            if ( qr.column(i).search() !== this.value ) {
                qr
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );

    var qr = $('#quizResultListTable').DataTable({
      orderCellsTop: true,
      fixedHeader: true
    });

    fetchLessons(0);
    fetchQuizzes(0);
    fetchActivities(0);
    fetchStudents();
    fetchSubjects();
    fetchQuizResults(0);

    function fetchSubjects(){
      var counter = 1;
      $.get( "controllers/getSubjects.php", function( data ) {
        $.each(JSON.parse(data), function(key, val){
          var html = `<li class="nav-item hideSubject" data="`+val.learningArea+`" subject="`+val.id+`"">
                   <a class="nav-link" href="#">`+val.name+`</a>
                   </li>`;

          $("#subjectNavList").append(html);
        })

        $("#subjectNavList li").click(function(){
          $("#subjectNavList li a").removeClass("active");
          $(this).children("a").addClass("active");
          fetchLessons($(this).attr('subject'));
          fetchQuizzes($(this).attr('subject'));
          fetchActivities($(this).attr('subject'));
          fetchQuizResults($(this).attr('subject'));
          $("input[name='subjectId']").val($(this).attr('subject'));
          localStorage.setItem("subject", $(this).attr('subject'));
        });

        $("#learningAreaSelect").change(function(){
          $(".addButton").attr('disabled',false);

          var learningArea = $(this).val()
          localStorage.setItem("learningArea", learningArea);
          $("input[name='learningAreaId']").val(learningArea);
          $("#subjectNavList li").removeClass("showSubject");
          $("#subjectNavList li").addClass("hideSubject");

          $("#subjectNavList li[data='"+learningArea+"']").addClass("showSubject").removeClass("hideSubject");

          if(localStorage.getItem("subject") != null && $("li[subject='"+localStorage.getItem("subject")+"']").attr('data') == learningArea) {
            $("li[subject='"+localStorage.getItem("subject")+"']").addClass("showSubject").removeClass("hideSubject").click();
          }
          else{
            $("#subjectNavList li[data='"+learningArea+"']").eq(0).click();  
          }

        }); 

        

        if(localStorage.getItem("learningArea") != null) {
          $("#learningAreaSelect").val(localStorage.getItem("learningArea")).change();
        }
        /*$(".editLessonBtn").click(function(){
          $("#updateLessonModal input[name='lessonId']").val($(this).parent().siblings(":eq(0)").text());
          $("#updateLessonModal input[name='lessonName']").val($(this).parent().siblings(":eq(1)").text());
          $("#updateLessonModal input[name='lessonDescription']").val($(this).parent().siblings(":eq(2)").text());
        })*/
      });
    }



    function fetchLessons(subjectId){
    	var counter = 1;
    	$.get( "controllers/getLessons.php?subjectId="+subjectId, function( data ) {
        t.clear().draw();
  		  $.each(JSON.parse(data), function(key, val){

  		  	t.row.add( [
  	            val.lessonId,
  	            val.lessonName,
  	            val.lessonDescription,
  	            val.dateUpdated,
  	            '<a href="assets/js/ViewerJS/#../../../lessons/'+val.fileName+'" target="_blank"><button class="btn btn-success btn-sm viewLesson"><i class="fa fa-eye"></i> View</button></a>    <button class="btn btn-info btn-sm editLessonBtn restrictedAccess" data-target="#updateLessonModal" data-toggle="modal"><i class="fa fa-edit"></i> Edit</button>'
  	        ] ).draw( false );
  		  })

  		  $(".editLessonBtn").click(function(){
        	$("#updateLessonModal input[name='lessonId']").val($(this).parent().siblings(":eq(0)").text());
        	$("#updateLessonModal input[name='lessonName']").val($(this).parent().siblings(":eq(1)").text());
        	$("#updateLessonModal input[name='lessonDescription']").val($(this).parent().siblings(":eq(2)").text());
        })

        if($("#globalStudentId").val() != null){
          $(".restrictedAccess").hide();
          $(".viewLesson").html('<i class="fa fa-book"></i> Read');
        }
		  });
    }

    function fetchQuizResults(subjectId){
      var counter = 1;
      $.get( "controllers/getQuizResult.php?subjectId="+subjectId, function( data ) {
        qr.clear().draw();
        $.each(JSON.parse(data), function(key, val){
          qr.row.add( [
                val.quizId,
                val.quizName,
                val.studentName,
                val.numberOfItems,
                val.numberOfCorrect,
                val.dateUpdated,
                val.section,
                val.schoolYear,
                '<div class="scores" style="display:none;">'+val.scores+'</div><div class="answers" style="display:none;">'+val.answers+'</div><div class="questions" style="display:none;">'+val.questionItems+'</div><button class="btn btn-info btn-sm viewQuizResultBtn" data-target="#takeQuizModal" data-toggle="modal"><i class="fa fa-edit"></i> View Answers</button>'
            ] ).draw( false );
        })

        $(".viewQuizResultBtn").click(function(){

          $("#takeQuizModal input[name='quizId']").val($(this).parent().siblings(":eq(0)").text());
          $("#quizTitleName").text($(this).parent().siblings(":eq(1)").text());
          questions =  JSON.parse($(this).siblings('div.questions').text());
          var answers =  JSON.parse($(this).siblings('div.answers').text());
          var scores =  JSON.parse($(this).siblings('div.scores').text());
          
          $("input[name='id']").val($("#globalStudentId").val());
          $("#showCompleteQuizError").hide();
          $("#showCompleteQuizSuccess").hide();
          $("#answerQuizSubmit").hide();

          renderQuizTestResult(questions, "#takeQuizModal", answers, scores);
        })

      });
    }


    function fetchStudents(){
      var counter = 1;
      $.get( "controllers/getStudents.php", function( data ) {

        $.each(JSON.parse(data), function(key, val){

          studentsTable.row.add( [
                val.studentId,
                val.fname,
                val.mname,
                val.lname,
                val.section,
                val.defaultPassword,
                val.schoolYear,
                '<div style="display:none;">'+val.id+'</div><button class="btn btn-info btn-sm editStudentBtn" data-target="#updateStudentModal" data-toggle="modal"><i class="fa fa-edit"></i> Update</button>'
            ] ).draw( false );
        })

        $(".editStudentBtn").click(function(){
          $("#updateStudentModal input[name='studentId']").val($(this).parent().siblings(":eq(0)").text());
          $("#updateStudentModal input[name='fname']").val($(this).parent().siblings(":eq(1)").text());
          $("#updateStudentModal input[name='mname']").val($(this).parent().siblings(":eq(2)").text());
          $("#updateStudentModal input[name='lname']").val($(this).parent().siblings(":eq(3)").text());
          $("#updateStudentModal input[name='section']").val($(this).parent().siblings(":eq(4)").text());
          $("#updateStudentModal input[name='schoolYear']").val($(this).parent().siblings(":eq(6)").text());
          $("#updateStudentModal input[name='id']").val($(this).siblings('div').text());
        })
      });
    }

    function fetchActivities(subjectId){
      var counter = 1;
      $.get( "controllers/getActivity.php?subjectId="+subjectId, function( data ) {
        activityTable.clear().draw();
        $.each(JSON.parse(data), function(key, val){
          
          activityTable.row.add( [
                val.activityId,
                val.activityName,
                val.activityDescription,
                val.dateUpdated,
                '<a href="assets/js/ViewerJS/#../../../activities/'+val.fileName+'" target="_blank"><button class="btn btn-success btn-sm"><i class="fa fa-eye"></i> View</button></a>    <button class="btn btn-info btn-sm editActivityBtn restrictedAccess" data-target="#updateActivityModal" data-toggle="modal"><i class="fa fa-edit"></i> Edit</button>'
            ] ).draw( false );
        })

        $(".editActivityBtn").click(function(){
          $("#updateActivityModal input[name='activityId']").val($(this).parent().siblings(":eq(0)").text());
          $("#updateActivityModal input[name='activityName']").val($(this).parent().siblings(":eq(1)").text());
          $("#updateActivityModal input[name='activityDescription']").val($(this).parent().siblings(":eq(2)").text());
        })

        if($("#globalStudentId").val() != null){
          $(".restrictedAccess").hide();
        }
      });
    }

    function fetchQuizzes(subjectId){

      var counter = 1;
      $.get( "controllers/getQuizzes.php?subjectId="+subjectId, function( data ) {
        q.clear().draw();
        $.each(JSON.parse(data), function(key, val){
          q.row.add( [
                val.quizId,
                val.quizName,
                val.dateUpdated,
                '<div style="display:none;">'+val.questionItems+'</div><button class="btn btn-info btn-sm editQuizBtn restrictedAccess" data-target="#updateQuizModal" data-toggle="modal"><i class="fa fa-edit"></i> Manage</button><button class="btn btn-info btn-sm takeQuizBtn restrictedAccess1" data-target="#takeQuizModal" data-toggle="modal"><i class="fa fa-edit"></i> Answer Quiz</button>'
            ] ).draw( false );
        })

        $(".editQuizBtn").click(function(){
          $("#updateQuizModal input[name='quizId']").val($(this).parent().siblings(":eq(0)").text());
          $("#updateQuizModal input[name='quizName']").val($(this).parent().siblings(":eq(1)").text());
          questions =  JSON.parse($(this).siblings('div').text());

          renderQuizTable(questions, "#updateQuizModal");
        })

        $(".takeQuizBtn").click(function(){
          $("#takeQuizModal input[name='quizId']").val($(this).parent().siblings(":eq(0)").text());
          $("#quizTitleName").text($(this).parent().siblings(":eq(1)").text());
          questions =  JSON.parse($(this).siblings('div').text());
          $("input[name='id']").val($("#globalStudentId").val());
          $("#showCompleteQuizError").hide();
          $("#showCompleteQuizSuccess").hide();
          $("#answerQuizSubmit").attr("disabled", false);
          $("#answerQuizSubmit").show();
          renderQuizTest(questions, "#takeQuizModal");
        })

        if($("#globalStudentId").val() != null){
          $(".restrictedAccess").hide();
        } else {
          $(".restrictedAccess1").hide();
        }
      });
    }

    

	
    $(".subject-activity").click(function(){
    	$(".subject-activity").removeClass("sub-active");
    	$(this).addClass("sub-active");
    })

    $("#quizToggleView").click(function(){
      localStorage.setItem("topSubmenu","#quiz");
    	$("#quizzesSection").show();
    	$("#lessonSection").hide();
    	$("#activitiesSection").hide();
    	$("#quizzesResultSection").hide();
    })

    $("#lessonToggleView").click(function(){
      localStorage.setItem("topSubmenu","#lesson");
    	$("#quizzesSection").hide();
    	$("#lessonSection").show();
    	$("#activitiesSection").hide();
    	$("#quizzesResultSection").hide();
    })

    $("#activityToggleView").click(function(){
      localStorage.setItem("topSubmenu","#activity");
    	$("#quizzesSection").hide();
    	$("#lessonSection").hide();
    	$("#activitiesSection").show();
    	$("#quizzesResultSection").hide();
    })

    $("#quizzesResultToggleView").click(function(){
      localStorage.setItem("topSubmenu","#quizResults");
    	$("#quizzesSection").hide();
    	$("#lessonSection").hide();
    	$("#activitiesSection").hide();
    	$("#quizzesResultSection").show();
    })

    

	$(".multipleChoiceInput").show();
	$(".answerTypeMultipleChoice").show();
	$(".answerTypeText").hide();
	$(".answerTypeTrueOrFalse").hide();
	$(".answerTypeEnumeration").hide();

	function changeQuestionType(type, container){

		if(type == 'multipleChoice'){
    		$(container+" .multipleChoiceInput").show();
    		$(container+" .answerTypeMultipleChoice").show();

    		$(container+" .answerTypeText").hide();
    		$(container+" .answerTypeText input").val("");
    		$(container+" .answerTypeTrueOrFalse").hide();
    		$(container+" .answerTypeTrueOrFalse input").prop("checked",false);
    		$(container+" .answerTypeEnumeration").hide();
    		$(container+" .answerTypeEnumeration textarea").val("");
    	} else if (type == 'fillInTheBlank' || type == 'identification'){
			   $(container+" .answerTypeText").show();
			   $(container+" .answerTypeText input").val("");
    		 $(container+" .answerTypeTrueOrFalse").hide();
    		 $(container+" .answerTypeTrueOrFalse input").prop("checked",false);
			   $(container+" .answerTypeEnumeration").hide();
    		$(container+" .multipleChoiceInput").hide();
    		$(container+" .multipleChoiceInput input").val("");
    		$(container+" .answerTypeMultipleChoice").hide();
    		$(container+" .answerTypeMultipleChoice input").prop("checked",false)
    		$(container+" .answerTypeEnumeration textarea").val("");
    	} else if (type == 'enumeration'){
    		$(container+" .answerTypeEnumeration").show();

    		$(container+" .answerTypeText").hide();
    		$(container+" .answerTypeText input").val("");
    		$(container+" .answerTypeTrueOrFalse").hide();
    		$(container+" .answerTypeTrueOrFalse input").prop("checked",false);
    		$(container+" .multipleChoiceInput").hide();
    		$(container+" .multipleChoiceInput input").val("");
    		$(container+" .answerTypeMultipleChoice").hide();
    		$(container+" .answerTypeMultipleChoice input").prop("checked",false)
    	} else if (type == 'trueOrFalse'){
    		$(container+" .answerTypeTrueOrFalse").show()
    		
    		$(container+" .answerTypeText").hide();
    		$(container+" .answerTypeText input").val("");
			  $(container+" .answerTypeEnumeration").hide();
    		$(container+" .multipleChoiceInput").hide();
    		$(container+" .multipleChoiceInput input").val("");
    		$(container+" .answerTypeMultipleChoice").hide();
    		$(container+" .answerTypeMultipleChoice input").prop("checked",false);
    		$(container+" .answerTypeEnumeration textarea").val("");
    	}
	}

    $("#addQuizModal select[name='questionType']").change(function(){
    	changeQuestionType($(this).val(), "#addQuizModal")
    })

    $("#updateQuizModal select[name='questionType']").change(function(){
      changeQuestionType($(this).val(), "#updateQuizModal")
    })

    $("#addQuizModal .addQuestionSubmit").click(function(){
      addQuestion("#addQuizModal");
    })

    $("#updateQuizModal .addQuestionSubmit").click(function(){
      addQuestion("#updateQuizModal");
    })

    function addQuestion(container){
    	var questionType = $(container+" select[name='questionType']").val();
    	var question = $(container+" textarea[name='question']").val();
    	var answer = "";
    	var a = "";
    	var b = "";
    	var c = "";
    	var d = "";
    	var questionItem;

    	if (questionType == 'multipleChoice')
    	{
    		a = $(container+" input[name='multipleChoiceA']").val();
    		b = $(container+" input[name='multipleChoiceB']").val();
    		c = $(container+" input[name='multipleChoiceC']").val();
    		d = $(container+" input[name='multipleChoiceD']").val();
    		answer = $(container+" .answerTypeMultipleChoice input:checked").val();

    		if (a.trim() == "" || b.trim() == "" || c.trim() == "" || d.trim() == "")
    		{
    			alert("Please complete the quiz item form");
    			return;
    		}
    	}

    	if (questionType == 'trueOrFalse')
    	{
    		answer = $(container+" .answerTypeTrueOrFalse input:checked").val();
    	}

    	if (questionType == 'fillInTheBlank' ||  questionType == 'identification')
    	{
    		answer = $(container+" .answerTypeText input").val();
    	}

    	if (questionType == 'enumeration')
    	{
    		answer = $(container+" .answerTypeEnumeration textarea").val();
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
      console.log(container+" .hiddenQuestionKey");
    	if($(container+" .hiddenQuestionKey").val() == "") {
			 questions.push(questionItem);
    	} else {
    	 questions[$(container+" .hiddenQuestionKey").val()] = questionItem;
    	}
    	

    	$(container+" .hiddenQuestionKey").val("");
    	$(container+" .addQuestionSubmit").text("Add Question");

    	$(container+" textarea[name='question']").val("");
    	$(container+" select[name='questionType']").val("multipleChoice");
  		$(container+" .multipleChoiceInput").show();
  		$(container+" .multipleChoiceInput input").val("");
  		$(container+" .answerTypeMultipleChoice").show();
  		$(container+" .answerTypeMultipleChoice input").prop("checked",false);

  		$(container+" .answerTypeText").hide();
  		$(container+" .answerTypeText input").val("");
  		$(container+" .answerTypeTrueOrFalse").hide();
  		$(container+" .answerTypeTrueOrFalse input").prop("checked",false);
  		$(container+" .answerTypeEnumeration").hide();
  		$(container+" .answerTypeEnumeration textarea").val("");

    	renderQuizTable(questions, container);
    }

    function renderQuizTestResult(data, container, answers, scores){

      $(container+" textarea[name='quizItems']").val(JSON.stringify(data));
      var quizHtml = "";
      var quizCount = 0;
      var instruction ="";
      $(container+" .quizContainer").empty();
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

        quizHtml += "<div><b>" +quizCount+".</b> "+ value.question+"<span class='small' style='color:gray'>    <i>"+instruction+"</i></span>&nbsp;&nbsp;<span class='small restrictedAccess' style='color:gray'><a href='#' class='editItem' data='"+key+"'>edit</a> | <a href='#' class='deleteItem' data='"+key+"'>delete</a></span></div><br/>"
        if(value.type=='multipleChoice')
        {
          
          quizHtml += "<div><input type='radio' name='"+quizCount+"' class='qAnswer' value='A'> A. "+value.choices[0]+"</div>"
          quizHtml += "<div><input type='radio' name='"+quizCount+"' class='qAnswer' value='B'> B. "+value.choices[1]+"</div>"
          quizHtml += "<div><input type='radio' name='"+quizCount+"' class='qAnswer' value='C'> C. "+value.choices[2]+"</div>"
          quizHtml += "<div><input type='radio' name='"+quizCount+"' class='qAnswer' value='D'> D. "+value.choices[3]+"</div><br/>"
        }

        if(value.type=='trueOrFalse')
        {
          quizHtml += "<div><input type='radio' name='"+quizCount+"' class='qAnswer' value='TRUE'> True </div>"
          quizHtml += "<div><input type='radio' name='"+quizCount+"' class='qAnswer' value='FALSE'> False </div><br/>"
        }

        if(value.type=='enumeration')
        {
          quizHtml += "<div><textarea name='"+quizCount+"' class='qAnswer form-control'></textarea></div><br/>"
        }

        if(value.type=="identification" || value.type=="fillInTheBlank")
        {
          quizHtml += "<div><input type='text' name='"+quizCount+"' class='qAnswer form-control'></div><br/>"
        }

        var answerColor = "text-success";
        var answerLogo = "fa-check-circle";

        if(scores[key] == "0") {
          answerColor = "text-danger";
          answerLogo = "fa-times-circle";
        }
        quizHtml += "<b class='"+answerColor+"'><i class='fa "+answerLogo+"'></i> Correct Answer: "+value.answer+"</b><br/><br/>"
      })

      $(container+" .quizContainer").append(quizHtml);

      $(".qAnswer").attr("disabled",true);

      $.each(questions, function(k,v){
        var i = k+1;
        if(v.type=='multipleChoice')
        {
          $("input[name='"+i+"'][value='"+answers[k]+"']").attr("checked", true)
        }
        if(v.type=='trueOrFalse')
        {
          $("input[name='"+i+"'][value='"+answers[k]+"']").attr("checked", true)
        }
        if(v.type=='fillInTheBlank' || v.type=='identification')
        {
          $("input[name='"+i+"']").val(answers[k])
        }
        if(v.type=='enumeration')
        {
          $("textarea[name='"+i+"']").val(answers[k])
        }
      })

      if($("#globalStudentId").val() != null){
        $(".restrictedAccess").hide();
      }
    }

    function renderQuizTest(data, container){

      $(container+" textarea[name='quizItems']").val(JSON.stringify(data));
      var quizHtml = "";
      var quizCount = 0;
      var instruction ="";
      $(container+" .quizContainer").empty();
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

        quizHtml += "<div><b>" +quizCount+".</b> "+ value.question+"<span class='small' style='color:gray'>    <i>"+instruction+"</i></span>&nbsp;&nbsp;<span class='small restrictedAccess' style='color:gray'><a href='#' class='editItem' data='"+key+"'>edit</a> | <a href='#' class='deleteItem' data='"+key+"'>delete</a></span></div><br/>"
        if(value.type=='multipleChoice')
        {
          console.log("hey")
          quizHtml += "<div><input type='radio' name='"+quizCount+"' class='qAnswer' value='A'> A. "+value.choices[0]+"</div>"
          quizHtml += "<div><input type='radio' name='"+quizCount+"' class='qAnswer' value='B'> B. "+value.choices[1]+"</div>"
          quizHtml += "<div><input type='radio' name='"+quizCount+"' class='qAnswer' value='C'> C. "+value.choices[2]+"</div>"
          quizHtml += "<div><input type='radio' name='"+quizCount+"' class='qAnswer' value='D'> D. "+value.choices[3]+"</div><br/>"
        }

        if(value.type=='trueOrFalse')
        {
          quizHtml += "<div><input type='radio' name='"+quizCount+"' class='qAnswer' value='TRUE'> True </div>"
          quizHtml += "<div><input type='radio' name='"+quizCount+"' class='qAnswer' value='FALSE'> False </div>"
        }

        if(value.type=='enumeration')
        {
          quizHtml += "<div><textarea name='"+quizCount+"' class='qAnswer form-control'></textarea></div>"
        }

        if(value.type=="identification" || value.type=="fillInTheBlank")
        {
          quizHtml += "<div><input type='text' name='"+quizCount+"' class='qAnswer form-control'></div>"
        }

        quizHtml += "<br/>"
      })

      $(container+" .quizContainer").append(quizHtml);

      if($("#globalStudentId").val() != null){
        $(".restrictedAccess").hide();
      }

      $("#answerQuizSubmit").click(function(){
        var answerList = [];
        var scoreList = [];
        $.each(questions, function(key, value){
          var quizItem = key+1;
          if(value.type == 'multipleChoice') {
            answerList.push($("input[name='"+quizItem+"']:checked").val());
            if(value.answer == $("input[name='"+quizItem+"']:checked").val()) {
              scoreList.push("1");
            }else{
              scoreList.push("0");
            }
          }
          if(value.type == 'trueOrFalse') {
            answerList.push($("input[name='"+quizItem+"']:checked").val());
            if(value.answer == $("input[name='"+quizItem+"']:checked").val()) {
              scoreList.push("1");
            }else{
              scoreList.push("0");
            }
          }
          if(value.type == 'enumeration') {
            answerList.push($("textarea[name='"+quizItem+"']").val());
            var correctAnswers = value.answer.toUpperCase().split(", ")
            var studAnswers = $("textarea[name='"+quizItem+"']").val().toUpperCase().split(", ")
            var score = "1";
            $.each(correctAnswers, function(k, v){
              if(!studAnswers.includes(v)){
                score = "0";
              }
            })

            scoreList.push(score);
          }
          if(value.type == 'fillInTheBlank' || value.type == 'identification') {
            answerList.push($("input[name='"+quizItem+"']").val());
            if(value.answer.toUpperCase().trim() == $("input[name='"+quizItem+"']").val().toUpperCase().trim()) {
              scoreList.push("1");
            }else{
              scoreList.push("0");
            }
          }
        })
        
        if(answerList.includes("") || answerList.includes(undefined)){
          $("#showCompleteQuizError").show();
        } else {
          $("#showCompleteQuizError").hide();
          $("#showCompleteQuizSuccess").show();
          $(".qAnswer").attr("disabled", true);
          $(this).attr("disabled",true);
          
          var data = {
            quizId : $("#takeQuizModal input[name='quizId']").val(),
            subjectId : $("#takeQuizModal input[name='subjectId']").val(),
            studentId : $("#takeQuizModal input[name='id']").val(),
            answers : answerList,
            scores : scoreList
          }

          submitQuiz(data)
          
        }
      })

      $(".deleteItem").click(function(){
          if($(container+" .hiddenQuestionKey").val() != "")
          {
            alert("A quiz item is being edited. Please finish it first before you can delete.")
            return
          }
        questions.splice($(this).attr('data'),1)
        renderQuizTable(questions, container);
      })

      $(".editItem").click(function(){
        var keyItem = $(this).attr('data')
        editQuestion(keyItem, container);
      })
    }

    function submitQuiz(data){
          $.ajax({
            type: "POST",
            url: "controllers/addQuizResult.php",
            data: JSON.stringify(data),
              contentType: "application/json; charset=utf-8",
              dataType: "json",
          }).done(function(s){
            
          });
    }

   	function renderQuizTable(data, container){

      $(container+" textarea[name='quizItems']").val(JSON.stringify(data));
   		var quizHtml = "";
   		var quizCount = 0;
   		var instruction ="";
   		$(container+" .quizContainer").empty();
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

   			quizHtml += "<div><b>" +quizCount+".</b> "+ value.question+"<span class='small' style='color:gray'>    <i>"+instruction+"</i></span>&nbsp;&nbsp;<span class='small restrictedAccess' style='color:gray'><a href='#' class='editItem' data='"+key+"'>edit</a> | <a href='#' class='deleteItem' data='"+key+"'>delete</a></span></div><br/>"
   			if(value.type=='multipleChoice')
   			{
   				quizHtml += "<div> A. "+value.choices[0]+"</div>"
   				quizHtml += "<div> B. "+value.choices[1]+"</div>"
   				quizHtml += "<div> C. "+value.choices[2]+"</div>"
   				quizHtml += "<div> D. "+value.choices[3]+"</div><br/>"
   			}
   			quizHtml += "<div><b>Answer: " +value.answer+"</b></div><br/>"
   		})

   		$(container+" .quizContainer").append(quizHtml);

      if($("#globalStudentId").val() != null){
        $(".restrictedAccess").hide();
      }

   		$(".deleteItem").click(function(){
     			if($(container+" .hiddenQuestionKey").val() != "")
     			{
     				alert("A quiz item is being edited. Please finish it first before you can delete.")
     				return
     			}
  			questions.splice($(this).attr('data'),1)
  			renderQuizTable(questions, container);
		  })

  		$(".editItem").click(function(){
  			var keyItem = $(this).attr('data')
  			editQuestion(keyItem, container);
  		})
   	}

   	function editQuestion(key, container)
   	{
   		var type = questions[key].type;
   		var answer = questions[key].answer;
  		changeQuestionType(type);
  		$(container+" select[name='questionType']").val(type);
  		$(container+" textarea[name='question']").val(questions[key].question);

  		if(type == 'multipleChoice'){
  			$(container+" input[name='multipleChoiceA']").val(questions[key].choices[0]);
      	$(container+" input[name='multipleChoiceB']").val(questions[key].choices[1]);
      	$(container+" input[name='multipleChoiceC']").val(questions[key].choices[2]);
      	$(container+" input[name='multipleChoiceD']").val(questions[key].choices[3]);
      	$(container+" .answerTypeMultipleChoice input[value='"+answer+"']").prop("checked",true);
  		} else if (type == 'identification' || type == 'fillInTheBlank'){
  			$(container+" .answerTypeText input").val(answer);
  		} else if (type == 'trueOrFalse'){
  			$(container+" .answerTypeTrueOrFalse input[value='"+answer+"']").prop("checked",true);
  		} else if (type == 'enumeration'){
  			$(container+" .answerTypeEnumeration textarea").val(answer);
  		}

  		$(container+" .hiddenQuestionKey").val(key);
  		$(container+" .addQuestionSubmit").text("Update Question");

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
      localStorage.setItem("topMenu","#subjects");
   	});

   	$("#studentMenu").click(function(){
   		$("#subjectMenuContent").hide();
   		$("#studentMenuContent").show();
      localStorage.setItem("topMenu","#students");
   	});



    if(localStorage.getItem("topSubmenu") == '#quiz'){
      $("#quizToggleView").click();
      $("#quizToggleView .subject-activity").click();
    }else if(localStorage.getItem("topSubmenu") == '#activity'){
      $("#activityToggleView").click();
      $("#activityToggleView .subject-activity").click();
    }else if(localStorage.getItem("topSubmenu") == '#quizResults'){
      $("#quizzesResultToggleView").click();
      $("#quizzesResultToggleView .subject-activity").click();
    }

    if(localStorage.getItem("topMenu") == '#students'){
      $("#studentMenu").click();
    }

    $("#editSubject").click(function(){
      var currentSubject = $("#subjectNavList li .active").text();
      $("#editSubjectModal input[name='subjectName']").val(currentSubject);
    })

    $("input[name='oldPassword']").keyup(function(){
        if($(this).val() != $("#globalPasswordId").val()){
          $("#showErrorChangePassword").text("Wrong Password!");
          $("#showErrorChangePassword").show();
          $("#changePasswordSubmit").attr("disabled",true);
        } else {
          $("#showErrorChangePassword").hide();
          $("#showErrorChangePassword").text("OK");
          $("#changePasswordSubmit").attr("disabled",false);
        }
    })

    $("input[name='confirmPassword']").keyup(function(){
        if($(this).val() != $("input[name='newPassword']").val()){
          $("#showErrorChangePassword").text("Password didn't match");
          $("#showErrorChangePassword").show();
          $("#changePasswordSubmit").attr("disabled",true);
        } else {
          $("#showErrorChangePassword").hide();
          $("#changePasswordSubmit").attr("disabled",false);
        }
    })
} );