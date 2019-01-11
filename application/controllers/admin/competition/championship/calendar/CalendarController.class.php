<?php

class CalendarController
{
    public function __construct(){
        // $this->competitionControl = new CompetitionModel();
        // $this->championshipControl = new ChampionshipModel();
        $this->calendarControl = new CalendarModel();
        //$this->competitionControl = new CompetitionModel();

    }
    public function httpGetMethod(Http $http, array $queryFields)
    {

        


        if(isset($_GET['action'])){

        /*    if($_GET['action'] == "update-date"){
                $competitionControl->updateDateOfCalendarLine($_GET['newDate'],$_GET['calendarLine_id']);
                echo json_encode($_GET['newDate']);
                exit();
            }
            if( $_GET['action'] == "update-time"){
                $competitionControl->updateTimeOfCalendarLine($_GET['newTime'],$_GET['calendarLine_id']);
                echo json_encode($_GET['newTime']);
                exit();
            }
            if( $_GET['action'] == "update-domicile"){
                $competitionControl->updateDomicileOfCalendarLine($_GET['newDomicile'],$_GET['newDomicile_id'],$_GET['calendarLine_id']);
                echo json_encode($_GET['newDomicile']);
                exit();
            }
            if( $_GET['action'] == "update-exterieur"){
                $competitionControl->updateExterieurOfCalendarLine($_GET['newExterieur'],$_GET['newExterieur_id'],$_GET['calendarLine_id']);
                echo json_encode($_GET['newExterieur']);
                exit();
            }
            if( $_GET['action'] == "update-resultat_exterieur"){
                $competitionControl->updateResultatExterieurOfCalendarLine($_GET['newResultatExterieur'],$_GET['calendarLine_id']);
                echo json_encode($_GET['newResultatExterieur']);
                exit();
            }
            if( $_GET['action'] == "update-resultat_domicile"){
                $competitionControl->updateResultatDomicileOfCalendarLine($_GET['newResultatDomicile'],$_GET['calendarLine_id']);
                echo json_encode($_GET['newResultatDomicile']);
                exit();
            }
            if( $_GET['action'] == "update-lieu"){
                $competitionControl->updateLieuOfCalendarLine($_GET['newLieu'],$_GET['calendarLine_id']);
                echo json_encode($_GET['newLieu']);
                exit();
            }*/

        }
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        // $formFields contient toute ma journée
        // appelle les fonctions qui modifient la date, le time, les équipes etc...
        // Appelle les fonctions qui modifient le classement
        // renvoie le résultat du classement avec $http->sendJsonResponse()


    }
}
