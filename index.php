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
				/* IN THIS SECTION, WE MAKE THE NAVIGATION BAR
                 * MONTHS = LIST OF ALL MONTH FOLDERS
				 * WEEKS = A VARIABLE LIST OF 4 PROBLEMS ANY IN MONTH i 
				 * FOURSET = A STRING WHICH CONCATENATES THE NAMES OF PROBLEMS 
				 * PROBLEMNUMBER = NUMBER OF PROBLEM IN THE FORMAT 2.3, 4.1, ETC*/
					$months = scandir("problems");
                    natsort($months); // NATURAL SORT ON THE MONTHS
                    if(in_array('.DS_Store', $months)) unset($months[2]); // REMOVING THE CRAZY MACINTOSH FILE
                    $months = array_values($months); // REARRANGING ARRAY KEYS
                    $months = array_slice($months, 2);
					for($i=sizeof($months)-1; $i>=0; $i--){
						$weeks = scandir("problems/".$months[$i]);
						$fourset = "<h3>".substr($months[$i], 2)."</h3><div name=".($i+1).">";
						for($j=2; $j<sizeof($weeks); $j++){
							$problemnumber = ($i+1).".".($j-1); // MONTHS IS SLICED, WEEKS ISN'T
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
					$problem_week = $matches[0][1]; // WEEK NUMBER
				
                $weeks = scandir("problems/".$months[$problem_month-1]);
                natsort($weeks); // NEVER FORGET TO USE natural sort. OTHERWISE THE ARRAY ORDER WILL GO HAYWIRE.
                $weeks = array_values($weeks); //REARRANGING ARRAY KEYS WILL GET NATSORT WORKING
                $weeks = array_slice($weeks, 2); // GETTING RID OF . and ..
				?>
				<h2><?php echo(substr($months[$problem_month-1], 2).", Week ".substr($weeks[$problem_week-1], 5, 1)); ?></h2>
				<h3><?php echo(substr($weeks[$problem_week-1], 7))?></h3>
			</section>
		</div>
	</body>
</html>
