<html>
<head>
	<title>The Tragic Voter</title>
</head>
<body>
	<h1>The Tragic Voter</h1>
	<h2>Give your input.</h2>

	<hr>
	<form method="POST">
		<div>
		
			<h1>Components of Tragedy</h1>
			How important do you think each component is?  <a href="https://pcds.instructure.com/courses/484/files/8690/download?wrap=1">Source</a>.
			<h2>Tragic Hero</h2>
			<p>A tragic hero is someone of great social importance who has admirable traits, which eventually cause his downfall.</p>
			<table cellpadding="10">
				<tr>
					<td colspan="3"><input type="range" name="tragHeroImportance" min="0" max="100" step="1" style="width: 100%;"></td>
				</tr>
				<tr>
					<td style="text-align: left;">|</td>
					<td style="text-align: center;">|</td>
					<td style="text-align: right;">|</td>
				</tr>
				<tr>
					<td>It's not really necessary</td>
					<td>It's good to have, but not having it isn't a dealbreaker.</td>
					<td>It's essential.</td>
				</tr>
			</table>

			<h2>Hero's Choice and <i>Peripetea</i></h2>
			<p>This hero makes a choice that eventually leads to his downfall. This choice causes unforeseen events (the <i>peripetea</i>).</p>
			<table cellpadding="10">
				<tr>
					<td colspan="3"><input type="range" name="peripImportance" min="0" max="100" step="1" style="width: 100%;"></td>
				</tr>
				<tr>
					<td style="text-align: left;">|</td>
					<td style="text-align: center;">|</td>
					<td style="text-align: right;">|</td>
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
				</tr>
				<tr>
					<td style="text-align: left;">|</td>
					<td style="text-align: center;">|</td>
					<td style="text-align: right;">|</td>
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
				</tr>
				<tr>
					<td style="text-align:   left;">|</td>
					<td style="text-align: center;">|</td>
					<td style="text-align:  right;">|</td>
				</tr>
				<tr>
					<td>It's not really necessary</td>
					<td>It's good to have, but not having it isn't a dealbreaker.</td>
					<td>It's essential.</td>
				</tr>
			</table>

		</div>
		<hr>
		<div>
			<h1>Evaluate the Literature</h1>
			<h2><i>Things Fall Apart</i></h2>
				<h3>Okonkwo as a Tragic Hero</h3>
				<p>Does he have a high social status is Umofia?</p>
				<table cellpadding="10">
					<tr>
						<td colspan="3"><input type="range" name="spiralImportance" min="0" max="100" step="1" style="width: 100%;"></td>
					</tr>
					<tr>
						<td style="text-align:   left;">|</td>
						<td style="text-align: center;"></td>
						<td style="text-align:  right;">|</td>
					</tr>
					<tr>
						<td>Yes</td>
						<td>(grey area)</td>
						<td>No</td>
					</tr>
				</table>

				<p>To what degree do Okonkwo's flaws contribute to his downfall?</p>
				<!-- TODO: ensure fields always sum to 100 -->
				<table cellpadding="10">
					<tr>
						<td>Stubbornness</td>
						<td><input type="range" name="stubbornDownfall" min="0" max="100" step="1" value="25" style="width: 100%;"></td>
					</tr>
					<tr>
						<td>Aggression</td>
						<td><input type="range" name="aggressionDownfall" min="0" max="100" step="1" value="25" style="width: 100%;"></td>
					</tr>
					<tr>
						<td>Harshness</td>
						<td><input type="range" name="aggressionDownfall" min="0" max="100" step="1" value="25" style="width: 100%;"></td>
					</tr>
					<tr>
						<td>other factors (not Okonkwo's flaws)</td>
						<td><input type="range" name="aggressionDownfall" min="0" max="100" step="1" value="25" style="width: 100%;"></td>
					</tr>
				</table>

				<h3>Okonkwo's choice and <i>peripetea</i></h3>
				<p>Does Okonkwo make a choice that causes the shift from glory to decline? If so, which is it?</p>
				<table>
					<tr>
						<td><input type="radio" name="tfaPeri"></td>
						<td>Rejecting Nwoye's conversion to Christianity</td>
					</tr>
					<tr>
						<td><input type="radio" name="tfaPeri"></td>
						<td>Executing Ikemefuna</td>
					</tr>
					<tr>
						<td><input type="radio" name="tfaPeri"></td>
						<td>Killing the messenger</td>
					</tr>
					<tr>
						<td><input type="radio" name="tfaPeri"></td>
						<td>there is no such choice</td>
					</tr>
				</table>

				<h3>Okonkwo's <i>agnoresis</i></h3>
				<p>Does Okonkwo ever realize his mistake?</p>
				<table cellpadding="10">
					<tr>
						<td colspan="3"><input type="range" name="tfaAnag" min="0" max="100" step="1" style="width: 100%;"></td>
					</tr>
					<tr>
						<td style="text-align: left;">|</td>
						<td style="text-align: center;">|</td>
						<td style="text-align: right;">|</td>
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
						<td colspan="3"><input type="range" name="tfaAnag" min="0" max="100" step="1" style="width: 100%;"></td>
					</tr>
					<tr>
						<td style="text-align: left;">|</td>
						<td style="text-align: center;">|</td>
						<td style="text-align: right;">|</td>
					</tr>
					<tr>
						<td>No: after he killed the <br> messenger, everyone <br> else was not convinced <br> that it was justified.</td>
						<td>(grey area)</td>
						<td>Yes: [TODO: FIGURE THIS OUT]</td>
					</tr>
				</table>


				<h2><i>Othello</i></h2>
				<h3>Othello as a Tragic Hero</h3>
				<p>Does Othello have a high social status?</p>
				<table cellpadding="10">
					<tr>
						<td colspan="3"><input type="range" name="spiralImportance" min="0" max="100" step="1" style="width: 100%;"></td>
					</tr>
					<tr>
						<td style="text-align:   left;">|</td>
						<td style="text-align: center;"></td>
						<td style="text-align:  right;">|</td>
					</tr>
					<tr>
						<td>Yes</td>
						<td>(grey area)</td>
						<td>No</td>
					</tr>
				</table>
				<p>Does Othello have flaw that leads to his downfall?</p>
				<table cellpadding="10">
					<tr>
						<td colspan="3"><input type="range" name="spiralImportance" min="0" max="100" step="1" style="width: 100%;"></td>
					</tr>
					<tr>
						<td style="text-align:   left;">|</td>
						<td style="text-align: center;"></td>
						<td style="text-align:  right;">|</td>
					</tr>
					<tr>
						<td>Yes</td>
						<td>(grey area)</td>
						<td>No</td>
					</tr>
				</table>

				<h3>Othello's choice and <i>peripetea</i></h3>
				<p>Does Othello make a choice that causes his downfall?</p>
				<table cellpadding="10">
					<tr>
						<td colspan="3"><input type="range" name="spiralImportance" min="0" max="100" step="1" style="width: 100%;"></td>
					</tr>
					<tr>
						<td style="text-align:   left;">|</td>
						<td style="text-align: center;"></td>
						<td style="text-align:  right;">|</td>
					</tr>
					<tr>
						<td>Yes</td>
						<td>(grey area)</td>
						<td>No</td>
					</tr>
				</table>

				<h3>Othello's <i>agnoresis</i></h3>
				<p>Does Othello realize his mistake? (I'm pretty sure we won't see much variance on this answer.)</p>
				<table cellpadding="10">
					<tr>
						<td colspan="3"><input type="range" name="spiralImportance" min="0" max="100" step="1" style="width: 100%;"></td>
					</tr>
					<tr>
						<td style="text-align:   left;">|</td>
						<td style="text-align: center;"></td>
						<td style="text-align:  right;">|</td>
					</tr>
					<tr>
						<td>Yes</td>
						<td>(grey area)</td>
						<td>No</td>
					</tr>
				</table>

				<h3>Othello's effect on others</h3>
				<p>Are innocent people affected by Othello's mistakes? (again, not too much variance)</p>
				<table cellpadding="10">
					<tr>
						<td colspan="3"><input type="range" name="spiralImportance" min="0" max="100" step="1" style="width: 100%;"></td>
					</tr>
					<tr>
						<td style="text-align:   left;">|</td>
						<td style="text-align: center;"></td>
						<td style="text-align:  right;">|</td>
					</tr>
					<tr>
						<td>Yes</td>
						<td>(grey area)</td>
						<td>No</td>
					</tr>
				</table>
		</div>
		<hr>
		<div>
			<input type="submit" value="Submit these results!">
		</div>

	</form>
</body>
</html>