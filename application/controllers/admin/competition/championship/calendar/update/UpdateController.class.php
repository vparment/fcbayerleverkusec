<?php

class UpdateController
{
    public function __construct(){
        $this->championshipControl = new ChampionshipModel();
        $this->calendarControl = new CalendarModel();
    }
    public function httpGetMethod(Http $http, array $queryFields)
    {

    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        $line = json_decode($_POST['line']);
        $line = $line[0];

        $this->calendarControl->updateCalendarLine($line->date,$line->time,$line->domicile_id,$line->domicile,$line->rDomicile,$line->rExterieur,$line->exterieur_id,$line->exterieur,$line->lieu,$line->calendarLine_id);

        $calendarLine = $this->calendarControl->selectOneCalendarLine($line->calendarLine_id);
        
        echo json_encode($calendarLine);
		exit();
    }
}
