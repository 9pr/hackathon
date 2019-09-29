<?php

class raiting {

    var $conn; //коннект к бд

    function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function getReitingUsers ($filtr = 'ASC')
    {
        $sql = 'SELECT * FROM history
        JOIN history_type ON history_type = history_type_id
        JOIN employee ON history_employee = employee_id';
        foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {

            $users[ $row['employee_id'] ]["FIO"] = $row['employee_surname'].' '.$row['employee_fathers_name'].' '.$row['employee_fathers_name'];
            $users[ $row['employee_id'] ]["birthday"] = $row['employee_birthday'];
            $users[ $row['employee_id'] ]["age"] = floor((time() - strtotime( $row['employee_birthday'] ))/(365*24*3600));
            if (isset($users[ $row['employee_id'] ]["rating"])) {
                $users[ $row['employee_id'] ]["rating"] += $row['history_type_assessment'];
            }
            else {
                $users[ $row['employee_id'] ]["rating"] = 0;
            }
        }
        //Изменим форму записи массива внеся идентивифкатор пользователя внутрь, для сортировки и просто пригодится на будущее запросы к бд делать.
        foreach ($users as $employee_id => $value) {
            $value['employee_id'] = $employee_id;
            $tmp[] = $value;
        }
        //Фильтруем и пересобираем массив от сотрудника с худшим рейтингом к сотруднику с лучшим
        if ($filtr === 'ASC') {
            usort($tmp, function ($a, $b) {
                    $a = $a['rating'];
                    $b = $b['rating'];
                    if ($a == $b) {
                        return 0;
                    }
                    return ($a < $b) ? -1 : 1;
                }
            );
        }
        //Фильтруем и пересобираем массив от сотрудника с лучшим рейтингом к сотруднику с худшим
        if ($filtr === 'DESC') {
            usort($tmp, function ($a, $b) {
                    $a = $a['rating'];
                    $b = $b['rating'];
                    if ($a == $b) {
                        return 0;
                    }
                    return ($a < $b) ? 1 : -1;
                }
            );
        }
        //для удобства и чтобы не плодить сущности переприсваиваем массивы и чистим
        $users = $tmp;
        unset($tmp);

        //выводим табличку
        $this->showTableRaitingEmployee($users);
    }
    private function showTableRaitingEmployee($users)
    {
        echo '<table border="1" width="100%">
                <tr>
                <td>FIO</td>
                <td>birthday</td>
                <td>age</td>
                <td>rating</td>
            </tr>';
        foreach ($users as $value) {
            echo "<tr>
                <td>{$value['FIO']}</td>
                <td>{$value['birthday']}</td>
                <td>{$value['age']}</td>
                <td>{$value['rating']}</td>
            </tr>";
        }
        echo '</table>';
    }
}
?>