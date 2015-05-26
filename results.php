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
	
?>
<!DOCTYPE html>

<html>
<head>
	<title>The Tragic Voter</title>
</head>
<body>
	<h1><a href="index.html">The Tragic Voter</a></h1>
	<h2>View the Results.</h2>

	<hr>
	<h2>Importance of each Component</h2>
	<table>
		<tr>
			<td>Tragic Hero</td>
			<td><?php echo $avgTragHeroImportance; ?> / 100</td>
		</tr>
		<tr>
			<td>Hero's choice and <i>Peripetea</i></td>
			<td><?php echo $avgPeripImportance; ?> / 100</td>
		</tr>
		<tr>
			<td><i>Anagnoresis</i></td>
			<td><?php echo $avgAnagImportance; ?> / 100</td>
		</tr>
		<tr>
			<td>Affecting innocent people</td>
			<td><?php echo $avgSpiralImportance; ?> / 100</td>
		</tr>
	</table>
	<h2><b><i>Things Fall Apart</i> Analysis</b></h2>
	<h3>Factors in Okonkwo's downfall</h3>
	<table>	
		<table>
		<tr>
			<td>Stubbornness</td>
			<td><?php echo $avgOkStubborn; ?>%</td>
		</tr>
		<tr>
			<td>Aggression</td>
			<td><?php echo $avgOkAgressive; ?>%</td>
		</tr>
		<tr>
			<td>Harshness</td>
			<td><?php echo $avgOkHarsh; ?>%</td>
		</tr>
		<tr>
			<td>Other (not his flaws)</td>
			<td><?php echo $avgOkOther; ?>%</td>
		</tr>
	</table>
	<h3>Okonkwo's Choice that leads to his downfall</h3>
	<table cellpadding="2">
		<tr>
			<td>Rejecting Nwoye's conversion to Christianity</td>
			<td><?php echo $okPerip1Count . " out of " . $peripVoters . " voters"?></td>
			<td>(<?php echo $okPerip1Percent ?>%)</td>
		</tr>
		<tr>
			<td>Executing Ikemefuna</td>
			<td><?php echo $okPerip2Count . " out of " . $peripVoters . " voters"?></td>
			<td>(<?php echo $okPerip2Percent ?>%)</td>
		</tr>
		<tr>
			<td>Killing the messenger</td>
			<td><?php echo $okPerip3Count . " out of " . $peripVoters . " voters"?></td>
			<td>(<?php echo $okPerip3Percent ?>%)</td>
		</tr>
		<tr>
			<td>there is no such choice</td>
			<td><?php echo $okPerip4Count . " out of " . $peripVoters . " voters"?></td>
			<td>(<?php echo $okPerip4Percent ?>%)</td>
		</tr>
	</table>
	<h3>Other Aspects</h3>
	<table>
		<tr>
			<td>Does Okonkwo have a high social status?</td>
			<td><?php echo $avgOkSocial; ?>% yes</td>
		</tr>
		<tr>
			<td>Does Okonkwo have an anagnoresis?</td>
			<td><?php echo $avgOkAnag; ?>% yes</td>
		</tr>
		<tr>
			<td>Does Okonkwo's downfall effect innocent people?</td>
			<td><?php echo $avgOkEffect; ?>% yes</td>
		</tr> 
	</table>
	<h2><i>Othello</i> Analysis</h2>
	<table>
		<tr>
			<td>Does Othello have a high social status?</td>
			<td><?php echo $avgOthSocial; ?>% yes</td>
		</tr>
		<tr>
			<td>Does Othello have a flaw that causes his downfall?</td>
			<td><?php echo $avgOthFlaw; ?>% yes</td>
		</tr>
		<tr>
			<td>Does Othello make a choice that causes his downfall?</td>
			<td><?php echo $avgOthPerip; ?>% yes</td>
		</tr>
		<tr>
			<td>Does Othello have an <i>anagnoresis</i>?</td>
			<td><?php echo $avgOthAnag; ?>% yes</td>
		</tr>
		<tr>
			<td>Does Othello's downfall affect innocent people?</td>
			<td><?php echo $avgOthEffect; ?>% yes</td>
		</tr>
	</table> 

	<h2>Final Results</h2>
	<h3><i>Othello</i> is <?php echo $avgothScore; ?>% a tragedy</h3>
	and
	<h3><i>Things Fall Apart</i> is <?php echo $avgtfaScore; ?>% a tragedy</h3>
	based on
	<h3><?php echo $elapsedWeight ?> submissions </h3>
</body>
</html>