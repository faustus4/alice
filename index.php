<?php
include 'components/header.php';

session_start();
if(!isset($_SESSION['authorized'])){ //if login in session is not set
    header("Location: login.php");
} else {
  echo("<input type='hidden' id='globalPasswordId' value=".$_SESSION["password"].">");
}

if(isset($_SESSION["studentId"])){
  echo("<input type='hidden' id='globalStudentId' value=".$_SESSION["studentId"].">");
}
?>
<link href="assets/css/main.css" rel="stylesheet">
  <body>
    <header>
      <nav class="navbar navbar-expand-md fixed-top top-bar">
        <a class="navbar-brand" href="#">TLE ICCM</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto" id="topBarMenu">
            <li class="nav-item active" id="subjectMenu">
              <a class="nav-link" href="#"><i class="fa fa-book"></i> Subjects</a>
            </li>
            <li class="nav-item restrictedAccess" id="studentMenu">
              <a class="nav-link" href="#"><i class="fa fa-book-reader"></i> Students</a>
            </li>
          </ul>
          
        </div>
        <div class="text-white" id="changePasswordBtn" style="cursor: pointer">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item" data-toggle="modal" data-target="#changePasswordModal">
              <a class="nav-link"><i class="fa fa-key"></i> Change Password</a>
            </li>
          </ul>
        </div>
        <div class="text-white" id="logoutBtn">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="controllers/logout.php"><i class="fa fa-power-off"></i> Logout</a>
            </li>
          </ul>
        </div>
        
      </nav>
    </header>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar" id="subjectList">
          <?php
              if(isset($_SESSION["fname"])){
                echo('<h5>Welcome <span id="studentFirstName">'.$_SESSION["fname"].'</span>!</h5><br/><br/>');
              }
          ?>
          
          <label>Learning Area</label>
          <select class="form-control" id="learningAreaSelect">
            <option value='0' disabled selected>----</option>
            <option value='1'>Home Economics</option>
            <option value='2'>ICT</option>
            <option value='3'>Industrial Arts</option>
            <option value='4'>AFA</option>
          </select>
          <br/>
          <ul class="nav nav-pills flex-column" id="subjectNavList">
            
          </ul>
          <br/>
          
          <div class="restrictedAccess">
            <a class="text-sm" data-toggle="modal" data-target="#addSubjectModal">
              <i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Tooltip on top"></i>
            </a>&nbsp;
            <a class="text-sm" data-toggle="modal" data-target="#editSubjectModal" id="editSubject">
              <i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Tooltip on top"></i>
            </a>&nbsp;
            <a class="text-sm" data-toggle="modal" data-target="#deleteSubjectModal" id="deleteSubject">
              <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Tooltip on top"></i>
            </a>
          </div>
          

        </nav>

        <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3" id="subjectMenuContent">
          <h1>Dashboard</h1>
          <section class="row text-center placeholders subject-activities">
            <div class="col-6 col-sm-3 placeholder" id="lessonToggleView">
              <div class="subject-activity sub-active">
                <img src="assets/images/lessons.jpg" class="img-fluid" alt="Generic placeholder thumbnail">
                <h4>Lessons</h4>
              </div>
            </div>
            <div class="col-6 col-sm-3 placeholder" id="quizToggleView">
              <div class="subject-activity">
                <img src="assets/images/quiz2.jpg" class="img-fluid" alt="Generic placeholder thumbnail">
                <h4>Quizzes</h4>
              </div>
            </div>
            <div class="col-6 col-sm-3 placeholder" id="activityToggleView">
              <div class="subject-activity">
                <img src="assets/images/activities2.jpg" class="img-fluid" alt="Generic placeholder thumbnail">
                <h4>Activities</h4>
              </div>
            </div>
            <div class="col-6 col-sm-3 placeholder" id="quizzesResultToggleView">
              <div class="subject-activity">
                <img src="assets/images/results.jpg" class="img-fluid" alt="Generic placeholder thumbnail">
                <h4>QuizResults</h4>
              </div>
            </div>
          </section>
          <br/><br/>

          <div id="lessonSection">
            <button type="button" class="btn btn-primary addButton restrictedAccess" data-toggle="modal" data-target="#addLessonModal" disabled>
              <i class="fa fa-plus"></i> Add Lesson
            </button>
            <br/><br/>
            <table id="lessonListTable" class="table" style="width:100%">
              <thead>
                  <tr>
                      <th>Lesson ID</th>
                      <th>Lesson Name</th>
                      <th>Description</th>
                      <th>Updated</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>

          <div id="quizzesSection">
            <button type="button" class="btn btn-primary restrictedAccess" data-toggle="modal" data-target="#addQuizModal">
              <i class="fa fa-plus"></i> Add Quiz
            </button>
            <br/><br/>
            <table id="quizListTable" class="table" style="width:100%">
              <thead>
                  <tr>
                      <th>Quiz ID</th>
                      <th>Quiz Lesson Name</th>
                      <th>Date Updated</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>

          <div id="activitiesSection">
            <button type="button" class="btn btn-primary restrictedAccess" data-toggle="modal" data-target="#addActivityModal">
              <i class="fa fa-plus"></i> Add Activity
            </button>
            <br/><br/>
            <table id="activityListTable" class="table" style="width:100%">
              <thead>
                  <tr>
                      <th>Activity ID</th>
                      <th>Activity Name</th>
                      <th>Description</th>
                      <th>Date Updated</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
               
              </tbody>
            </table>
          </div>

          <div id="quizzesResultSection">
            <h3>Quiz Results</h3>
            <br/><br/>
            <table id="quizResultListTable" class="table" style="width:100%">
              <thead>
                  <tr>
                      <th>Quiz ID</th>
                      <th>Quiz Name</th>
                      <th>Student Name</th>
                      <th># Items</th>
                      <th># Correct Answers</th>
                      <th>Date Taken</th>
                      <th>Section</th>
                      <th>School Year</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>
        

          <!--Add Subject Modal-->
          <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content modal-lg">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="controllers/changePassword.php" method ="POST" enctype="multipart/form-data">
               
                <div class="modal-body">
                  <div class="alert alert-warning" role="alert" id="showErrorChangePassword" style="display:none;">
                    
                  </div><br>
                  <div class="form-group">
                    <label for="subjectName">Old Password</label>
                    <input type="password" class="form-control" name="oldPassword" required="" />
                  </div>
                  <div class="form-group">
                    <label for="subjectName">New Password</label>
                    <input type="password" class="form-control" name="newPassword" required="" />
                  </div>
                  <div class="form-group">
                    <label for="subjectName">Confirm Password</label>
                    <input type="password" class="form-control" name="confirmPassword" required="" />
                  </div>
                </div>
            
        
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" id="changePasswordSubmit" disabled="">Submit</button>
                </div>
                </form>
              </div>
            </div>
          </div>

          <!--Add Subject Modal-->
          <div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content modal-lg">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Subject</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="controllers/addSubject.php" method ="POST" enctype="multipart/form-data">
                <input type="hidden" name="learningAreaId"/>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="subjectName">Subject Name</label>
                    <input type="text" class="form-control" name="subjectName"/>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
              </div>
            </div>
          </div>

          <!--Edit Subject Modal-->
          <div class="modal fade" id="editSubjectModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content modal-lg">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Subject</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="controllers/updateSubject.php" method ="POST" enctype="multipart/form-data">
                <input type="hidden" name="subjectId"/>
                <input type="hidden" name="learningAreaId"/>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="subjectName">Subject Name</label>
                    <input type="text" class="form-control" name="subjectName"/>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
              </div>
            </div>
          </div>


          <!--Add Lesson Modal -->
          <div class="modal fade" id="addLessonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content modal-lg">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Upload Lesson</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="controllers/upload.php" method ="POST" enctype="multipart/form-data">
                <input type="hidden" name="subjectId"/>
                <div class="modal-body">
                      <div class="form-group">
                        <label for="lessonName">Lesson Name</label>
                        <input type="text" class="form-control" id="lessonName" name="lessonName"/>
                      </div>
                      <div class="form-group">
                        <label for="lessonName">Description</label>
                        <input type="text" class="form-control" id="lessonDescription" name="lessonDescription"/>
                      </div>
                      <div class="form-group">
                        <label for="lessonFile">Lesson File</label>
                        <input type="file" class="form-control" name="lessonFile"/>
                        <small class="form-text text-muted">please upload PDF and ODF file only</small>
                      </div>
                      
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
              </div>
            </div>
          </div>

          <!--Update Lesson Modal -->
          <div class="modal fade" id="updateLessonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content modal-lg">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Update Lesson</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="controllers/updateLesson.php" method ="POST" enctype="multipart/form-data">
                  <input type = "hidden" name="lessonId" />
                <div class="modal-body">
                      <div class="form-group">
                        <label for="lessonName">Lesson Name</label>
                        <input type="text" class="form-control" name="lessonName"/>
                      </div>
                      <div class="form-group">
                        <label for="lessonName">Description</label>
                        <input type="text" class="form-control" name="lessonDescription"/>
                      </div>
                      <div class="form-group">
                        <label for="lessonFile">Lesson File</label>
                        <input type="file" class="form-control" name="lessonFile"/>
                        <small class="form-text text-muted">Leave blank if you don't want to change the existing file. Please upload PDF and ODF file only.</small>
                      </div>
                      
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
              </div>
            </div>
          </div>

          <!--Add Activity Modal -->
          <div class="modal fade" id="addActivityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content modal-lg">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Upload Activity</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="controllers/addActivity.php" method ="POST" enctype="multipart/form-data">
                <div class="modal-body">
                      <div class="form-group">
                        <label for="activityName">Activity Name</label>
                        <input type="text" class="form-control" id="activityName" name="activityName"/>
                      </div>
                      <div class="form-group">
                        <label for="activityDescription">Description</label>
                        <input type="text" class="form-control" id="activityDescription" name="activityDescription"/>
                      </div>
                      <div class="form-group">
                        <label for="activityFile">Activity File</label>
                        <input type="file" class="form-control" name="activityFile" accept="application/pdf, application/ODF"/>
                        <small class="form-text text-muted">please upload PDF and ODF file only</small>
                      </div>
                      
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
              </div>
            </div>
          </div>

          <!--Update Activity Modal -->
          <div class="modal fade" id="updateActivityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content modal-lg">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Update Activity</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="controllers/updateActivity.php" method ="POST" enctype="multipart/form-data">
                  <input type = "hidden" name="activityId" />
                  <input type="hidden" name="subjectId"/>
                <div class="modal-body">
                      <div class="form-group">
                        <label for="lessonName">Activity Name</label>
                        <input type="text" class="form-control" name="activityName"/>
                      </div>
                      <div class="form-group">
                        <label for="lessonName">Description</label>
                        <input type="text" class="form-control" name="activityDescription"/>
                      </div>
                      <div class="form-group">
                        <label for="lessonFile">Lesson File</label>
                        <input type="file" class="form-control" name="activityFile"/>
                        <small class="form-text text-muted">Leave blank if you don't want to change the existing file. Please upload PDF and ODF file only.</small>
                      </div>
                      
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
              </div>
            </div>
          </div>

          <!--Add Quiz Modal -->
          <div class="modal fade large-modal" id="addQuizModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Create Quiz</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="controllers/addQuiz.php" method ="POST" enctype="multipart/form-data">
                <textarea style="display:none;" name="quizItems"></textarea>
                <input type="hidden" style="display:none;" name="subjectId"></textarea>
                <div class="modal-body">
                      <div class="form-group">
                        <label for="activityName">Quiz Name</label>
                        <input type="text" class="form-control" name="quizName"/>
                      </div>
                      <div>
                        <h5>Quiz Items</h5>

                        <div class="quizContainer">
                        </div>
                        <br/>
                        <label>Question Type: </label>
                        <input type="hidden" class="hiddenQuestionKey" >
                        <select class="form-control" id="questionType" name="questionType">
                          <option value="multipleChoice">Multiple Choice</option>
                          <option value="fillInTheBlank">Fill In The Blank</option>
                          <option value="enumeration">Enumeration</option>
                          <option value="trueOrFalse">True or False</option>
                          <option value="identification">Identification</option>
                        </select>
                        <br>
                        <div class="form-group">
                          <label>Question: </label>
                          <textarea class="form-control" id="question" name="question"></textarea>
                        </div>

                        <!--Multiple choices-->
                        <div class="multipleChoiceInput">
                          <div class="row">
                            <div class="form-group col-md-6">
                              <label>A: </label>
                              <input type="text" class="form-control"  name="multipleChoiceA" />
                            </div>
                            <div class="form-group col-md-6">
                              <label>B: </label>
                              <input type="text" class="form-control"  name="multipleChoiceB"/>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-6">
                              <label>C: </label>
                              <input type="text" class="form-control"  name="multipleChoiceC"/>
                            </div>
                            <div class="form-group col-md-6">
                              <label>D: </label>
                              <input type="text" class="form-control"  name="multipleChoiceD"/>
                            </div>
                          </div>  
                        </div>
                        

                        <div class="form-group">
                          <label>Answer: </label>
                          <div class="answerTypeText">
                            <input type="text" class="form-control" />  
                          </div>
                          <div class="answerTypeTrueOrFalse">

                            <input type="radio" name="trueOrFalse" value="TRUE">
                            <label>True&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

                            <input type="radio" name="trueOrFalse" value="FALSE">
                            <label>False&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>  
                          </div>
                          <div class="answerTypeMultipleChoice">

                            <input type="radio" name="multipleChoice" value="A">
                            <label>A&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

                            <input type="radio" name="multipleChoice" value="B">
                            <label>B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

                            <input type="radio" name="multipleChoice" value="C">
                            <label>C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>  

                            <input type="radio" name="multipleChoice" value="D">
                            <label>D&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>    
                          </div>
                          <div class="answerTypeEnumeration">
                            <textarea class="form-control"></textarea>
                          </div>
                        </div>
                        <div>
                          
                        </div>
                        <button type="button" class="addQuestionSubmit">Add Question</button>

                        
                        <!--Fill In the blank-->
                        <!--True of False-->
                        <!--Inumeration-->
                      </div>
                      
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
              </div>
            </div>
          </div>

          <!--Update Quiz Modal -->
          <div class="modal fade large-modal" id="updateQuizModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Update Quiz</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="controllers/updateQuiz.php" method ="POST" enctype="multipart/form-data">
                <textarea style="display:none;" name="quizItems"></textarea>
                <input type="hidden" style="display:none;" name="subjectId"></textarea>
                <input type="hidden" style="display:none;" name="quizId"></textarea>
                <div class="modal-body">
                      <div class="form-group">
                        <label for="activityName">Quiz Name</label>
                        <input type="text" class="form-control" name="quizName"/>
                      </div>
                      <div>
                        <h5>Quiz Items</h5>

                        <div class="quizContainer">
                        </div>
                        <br/>
                        <label>Question Type: </label>
                        <input type="hidden" class="hiddenQuestionKey" >
                        <select class="form-control" name="questionType">
                          <option value="multipleChoice">Multiple Choice</option>
                          <option value="fillInTheBlank">Fill In The Blank</option>
                          <option value="enumeration">Enumeration</option>
                          <option value="trueOrFalse">True or False</option>
                          <option value="identification">Identification</option>
                        </select>
                        <br>
                        <div class="form-group">
                          <label>Question: </label>
                          <textarea class="form-control" name="question"></textarea>
                        </div>

                        <!--Multiple choices-->
                        <div class="multipleChoiceInput">
                          <div class="row">
                            <div class="form-group col-md-6">
                              <label>A: </label>
                              <input type="text" class="form-control"   name="multipleChoiceA"/>
                            </div>
                            <div class="form-group col-md-6">
                              <label>B: </label>
                              <input type="text" class="form-control" name="multipleChoiceB"/>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-6">
                              <label>C: </label>
                              <input type="text" class="form-control"  name="multipleChoiceC"/>
                            </div>
                            <div class="form-group col-md-6">
                              <label>D: </label>
                              <input type="text" class="form-control"  name="multipleChoiceD"/>
                            </div>
                          </div>  
                        </div>
                        

                        <div class="form-group">
                          <label>Answer: </label>
                          <div class="answerTypeText">
                            <input type="text" class="form-control" />  
                          </div>
                          <div class="answerTypeTrueOrFalse">

                            <input type="radio" name="trueOrFalse" value="TRUE">
                            <label>True&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

                            <input type="radio" name="trueOrFalse" value="FALSE">
                            <label>False&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>  
                          </div>
                          <div class="answerTypeMultipleChoice">

                            <input type="radio" name="multipleChoice" value="A">
                            <label>A&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

                            <input type="radio" name="multipleChoice" value="B">
                            <label>B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

                            <input type="radio" name="multipleChoice" value="C">
                            <label>C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>  

                            <input type="radio" name="multipleChoice" value="D">
                            <label>D&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>    
                          </div>
                          <div class="answerTypeEnumeration">
                            <textarea class="form-control"></textarea>
                          </div>
                        </div>
                        <div>
                          
                        </div>
                        <button type="button" class="addQuestionSubmit">Add Question</button>

                        
                        <!--Fill In the blank-->
                        <!--True of False-->
                        <!--Inumeration-->
                      </div>
                      
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
              </div>
            </div>
          </div>

          <!--Answer Quiz Modal -->
          <div class="modal fade large-modal" id="takeQuizModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                 <h3 id="quizTitleName"></h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="controllers/submitQuiz.php" method ="POST" enctype="multipart/form-data" onsubmit="event.preventDefault();">
                <textarea style="display:none;" name="quizItems"></textarea>
                <input type="hidden" style="display:none;" name="subjectId"></textarea>
                <input type="hidden" style="display:none;" name="quizId"></textarea>
                <input type="hidden" name="id"/>
                <div class="modal-body">
                      <div class="alert alert-warning" role="alert" id="showCompleteQuizError" style="display:none;">
                        Please complete the quiz!
                      </div>
                      <div class="alert alert-success" role="alert" id="showCompleteQuizSuccess" style="display:none;">
                        Quiz successfully submitted, see your score on Quiz Result Page!
                      </div>
                      <div>
                        <h5>Quiz Items</h5>

                        <div class="quizContainer">
                        </div>
                        <br/>
                        <!--Fill In the blank-->
                        <!--True of False-->
                        <!--Inumeration-->
                      </div>
                      
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" id="answerQuizSubmit">Submit</button>
                </div>
                </form>
              </div>
            </div>
          </div>
        </main>

        <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3" id="studentMenuContent" style="display: none;">
          <h1>Dashboard</h1>
          
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal">
            <i class="fa fa-plus"></i> Add Student
          </button>
          <br><br>
          <table id="studentListTable" class="table" style="width:100%">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Section</th>
                    <th>Default Password</th>
                    <th>Shool Year</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
          </table>

          <!--Add Student Modal -->
          <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content modal-lg">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="controllers/addStudent.php" method ="POST" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="studentId">Student ID</label>
                    <input type="text" class="form-control" id="studentId" name="studentId" required="" />
                  </div>
                  <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="fname" required=""/>
                  </div>
                  <div class="form-group">
                    <label for="middleName">Middle Name</label>
                    <input type="text" class="form-control" id="middleName" name="mname" required=""/>
                  </div>
                  <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lname" required=""/>
                  </div>
                  <div class="form-group">
                    <label for="studentSection">Section</label>
                    <input type="text" class="form-control" id="studentSection" name="section" required=""/>
                  </div>
                  <div class="form-group">
                    <label for="schoolYear">School Year</label>
                    <input type="text" class="form-control" id="schoolYear" name="schoolYear" required=""/>
                  </div>  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
              </div>
            </div>
          </div>

          <!--Update Student Modal -->
          <div class="modal fade" id="updateStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content modal-lg">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="controllers/updateStudent.php" method ="POST" enctype="multipart/form-data">
                  <input type="hidden" name="id"/>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="studentId">Student ID</label>
                    <input type="text" class="form-control" name="studentId"/>
                  </div>
                  <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" name="fname"/>
                  </div>
                  <div class="form-group">
                    <label for="middleName">Middle Name</label>
                    <input type="text" class="form-control" name="mname"/>
                  </div>
                  <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" name="lname"/>
                  </div>
                  <div class="form-group">
                    <label for="studentSection">Section</label>
                    <input type="text" class="form-control" name="section"/>
                  </div>
                  <div class="form-group">
                    <label for="schoolYear">School Year</label>
                    <input type="text" class="form-control" name="schoolYear"/>
                  </div>  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
              </div>
            </div>
          </div>
        </main>

        <div class="col-sm-9">

        </div>
      </div>
    </div>


<?php
include "components/footer.php";
?>