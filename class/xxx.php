<?php
class xxx {

    var $conn;

    function __construct()
    {
        /* Подключение к базе данных MySQL с помощью вызова драйвера */
        $host = '92.63.100.73';
        $dbname = 'hackathon';
        $user = 'hackathon';
        $password = 'hackathon';
        try {
            $this->conn = new PDO('mysql:dbname='.$dbname.';host='.$host.'', $user, $password, 
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
        } catch (PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
        }
    }

    function yyy($date = 'массив данных для работы метода') 
    {
        $sql = 'SELECT
        competence_id AS id,
        competence_name AS competence,
        training_type_name AS type,
        training_name AS name,
        time AS time,
        price AS price
        FROM competence_speciality
        JOIN competence ON competence = competence_id
        JOIN training_competence ON competence_id = id
        JOIN training ON training = training_id
        JOIN training_type ON training_type = training_type_id
        WHERE speciality = 2 AND competence_id NOT IN (
        SELECT competence_id FROM competence_employee
        JOIN competence ON competence = competence_id
        WHERE employee = 1
        )';
        foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $page) {
            print_r ($page);
        }

        //Запрос на поиск предпенсионнеров
        $sql = 'SELECT * FROM employee
        WHERE (employee_sex = 1 AND DATEDIFF(CURDATE(), employee_birthday) > 23360) OR
        (employee_sex = 2 AND DATEDIFF(CURDATE(), employee_birthday) > 21535)';
        foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $page) {
            print_r ($page);
        }
    }
}
?>