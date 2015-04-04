<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="../css/styles.css">
  
  <script src="../js/jquery.js"></script>
  <script src="../js/jqueryui.js"></script>
  <script>
  $(function() {
    $( "#accordion" ).accordion();
  });
  
  function checkIfLoginValid() {
			var form = document.login_form;
			if(form.user_name.value == "" ) {
				alert("Please enter a username");
				return false;
			}
			else if(form.password.value == ""){
				alert("Please enter a password");
				return false;				
			}
			else {
				return true;
			}
		}	

		function checkIfSignUpValid(){
			var form = document.registration_form;
			if(form.user_name.value == "" || form.email.value == "" || form.password.value == "" )
			{
				alert("Please Ensure All Fields Are Filled In Correctly");
				return false;
			}
			else if (!validateEmail(form.email.value))
			{
				alert("Please enter a valid email ID");
				return false;
			}
			else if (form.password.value != form.confirm_password.value)
			{
				alert("The passwords don't match");
				return false;
			}
			else{
				//submit form
				return true;
			}
		}
		
		function validateEmail(email) { 
			var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return re.test(email);
		}
  </script>
</head>
<body>

<div id="accordion">
  <h3>Login</h3>
  <div>
	<form action="login.php" method="POST" name="login_form">
		<input type="text" id="login-name" name="user_name" placeholder="Username" class="inputbox"/>
		<input type="password" id="login-password" name="password" placeholder="Password" class="inputbox"/>
		<input type="submit" class="submit-button" value="Login" onclick = "return checkIfLoginValid();"/>
	</form>
  </div>
  <h3>Register</h3>
  <div>
    <form action="signup.php" method="POST" name="registration_form">
		<input type="text" id="full-name"  name="full_name" placeholder="Full Name" class="inputbox"/>
		<input type="text" id="signup-name" name="user_name" placeholder="Username" class="inputbox"/>
		<input type="text" id="email" name="email" placeholder="E-mail" class="inputbox"/>
		<input type="password" id="signup-password" name="password" placeholder="Password" class="inputbox"/>
		<input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm Password" class="inputbox"/>
		<input type="submit" class="submit-button" value="Register" onclick="return checkIfSignUpValid();"/>
	</form>
  </div>
	<h3>Rank List</h3>
		<div>
		<div class="data-container">
			<table>
			<?php
				$con = mysqli_connect("localhost","root","","sample");
				$fetch_data_query = "SELECT full_name,grade FROM user,exam_result,grade WHERE exam_result.exam_start =1 AND user.user_id = exam_result.user_id AND exam_result.marks = grade.marks ORDER BY grade";
				$result = mysqli_query($con,$fetch_data_query);
				while($row = mysqli_fetch_array($result)) {
				?>
				<tr>
					<td width =60%><?php echo $row['full_name']; ?> :</td>
					<td width =40%><?php echo $row['grade']; ?></td>
				</tr>
				<?php
				}
				?>
			</table>	
		</div>
		</div>
</div>
 
</body>
</html>