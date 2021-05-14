<?php
echo "<img src='images/card.png' height='25%' width='25%'/>";
echo "<div style='position: absolute; top: 40px; left: 245px; '><b><u>HUMAN</u></b></div>";
echo "<div style='position: absolute; top: 80px; left: 225px; '>" . $_POST['name'] . "</div>";
echo "<div style='position: absolute; top: 120px; left: 225px; '> &nbsp; &nbsp;[" . $_POST['handle'] . "]</div>";
echo "<div style='position: absolute; top: 160px; left: 225px; '>" . $_POST['clan'] . "</div>";
echo "<div style='position: absolute; top: 200px; left: 225px; '>" . $_POST['code'] . "</div>";
echo "<br /><br /><br /><img src='images/card.png' height='25%' width='25%'/>";
echo "<div style='position: absolute; top: 350px; left: 245px; '><b><u>ZOMBIE</u></b></div>";
echo "<div style='position: absolute; top: 390px; left: 225px; '>" . $_POST['name'] . "</div>";
echo "<div style='position: absolute; top: 430px; left: 225px; '> &nbsp; &nbsp;[" . $_POST['handle'] . "]</div>";
echo "<div style='position: absolute; top: 470px; left: 225px; '>" . $_POST['clan'] . "</div>";
echo "<br /><br /><br /><b>Clarification!</b><br />";
echo "Give the top card away (with tag) if you get tagged by a zombie.  Hold onto the bottom card for identification purposes and to better assist moderators and admins.";
?>