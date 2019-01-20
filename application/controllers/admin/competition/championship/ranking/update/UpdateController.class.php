<?php

class UpdateController
{
    public function __construct(){
        $this->championshipControl = new ChampionshipModel();
        $this->calendarControl = new CalendarModel();
    }
    public function httpGetMethod(Http $http, array $queryFields)
    {
        $this->championshipControl->updateChampionshipLinesReset($_GET['competition_id']);
        $championshipLines = $this->championshipControl->selectChampionshipLinesByCompetitionId($_GET['competition_id']);

        $calendarLines = $this->calendarControl->selectCalendarLinesByCompetitionId($_GET['competition_id']);

        foreach ($calendarLines as $calendarLine) {
            if($calendarLine['domicile_id'] && $calendarLine['exterieur_id'] && $calendarLine['resultat_domicile']!=null && $calendarLine['resultat_exterieur']!=null){
                $this->championshipControl->updateRankingForOneCalendarLine($calendarLine['domicile_id'],$calendarLine['resultat_domicile'],$calendarLine['exterieur_id'],$calendarLine['resultat_exterieur']);
            }
        }
        $championshipLines = $this->championshipControl->selectChampionshipLinesByCompetitionId($_GET['competition_id']);
        echo json_encode($championshipLines);
        exit();
    }

    public function httpPostMethod(Http $http, array $formFields)
    {

    }
}
