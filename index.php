<?php
include("core/coreHead.php");

$query = "SELECT news.nid, news.title, news.story, news.time, news.mid, members.handle FROM `news` LEFT JOIN `members` ON news.mid = members.mid ORDER BY time DESC LIMIT 5;";
$news = mysql_query($query);
$numNews = mysql_num_rows($news);

for($i=0; $i<$numNews; $i++) {
	$content .= "
		<div class='post'>
			<div class='title'>
				<h2>" . mysql_result($news, $i, 'title') . "</h2>
				<p><small>Posted on " . date("F jS, Y", mysql_result($news, $i, 'time')) . " at " . date("Hi", mysql_result($news, $i, 'time')) . " by " . mysql_result($news, $i, 'handle') . "</small></p>
			</div>
			<div class='entry'>
				<p>
					<img src='images/img17.jpg' alt='' width='112' height='112' class='left' />
					" . stripslashes(mysql_result($news, $i, 'story')) . "
				</p>
			</div>
		</div>
	";
	if ($_SESSION['admin'] == 'true') {
		$content .= "<small><a href='addNews.php?action=edit&nid=" . mysql_result($news, $i, 'nid') . "'>EDIT</a> - <a href='delNews.php?nid=" . mysql_result($news, $i, 'nid') . "'>DELETE</a></small>";
	}
	$content .= "
		<hr>
	";
}

$sidebar .= "
<ul>
	<li id='categories'>
		<h2>Upcoming Events</h2>
		<ul>";
			$query = "SELECT * FROM `events` WHERE start > " . time() . " ORDER BY start ASC;";
			$events=mysql_query($query);
			$numRows=mysql_numrows($events);
			for($i = 0; $i < $numRows; $i++) {
				$sidebar .= "<li>" . mysql_result($events, $i, "title") . "</li>";
			}
$sidebar .= "
		</ul>
	</li>
</ul>
";
include("core/coreFoot.php");
?>
