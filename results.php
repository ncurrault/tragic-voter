<?php
	require_once "sql_functions.php";

	$votes = sqlQuery("SELECT * FROM Votes;");

	if (empty($votes)) {
		echo "ERROR: It seems that there aren't any votes";
		error_log("Tried to generate results with no votes.");
		exit();
	}

	$avgTragHeroImportance = $votes[0]["tragheroimportance"];
	$avgPeripImportance = $votes[0]["peripimportance"];
	$avgAnagImportance = $votes[0]["anagimportance"];
	$avgSpiralImportance = $votes[0]["spiralimportance"];
	$avgOkSocial = $votes[0]["oksocial"];
	$avgOkStubborn = $votes[0]["okstubborn"];
	$avgOkAgressive = $votes[0]["okagressive"];
	$avgOkHarsh = $votes[0]["okharsh"];
	$avgOkOther = $votes[0]["okother"];
	$okPerip1Count = $votes[0]["okperip1count"];
	$okPerip2Count = $votes[0]["okperip2count"];
	$okPerip3Count = $votes[0]["okperip3count"];
	$okPerip4Count = $votes[0]["okperip4count"];
	$avgOkAnag = $votes[0]["okanag"];
	$avgOkEffect = $votes[0]["okeffect"];
	$avgOthSocial = $votes[0]["othsocial"];
	$avgOthFlaw = $votes[0]["othflaw"];
	$avgOthPerip = $votes[0]["othperip"];
	$avgOthAnag = $votes[0]["othanag"];
	$avgOthEffect = $votes[0]["otheffect"];

	$avgothScore = $votes[0]["othscore"];
	$avgtfaScore = $votes[0]["tfascore"];

	$elapsedWeight = $votes[0]["weight"];

	foreach (array_slice($votes, 1) as $vote) {
		$currentWeight = $vote["weight"];

		// You don't even wanna know
		$avgTragHeroImportance = (($avgTragHeroImportance * $elapsedWeight) + ($vote["tragheroimportance"] * $currentWeight))/($elapsedWeight + $currentWeight);
		$avgPeripImportance    = (($avgPeripImportance    * $elapsedWeight) + ($vote["peripimportance"]    * $currentWeight))/($elapsedWeight + $currentWeight);
		$avgAnagImportance     = (($avgAnagImportance     * $elapsedWeight) + ($vote["anagimportance"]     * $currentWeight))/($elapsedWeight + $currentWeight);
		$avgSpiralImportance   = (($avgSpiralImportance   * $elapsedWeight) + ($vote["spiralimportance"]   * $currentWeight))/($elapsedWeight + $currentWeight);
		$avgOkSocial           = (($avgOkSocial           * $elapsedWeight) + ($vote["oksocial"]           * $currentWeight))/($elapsedWeight + $currentWeight);
		$avgOkStubborn         = (($avgOkStubborn         * $elapsedWeight) + ($vote["okstubborn"]         * $currentWeight))/($elapsedWeight + $currentWeight);
		$avgOkAgressive        = (($avgOkAgressive        * $elapsedWeight) + ($vote["okagressive"]        * $currentWeight))/($elapsedWeight + $currentWeight);
		$avgOkHarsh            = (($avgOkHarsh            * $elapsedWeight) + ($vote["okharsh"]            * $currentWeight))/($elapsedWeight + $currentWeight);
		$avgOkOther            = (($avgOkOther            * $elapsedWeight) + ($vote["okother"]            * $currentWeight))/($elapsedWeight + $currentWeight);
		$avgOkAnag             = (($avgOkAnag             * $elapsedWeight) + ($vote["okanag"]             * $currentWeight))/($elapsedWeight + $currentWeight);
		$avgOkEffect           = (($avgOkEffect           * $elapsedWeight) + ($vote["okeffect"]           * $currentWeight))/($elapsedWeight + $currentWeight);
		$avgOthSocial          = (($avgOthSocial          * $elapsedWeight) + ($vote["othsocial"]          * $currentWeight))/($elapsedWeight + $currentWeight);
		$avgOthFlaw            = (($avgOthFlaw            * $elapsedWeight) + ($vote["othflaw"]            * $currentWeight))/($elapsedWeight + $currentWeight);
		$avgOthPerip           = (($avgOthPerip           * $elapsedWeight) + ($vote["othperip"]           * $currentWeight))/($elapsedWeight + $currentWeight);
		$avgOthAnag            = (($avgOthAnag            * $elapsedWeight) + ($vote["othanag"]            * $currentWeight))/($elapsedWeight + $currentWeight);
		$avgOthEffect          = (($avgOthEffect          * $elapsedWeight) + ($vote["otheffect"]          * $currentWeight))/($elapsedWeight + $currentWeight);

		$okPerip1Count += $vote["okperip1count"];
		$okPerip2Count += $vote["okperip2count"];
		$okPerip3Count += $vote["okperip3count"];
		$okPerip4Count += $vote["okperip4count"];

		$elapsedWeight += $currentWeight;
	}

	$peripVoters = $okPerip1Count + $okPerip2Count +$okPerip3Count + $okPerip4Count;
	$okPerip1Percent = 100 * $okPerip1Count / $peripVoters;
	$okPerip2Percent = 100 * $okPerip2Count / $peripVoters;
	$okPerip3Percent = 100 * $okPerip3Count / $peripVoters;
	$okPerip4Percent = 100 * $okPerip4Count / $peripVoters;
	

	$avgTragHeroImportance = round($avgTragHeroImportance, 2);
	$avgPeripImportance = round($avgPeripImportance, 2);
	$avgAnagImportance = round($avgAnagImportance, 2);
	$avgSpiralImportance = round($avgSpiralImportance, 2);
	$avgOkSocial = round($avgOkSocial, 2);
	$avgOkStubborn = round($avgOkStubborn, 2);
	$avgOkAgressive = round($avgOkAgressive, 2);
	$avgOkHarsh = round($avgOkHarsh, 2);
	$avgOkOther = round($avgOkOther, 2);
	$okPerip1Count = round($okPerip1Count, 2);
	$okPerip2Count = round($okPerip2Count, 2);
	$okPerip3Count = round($okPerip3Count, 2);
	$okPerip4Count = round($okPerip4Count, 2);
	$avgOkAnag = round($avgOkAnag, 2);
	$avgOkEffect = round($avgOkEffect, 2);
	$avgOthSocial = round($avgOthSocial, 2);
	$avgOthFlaw = round($avgOthFlaw, 2);
	$avgOthPerip = round($avgOthPerip, 2);
	$avgOthAnag = round($avgOthAnag, 2);
	$avgOthEffect = round($avgOthEffect, 2);

	$avgothScore = round($avgothScore, 2);
	$avgtfaScore = round($avgtfaScore, 2);

	$okPerip1Percent = round($okPerip1Percent, 2);
	$okPerip2Percent = round($okPerip2Percent, 2);
	$okPerip3Percent = round($okPerip3Percent, 2);
	$okPerip4Percent = round($okPerip4Percent, 2);
?>
<!DOCTYPE html>

<html>
<head>
	<title>The Tragic Voter</title>

	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

	<!-- Bootstrap -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

	<style>
		.rt-al {
			text-align: right;
		}
	</style>
</head>
<body class="container-fluid">
	<div id="intro" class="jumbotron">
		<h1><a href="index.html">The Tragic Voter</a></h1>
		<h2>View the results.</h2>
	</div>
	
	<h2>Importance of each Component</h2>
	<div class="row">
		<div class="col-md-3 col-sm-5 col-xs-6 rt-al">
			Tragic Hero
		</div>
		<div class="col-md-9 col-sm-7 col-xs-6">
			<div class="progress">
				<div class="progress-bar progress-bar-info " role="progressbar" aria-valuenow="<?php echo $avgTragHeroImportance; ?>"
					aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: <?php echo $avgTragHeroImportance; ?>%">
					<?php echo $avgTragHeroImportance; ?> / 100
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-sm-5 col-xs-6 rt-al">
			Hero's choice and <i>Peripetea</i>
		</div>
		<div class="col-md-9 col-sm-7 col-xs-6">
			<div class="progress">
				<div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $avgPeripImportance; ?>"
					aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: <?php echo $avgPeripImportance; ?>%">
					<?php echo $avgPeripImportance; ?> / 100
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-sm-5 col-xs-6 rt-al">
			<i>Anagnoresis</i>
		</div>
		<div class="col-md-9 col-sm-7 col-xs-6">
			<div class="progress">
				<div class="progress-bar progress-bar-info " role="progressbar" aria-valuenow="<?php echo $avgAnagImportance; ?>"
					aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: <?php echo $avgAnagImportance; ?>%">
					<?php echo $avgAnagImportance; ?> / 100
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-sm-5 col-xs-6 rt-al">
			Affecting innocent people
		</div>
		<div class="col-md-9 col-sm-7 col-xs-6">
			<div class="progress">
				<div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $avgSpiralImportance; ?>"
					aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: <?php echo $avgSpiralImportance; ?>%">
					<?php echo $avgSpiralImportance; ?> / 100
				</div>
			</div>
		</div>
	</div>

	<hr>

	<h2><b><i>Things Fall Apart</i> Analysis</b></h2>
	<h3>Factors in Okonkwo's downfall</h3>
	<div class="row">
		<div class="col-md-3 col-sm-5 col-xs-6 rt-al">
			Stubbornness
		</div>
		<div class="col-md-9 col-sm-7 col-xs-6">
			<div class="progress">
				<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $avgOkStubborn; ?>"
					aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: <?php echo $avgOkStubborn; ?>%">
					<?php echo $avgOkStubborn; ?>%
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-sm-5 col-xs-6 rt-al">
			Aggression
		</div>
		<div class="col-md-9 col-sm-7 col-xs-6">
			<div class="progress">
				<div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $avgOkAgressive; ?>"
					aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: <?php echo $avgOkAgressive; ?>%">
					<?php echo $avgOkAgressive; ?>%
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-sm-5 col-xs-6 rt-al">
			Harshness
		</div>
		<div class="col-md-9 col-sm-7 col-xs-6">
			<div class="progress">
				<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $avgOkHarsh; ?>"
					aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: <?php echo $avgOkHarsh; ?>%">
					<?php echo $avgOkHarsh; ?>%
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-sm-5 col-xs-6 rt-al">
			Other (not his flaws)
		</div>
		<div class="col-md-9 col-sm-7 col-xs-6">
			<div class="progress">
				<div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $avgOkOther; ?>"
					aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: <?php echo $avgOkOther; ?>%">
					<?php echo $avgOkOther; ?>%
				</div>
			</div>
		</div>
	</div>

	<h3>Okonkwo's Choice that leads to his downfall</h3>
	
	<div class="row">
		<div class="col-md-3 col-sm-5 col-xs-6 rt-al">
			Rejecting Nwoye's conversion to Christianity
		</div>
		<div class="col-md-9 col-sm-7 col-xs-6">
			<div class="progress">
				<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $okPerip1Percent; ?>"
					aria-valuemin="0" aria-valuemax="100" style="min-width: 5em; width: <?php echo $okPerip1Percent; ?>%">
					<?php echo $okPerip1Count . " / " . $peripVoters ?> (<?php echo $okPerip1Percent; ?>%)
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-sm-5 col-xs-6 rt-al">
			Executing Ikemefuna
		</div>
		<div class="col-md-9 col-sm-7 col-xs-6">
			<div class="progress">
				<div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $okPerip2Percent; ?>"
					aria-valuemin="0" aria-valuemax="100" style="min-width: 5em; width: <?php echo $okPerip2Percent; ?>%">
					<?php echo $okPerip2Count . " / " . $peripVoters ?> (<?php echo $okPerip2Percent; ?>%)
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-sm-5 col-xs-6 rt-al">
			Killing the messenger
		</div>
		<div class="col-md-9 col-sm-7 col-xs-6">
			<div class="progress">
				<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $okPerip3Percent; ?>"
					aria-valuemin="0" aria-valuemax="100" style="min-width: 5em; width: <?php echo $okPerip3Percent; ?>%">
					<?php echo $okPerip3Count . " / " . $peripVoters ?> (<?php echo $okPerip3Percent; ?>%)
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-sm-5 col-xs-6 rt-al">
			There is no such choice.
		</div>
		<div class="col-md-9 col-sm-7 col-xs-6">
			<div class="progress">
				<div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $okPerip4Percent; ?>"
					aria-valuemin="0" aria-valuemax="100" style="min-width: 5em; width: <?php echo $okPerip4Percent; ?>%">
					<?php echo $okPerip4Count . " / " . $peripVoters ?> (<?php echo $okPerip4Percent; ?>%)
				</div>
			</div>
		</div>
	</div>

	<h3>Other Aspects</h3>
	<div class="row">
		<div class="col-md-3 col-sm-5 col-xs-6 rt-al">
			Does Okonkwo have a high social status?
		</div>
		<div class="col-md-9 col-sm-7 col-xs-6">
			<div class="progress">
				<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $avgOkSocial; ?>"
					aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: <?php echo $avgOkSocial; ?>%">
					<?php echo $avgOkSocial; ?>% yes
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-sm-5 col-xs-6 rt-al">
			Does Okonkwo have an anagnoresis?
		</div>
		<div class="col-md-9 col-sm-7 col-xs-6">
			<div class="progress">
				<div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $avgOkAnag; ?>"
					aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: <?php echo $avgOkAnag; ?>%">
					<?php echo $avgOkAnag; ?>% yes
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-sm-5 col-xs-6 rt-al">
			Does Okonkwo's downfall effect innocent people?
		</div>
		<div class="col-md-9 col-sm-7 col-xs-6">
			<div class="progress">
				<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $avgOkEffect; ?>"
					aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: <?php echo $avgOkEffect; ?>%">
					<?php echo $avgOkEffect; ?>% yes
				</div>
			</div>
		</div>
	</div>
	
<hr>

	<h2><i>Othello</i> Analysis</h2>
	<div class="row">
		<div class="col-md-3 col-sm-5 col-xs-6 rt-al">
			Does Othello have a high social status?
		</div>
		<div class="col-md-9 col-sm-7 col-xs-6">
			<div class="progress">
				<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $avgOthSocial; ?>"
					aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: <?php echo $avgOthSocial; ?>%">
					<?php echo $avgOthSocial; ?>% yes
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-sm-5 col-xs-6 rt-al">
			Does Othello have a flaw that causes his downfall?
		</div>
		<div class="col-md-9 col-sm-7 col-xs-6">
			<div class="progress">
				<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $avgOthFlaw; ?>"
					aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: <?php echo $avgOthFlaw; ?>%">
					<?php echo $avgOthFlaw; ?>% yes
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-sm-5 col-xs-6 rt-al">
			Does Othello make a choice that causes his downfall?
		</div>
		<div class="col-md-9 col-sm-7 col-xs-6">
			<div class="progress">
				<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $avgOthPerip; ?>"
					aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: <?php echo $avgOthPerip; ?>%">
					<?php echo $avgOthPerip; ?>% yes
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-sm-5 col-xs-6 rt-al">
			Does Othello have an <i>anagnoresis</i>?
		</div>
		<div class="col-md-9 col-sm-7 col-xs-6">
			<div class="progress">
				<div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $avgOthAnag; ?>"
					aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: <?php echo $avgOthAnag; ?>%">
					<?php echo $avgOthAnag; ?>% yes
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-sm-5 col-xs-6 rt-al">
			Does Othello's downfall affect innocent people?
		</div>
		<div class="col-md-9 col-sm-7 col-xs-6">
			<div class="progress">
				<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $avgOthEffect; ?>"
					aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: <?php echo $avgOthEffect; ?>%">
					<?php echo $avgOthEffect; ?>% yes
				</div>
			</div>
		</div>
	</div>
	

	<div class="jumbotron">
		<h1>Final Results</h1>

		<h2><i>Othello</i> is <?php echo $avgothScore; ?>% a tragedy</h2>
		<div class="row col-xs-12">
			<div class="progress">
				<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $avgothScore; ?>"
					aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: <?php echo $avgothScore; ?>%">
					<?php echo $avgothScore; ?>%
				</div>
			</div>
		</div>

		<h2><i>Things Fall Apart</i> is <?php echo $avgtfaScore; ?>% a tragedy</h2>
		<div class="row col-xs-12">
			<div class="progress">
				<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $avgtfaScore; ?>"
					aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: <?php echo $avgtfaScore; ?>%">
					<?php echo $avgtfaScore; ?>%
				</div>
			</div>
		</div>
	</div>
	
	<h3>Based on <?php echo $elapsedWeight ?> submissions.</h3>

</body>
</html>