<?php

class RankingController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {

        if(isset($_GET['action'])){

          /*  if( $_GET['action'] == "select-teams"){
                $teams = $competitionControl->selectChampionshipLinesByCompetitionId($_GET['competition_id']);
                echo json_encode($teams);
                exit();
            }
            if($_GET['action'] == "selectCalendarLine-update-ranking"){
                $calendarLine = $competitionControl->selectOneCalendarLine($_GET['calendarLine_id']);
                echo json_encode($calendarLine);
                exit();
            }
            if($_GET['action'] == "selectChampionshipLine-update-ranking"){

                $championshipLine = $competitionControl->selectOneChampionshipLine($_GET['championshipLine_id']);
                echo json_encode($championshipLine);
                exit();
            }
            if($_GET['action'] == "update-winner-championshipLine"){

                $competitionControl->updateWinnerChampionshipLine($_GET['pts'],$_GET['J'],$_GET['G'],$_GET['Butpour'],$_GET['Butcontre'],$_GET['Diff'],$_GET['championshipLine_id']);
                echo json_encode("ok");
                exit();
            }
            if($_GET['action'] == "update-looser-championshipLine"){

                $competitionControl->updateLooserChampionshipLine($_GET['pts'],$_GET['J'],$_GET['P'],$_GET['Butpour'],$_GET['Butcontre'],$_GET['Diff'],$_GET['championshipLine_id']);
                echo json_encode("ok");
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
