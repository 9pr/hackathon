<?PHP
//http://example.com/class=XXX&method=YYY&value=ZZZ
header('Content-Type: text/html; charset=utf-8');
$_GET['class'] = "xxx";
$_GET['method'] = "yyy";
$_GET['value'] = "ZZZ";
$className = $_GET['class'];
$classMethod = $_GET['method'];
$methodValue = $_GET['value'];

if (file_exists("class/$className.php")) {
    include ("class/$className.php");
    $myclass = new $className;
}
else {
    echo "Упс :(";
    exit;
}
$myclass->$classMethod ($methodValue);

?>