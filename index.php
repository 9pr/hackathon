<?PHP
//http://example.com/class=XXX&method=YYY&value=ZZZ
header('Content-Type: text/html; charset=utf-8');
$_GET['class'] = "xxx";
$_GET['method'] = "yyy";
$_GET['value'] = "ZZZ";
$className = $_GET['class'];
$classMethod = $_GET['method'];
$methodValue = $_GET['value'];

/* Подключение к базе данных MySQL с помощью вызова драйвера */
$host = '92.63.100.73';
$dbname = 'hackathon';
$user = 'hackathon';
$password = 'hackathon';

try {
    $conn = new PDO('mysql:dbname='.$dbname.';host='.$host.'', $user, $password, 
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}

if (file_exists("class/$className.php")) {
    include ("class/$className.php");
    $myclass = new $className($conn);
}
else {
    echo "Упс :(";
    exit;
}
$myclass->$classMethod ($methodValue);

?>