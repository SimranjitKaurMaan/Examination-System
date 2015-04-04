<?php require 'session_check.php'; ?>
<html class="exam">
<head>
<title>Exam</title>
<meta charset="utf-8">
  <link rel="stylesheet" href="../css/styles.css">
  <script src="../js/jquery.js"></script>
  <script src="../js/jqueryui.js"></script>
  <script src="../js/flipclock.js"></script>
<script>
$(function() {
    $( "#accordion" ).accordion();
  });
  </script>
 </head>
<body>
<div class="clock" style="margin:2em;"></div>
	<div class="message"></div>

	<script type="text/javascript">
		var clock;
		
		$(document).ready(function() {
			var clock;

			clock = $('.clock').FlipClock({
		        clockFace: 'MinuteCounter',
		        autoStart: false,
		        callbacks: {
		        	stop: function() {
						document.questions_form.submit();
		        	}
		        }
		    });
				    
		    clock.setTime(60);
		    clock.setCountdown(true);
		    clock.start();

		});
	</script>	
	<form action="calculate_marks.php" method="POST" name="questions_form">
		<div id="accordion">
		<?php
		$con = mysqli_connect("localhost","root","","sample");
		$exam_start_query = "UPDATE exam_result SET exam_start = 1 WHERE user_id =" . $_SESSION['userid'];
		mysqli_query($con,$exam_start_query);
		$_SESSION['exam_taken'] = "true";
		$Query="SELECT question_no,question,option1,option2,option3,option4 FROM exam ";
		$result=mysqli_query($con,$Query);

		while($row = mysqli_fetch_array($result))
		{	$row['question_no']
			?>
			<h3>Question<?php echo $row['question_no']; ?></h3>
			<div>
				<table>
					<tr><td><?php echo $row['question']; ?></td></tr>
					<tr><td><input type="radio" name="<?php echo $row['question_no']; ?>" value="1" id="radio1-<?php echo $row['question_no']; ?>" class="css-checkbox" /><label for="radio1-<?php echo $row['question_no']; ?>" class="css-label radGroup2"><?php echo $row['option1']; ?></label></tr></td>
					<tr><td><input type="radio" name="<?php echo $row['question_no']; ?>" value="2" id="radio2-<?php echo $row['question_no']; ?>" class="css-checkbox" /><label for="radio2-<?php echo $row['question_no']; ?>" class="css-label radGroup2"><?php echo $row['option2']; ?></label></tr></td>
					<tr><td><input type="radio" name="<?php echo $row['question_no']; ?>" value="3" id="radio3-<?php echo $row['question_no']; ?>" class="css-checkbox" /><label for="radio3-<?php echo $row['question_no']; ?>" class="css-label radGroup2"><?php echo $row['option3']; ?></label></tr></td>
					<tr><td><input type="radio" name="<?php echo $row['question_no']; ?>" value="4" id="radio4-<?php echo $row['question_no']; ?>" class="css-checkbox" /><label for="radio4-<?php echo $row['question_no']; ?>" class="css-label radGroup2"><?php echo $row['option4']; ?></label></tr></td>
				</table>
			</div>
			<?php
		}
		?>
		</div>
		<input type="submit" class="submit-button" value="Submit" />
	</form>
</body>
</html>