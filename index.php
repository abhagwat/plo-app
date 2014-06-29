<!doctype html>
<html>
	<head>
		<link rel="stylesheet" href="fontfaces.css"/>
		<link rel="stylesheet" href="home.css"/>
		<link rel="stylesheet" href="jqueryui/css/smoothness/jquery-ui-1.8.20.custom.css"/>
		<script src="jquery.js"></script>
		<script src="jqueryui/js/jqueryui.js"></script>
		<script src="home.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<div id="months">
				<?php 
				/* MONTHS = LIST OF ALL MONTH FOLDERS
				 * WEEKS = A VARIABLE LIST OF 4 PROBLEMS IN MONTH i 
				 * FOURSET = A STRING WHICH CONCATENATES THE NAMES OF PROBLEMS 
				 * PROBLEMNUMBER = NUMBER OF PROBLEM IN THE FORMAT 2.3, 4.1, ETC*/
					$months = scandir("problems");
                    natsort($months); // NATURAL SORT ON THE MONTHS
                    $months = array_values($months); // REARRANGING ARRAY KEYS
					for($i=sizeof($months)-1; $i>=2; $i--){ 
						$weeks = scandir("problems/".$months[$i]);
						$fourset = "<h3>".substr($months[$i], 2)."</h3><div name=".($i-1).">";
						for($j=2; $j<sizeof($weeks); $j++){ 
							$problemnumber = ($i-1).".".($j-1);
							$fourset = $fourset."<p><a href=index.php?problem=".$problemnumber.
							" class=problemlink name=".$problemnumber.">".substr($weeks[$j], 7)."</a></p>";				
						}
						$fourset = $fourset."</div>"; // CLOSES THE div TAG 
						echo($fourset);
					}
				?>
			</div>
			
			<section id="display">
				<?php 
				if(!array_key_exists('problem', $_GET))
					$problem_parameter = $months[sizeof($months)-1]; // DEFAULT: THE LATEST PROBLEM
				else
					$problem_parameter = $_GET['problem']; // DYNAMIC PARAMETER
					
				preg_match_all('/\w+/', $problem_parameter, $matches);
				$problem_month = $matches[0][0];
				
				if(!array_key_exists('problem', $_GET))
					$problem_week = sizeof(scandir("problems/".$months[sizeof($months)-1]))-2; // -2 TO REMOVE THE FILES . AND ..
				else
					$problem_week = $matches[0][1];
				
				echo $problem_month;
				echo ".".$problem_week;
				
				
				$weeks = scandir("problems/".$months[sizeof($months)-1]);
				?>
				<h2><?php echo(substr($months[sizeof($months)-1], 2).", Week ".substr($weeks[sizeof($weeks)-1], 5, 1)); ?></h2>
				<h3><?php echo(substr($weeks[sizeof($weeks)-1], 7))?></h3>
			</section>
		</div>
	</body>
</html>
