<?php

class TeamController
{
    public function __construct(){
        $this->playerControl  = new PlayerModel();
    }
    public function httpGetMethod(Http $http, array $queryFields)
    {
        if (isset($_GET['action'])) {

            if($_GET['action'] == "delete-player"){
                $this->playerControl->deletePlayer($_GET['player_id']);
                $players = $this->playerControl->selectAllPlayersWithPosition();
                echo json_encode($players);
                exit();
            }
            if($_GET['action'] == "edit-player"){
                $player = $this->playerControl->selectOnePlayerWithPosition($_GET['player_id']);
                echo json_encode($player);
                exit();
            }
        }
        $players = $this->playerControl->selectAllPlayersWithPosition();
        $positions = $this->playerControl->selectAllPositions();
        return ["players"=>$players,"positions"=>$positions];
    }
    public function httpPostMethod(Http $http, array $formFields)
    {
        if (isset($_GET['action'])) {
            if($_GET['action'] == "insert-player")
            {
                $this->playerControl->insertPlayer($_POST['name'],$_POST['pseudo'],$_POST['description'],$_POST['number'],$_POST['position_code']);
            }
            if($_GET['action'] == "update-player"){
                $this->playerControl->updatePlayer($_POST['name'],$_POST['pseudo'],$_POST['description'],$_POST['number'],$_POST['position_code'],$_GET['player_id']);
            }
        }
        $players = $this->playerControl->selectAllPlayersWithPosition();
        $positions = $this->playerControl->selectAllPositions();
        return ["players"=>$players,"positions"=>$positions];
    }
}
