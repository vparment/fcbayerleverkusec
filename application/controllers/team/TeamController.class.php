<?php

class TeamController
{
    public function __construct(){
        $this->playerControl  = new PlayerModel();
    }
    public function httpGetMethod(Http $http, array $queryFields)
    {
         $players = $this->playerControl->selectAllPlayersWithPosition();
         return["players"=>$players];
    }
    public function httpPostMethod(Http $http, array $formFields)
    {
    }
}
