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
        $calendarLines = null;
        $championshipLines = null;
        $championshipsList = null;
        $championship = null;
        $calendar = null;
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
        //////////////////CREER///////////////////////////
        $lastCompetitionId = $this->competitionControl->insertCompetitionList($_POST['name'],($_POST['nb_team']+1),1);

        $index = 0;
        $listTeams = ['FC BAYER LEVERKUSEC'];
        while(isset($_POST[$index])){
            array_push($listTeams,$_POST[$index]);
            $index++;
        }
        $this->championshipControl->insertChampionshipLines($_POST['name'],$listTeams,$lastCompetitionId);
        $matchPerDay = $this->calendarControl->insertCalendarLines($lastCompetitionId,sizeof($listTeams));
        $this->calendarControl->insertCalendarList($lastCompetitionId,1,$matchPerDay);

        //////////////////SUPPRIMER///////////////////////////


        //////////////////FIN///////////////////////////
        $championshipsList = $this->competitionControl->selectCompetitionsByCompetitionCode(1);

        return ["championshipsList"=>$championshipsList];
    }
}
