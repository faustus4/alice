<?php
	include "components/header.php"
?>
<div id="loginPage">
  <div class="main">
    <br/><br/>
    <div class="row">
      <div class="col-md-4 col-sm-12"></div>
        <div class="col-md-4 col-sm-12" id="loginSheet">
        
        <div class="login-form">

          <h2 style="text-align: center">Interactive Computer<br> Controlled Instruction Material</h2><br/><br/>
           <div class="alert alert-warning" role="alert" id="showErrorLogin" style="display:none;">
              Username and password didn't match.
            </div><br>
              <div class="form-group">
                 <label>User Name</label>
                 <input type="text" class="form-control" placeholder="User Name" id="username">
              </div>
              <div class="form-group">
                 <label>Password</label>
                 <input type="password" class="form-control" placeholder="Password" id="password">
              </div>
              <button class="btn btn-yellow-green" id="loginBtn">Login</button>
           
           
        </div>
     </div>
     <div class="col-md-4 col-sm-12"></div>

    </div>
     
  </div>

</div>

<?php
	include "components/footer.php"
?>
<script src="assets/js/login.js"></script>