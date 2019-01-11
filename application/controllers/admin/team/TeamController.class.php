<?php

class TeamController
{
    //$playerControl  = new PlayerModel();
    public function httpGetMethod(Http $http, array $queryFields)
    {
        $playerControl  = new PlayerModel();
        if (isset($_GET['action'])) {

            if($_GET['action'] == "delete-player"){
                $playerControl->deletePlayer($_GET['player_id']);
                $players = $playerControl->selectAllPlayersWithPosition();
                echo json_encode($players);
                exit();
            }
            if($_GET['action'] == "edit-player"){
                $player = $playerControl->selectOnePlayerWithPosition($_GET['player_id']);
                echo json_encode($player);
                exit();
            }
        }
        $players = $playerControl->selectAllPlayersWithPosition();
        $positions = $playerControl->selectAllPositions();
        return ["players"=>$players,"positions"=>$positions];

    }

    public function httpPostMethod(Http $http, array $formFields)
    {

        $playerControl  = new PlayerModel();
        if (isset($_GET['action'])) {
            if($_GET['action'] == "insert-player")
            {
                $playerControl->insertPlayer($_POST['name'],$_POST['pseudo'],$_POST['description'],$_POST['number'],$_POST['position_code']);
            }
            if($_GET['action'] == "update-player"){
                $playerControl->updatePlayer($_POST['name'],$_POST['pseudo'],$_POST['description'],$_POST['number'],$_POST['position_code'],$_GET['player_id']);
            }
        }
        $players = $playerControl->selectAllPlayersWithPosition();
        $positions = $playerControl->selectAllPositions();
        return ["players"=>$players,"positions"=>$positions];
    }
}
