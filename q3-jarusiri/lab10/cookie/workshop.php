<html>
<body>
<?php
if (empty($_COOKIE["visit"])) {
setcookie("visit", 0, time() + 3600 * 24);
}


if (!isset($_COOKIE["visit"])) {
echo "Welcome to my website! Click here for a tour";
} else {
$visit = $_COOKIE["visit"] + 1;
setcookie("visit", $visit, time() + 3600 * 24);
echo "This is visit number $visit.";
}
?>
</body>
</html>