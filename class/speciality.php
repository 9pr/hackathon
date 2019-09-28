<?php
class speciality {

    var $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function get_list($date = 'массив данных для работы метода') 
    {
        $sql = '
            SELECT * FROM speciality
        ';
        
        $result = [];
        foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $line) {
            $result[] = $line;
        }
        header('Content-Type: application/json');
        echo json_encode($result, JSON_UNESCAPED_UNICODE);

    }
}
?>