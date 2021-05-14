<?php
include("core/coreHead.php");

mysql_query("UPDATE `members` SET read_rules = '1' WHERE mid = '" . $_SESSION['mid'] . "';");

header('Location: index.php');

include("core/coreFoot.php");
?>