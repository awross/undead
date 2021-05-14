<?php
// Start footer
$footer .= "
<div id='footer'>
	<p class='legal'>
		&copy;2007 Night Vision. All Rights Reserved.
		&nbsp;&nbsp;&bull;&nbsp;&nbsp;
		Design by <a href='http://www.freecsstemplates.org/'>Free CSS Templates</a>
	</p>
</div>

</div> <!-- END wrapper div -->

</body>";
// End footer
echo "<head>";
echo $head;
echo "</head><body><div id='outerMost'>";
echo $header, $menu;
echo "<div id='page'>";
echo "<div id='ads'>";
echo $ads;
echo "</div><!-- End Ads -->";
echo "<div id='content'>";
echo $content;
echo "</div><!-- End Content -->";
echo "<div id='sidebar'>";
echo $sidebar;
echo "</div><!-- End Sidebar -->";
echo "</div><!-- End Page -->";
echo $footer;
echo "</div></body>";
echo "</body>";
mysql_close();
?>