<?php
	require_once "sql_functions.php";

	$isPost = false;
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$voteObj = array(
			"tragheroimportance" => $_POST["tragHeroImportance"],
			"peripimportance" => $_POST["peripImportance"],
			"anagimportance" => $_POST["anagImportance"],
			"spiralimportance" => $_POST["spiralImportance"],
			"oksocial" => $_POST["tragHeroTfa1"],
			"okstubborn" => $_POST["stubbornDownfall"],
			"okagressive" => $_POST["aggressionDownfall"],
			"okharsh" => $_POST["harshnessDownfall"],
			"okother" => $_POST["otherDownfall"],
			"okperip1count" => $_POST["tfaPeri"] == "peripReject" ? 1 : 0,
			"okperip2count" => $_POST["tfaPeri"] == "peripExecute" ? 1 : 0,
			"okperip3count" => $_POST["tfaPeri"] == "peripKilling" ? 1 : 0,
			"okperip4count" => $_POST["tfaPeri"] == "peripNoChoice" ? 1 : 0,
			"okanag" => $_POST["tfaAnag"],
			"okeffect" => $_POST["tfaSpiral"],
			"othsocial" => $_POST["othTragHero1"],
			"othflaw" => $_POST["othTragHero2"],
			"othperip" => $_POST["othPerip"],
			"othanag" => $_POST["othAnag"],
			"otheffect" => $_POST["othSpiral"],
			"othScore" => $_POST["tfaScore"],
			"tfaScore" => $_POST["othScore"]
		);

		sqlAddRow("Votes", $voteObj);
		$isPost = true;
	}
?>

<!DOCTYPE html>

<html>
<head>
	<title>The Tragic Voter</title>

	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

	<!-- Basic functionality JS -->
	<script type="text/javascript">
		$(function() {
			$(".valueOutput").each(function () {
				var outputID = $(this).attr("id");
				var inputName = outputID.substring(0, outputID.length - 6);
				
				$(this).html($("[name=" + inputName + "]").val())
				
				$("[name=" + inputName + "]").change(function () {
					$("#" + outputID).html($(this).val());
				});
			});
		});

		function okFlawToPercent() {
			var flawSum = 0;
			$(".okFlaw").each(function() {
				flawSum += Number($(this).val());
			}).each(function() {
				$(this).val( 100.0 * $(this).val() / flawSum);
			}).change();
		}

		function calculateScores() {
			okFlawToPercent();

			var   heroImportance = Number($("[name=tragHeroImportance]").val());
			var  peripImportance = Number($("[name=peripImportance]").val());
			var   anagImportance = Number($("[name=anagImportance]").val());
			var spiralImportance = Number($("[name=spiralImportance]").val());
			var  totalImportance =  heroImportance + peripImportance + anagImportance + spiralImportance;
			heroImportance /= totalImportance;
			peripImportance /= totalImportance;
			anagImportance /= totalImportance;
			spiralImportance /= totalImportance;

			okFlawToPercent();
			var tfaHero  = (Number($("[name=tragHeroTfa1]").val()) + (100 - Number($("[name=otherDownfall]").val())))/2.0; // average the "tragic" parts of both questions
			var tfaPerip  = $("[name=tfaPeri]").val() == "peripNoChoice" ? 0 : 100;
			var tfaAnag   = Number($("[name=tfaAnag]").val());
			var tfaSpiral = Number($("[name=tfaSpiral]").val());

			var tfaScore = (tfaHero * heroImportance) + (tfaPerip * peripImportance) + (tfaAnag * anagImportance) + (tfaSpiral * spiralImportance);
			tfaScore = Math.round(tfaScore);

			var othHero  = (Number($("[name=othTragHero1]").val()) + Number($("[name=othTragHero2]").val()))/2.0;
			var othPerip  = Number($("[name=othPerip]").val());
			var othAnag   = Number($("[name=othAnag]").val());
			var othSpiral = Number($("[name=othSpiral]").val());

			var othScore = (othHero * heroImportance) + (othPerip * peripImportance) + (othAnag * anagImportance) + (othSpiral * spiralImportance);
			othScore = Math.round(othScore);

			$("#tfaScoreOut").html(tfaScore + "%");
			$("#othScoreOut").html(othScore + "%");

			$("#tfaScoreSubmit").val(tfaScore);
			$("#othScoreSubmit").val(othScore);			
		}

		function step1to2() {
			$("#step1 input").prop('readonly', true);
			$("#calcScoresButton").prop('disabled', true);
			calculateScores();
			$("input[type=submit]").prop('disabled', false);
			$("#backbutton").prop('disabled', false);
		}
		function step2to1() {
			$("#step1 input").prop('readonly', false);
			$("#calcScoresButton").prop('disabled', false);
			
			$("input [type=submit]").prop('disabled', true);
			$("#backbutton").prop('disabled', true);
		}
	</script>

	<style>
		.distrib3 > div {
			display: inline-block;
  			zoom: 1;
   			width: 33%;
		}
		.distrib3 > div:first-child {
			text-align: left;
		}

		.distrib3 > div:nth-child(2) {
			text-align: center;
		}
		.distrib3 > div:nth-child(3) {
			text-align: right;
		}
	</style>
</head>
<body>
	<h1><a href="index.html">The Tragic Voter</a></h1>
	<h2>Give your input.</h2>

	<div id="successMsg" <?php if (!$isPost) echo "hidden";?>>Your results have been submitted!</div>

	<hr>
	<form method="POST">
		<div id="step1">
			<div id="componentImportance">
				<h1>Components of Tragedy</h1>
				How important do you think each component is?
				<h2>Tragic Hero</h2>
				<p>A tragic hero is someone of great social importance who has admirable traits, which eventually cause his downfall.</p>
				<table cellpadding="10">
					<tr>
						<td colspan="3"><input type="range" name="tragHeroImportance" min="0" max="100" step="1" style="width: 100%;"></td>
						<td id="tragHeroImportanceOutput" class="valueOutput"></td>
					</tr>
					<tr>
						<td colspan="3" class="distrib3">
							<div>|</div><div>|</div><div>|</div>
						</td>
					</tr>
					<tr>
						<td style="text-align: left;">It's not really necessary</td>
						<td style="text-align: center;">It's good to have, but not having it isn't a dealbreaker.</td>
						<td style="text-align: right;">It's essential.</td>
					</tr>
				</table>

				<h2>Hero's Choice and <i>Peripetea</i></h2>
				<p>This hero makes a choice that eventually leads to his downfall. This choice causes unforeseen events (the <i>peripetea</i>).</p>
				<table cellpadding="10">
					<tr>
						<td colspan="3"><input type="range" name="peripImportance" min="0" max="100" step="1" style="width: 100%;"></td>
						<td id="peripImportanceOutput" class="valueOutput"></td>
					</tr>
					<tr>
						<td colspan="3" class="distrib3">
							<div>|</div><div>|</div><div>|</div>
						</td>
					</tr>
					<tr>
						<td>It's not really necessary</td>
						<td>It's good to have, but not having it isn't a dealbreaker.</td>
						<td>It's essential.</td>
					</tr>
				</table>

				<h2><i>Anagnorisis</i></h2>
				<p>The hero realizes his mistake and its effects.</p>
				<table cellpadding="10">
					<tr>
						<td colspan="3"><input type="range" name="anagImportance" min="0" max="100" step="1" style="width: 100%;"></td>
						<td id="anagImportanceOutput" class="valueOutput"></td>
					</tr>
					<tr>
						<td colspan="3" class="distrib3">
							<div>|</div><div>|</div><div>|</div>
						</td>
					</tr>
					<tr>
						<td>It's not really necessary</td>
						<td>It's good to have, but not having it isn't a dealbreaker.</td>
						<td>It's essential.</td>
					</tr>
				</table>

				<h2>Spiraling Out of Control</h2>
				<p>Everyone, not just the hero, but other innocent people are affected.</p>
				<table cellpadding="10">
					<tr>
						<td colspan="3"><input type="range" name="spiralImportance" min="0" max="100" step="1" style="width: 100%;"></td>
						<td id="spiralImportanceOutput" class="valueOutput"></td>
					</tr>
					<tr>
						<td colspan="3" class="distrib3">
							<div>|</div><div>|</div><div>|</div>
						</td>
					</tr>
					<tr>
						<td>It's not really necessary</td>
						<td>It's good to have, but not having it isn't a dealbreaker.</td>
						<td>It's essential.</td>
					</tr>
				</table>
			</div>
			<hr>
			<div id="evalLit">
				<h1>Evaluate the Literature</h1>
				<h2><i>Things Fall Apart</i></h2>
					<h3>Okonkwo as a Tragic Hero</h3>
					<p>Does he have a high social status is Umofia?</p>
					<table cellpadding="10">
						<tr>
							<td colspan="3"><input type="range" name="tragHeroTfa1" min="0" max="100" step="1" style="width: 100%;"></td>
							<td id="tragHeroTfa1Output" class="valueOutput"></td>
						</tr>
						<tr>
							<td>|</td>
							<td style="text-align: right;">|</td>
						</tr>
						<tr>
							<td>No</td>
							<td style="text-align: right;">Yes</td>
						</tr>
					</table>

					<p>To what degree do Okonkwo's flaws contribute to his downfall?</p>
					<!-- TODO: ensure fields always sum to 100 -->
					<table cellpadding="10">
						<tr>
							<td>Stubbornness</td>
							<td><input type="range" class="okFlaw" name="stubbornDownfall" min="0" max="100" step="1" value="25" style="width: 100%;"></td>
							<td id="stubbornDownfallOutput" class="valueOutput"></td>
						</tr>
						<tr>
							<td>Aggression</td>
							<td><input type="range" class="okFlaw" name="aggressionDownfall" min="0" max="100" step="1" value="25" style="width: 100%;"></td>
							<td id="aggressionDownfallOutput" class="valueOutput"></td>
						</tr>
						<tr>
							<td>Harshness</td>
							<td><input type="range" class="okFlaw" name="harshnessDownfall" min="0" max="100" step="1" value="25" style="width: 100%;"></td>
							<td id="harshnessDownfallOutput" class="valueOutput"></td>
						</tr>
						<tr>
							<td>other factors (not Okonkwo's flaws)</td>
							<td><input type="range" class="okFlaw" name="otherDownfall" min="0" max="100" step="1" value="25" style="width: 100%;"></td>
							<td id="otherDownfallOutput" class="valueOutput"></td>
						</tr>
					</table>

					<h3>Okonkwo's choice and <i>peripetea</i></h3>
					<p>Does Okonkwo make a choice that causes the shift from glory to decline? If so, which is it?</p>
					<table>
						<tr>
							<td><input type="radio" name="tfaPeri" value="peripReject"></td>
							<td>Rejecting Nwoye's conversion to Christianity</td>
						</tr>
						<tr>
							<td><input type="radio" name="tfaPeri" value="peripExecute"></td>
							<td>Executing Ikemefuna</td>
						</tr>
						<tr>
							<td><input type="radio" name="tfaPeri" value="peripKilling"></td>
							<td>Killing the messenger</td>
						</tr>
						<tr>
							<td><input type="radio" name="tfaPeri" value="peripNoChoice"></td>
							<td>there is no such choice</td>
						</tr>
					</table>

					<h3>Okonkwo's <i>anagnoresis</i></h3>
					<p>Does Okonkwo ever realize his mistake?</p>
					<table cellpadding="10">
						<tr>
							<td colspan="3"><input type="range" name="tfaAnag" min="0" max="100" step="1" style="width: 100%;"></td>
							<td id="tfaAnagOutput" class="valueOutput"></td>
						</tr>
						<tr>
							<td colspan="3" class="distrib3">
								<div>|</div><div>|</div><div>|</div>
							</td>
						</tr>
						<tr>
							<td>No: He never thinks <br> he himself is mistaken; <br> he thinks everyone <br> else in Umofia is.</td>
							<td>Maybe: He realizes that <br> he cannot live in the new <br> Umofia, regardless of <br> who is actually right.</td>
							<td>Yes: He commits suicide <br> because he realized the <br> heinousness of killing <br> the messenger.</td>
						</tr>
					</table>

					<h3>Okonkwo's effect</h3>
					<p>Do Okonkwo's actions cause negative consequences beyond Okonkwo?</p>
					<table cellpadding="10">
						<tr>
							<td colspan="2"><input type="range" name="tfaSpiral" min="0" max="100" step="1" style="width: 100%;"></td>
							<td id="tfaSpiralOutput" class="valueOutput"></td>
						</tr>
						<tr>
							<td>|</td>
							<td style="text-align: right">|</td>
						</tr>
						<tr>
							<td>No: after he killed the <br> messenger, everyone <br> else was not convinced <br> that it was justified.</td>
							<td>Yes: [TODO: FIGURE THIS OUT]</td>
						</tr>
					</table>


					<h2><i>Othello</i></h2>
					<h3>Othello as a Tragic Hero</h3>
					<p>Does Othello have a high social status?</p>
					<table cellpadding="10">
						<tr>
							<td colspan="3"><input type="range" name="othTragHero1" min="0" max="100" step="1" style="width: 100%;"></td>
							<td id="othTragHero1Output" class="valueOutput"></td>
						</tr>
						<tr>
							<td>|</td>
							<td style="text-align: right">|</td>
						</tr>
						<tr>
							<td>No</td>
							<td style="text-align: right;">Yes</td>
						</tr>
					</table>
					<p>Does Othello have flaw that leads to his downfall?</p>
					<table cellpadding="10">
						<tr>
							<td colspan="3"><input type="range" name="othTragHero2" min="0" max="100" step="1" style="width: 100%;"></td>
							<td id="othTragHero2Output" class="valueOutput"></td>
						</tr>
						<tr>
							<td>|</td>
							<td style="text-align: right">|</td>
						</tr>
						<tr>
							<td>No</td>
							<td style="text-align: right;">Yes</td>
						</tr>
					</table>

					<h3>Othello's choice and <i>peripetea</i></h3>
					<p>Does Othello make a choice that causes his downfall?</p>
					<table cellpadding="10">
						<tr>
							<td colspan="3"><input type="range" name="othPerip" min="0" max="100" step="1" style="width: 100%;"></td>
							<td id="othPeripOutput" class="valueOutput"></td>
						</tr>
						<tr>
							<td>|</td>
							<td style="text-align: right">|</td>
						</tr>
						<tr>
							<td>No</td>
							<td style="text-align: right;">Yes</td>
						</tr>
					</table>

					<h3>Othello's <i>anagnoresis</i></h3>
					<p>Does Othello realize his mistake? (I'm pretty sure we won't see much variance on this answer.)</p>
					<table cellpadding="10">
						<tr>
							<td colspan="3"><input type="range" name="othAnag" min="0" max="100" step="1" style="width: 100%;"></td>
							<td id="othAnagOutput" class="valueOutput"></td>
						</tr>
						<tr>
							<td>|</td>
							<td style="text-align: right">|</td>
						</tr>
						<tr>
							<td>No</td>
							<td style="text-align: right;">Yes</td>
						</tr>
					</table>

					<h3>Othello's effect on others</h3>
					<p>Are innocent people affected by Othello's mistakes? (again, not too much variance)</p>
					<table cellpadding="10">
						<tr>
							<td colspan="3"><input type="range" name="othSpiral" min="0" max="100" step="1" style="width: 100%;"></td>
							<td id="othSpiralOutput" class="valueOutput"></td>
						</tr>
						<tr>
							<td>|</td>
							<td style="text-align: right">|</td>
						</tr>
						<tr>
							<td>No</td>
							<td style="text-align: right;">Yes</td>
						</tr>
					</table>
			</div>
			<hr>
		</div>
		<div id="mid">
			<button type="button" id="calcScoresButton" onclick="step1to2();">Calculate Scores</button>
			<button disabled type="button" id="backbutton" onclick="step2to1();">Go Back</button>
		</div>
		<div id="step2">
			
			<h1><i>Things Fall Apart</i></h2>
			<p id="tfaScoreOut"></p>
			<h1><i>Othello</i></h2>
			<p id="othScoreOut"></p>
			
			<input type="hidden" name="tfaScore" id="tfaScoreSubmit">
			<input type="hidden" name="othScore" id="othScoreSubmit">
			<input disabled type="submit" value="Submit these results!">
		</div>

	</form>
</body>
</html>