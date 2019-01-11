<?php

class CompetitionModel{

    function selectCompetitionsByCompetitionCode($competition_code){
        $database = new Database();

        $competitionsList = $database->query("
            SELECT  *
            FROM competition_list
            WHERE competition_code=?
        ",[$competition_code]);

        return $competitionsList;
    }
    function selectOneCompetitionByCompetitionId($competition_id){
        $database = new Database();
        $championship = $database->queryOne("
            SELECT  *
            FROM competition_list
            WHERE competition_id = ?
        ",[$competition_id]);

        return $championship;
    }
    function insertCompetitionList($name,$nb_team,$competition_code){
        $database = new Database();

        $lastCompetitionId = $database->executeSql("
            INSERT INTO competition_list (name, date, nb_team, competition_code)
            VALUES (?,NOW(),?,?)
        ",[$name,$nb_team,$competition_code]);
        return $lastCompetitionId;
    }
}
?>
