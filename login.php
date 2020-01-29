<?php
	include "components/header.php"
?>
<link href="assets/css/login.css" rel="stylesheet">
<div class="sidenav">
     <div class="login-main-text">
        <h2>Interactive Computer<br> Controlled Instruction Material</h2>
        
     </div>
  </div>
  <div class="main">
     <div class="col-md-6 col-sm-12">
        <div class="login-form">
           
              <div class="form-group">
                 <label>User Name</label>
                 <input type="text" class="form-control" placeholder="User Name" id="username">
              </div>
              <div class="form-group">
                 <label>Password</label>
                 <input type="password" class="form-control" placeholder="Password" id="password">
              </div>
              <button class="btn btn-yellow-green" id="loginBtn">Login</button>
              <button class="btn btn-secondary">Sign Up</button>
           
        </div>
     </div>
  </div>

<?php
	include "components/footer.php"
?>
<script src="assets/js/login.js"></script>