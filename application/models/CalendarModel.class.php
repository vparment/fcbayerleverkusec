<?php

class CalendarModel{
    function selectCalendarLinesByCompetitionId($competition_id){
        $database = new Database();

        $calendarLines =$database->query("
            SELECT  *
            FROM calendarline
            WHERE competition_id = ?
            ORDER BY calendarLine_id DESC
        ",[$competition_id]);

        return $calendarLines;
    }
    function selectOneCalendarByCompetitionId($competition_id){
        $database = new Database();
        $calendar = $database->queryOne("
            SELECT  *
            FROM calendar_list
            WHERE competition_id = ?
        ",[$competition_id]);

        return $calendar;

    }
    function selectOneCalendarLine($calendarLine_id){
        $database = new Database();
        $calendarLine = $database->queryOne("
            SELECT  *
            FROM calendarline
            WHERE calendarLine_id = ?
        ",[$calendarLine_id]);

        return $calendarLine;

    }
    function insertCalendarList($competition_id, $competition_code,$matchPerDay){
        $database = new Database();

        $database->executeSql("
            INSERT INTO calendar_list (competition_id, competition_code,matchPerDay)
            VALUES (?,?,?)
        ",[$competition_id,$competition_code,$matchPerDay]);
    }
    function insertCalendarLine($competition_id,$num_day){
        $database = new Database();

        $database->executeSql("
            INSERT INTO calendarline (competition_id, num_day)
            VALUES (?,?)
        ",[$competition_id,$num_day]);

    }
    function insertCalendarLines($competition_id,$nb_team){
        $i = 1;
        while($nb_team % 2 != 0){
            $nb_team++;
        }
        $nb_rencontreParJournee = $nb_team/2;
        $nb_rencontreTotalParEquipe = $nb_team-1;
        $total_match = $nb_rencontreParJournee * $nb_rencontreTotalParEquipe;

        while($nb_rencontreTotalParEquipe > 0){
            $this->insertCalendarLine($competition_id,$nb_rencontreTotalParEquipe);
            if($i % $nb_rencontreParJournee == 0){
                $nb_rencontreTotalParEquipe--;
            }
            $i++;
        }
        return $nb_rencontreParJournee;
    }
    function updateCalendarLine($newDate,$newTime,$newDomicile_id,$newDomicile,$newResultatDomicile,$newResultatExterieur,$newExterieur_id,$newExterieur,$newLieu,$calendarLine_id){
        $database = new Database();
        //var_dump($newDate);
        $database->executeSql("
            UPDATE calendarline
            SET date=?, time = ?, domicile_id = ?, domicile = ?, resultat_domicile = ?, resultat_exterieur = ?, exterieur_id = ?, exterieur = ?, lieu = ?
            WHERE calendarLine_id = ?
        ",[$newDate,$newTime,$newDomicile_id,$newDomicile,$newResultatDomicile,$newResultatExterieur,$newExterieur_id,$newExterieur,$newLieu,$calendarLine_id]);
    }
    function updateDateOfCalendarLine($newDate,$calendarLine_id){
        $database = new Database();
        $database->executeSql("
            UPDATE calendarline
            SET date = ?
            WHERE calendarLine_id = ?
        ",[$newDate,$calendarLine_id]);
    }
    function updateTimeOfCalendarLine($newTime,$calendarLine_id){
        $database = new Database();
        $database->executeSql("
            UPDATE calendarline
            SET time = ?
            WHERE calendarLine_id = ?
        ",[$newTime,$calendarLine_id]);
    }
    function updateDomicileOfCalendarLine($newDomicile,$newDomicile_id,$calendarLine_id){
        $database = new Database();
        $database->executeSql("
            UPDATE calendarline
            SET domicile = ? , domicile_id= ?
            WHERE calendarLine_id = ?
        ",[$newDomicile,$newDomicile_id,$calendarLine_id]);
    }
    function updateExterieurOfCalendarLine($newExterieur,$newExterieur_id,$calendarLine_id){
        $database = new Database();
        $database->executeSql("
            UPDATE calendarline
            SET exterieur = ? , exterieur_id= ?
            WHERE calendarLine_id = ?
        ",[$newExterieur,$newExterieur_id,$calendarLine_id]);
    }
    function updateResultatExterieurOfCalendarLine($newResultatExterieur,$calendarLine_id){
        $database = new Database();
        $database->executeSql("
            UPDATE calendarline
            SET resultat_exterieur = ?
            WHERE calendarLine_id = ?
        ",[$newResultatExterieur,$calendarLine_id]);
    }
    function updateResultatDomicileOfCalendarLine($newResultatDomicile,$calendarLine_id){
        $database = new Database();
        $database->executeSql("
            UPDATE calendarline
            SET resultat_domicile = ?
            WHERE calendarLine_id = ?
        ",[$newResultatDomicile,$calendarLine_id]);
    }
    function updateLieuOfCalendarLine($newLieu,$calendarLine_id){
        $database = new Database();
        $database->executeSql("
            UPDATE calendarline
            SET lieu = ?
            WHERE calendarLine_id = ?
        ",[$newLieu,$calendarLine_id]);
    }
}
?>
