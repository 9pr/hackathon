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

            $people["posted"][$speciality_id] = ["post" => $speciality_name];

            //получаем недостающие компетенции/навыки для занятия должности
            foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
                $people["posted"][$speciality_id]["competence_absent"][] = $row;
                $this->needComp[] = $row['id'];
            }
        }
        // echo "Информация о человеке\r\n";
        // print_r($people);
        return $people;
    }


    //принимаем информацию о человеке и востребованных специальногстях, находим недостающие квалификации и возвращаем итог
    private function expert_list ()
    {
  
            //Запрос позволяет получить недостающие квалификации по специальности
            $sql = 'SELECT employee_id, employee_surname, employee_name, employee_fathers_name, competence_name, post_name, speciality_name, YEAR(NOW()) - YEAR(BEGIN) AS stage
            FROM competence_employee
            JOIN competence ON competence = competence_id
            JOIN employee ON employee = employee_id
            JOIN post ON employee_id = post_id
            JOIN speciality ON post_speciality = speciality_id
            JOIN career ON career.employee = employee_id 
            
            WHERE LEVEL = 4 AND end IS NULL';
            //получаем недостающие компетенции/навыки для занятия должности
            foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
                if (!isset($people[$row['employee_id']])) {
                    $people[$row['employee_id']] = [];
                }
                $people[$row['employee_id']][] = $row;
            }
        return $people;
    }
    //Находим экспертов способных обучить переквалифицируемых по недостающим компетенциям
    private function expert2comp(Type $var = null)
    {
        // получаем уникальные недостающие компетенции
        $needCompUnik = array_unique ($this->needComp);

        // echo "Недостающие компетенции сокращаемых для переквалификации\r\n";
        // print_r($needCompUnik);
        $tmp = [];
        foreach ($needCompUnik as $idComp) {
            $sql = 'SELECT COUNT(*) AS count FROM competence_employee
            JOIN competence ON competence = competence_id
            JOIN employee ON employee = employee_id
            WHERE LEVEL = 4 AND competence = '.$idComp;
            
            foreach ($this->conn->query($sql, PDO::FETCH_ASSOC) as $row) {
                $tmp[$idComp] = ["competence_absent_id" => $idComp, "expert_count" => $row['count']];
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
        $result["need_speciality"] = $relevantSpecialties;

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
        $result["employee_removed"] = $retiredSpecialist;


        // находим экспертов по недостающим компетенциям
        $needCompUnik = $this->expert2comp ();

        $result["expert_need_competence"] = $needCompUnik;
        $result["expert_list"] = $this->expert_list();



        foreach($result["employee_removed"] as $key => $value) {
            foreach($value["posted"] as $key2 => $value2) {
                if (!isset($value2["competence_absent"])) {
                    $result["employee_removed"][$key]["posted"][$key2]['count_expert'] = 0;
                    continue;
                } 
                $result["employee_removed"][$key]["posted"][$key2]['count_expert'] = 0;
                foreach($value2["competence_absent"] as $key3 => $value3) {
                    $result["employee_removed"][$key]["posted"][$key2]['count_expert'] += $result["expert_need_competence"][$value3['id']]['expert_count'];
                    // print_r('######');
                    // print_r($key2);
                    //print_r($result["expert_need_competence"][$value3['id']]);
                }
            }
        }



        header('Content-Type: application/json');
        echo json_encode($result, JSON_UNESCAPED_UNICODE);

    }
}
?>