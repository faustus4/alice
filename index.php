<?php
session_start();
if(!isset($_SESSION['authorized'])){ //if login in session is not set
    header("Location: login.php");
}

include 'components/header.php';
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
            <li class="nav-item" id="studentMenu">
              <a class="nav-link" href="#"><i class="fa fa-book-reader"></i> Students</a>
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
          <ul class="nav nav-pills flex-column" id="subjectNavList">
            <li class="nav-item">
              <a class="nav-link active" href="#">Home Economics</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">ICT</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Industrial Arts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">AFA</a>
            </li>
          </ul>

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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addLessonModal">
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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addQuizModal">
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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addActivityModal">
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
                <tr>
                      <td>1</td>
                      <td>Sewing Activity #1</td>
                      <td>The art of sewing</td>
                      <td>January 23, 2020</td>
                      <td>
                        
                         <a href="assets/js/ViewerJS/#../../../lessons/test.otp" target="_blank"><button class="btn btn-success"><i class="fa fa-eye"></i> View</button></a>
                        <button class="btn btn-info"><i class="fa fa-edit"></i> Edit</button>
                      </td>

                  </tr>
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
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                <tr>
                      <td>1</td>
                      <td>Quiz #1</td>
                      <td>
                        
                         <a href="assets/js/ViewerJS/#../../../lessons/test.otp" target="_blank"><button class="btn btn-success"><i class="fa fa-eye"></i> View</button></a>
                        <button class="btn btn-info"><i class="fa fa-edit"></i> Edit</button>
                      </td>

                  </tr>
              </tbody>
            </table>
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
                <form action="controllers/upload.php" method ="POST" enctype="multipart/form-data">
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

                        <div id="quizContainer">
                        </div>
                        <br/>
                        <label>Question Type: </label>
                        <input type="hidden" id="hiddenQuestionKey" >
                        <select class="form-control" id="questionType">
                          <option value="multipleChoice">Multiple Choice</option>
                          <option value="fillInTheBlank">Fill In The Blank</option>
                          <option value="enumeration">Enumeration</option>
                          <option value="trueOrFalse">True or False</option>
                          <option value="identification">Identification</option>
                        </select>
                        <br>
                        <div class="form-group">
                          <label>Question: </label>
                          <textarea class="form-control" id="question"></textarea>
                        </div>

                        <!--Multiple choices-->
                        <div id="multipleChoiceInput">
                          <div class="row">
                            <div class="form-group col-md-6">
                              <label>A: </label>
                              <input type="text" class="form-control" id="multipleChoiceA" />
                            </div>
                            <div class="form-group col-md-6">
                              <label>B: </label>
                              <input type="text" class="form-control" id="multipleChoiceB" />
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-6">
                              <label>C: </label>
                              <input type="text" class="form-control" id="multipleChoiceC" />
                            </div>
                            <div class="form-group col-md-6">
                              <label>D: </label>
                              <input type="text" class="form-control" id="multipleChoiceD" />
                            </div>
                          </div>  
                        </div>
                        

                        <div class="form-group">
                          <label>Answer: </label>
                          <div id="answerTypeText">
                            <input type="text" class="form-control" />  
                          </div>
                          <div id="answerTypeTrueOrFalse">

                            <input type="radio" name="trueOrFalse" value="TRUE">
                            <label>True&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

                            <input type="radio" name="trueOrFalse" value="FALSE">
                            <label>False&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>  
                          </div>
                          <div id="answerTypeMultipleChoice">

                            <input type="radio" name="multipleChoice" value="A">
                            <label>A&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

                            <input type="radio" name="multipleChoice" value="B">
                            <label>B&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

                            <input type="radio" name="multipleChoice" value="C">
                            <label>C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>  

                            <input type="radio" name="multipleChoice" value="D">
                            <label>D&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>    
                          </div>
                          <div id="answerTypeEnumeration">
                            <textarea class="form-control"></textarea>
                          </div>
                        </div>
                        <div>
                          
                        </div>
                        <button type="button" id="addQuestionSubmit">Add Question</button>

                        
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
              <tr>
                    <td>234234234</td>
                    <td>Erwin</td>
                    <td>Lirazan</td>
                    <td>Daza</td>
                    <td>SOC1</td>
                    <td>abcdefg</td>
                    <td>2010</td>
                    <td>
                      <button class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</button>
                    </td>

                </tr>
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
                    <input type="text" class="form-control" id="studentId" name="studentId"/>
                  </div>
                  <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName"/>
                  </div>
                  <div class="form-group">
                    <label for="middleName">Middle Name</label>
                    <input type="text" class="form-control" id="middleName" name="middleName"/>
                  </div>
                  <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName"/>
                  </div>
                  <div class="form-group">
                    <label for="studentSection">Section</label>
                    <input type="text" class="form-control" id="studentSection" name="studentSection"/>
                  </div>
                  <div class="form-group">
                    <label for="schoolYear">School Year</label>
                    <input type="text" class="form-control" id="schoolYear" name="schoolYear"/>
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