<?php
class competence {

    var $conn; //коннект к бд
    var $reducible; //Те кого требуется перекваллифицировать
    var $needComp; //Необходимые компетенции для переквалификации сотрудников

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    //На перспективу, если решим иные способы обработки использовать (теперь тут список сокращаемых должностей (массив с ид должности))
    private function varReducible($var)
    {
        return explode(',', $var);
    }
    //получаем список востребованных специальностей
    private function relevantSpecialties($var)
    {
        $sql = 'SELECT * FROM speciality WHERE speciality_id IN ('.$var.')';
        foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
            $relevantSpecialties[] = $row;
        }
        return $relevantSpecialties;
    }
    //принимаем информацию о человеке и востребованных специальногстях, находим недостающие квалификации и возвращаем итог
    private function employeeWeaknesses ($people, $specialty)
    {
        // echo "Информация о человеке\r\n";
        // print_r($people);
        //идентификатор переквалифицируемого/увольняемого/сокрощаемого сотрудника
        $employee_id = $people['employee_id'];

        foreach ($specialty as $key => $value) {

            $speciality_id = $value['speciality_id'];
            $speciality_name = $value['speciality_name'];

            //Запрос позволяет получить недостающие квалификации по специальности
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
            WHERE speciality = '.$speciality_id.' AND competence_id NOT IN (
            SELECT competence_id FROM competence_employee
            JOIN competence ON competence = competence_id
            WHERE employee = '.$employee_id.'
            )';

            $people["Должности"][$speciality_id] = ["Должность" => $speciality_name];

            //получаем недостающие компетенции/навыки для занятия должности
            foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
                $people["Должности"][$speciality_id]["Недостающие навыки"][] = $row;
                $this->needComp[] = $row['id'];
            }
        }
        // echo "Информация о человеке\r\n";
        // print_r($people);
        return $people;
    }
    //Находим экспертов способных обучить переквалифицируемых по недостающим компетенциям
    private function expert2comp(Type $var = null)
    {
        // получаем уникальные недостающие компетенции
        $needCompUnik = array_unique ($this->needComp);

        // echo "Недостающие компетенции сокращаемых для переквалификации\r\n";
        // print_r($needCompUnik);

        foreach ($needCompUnik as $idComp) {
            $sql = 'SELECT COUNT(*) AS count FROM competence_employee
            JOIN competence ON competence = competence_id
            JOIN employee ON employee = employee_id
            WHERE LEVEL = 4 AND competence = '.$idComp;
            foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
                $tmp[] = ["Ид недостающий компетенции" => $idComp, "Кол-во экспертов по компетенции" => $row['count']];
            }
        }
        return $tmp;
    }
    //получаем список сокращаемых сотрудников и их компетенции
    function reducible($var)
    {
        //разбираем входящие данные
        $var = explode (':',$var);

        //теперь тут список сокращаемых должностей (массив с ид должности)
        $varReducible = $this->varReducible ($var[0]);

        $result = [];
        //получаем список востребованных специальностей
        $relevantSpecialties = $this->relevantSpecialties($var[1]);
        $result["Востребованные специальности"] = $relevantSpecialties;

        //выясняем каких навыков/компетенций не хватает сокращаемым для занятия вакантных должностей
        foreach ($varReducible as $idSpeciality) {
            // Это запрос на людей из сокрощаемой должности
            $sql = 'SELECT *
            FROM employee
            JOIN post ON employee_post = post_id
            WHERE post_speciality = '.$idSpeciality;
            foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
                //Добавляем к информации о сокращаемом специалисте информацию о необходимых кваллификациях для занятия вакантных должностей
                $retiredSpecialist[] = $this->employeeWeaknesses ($row, $relevantSpecialties);;
            }
        }
        $result["Сокращаемые специалисты"] = $retiredSpecialist;

        // находим экспертов по недостающим компетенциям
        $needCompUnik = $this->expert2comp ();

        $result["Эксперты по востребованным компетенциям"] = $needCompUnik;

        //header('Content-Type: application/json');
        echo '{% set data = '.json_encode($result, JSON_UNESCAPED_UNICODE).'%}';

    }
}
?>