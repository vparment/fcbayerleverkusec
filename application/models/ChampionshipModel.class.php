<?php

class ChampionshipModel{

    function selectChampionshipLinesByCompetitionId($competition_id){
        $database = new Database();

        $championshipLines =$database->query("
            SELECT  *
            FROM championshipline
            WHERE competition_id = ?
            ORDER BY pts DESC, Diff DESC
        ",[$competition_id]);

        return $championshipLines;
    }
    function selectOneChampionshipLine($championshipLine_id){
        $database = new Database();
        $championshipLine = $database->queryOne("
            SELECT  *
            FROM championshipline
            WHERE championshipLine_id = ?
        ",[$championshipLine_id]);

        return $championshipLine;
    }
    function insertChampionshipLines($name, $listTeams,$competition_id){
        $database = new Database();

        foreach ($listTeams as $team) {
            $database->executeSql("
                INSERT INTO championshipline (competition_id,name)
                VALUES (?,?)
            ",[$competition_id,$team]);
        }
    }
    function updateChampionshipLinesReset($competition_id){
        $database = new Database();
        $i = 0;
        $database->executeSql("
            UPDATE championshipline
            SET pts=?, J=?, G=?,N=?,P=?,Butpour=?,Butcontre=?,Diff=?
            WHERE competition_id = ?
        ",[$i,$i,$i,$i,$i,$i,$i,$i,$competition_id]);
    }
    function updateChampionshipLine($team){
        $database = new Database();
        $database->executeSql("
            UPDATE championshipline
            SET pts=?, J=?, G=?,N=?,P=?,Butpour=?,Butcontre=?,Diff=?
            WHERE championshipLine_id = ?
        ",[$team['pts'],$team['J'],$team['G'],$team['N'],$team['P'],$team['Butpour'],$team['Butcontre'],$team['Diff'],$team['championshipLine_id']]);
    }
    function updateRankingForOneCalendarLine($domicile_id,$resultat_domicile,$exterieur_id,$resultat_exterieur){
        $database = new Database();
        $D = $this->selectOneChampionshipLine($domicile_id);
        $E = $this->selectOneChampionshipLine($exterieur_id);
        //var_dump($D);
        //var_dump($E);
        $D['J']+=1;

        $D['Butpour'] += $resultat_domicile;
        $D['Butcontre'] += $resultat_exterieur;
        $D['Diff'] += $resultat_domicile - $resultat_exterieur;

        $E['J']+=1;
        $E['Butpour'] += $resultat_exterieur;
        $E['Butcontre'] += $resultat_domicile;
        $E['Diff'] += $resultat_exterieur - $resultat_domicile;

        if($resultat_domicile > $resultat_exterieur){

            $D['pts'] += 3;
            $D['G'] += 1;
            $E['pts'] += 1;
            $E['P'] += 1;
        }
        else if ($resultat_domicile < $resultat_exterieur) {
            $E['pts'] += 3;
            $E['G'] += 1;
            $D['pts'] += 1;
            $D['P'] += 1;
        }
        else {
            $E['pts'] += 2;
            $E['N'] += 1;
            $D['pts'] += 2;
            $D['N'] += 1;
        }
        //var_dump($D);
        //var_dump($E);
        $this->updateChampionshipLine($D);
        $this->updateChampionshipLine($E);
        // $database->executeSql("
        //     UPDATE championshipline
        //     SET pts=?, J=?, G=?,N=?,P=?,Butpour=?,Butcontre=?,Diff=?
        //     WHERE competition_id = ?
        // ",[$i,$i,$i,$i,$i,$i,$i,$i,$competition_id]);
    }
    // function updateWinnerChampionshipLine($pts,$J,$G,$Butpour,$Butcontre,$diff,$championshipLine_id){
    //     $database = new Database();
    //     $database->executeSql("
    //         UPDATE championshipline
    //         SET pts = ? , J= ? , G = ?,Butpour = ?, Butcontre = ? , Diff = ?
    //         WHERE championshipLine_id = ?
    //     ",[$pts,$J,$G,$Butpour,$Butcontre,$diff,$championshipLine_id]);
    // }
    // function updateLooserChampionshipLine($pts,$J,$P,$Butpour,$Butcontre,$diff,$championshipLine_id){
    //     $database = new Database();
    //     $database->executeSql("
    //         UPDATE championshipline
    //         SET pts = ? , J= ? , P = ?,Butpour = ?, Butcontre = ? , Diff = ?
    //         WHERE championshipLine_id = ?
    //     ",[$pts,$J,$P,$Butpour,$Butcontre,$diff,$championshipLine_id]);
    // }


}
?>
