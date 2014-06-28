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
					$months = scandir("problems");
					for($i=2; $i<sizeof($months); $i++){ 
						$weeks = scandir("problems/".$months[$i]);
						$fourset = "<h3>".substr($months[$i], 2)."</h3><div name=".($i-1).">";
						for($j=2; $j<sizeof($weeks); $j++) $fourset = $fourset."<p>".substr($weeks[$j], 7)."</p>";
						$fourset = $fourset."</div>";
						echo($fourset);
					}
				?>
			</div>
			
			<section id="display">
				<?php 
				$weeks = scandir("problems/".$months[sizeof($months)-1]);
				?>
				<h2><?php echo(substr($months[sizeof($months)-1], 2).", Week ".substr($weeks[sizeof($weeks)-1], 5, 1)); ?></h2>
				<h3><?php echo(substr($weeks[sizeof($weeks)-1], 7))?></h3>
			</section>
		</div>
	</body>
</html>
