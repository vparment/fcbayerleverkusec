<?php

class ChampionshipController
{
    public function __construct(){
        $this->competitionControl = new CompetitionModel();
        $this->championshipControl = new ChampionshipModel();
        $this->calendarControl = new CalendarModel();
        $this->competitionControl = new CompetitionModel();

    }

    public function httpGetMethod(Http $http, array $queryFields)
    {
        $calendarLines = null; //
        $championshipLines = null; //
        $championshipsList = null; //
        $championship = null; ////
        $calendar = null; ////
        
        if(isset($_GET['competition_id'])){
            $championshipLines =
                $this->championshipControl->selectChampionshipLinesByCompetitionId($_GET['competition_id']);
            $calendarLines = $this->calendarControl->selectCalendarLinesByCompetitionId($_GET['competition_id']);
            $championship = $this->competitionControl->selectOneCompetitionByCompetitionId($_GET['competition_id']);
            $calendar = $this->calendarControl->selectOneCalendarByCompetitionId($_GET['competition_id']);
        }
        $championshipsList = $this->competitionControl->selectCompetitionsByCompetitionCode(1);

        return ["championshipLines"=>$championshipLines,"championship"=>$championship, "calendarLines"=>$calendarLines,"championshipsList"=>$championshipsList,"calendar"=>$calendar];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {

    }
}
