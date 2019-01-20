<?php

class EditController
{
    public function __construct(){
        $this->championshipControl = new ChampionshipModel();
        $this->calendarControl = new CalendarModel();
    }
    public function httpGetMethod(Http $http, array $queryFields)
    {
        $calendarLine = $this->calendarControl->selectOneCalendarLine($_GET['calendarLine_id']);
        $championshipLines = $this->championshipControl->selectChampionshipLinesByCompetitionId($_GET['competition_id']);
        echo json_encode([$calendarLine,$championshipLines]);
        exit();
    }

    public function httpPostMethod(Http $http, array $formFields)
    {

    }
}
