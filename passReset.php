<?php
include("core/coreHead.php");
if($_SESSION['loggedin'] != 'true') {
	
	$userToReset = mysql_real_escape_string($_POST['username']);
	
	$content .= "	
		<div class='title'>
			<h2>Password Reset</h2>
		</div>
	";
	
	if($_GET['action'] == '' || $userToReset == '' || $userToReset == 'username') {
		$content .= "
			<table>
			<form action='passReset.php?action=edit' method='post'>
				<tr>
					<td>Password Reset:</td>
					<td>
						<input type='text' name='username' value='Email Address' />
					</td>
				</tr>
				<tr>
					<td align='center'>
						<input type='submit' value='Send' />
					</td>
				</tr>
			</form>
			</table>
		";
	} elseif($_GET['action'] == 'edit') {
		$query = "SELECT * FROM `members` WHERE LOWER(email) = '" . strtolower($userToReset) . "';";
		$results=mysql_query($query);
		if (mysql_numrows($results) > 0)
		{
			$to = mysql_result($results, 0, 'email');
			$subject = "BGUNDEAD.COM Login and Password";
			$message =  "Username: " . mysql_result($results, 0, 'email') . "\n";
			$message .= "Password: " . mysql_result($results, 0, 'password') . "\n";
			$headers = "From: bgundead@gmail.com" . "\r\n" .
						"Reply-To: bgundead@gmail.com" . "\r\n" .
						"X-Mailer: PHP/" . phpversion();
			
			if (mail($to, $subject, $message, $headers))
			{
				$content .= "Your password has been sent to " . $userToReset;
			}
			else
			{
				$content .= "Mailing Failed";
			}
		}
		else
		{
			$content .= "No such user";
		}
	}
}
include("core/coreFoot.php");
?>
