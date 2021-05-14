<?php
include("core/coreHead.php");

if ($_SESSION['loggedin'] == 'true') {
	if ($_SESSION['rules'] == 0) {
		$content .= "
			<h2>YOU MUST COMPLETE THIS WAIVER BEFORE YOU MAY REGISTER FOR THIS SEMESTER'S GAME.</h2>
		";
	}
}

$content .= "
	<font face='verdana' color='white'>
		<big><big>
			<b>Waiver of Responsibility</b>
		</big></big>
		<br> 
		I have read the game <a href='rules.php' target='_blank'>rules</a> and I acknowledge that the organization (BG Undead) and those associated are not 
		responsible for my actions during play of the bi-yearly game of Humans Vs. Zombies.  By clicking this button 
		I agree to abide by the rules and that I take complete responsibility for any damage to myself, others, and
		any property I may incur.
	</font>
";

if ($_SESSION['loggedin'] == 'true') {
	if ($_SESSION['rules'] == 0) {
		$content .= "
			<br /><br /><br />
			<form action='setRules.php' method='post'>
			<input type='hidden' name='check' value='true' />
			<input type='submit' value='I Hereby Agree To This Waiver' />
			</form>	
		";
	}
}

include("core/coreFoot.php");
?>