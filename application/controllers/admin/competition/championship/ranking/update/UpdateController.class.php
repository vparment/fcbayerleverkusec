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
        $this->championshipControl->updateChampionshipLinesReset($_GET['competition_id']);
        $championshipLines = $this->championshipControl->selectChampionshipLinesByCompetitionId($_GET['competition_id']);

        $calendarLines = $this->calendarControl->selectCalendarLinesByCompetitionId($_GET['competition_id']);
        //var_dump($calendarLines);

        foreach ($calendarLines as $calendarLine) {
            //var_dump($calendarLine);

            /*if($calendarLine['resultat_domicile'] != null)
                var_dump($calendarLine['resultat_domicile']);
            if($calendarLine['resultat_exterieur'] != null)
                var_dump($calendarLine['resultat_exterieur']);*/
                //var_dump($calendarLine['domicile_id']);
                //var_dump($calendarLine['exterieur_id']);
        if($calendarLine['domicile_id'] && $calendarLine['exterieur_id'] && $calendarLine['resultat_domicile']!=null && $calendarLine['resultat_exterieur']!=null){
            ////    if($calendarLine['domicile_id'] || $calendarLine['domicile_id'])
            //var_dump("je suis rentrer");
            //var_dump($calendarLine['calendarLine_id']);
            // var_dump($calendarLine['calendarLine_id']);
            // var_dump($calendarLine['domicile_id']);
            //     var_dump($calendarLine['exterieur_id']);

                    $this->championshipControl->updateRankingForOneCalendarLine($calendarLine['domicile_id'],$calendarLine['resultat_domicile'],$calendarLine['exterieur_id'],$calendarLine['resultat_exterieur']);
                }
            // var_dump($calendarLine['domicile_id']);
            //     var_dump($calendarLine['exterieur_id']);
        }
        $championshipLines = $this->championshipControl->selectChampionshipLinesByCompetitionId($_GET['competition_id']);
        //var_dump($championshipLines);
        echo json_encode($championshipLines);
        //echo json_encode("ok");
        exit();

    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        // $formFields contient toute ma journée
        // appelle les fonctions qui modifient la date, le time, les équipes etc...
        // Appelle les fonctions qui modifient le classement
        // renvoie le résultat du classement avec $http->sendJsonResponse()


    }
}
