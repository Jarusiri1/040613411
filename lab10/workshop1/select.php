<html>
<body>
<?php
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];

    if ($lang === 'en') {
        setcookie('lang', 'en', time() + 3600); 
        header("Location: main.php"); 
    } elseif ($lang === 'th') {
        setcookie('lang', 'th', time() + 3600); 
        header("Location: main.php"); 
    } else {
        echo "Invalid";
    }
} else {
    echo "No lang";
}
?>

</body>
</html>

