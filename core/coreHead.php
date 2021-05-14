<?php
/*function MakeFeed() {
	$query = "SELECT news.nid, news.title, news.story, news.time, news.mid, members.handle FROM `news` LEFT JOIN `members` ON news.mid = members.mid ORDER BY time ASC LIMIT 10;";
	$news = mysql_query($query);
	$numNews = mysql_num_rows($news);
	
	$myFile = "news.xml";
	$fh = fopen($myFile, 'w') or die("can't open file");
	
	fwrite($fh, "<?xml version='1.0' encoding='ISO-8859-1' ?>"."\r\n");
	fwrite($fh, "<rss version='2.0'>"."\r\n");
	fwrite($fh, ""."\r\n");
	fwrite($fh, "<channel>"."\r\n");
	
	$titleLine = "<title>\r\nBG UNDEAD NEWS\r\n</title>";
	$linkLinr = "<link>\r\nhttp://www.bgundead.com\r\n</link>";
	$descLine = "<description>\r\nYour source for all things unholy.\r\n</description>";
	
	fwrite($fh, $titleLine."\r\n");
	fwrite($fh, $linkLine."\r\n");
	fwrite($fh, $descLine."\r\n");
	
	for($i=0; $i<$numNews; $i++) {
		$titleLine = "<title>\r\n" . mysql_result($news, $i, 'title') . "\r\n</title>";
		$linkLinr = "<link>\r\nhttp://www.bgundead.com</link>";
		$descLine = "<description>\r\n" . mysql_result($news, $i, 'story') . "</description>";
		
		fwrite($fh, "<item>"."\r\n");
		fwrite($fh, $titleLine."\r\n");
		fwrite($fh, $linkLine."\r\n");
		fwrite($fh, $descLine."\r\n");
		fwrite($fh, "</item>"."\r\n");
	}
	
	fwrite($fh, "</channel>"."\r\n");
	fwrite($fh, "</rss>"."\r\n");
	fclose($fh);
}*/

mysql_connect(localhost, "bgundead", "@aG2Asd5#aS28asFB");
//mysql_connect(localhost, "root", "");
@mysql_select_db("bgundead") or die( "Unable to select database");
session_start();
$content = "";
$sidebar = "";
$ads = "";

// Start adding to head
$head .= "
<title>BG UNDEAD</title>
<link href='default.css' rel='stylesheet' type='text/css' media='screen' />
"; // End adding to head
// Start adding to header
$header .= "
<div id='wrapper'>
	<div id='header'>
		<div id='logo'><h1>BG UNDEAD</h1></div>
	</div>";

$query = "SELECT * FROM `events` WHERE end > '" . time() . "' AND type = 'G' ORDER BY start LIMIT 1;";
$curgames=mysql_query($query);
$numCurgames = mysql_numrows($curgames);

$menu .= "
<div id='menu'>
	<ul>
		<li><a href='index.php'>Home</a></li>
		<li><a href='events.php'>Events</a></li>
";
if ($numCurgames > 0) {
	if($numCurgames > 0 && mysql_result($curgames, 0, 'start') < time()) {
		$menu .= "<li><a href='curgame.php'>Current Game</a></li>";
	}
	if ($_SESSION['admin'] == 'true') {
		$adminPanel .= "
			<a href='editCurgame.php'>Admin Game Panel</a><br />
			<a href='curEmails.php'>Current Email List</a><br />
			<a href='zombiefood.php'>Add Zombie Food</a><br />
		";
	}
}
$menu .= "
		<li><a href='rules.php'>Rules</a></li>
		<li><a href='constitution.pdf'>Constitution</a></li>
		<li><a href='contact.php'>Contact</a></li>
		<li><a href='heatBlue.php'>Heat Map</a></li>
	</ul>
</div>
";

$_SESSION['loggedin'] = 'false';
$_SESSION['admin'] = 'false';

if($_GET["loggingin"] != "")
{
	$_SESSION["username"] = $_POST["username"];
	$_SESSION["password"] = $_POST["password"];
	$toGo = basename(substr($_SERVER['PHP_SELF'], 1)) == "register.php" ? "index.php" : basename(substr($_SERVER['PHP_SELF'], 1));
	header('Location: ' . $toGo, 1);
}
if($_GET["loggingout"] != "")
{
	session_destroy();
	header('Location: index.php');
	
}

if($_SESSION["username"] != "")
{
	$query = "SELECT * FROM `members`, `res_hall` WHERE members.rid = res_hall.rid AND email = '" . $_SESSION["username"] . "' AND password = '" . $_SESSION["password"] . "' LIMIT 1;";
	$results=mysql_query($query);
	$numRows=mysql_numrows($results);
	if( $numRows > 0 )
	{
		$_SESSION['loggedin'] = 'true';
		$_SESSION["name"] = mysql_result($results, 0, "fname") . " " . mysql_result($results, 0, "lname");
		$_SESSION["clan"] = mysql_result($results, 0, "clan");
		$_SESSION["handle"] = mysql_result($results, 0, "handle");
		$_SESSION["mid"] = mysql_result($results, 0, "mid");
		$_SESSION["rid"] = mysql_result($results, 0, "rid");
		$_SESSION["rules"] = mysql_result($results, 0, "read_rules");
		if (mysql_result($results, 0, "admin") > 0)
		{
			$_SESSION['admin'] = 'true';
		}
	}
	if($_SESSION['loggedin'] == 'false') {
		$ads .= "Invalid user/pass combo";
	}
}
if($_SESSION["rules"] == '0' && basename(substr($_SERVER['PHP_SELF'], 1)) != "waiver.php") {
	header('Location: waiver.php');
}
if($_SESSION['loggedin'] == 'false')
{
	$current_page = basename(substr($_SERVER['PHP_SELF'], 1));
	$ads .= "
		<table>
		<form action='" . $current_page . "?loggingin=true' method='post'>
			<tr>
				<td>Email:</td>
				<td><input type='text' name='username' /></td>
			</tr>
			<tr>
				<td>Pass:</td>
				<td><input type='password' name='password' /></td>
			</tr>
			<tr>
				<td colspan='2'><center><input type='submit' value='Log In' /> - <a href='register.php'>Register</a></center></td>
			</tr>
			<tr>
				<td colspan='2' align='right'><small><a href='passReset.php'>Forgot Password?</a></small></td>
			</tr>
		</form>
		</table>
	";
} else {
	$ads .= "<h3><small>Welcome " . $_SESSION["handle"] . "</small></h3><p><small>";
	
	if ($_SESSION['admin'] == 'true') {
		$adminPanel .= "
		<br /><a href='roster.php'>Org Roster</a>
		<br /><a href='addNews.php'>Add News</a>
		<br /><a href='addEvent.php'>Add Event</a>
		<br /><a href='dorms.php'>Res Halls</a>
		<br /><br />";
	}
	
	$ads .= $adminPanel . "
		<a href='register.php?action=edit'>Edit Profile</a><br />
		<a href='index.php?loggingout=true'>Log Out</a></small></p>";
	
	if ($numCurgames > 0) {
		$CU = mysql_query("SELECT * FROM `game_op` WHERE active = '1' AND eid = '" . mysql_result($curgames, 0, 'eid') . "' AND mid = '" . $_SESSION["mid"] . "';");
		$num_CU = mysql_numrows($CU);
		
		if ($num_CU > 0 && mysql_result($CU, 0, 'status') == "H") {
			$ads .= "<strong><center><span style='color: white;'>TAG CODE:<br />" . mysql_result($CU, 0, 'killcode') . "</span></center></strong>";
			$ads .= "<form action='../card.php' method='post'>
						<input type='hidden' name='name' value='" . $_SESSION['name'] . "' />
						<input type='hidden' name='handle' value='" . $_SESSION['handle'] . "' />
						<input type='hidden' name='clan' value='" . $_SESSION['clan'] . "' />
						<input type='hidden' name='code' value='" . mysql_result($CU, 0, 'killcode') . "' />
						<input type='submit' value='Get Card' />
					</form>";
		} elseif ($num_CU > 0 && mysql_result($CU, 0, 'status') != "H") {
			$ads .= "<strong>UR A ZOMBIE!</strong>";
		}
	}
}
?>
