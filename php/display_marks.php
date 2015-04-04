<?php session_start();
	$con = mysqli_connect("localhost","root","","sample");
?>

<head>
	<title>Result</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/styles.css">
	<script src="../js/jquery.js"></script>
	<script src="../js/jqueryui.js"></script>
	<script>
		$(function() {
			$( "#accordion" ).accordion();
		  });
		  
		function logout() {
			window.location = 'logout.php';
			return true;
		}
    </script>
</head>
<body >	
<?php
	$fetch_data_query = "SELECT full_name,email FROM user WHERE user_id =" . $_SESSION['userid'];
	$result = mysqli_query($con,$fetch_data_query);
	$row = mysqli_fetch_row($result);
	$fetch_marks_query = "SELECT marks FROM exam_result WHERE user_id =" . $_SESSION['userid'];
	$marks_result = mysqli_query($con,$fetch_marks_query);
	$marks_row = mysqli_fetch_row($marks_result);
	$get_grade_query = "SELECT grade FROM grade WHERE marks =" . $marks_row[0];
	$grade_result = mysqli_query($con,$get_grade_query);
	$grade_row = mysqli_fetch_row($grade_result);
?>
	<div id="accordion">
		<h3>Result</h3>
		<div>
		<div class="data-container">
			<table>
				<tr>
					<td>Name :</td>
					<td><?php echo $row[0]; ?></td>
				</tr>
				<tr>
					<td>E-mail :</td>
					<td><?php echo $row[1]; ?></td>
				</tr>
				<tr>
					<td>Marks :</td>
					<td><?php echo $marks_row[0]; ?></td>
				</tr>
				<tr>
					<td>Grade :</td>
					<td><?php echo $grade_row[0]; ?></td>
				</tr>
			</table>	
			<button class="submit-button" onclick="return logout();">Logout</button></td>
		</div>
		</div>
	</div>
</body>