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

		function inputToResults() {
			$("#dataInput input").prop('readonly', true);

			$("#calcScoresButton").fadeOut({complete: function() {
				$("#backbutton").fadeIn();
			}});
			calculateScores();

			$("#results").animate({opacity: 1});
		}
		function resultsBackToInput() {
			$("#dataInput input").prop('readonly', false);

			$("#backbutton").fadeOut({complete: function() {
				$("#calcScoresButton").fadeIn();
			}});

			
			$("#results").css("opacity", 0);
		}
	</script>

	<!-- Bootstrap -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

	<style>
		html, body {
			height: 100%;
		}
		#resultContainter {
			min-height: 100%;
		}
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

		.rt-al {
			text-align: right;
		}
		#upperRightButtons {
			position: fixed;
			right: 10px;
			top: 10px;
		}

		#successMsg {
			color: green;
		}
	</style>
</head>
<body class="container-fluid">

	<div id="intro" class="jumbotron">
		<h1><a href="index.html">The Tragic Voter</a></h1>
		<h2>Give your input.</h2>

		<div id="navButtons">
			<a href="#componentImportance" class="btn btn-primary">What defines a tragedy?</a>
			<a href="#evalTfa" class="btn btn-primary">Is <i>Things Fall Apart</i> a tragedy?</a>
			<a href="#evalOth"class="btn btn-primary">Is <i>Othello</i> a tragedy?</a>
		</div>

		<h3 id="successMsg" <?php if (!$isPost) echo "hidden";?>>Your results have been submitted!</h3>
	</div>

	<div id="upperRightButtons">
		<a href="#resultContainter" class="btn btn-warning" id="calcScoresButton" onclick="inputToResults(); return true;">Calculate Scores</a>
		<a href="#"      class="btn btn-danger"  id="backbutton"       onclick="resultsBackToInput();" style="display: none;">Go Back</a>
	</div>

	<form method="POST">
		<div id="dataInput">
			<div id="componentImportance">
				<h1 class="row col-xs-12">What defines a tragedy?</h1>
				<p class="row col-xs-12">How important do you think each component is?</p>
				
				<div class="row">
					<h2 class="col-sm-6">Tragic Hero</h2>
					<h2 class="col-sm-6">Hero's Choice and <i>Peripetea</i></h2>
				</div>
					
				<div class="row">
					<p class="col-sm-6">A tragic hero is someone of great social importance who has admirable traits, which eventually cause his downfall.</p>
					<p class="col-sm-6">This hero makes a choice that eventually leads to his downfall. This choice causes unforeseen events (the <i>peripetea</i>).</p>
				</div>

				<div class="row">
					<div class="col-sm-5">
						<input type="range" name="tragHeroImportance" min="0" max="100" step="1" style="width: 100%;">
					</div>
					<div id="tragHeroImportanceOutput" class="valueOutput col-sm-1"></div>

					<div class="col-sm-5"><input type="range" name="peripImportance" min="0" max="100" step="1" style="width: 100%;"></div>
					<div id="peripImportanceOutput" class="valueOutput col-sm-1"></div>
				</div>
				<div class="row">
					<div class="distrib3 col-sm-5">
						<div>|</div><div>|</div><div>|</div>
					</div>
					<div class="distrib3 col-sm-5 col-sm-offset-1">
						<div>|</div><div>|</div><div>|</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-2">not really necessary</div>
					<div class="col-sm-2">good to have, but not having isn't a deal-breaker.</div>
					<div class="col-sm-1">essential</div>

					<div class="col-sm-2 col-sm-offset-1">not really necessary</div>
					<div class="col-sm-2">good to have, but not having isn't a deal-breaker.</div>
					<div class="col-sm-1">essential</div>
				</div>

				<div class="row">
					<h2 class="col-sm-6"><i>Anagnorisis</i></h2>
					<h2 class="col-sm-6">Spiraling Out of Control</h2>
				</div>
					
				<div class="row">
					<p class="col-sm-6">The hero realizes his mistake and its effects.</p>
					<p class="col-sm-6">Everyone, not just the hero, but other innocent people are affected.</p>
				</div>

				<div class="row">
					<div class="col-sm-5">
						<input type="range" name="anagImportance" min="0" max="100" step="1" style="width: 100%;">
					</div>
					<div id="anagImportanceOutput" class="valueOutput col-sm-1"></div>

					<div class="col-sm-5"><input type="range" name="spiralImportance" min="0" max="100" step="1" style="width: 100%;"></div>
					<div id="spiralImportanceOutput" class="valueOutput col-sm-1"></div>
				</div>
				<div class="row">
					<div class="distrib3 col-sm-5">
						<div>|</div><div>|</div><div>|</div>
					</div>
					<div class="distrib3 col-sm-5 col-sm-offset-1">
						<div>|</div><div>|</div><div>|</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-2">not really necessary</div>
					<div class="col-sm-2">good to have, but not having isn't a deal-breaker.</div>
					<div class="col-sm-1">essential</div>

					<div class="col-sm-2 col-sm-offset-1">not really necessary</div>
					<div class="col-sm-2">good to have, but not having isn't a deal-breaker.</div>
					<div class="col-sm-1">essential</div>
				</div>
			</div>
			<hr>
			<div id="evalTfa">
				<h1 class="row col-xs-12">Is <i>Things Fall Apart</i> a tragedy?</h1>
				<h2 class="row col-xs-12">Okonkwo as a Tragic Hero</h2>
				
				<div class="row">
					<h4 class="col-sm-6">Does he have a high social status is Umofia?</h4>
					<h4 class="col-sm-6">To what degree do Okonkwo's flaws contribute to his downfall?</h4>
				</div>
				<div class="row">
					<div class="col-sm-5">
						<input type="range" name="tragHeroTfa1" min="0" max="100" step="1" style="width: 100%;">
					</div>
					<div id="tragHeroTfa1Output" class="valueOutput col-sm-1"></div>

					<div class="col-sm-3 rt-al">Stubbornness</div>
					<div class="col-sm-2">
						<input type="range" class="okFlaw" name="stubbornDownfall" min="0" max="100" step="1" value="25" style="width: 100%;">
					</div>
					<div id="stubbornDownfallOutput" class="valueOutput col-sm-1"></div>
				</div>
				<div class="row">
					<div class="col-sm-1" style="text-align: left;">|</div>
					<div class="col-sm-1 col-sm-offset-3" style="text-align: right;">|</div>

					<div class="col-sm-3 col-sm-offset-1 rt-al">Aggression</div>
					<div class="col-sm-2">
						<input type="range" class="okFlaw" name="aggressionDownfall" min="0" max="100" step="1" value="25" style="width: 100%;">
					</div>
					<div id="aggressionDownfallOutput" class="valueOutput col-sm-1"></div>
				</div>
				<div class="row">
					<div class="col-sm-1" style="text-align: left;">No</div>
					<div class="col-sm-1 col-sm-offset-3" style="text-align: right;">Yes</div>

					<div class="col-sm-3 col-sm-offset-1 rt-al">Harshness</div>
					<div class="col-sm-2">
						<input type="range" class="okFlaw" name="harshnessDownfall" min="0" max="100" step="1" value="25" style="width: 100%;">
					</div>
					<div id="harshnessDownfallOutput" class="valueOutput col-sm-1"></div>
				</div>
				<div class="row">
					<div class="col-sm-3 col-sm-offset-6 rt-al">Other factors (not Okonkwo's flaws)</div>
					<div class="col-sm-2"><input type="range" class="okFlaw" name="otherDownfall" min="0" max="100" step="1" value="25" style="width: 100%;"></div>
					<div id="otherDownfallOutput" class="valueOutput col-sm-1"></div>
				</div>

				<div class="row">
					<h2 class="col-sm-6">Okonkwo's choice and <i>peripetea</i></h2>
					<h2 class="col-sm-6">Okonkwo's <i>anagnoresis</i></h2>
				</div>
				<div class="row">
					<h4 class="col-sm-6">Does Okonkwo make a choice that causes a shift from glory to decline? If so, which is it?</h4>
					<h4 class="col-sm-6">Does Okonkwo ever realize his mistake?</h4>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<input type="radio" name="tfaPeri" value="peripReject">
						&nbsp;
						Rejecting Nwoye's conversion to Christianity
					</div>

					<div class="col-sm-5">
						<input type="range" name="tfaAnag" min="0" max="100" step="1" style="width: 100%;">
					</div>
					<div id="tfaAnagOutput" class="valueOutput col-sm-1"></div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<input type="radio" name="tfaPeri" value="peripExecute">
						&nbsp;
						Executing Ikemefuna
					</div>

					<div class="col-sm-5 distrib3">
						<div>|</div><div>|</div><div>|</div>
					</div>
				</div>
				<div class="row">

					<div class="col-sm-5">
						<input type="radio" name="tfaPeri" value="peripKilling">
						&nbsp;
						Killing the messenger
						<br>
						<input type="radio" name="tfaPeri" value="peripNoChoice">
						&nbsp;
						There is no such choice.
					</div>

					<div class="col-sm-2" style="text-align: right;  ">No: He never thinks he himself is mistaken; he thinks everyone else in Umofia is.</div>
					<div class="col-sm-2" style="text-align: right;">Maybe: He realizes that he cannot live in the new Umofia, regardless of who is actually right.</div>
					<div class="col-sm-2" style="text-align: right; ">Yes: He commits suicide because he realized the heinousness of killing the messenger.</div>
				</div>
				
				<h2 class="row col-xs-12">Okonkwo's effect</h2>
				<div class="row">
					<h4 class="col-sm-6">Do Okonkwo's actions cause negative consequences beyond Okonkwo?</h4>
				</div>
				<div class="row">
					<div class="col-sm-5">
						<input type="range" name="tfaSpiral" min="0" max="100" step="1" style="width: 100%;">
					</div>
					<div id="tfaSpiralOutput" class="valueOutput col-sm-1"></div>
				</div>
				<div class="row">
					<div class="col-sm-1">|</div>
					<div class="col-sm-1 col-sm-offset-3 rt-al">|</div>
				</div>
				<div class="row">
					<div class="col-sm-6 row">
						<div class="col-sm-6">No: the last remark about how his story was only a paragraph in a book demonstrated this. </div>
						<div class="col-sm-5 rt-al">Yes: he was well-respected in Umofia and his death is a loss for everyone.</div>
					</div>
				</div>
			</div>
			<hr>
			<div id="evalOth">
				<h1 class="row col-xs-12">Is <i>Othello</i> a tragedy?</h1>
				<h2 class="row col-xs-12">Othello as a Tragic Hero</h2>
				<div class="row">
					<h4 class="col-sm-6">Does Othello have a high social status?</h4>
					<h4 class="col-sm-6">Does Othello have flaw that leads to his downfall?</h4>
				</div>
				<div class="row">
					<div class="col-sm-5">
						<input type="range" name="othTragHero1" min="0" max="100" step="1" style="width: 100%;">
					</div>
					<div id="othTragHero1Output" class="valueOutput col-sm-1"></div>
					
					<div class="col-sm-5">
						<input type="range" name="othTragHero2" min="0" max="100" step="1" style="width: 100%;">
					</div>
					<div id="othTragHero2Output" class="valueOutput col-sm-1"></div>
				</div>
				<div class="row">
					<div class="col-sm-1">|</div>
					<div class="col-sm-1 col-sm-offset-3 rt-al">|</div>

					<div class="col-sm-1 col-sm-offset-1">|</div>
					<div class="col-sm-1 col-sm-offset-3 rt-al">|</div>
				</div>
				<div class="row">
					<div class="col-sm-1">No</div>
					<div class="col-sm-1 col-sm-offset-3 rt-al">Yes</div>
					
					<div class="col-sm-1 col-sm-offset-1">No</div>
					<div class="col-sm-1 col-sm-offset-3 rt-al">Yes</div>
				</div>

				<div class="row">
					<h2 class="col-sm-6">Othello's choice and <i>peripetea</i></h2>
					<h2 class="col-sm-6">Othello's <i>anagnoresis</i></h2>
				</div>
				<div class="row">
					<h4 class="col-sm-6">Does Othello make a choice that causes his downfall?</h4>
					<h4 class="col-sm-6">Does Othello realize his mistake? (I'm pretty sure we won't see much variance on this answer.)</h4>
				</div>
				<div class="row">
					<div class="col-sm-5">
						<input type="range" name="othPerip" min="0" max="100" step="1" style="width: 100%;">
					</div>
					<div id="othPeripOutput" class="valueOutput col-sm-1"></div>

					<div class="col-sm-5">
						<input type="range" name="othAnag" min="0" max="100" step="1" style="width: 100%;">
					</div>
					<div id="othAnagOutput" class="valueOutput col-sm-1"></div>
				</div>
				<div class="row">
					<div class="col-sm-1">|</div>
					<div class="col-sm-1 col-sm-offset-3 rt-al">|</div>

					<div class="col-sm-1 col-sm-offset-1">|</div>
					<div class="col-sm-1 col-sm-offset-3 rt-al">|</div>
				</div>
				<div class="row">
					<div class="col-sm-1">No</div>
					<div class="col-sm-1 col-sm-offset-3 rt-al">Yes</div>

					<div class="col-sm-1 col-sm-offset-1">No</div>
					<div class="col-sm-1 col-sm-offset-3 rt-al">Yes</div>
				</div>

				<div class="row">
					<h2 class="col-sm-6">Othello's effect on others</h2>
				</div>
				<div class="row">
					<h4 class="col-sm-6">Are innocent people affected by Othello's mistakes? (again, not too much variance)</h4>
				</div>
				<div class="row">
					<div class="col-sm-5">
						<input type="range" name="othSpiral" min="0" max="100" step="1" style="width: 100%;">
					</div>
					<div id="othSpiralOutput" class="valueOutput col-sm-1"></div>
				</div>
				<div class="row">
					<div class="col-sm-1">|</div>
					<div class="col-sm-1 col-sm-offset-3 rt-al">|</div>
				</div>
				<div class="row">
					<div class="col-sm-1">No</div>
					<div class="col-sm-1 col-sm-offset-3 rt-al">Yes</div>
				</div>
			</div>
			<hr>
		</div>
		
		<div id="resultContainter">
			<h1>Results</h1>
			<div id="results" style="opacity: 0;">
				<h3>
					<i>Things Fall Apart</i>:
					<span id="tfaScoreOut"></span>
				</h3>
				
				<h3>
					<i>Othello</i>:
					<span id="othScoreOut"></span>
				</h3>
				
				<input type="hidden" name="tfaScore" id="tfaScoreSubmit">
				<input type="hidden" name="othScore" id="othScoreSubmit">
				<input type="submit" class="btn btn-success" value="Submit these results!">
			</div>

		</div>

	</form>
</body>
</html>