<?php

class UpdateController
{
    public function __construct(){
    // $this->competitionControl = new CompetitionModel();
    $this->championshipControl = new ChampionshipModel();
    $this->calendarControl = new CalendarModel();
    //$this->competitionControl = new CompetitionModel();

    }
    public function httpGetMethod(Http $http, array $queryFields)
    {
        //var_dump($_GET['calendarLine_id']);


    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        $line = json_decode($_POST['line']);
    //    var_dump($line);
        $line = $line[0];
    //    var_dump($line);

    //    var_dump($line->date);
    /*     var_dump($line['date']);
         var_dump($line['time']);*/


        $this->calendarControl->updateCalendarLine($line->date,$line->time,$line->domicile_id,$line->domicile,$line->rDomicile,$line->rExterieur,$line->exterieur_id,$line->exterieur,$line->lieu,$line->calendarLine_id);

        $calendarLine = $this->calendarControl->selectOneCalendarLine($line->calendarLine_id);

        //var_dump($calendarLine);
        $http->sendJsonResponse($calendarLine);
        exit();
        // $formFields contient toute ma journée
        // appelle les fonctions qui modifient la date, le time, les équipes etc...
        // Appelle les fonctions qui modifient le classement
        // renvoie le résultat du classement avec $http->sendJsonResponse()


    }
}
