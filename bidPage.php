<?php require 'checkLoginStatus.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <title> Task Turtle | Bidding </title>
    </head>
    <body>
		<?php include 'template.php'; ?>
		<h1> Task Turtle </h1>

    	<?php
	
			require 'dbfunction.php';
			require 'dbqueryfunction.php';

			$con = getDbConnect();

			if (!$con) {
				
				echo 'Not connected to server';
			}

			$taskid = isset($_POST['taskid']) ? $_POST['taskid'] : null;

			if ($taskid == null) {
				session_start();
	        	$taskid = $_SESSION["taskid"];
	        }

	        $queryStr = "SELECT * FROM task where taskid = $taskid";
			$retrieveTask = dbQuery($con, $queryStr);
			$arr = dbFetchArray($retrieveTask);

			// Display the information of the task
	        echo "</br>".'<div style="border:1px solid; padding:20px; margin-bottom:20px;">'.$arr['title']."</br>".$arr['description']."</br>".$arr['task_date']."</br>".$arr['creator'].'</div>';

	        // Click to direct to another page to insert & submit your bid
			echo '<form action="updateBid.php" method="POST">'."Enter your bid: ".'<input type="number" name="bidValue" step="0.01"/><input type="hidden" name="taskid" value='.$taskid.'>&nbsp;<input type="submit" value="Submit your bid"/></form>'
		?>
		
		<a href="taskPage.php">
			<button> Back </button>
		</a>


	</body>
</html>