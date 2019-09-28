<?php
class speciality {

    var $conn;

    function __construct($conn)
    {
        $this->$conn = $conn;
    }

    function get_list($date = 'массив данных для работы метода') 
    {
        $sql = '
            SELECT * FROM speciality
        ';
        
        foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $page) {
            print_r ($page);
        }
    }
}
?>