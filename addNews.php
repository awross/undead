<?php
include("core/coreHead.php");
if ($_SESSION['admin'] == 'true') {
	if($_GET['action'] == 'edit') {
		$result = mysql_query("SELECT * FROM `news` WHERE nid = '" . $_GET['nid'] . "' LIMIT 1;");
		
		$content .= "
			<h2>Edit Post</h2><br />
			<form action='addNews.php?action=editsubmit&nid=" . $_GET['nid'] . "' method='post'>
			<table>
				<tr><td>Title</td><td><input type='text' size='80' name='title' value='" . mysql_result($result, 0, 'title') . "' /></td></tr>
				<tr><td>Post</td><td></td></tr><tr><td colspan='2'><textarea cols='80' rows='6' name='story'>" . mysql_result($result, 0, 'story') . "</textarea></td></tr>
				<tr><td><input type='submit' value='Edit News Post' /></td><td> </td></tr>
			</table>
			</form>
		";
	} elseif ($_GET['action'] == 'editsubmit') {	
		$result = mysql_query("SELECT * FROM `news` WHERE nid = '" . $_GET['nid'] . "' LIMIT 1;");
		
		if ($_POST['title'] != mysql_result($result, 0, 'title')) {
			mysql_query("UPDATE `news` SET title = '" . $_POST['title'] . "' WHERE nid = '" . $_GET['nid'] . "';");
			$content .= "Title updated, it is now " . $_POST['title'] . ".</br>";
		}
		if ($_POST['story'] != mysql_result($result, 0, 'story')) {
			mysql_query("UPDATE `news` SET story = '" . $_POST['story'] . "' WHERE nid = '" . $_GET['nid'] . "';");
			$content .= "Post updated, it is now:<br />'" . $_POST['story'] . ".'</br>";
		}
		
		$head .= "<meta http-equiv='refresh' content='2; URL=index.php'>";
	} elseif ($_GET['action'] == '' || $_POST['title'] == '' || $_POST['story'] == '') {
		$result = mysql_query("SELECT * FROM `news` WHERE nid = '" . $_GET['nid'] . "' LIMIT 1;");
		
		$content .= "
			<h2>Add News</h2><br />
			<form action='addNews.php?action=submit' method='post'>
			<table>
				<tr><td>Title</td><td><input type='text' name='title' size='25' name='name' value='" . $_POST['title'] . "' /></td></tr>
				<tr><td>Post</td><td><textarea cols='80' rows='6' name='story'>" . $_POST['story'] . "</textarea></td></tr>
				<tr><td><input type='submit' value='Add News Post' /></td><td> </td></tr>
			</table>
			</form>
		";
	} elseif ($_GET['action'] == 'submit' && $_POST['title'] != '' && $_POST['story'] != '') {
		mysql_query("INSERT INTO `news` (title, story, time, mid) VALUES ('" . addslashes($_POST['title']) . "', '" . addslashes($_POST['story']) . "', '" . time() . "', '" . $_SESSION['mid'] . "');");
		
		$twitter_api_url = "http://twitter.com/statuses/update.xml";	
		$twitter_data = "status=" . strip_tags($_POST['title']) . " : " . strip_tags($_POST['story']);
		$twitter_data = substr($twitter_data, 0, 134);
		$twitter_data .= " #HvZ";
		
		//$content .= $twitter_data;
		
		$twitter_user = "bgundead";
		$twitter_password = "boxcar187";
		$ch = curl_init($twitter_api_url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $twitter_data);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERPWD, "{$twitter_user}:{$twitter_password}");
		$twitter_data = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if ($httpcode != 200) {
			$content .= "<strong>Error - But its All Good</strong> Something went wrong, and the tweet wasn't posted correctly.";
		}
		
		$content .= "Added successfully!";
		$head .= "<meta http-equiv='refresh' content='2; URL=index.php'>";
	}
}
include("core/coreFoot.php");

?>