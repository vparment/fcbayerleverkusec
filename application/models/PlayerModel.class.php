<?php

class PlayerModel{///OK////
    function selectOnePlayerWithPosition($player_id){
        $database = new Database();
        $player = $database->queryOne("
            SELECT  *
            FROM player
            INNER JOIN position_code
            ON position_code.position_code=player.position_code
            WHERE player.player_id=?
        ",[$player_id]);
        return $player;
    }
    function selectAllPlayersWithPosition(){
        $database = new Database();
        $players = $database->query("
            SELECT  *
            FROM player
            INNER JOIN position_code
            ON position_code.position_code=player.position_code
            WHERE 1
            ORDER BY position_code.position_code
        ");
        return $players;
    }
    function selectAllPositions(){
        $database = new Database();
        $positions = $database->query("
            SELECT  *
            FROM position_code
            WHERE 1
            ORDER BY position_code
        ");
        return $positions;
    }
    function insertPlayer($name,$pseudo,$description,$number,$position_code){
        $database = new Database();
        $database->executeSql("
            INSERT INTO player (name, pseudo, description, number, position_code)
            VALUES (?,?,?,?,?)
        ",[$name,$pseudo,$description,$number,$position_code]);
    }
    function updatePlayer($name,$pseudo,$description,$number,$position_id,$player_id){
        $database = new Database();
        $database->executeSql("
            UPDATE player
            SET name=?, pseudo=?, description=? , number=? , position_code=?
            WHERE player_id=?
        ",[$name,$pseudo,$description,$number,$position_id,$player_id]);
    }
    function deletePlayer($player_id){
        $database = new Database();
        $database->executeSql("
            DELETE FROM player WHERE player_id=?
        ",[$player_id]);
    }
}
?>
