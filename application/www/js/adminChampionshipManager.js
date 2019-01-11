class adminChampionshipManager {
    constructor(){
        $(".fieldset-competition-championship-admin input[name=nb_team]").on("keyup",(event)=>this.OnGiveNumberOfTeams(event));
        this.getInputsTeamsGenerator($(".fieldset-competition-championship-admin input[name=nb_team]").val());
        $(".edit-calendarline").on("click",(event)=>this.OnEditCalendarLineClick(event));
        this.allLine = [];
        //var currentLine;
    }
    getInputsTeamsGenerator(number){
        $('.input-teams').empty();
        var i = 0;
        while(i<number){
            var div_field = $('<div>');
            $('.input-teams').append(div_field);
            var label = $('<label>');
            var input = $('<input>');
            input.attr("placeholder","Nom Equipe "+(i+1)).attr("name",(i)).attr("data-id",(i+1)).attr("required","required").attr("value","equipe"+(i+1));
            div_field.append(label).append(input);
            i++;
        }
    }
    OnGiveNumberOfTeams(event){
        //console.log(event);
        var number = $(event.currentTarget).val();
        this.getInputsTeamsGenerator(number);
    }
    OnEditCalendarLineClick(event){

        // console.log(event);
        // console.log(this);
        // console.log(event);
        //  console.log("la");
         var calendarLine_id = $(event.currentTarget).data('id');
        var competition_id = $(event.currentTarget).data('competition');
    //    console.log(calendarLine_id);
        //console.log(competition_id);
         $.getJSON(getRequestUrl() + '/admin/competition/championship/calendar/edit?calendarLine_id='+calendarLine_id+'&competition_id='+competition_id,(resultAjax)=>this.getFormCalendarLine(resultAjax));
    }
    getFormCalendarLine(resultAjax){
        //console.log(resultAjax);
        var calendarLine = resultAjax[0];
        var championshipLines = resultAjax[1];
        //console.log(calendarLine);
        //console.log(championshipLines);
        //currentLine = calendarline;
        //console.log($('.table-calendar-admin tr[data-id='+calendarline.calendarLine_id+'] td'));
        var id  = calendarLine.calendarLine_id;
        //console.log(id);

        var input_date = $('<input>').attr("type","date");
        if (calendarLine.date)
            input_date.attr("value",calendarLine.date);
        var input_time = $('<input>').attr("type","time");
        if (calendarLine.time)
            input_time.attr("value",calendarLine.time);
        var select_domicile = $('<select>').attr("name","domicile");
            if(!calendarLine.domicile_id) {
                var option_domicile = $('<option>').attr("value","0").text("Equipe domicile").attr("selected","selected");
                select_domicile.append(option_domicile);
            }
            for (var championshipLine of championshipLines){

                var option_domicile = $('<option>').attr("value",championshipLine.championshipLine_id).text(championshipLine.name);
                if(championshipLine.championshipLine_id == calendarLine.domicile_id){
                    option_domicile.attr("selected","selected");
                }
                select_domicile.append(option_domicile);

            }
        var input_rDomicile = $('<input>').attr("type","number");
        if (calendarLine.resultat_domicile)
            input_rDomicile.attr("value",calendarLine.resultat_domicile);
        var input_rExterieur = $('<input>').attr("type","number");
        if (calendarLine.resultat_exterieur)
            input_rExterieur.attr("value",calendarLine.resultat_exterieur);
        var select_exterieur = $('<select>');
        if(!calendarLine.exterieur_id) {
            var option_exterieur = $('<option>').attr("value","0").text("Equipe exterieur").attr("selected","selected");
            select_exterieur.append(option_exterieur);
        }

        for (var championshipLine of championshipLines){

            var option_exterieur = $('<option>').attr("value",championshipLine.championshipLine_id).text(championshipLine.name);
            if(championshipLine.championshipLine_id == calendarLine.exterieur_id){
                option_exterieur.attr("selected","selected");
            }
            select_exterieur.append(option_exterieur);

        }
        var input_lieu = $('<input>').attr("type","text");
        if (calendarLine.lieu != "A définir")
            input_lieu.attr("value",calendarLine.lieu);
        var icone_validate = $('<i>').attr("class","fas fa-check");
        var div_validate = $('<div>').attr("class","validate-calendarline").attr("data-id",calendarLine.calendarLine_id).append(icone_validate);
        //console.log(this);
        div_validate.on("click",(event)=>this.OnValidateClick(event));

        var line = $('.table-calendar-admin tr[data-id='+calendarLine.calendarLine_id+'] td').empty();

        var date = $('.table-calendar-admin tr[data-id='+calendarLine.calendarLine_id+'] .date');
        var time = $('.table-calendar-admin tr[data-id='+calendarLine.calendarLine_id+'] .time');
        var domicile = $('.table-calendar-admin tr[data-id='+calendarLine.calendarLine_id+'] .domicile');
        var rDomicile = $('.table-calendar-admin tr[data-id='+calendarLine.calendarLine_id+'] .resultat_domicile');
        var rExterieur = $('.table-calendar-admin tr[data-id='+calendarLine.calendarLine_id+'] .resultat_exterieur');
        var exterieur = $('.table-calendar-admin tr[data-id='+calendarLine.calendarLine_id+'] .exterieur');
        var lieu = $('.table-calendar-admin tr[data-id='+calendarLine.calendarLine_id+'] .lieu');
        var cellButton = $('.table-calendar-admin tr[data-id='+calendarLine.calendarLine_id+'] .cell-button');

        cellButton.append(div_validate);
        date.append(input_date);
        time.append(input_time);
        domicile.append(select_domicile);
        rDomicile.append(input_rDomicile);
        rExterieur.append(input_rExterieur);
        exterieur.append(select_exterieur);
        lieu.append(input_lieu);

    //    console.log(line);
        //$('.table-calendar-admin tr[data-id='+calendarline.calendarLine_id+'] .date').append
        // console.log()
        // console.log(calendarLine.calendarLine_id);
    }
    recupFormForUpdate(event){
        var calendarLine_id = $(event.currentTarget).data('id');
        //console.log(calendarLine_id);
        var line = {};
        var date = $('.calendar-line[data-id='+calendarLine_id+'] .date input').val();
        var time = $('.calendar-line[data-id='+calendarLine_id+'] .time input').val();
        var domicile = $('.calendar-line[data-id='+calendarLine_id+'] .domicile option:checked').text();
        var domicile_id = $('.calendar-line[data-id='+calendarLine_id+'] .domicile option:checked').val();
        var rDomicile = $('.calendar-line[data-id='+calendarLine_id+'] .resultat_domicile input').val();
        var rExterieur = $('.calendar-line[data-id='+calendarLine_id+'] .resultat_exterieur input').val();
        var exterieur = $('.calendar-line[data-id='+calendarLine_id+'] .exterieur option:checked').text();
        var exterieur_id = $('.calendar-line[data-id='+calendarLine_id+'] .exterieur option:checked').val();
        var lieu = $('.calendar-line[data-id='+calendarLine_id+'] .lieu input').val();
        var competition_id = $('.calendar-line[data-id='+calendarLine_id+']').data('competition');
        //console.log(domicile_id);
        //console.log(domicile);
        if(!date)
         date=null;
        line.date = date;
        if(!time)
         time=null;
        line.time = time;
        if(domicile_id == 0){
            domicile_id = null;
            domicile = "Equipe domicile";
        }
        line.domicile_id = domicile_id;
        line.domicile = domicile;
        if(!rDomicile)
          rDomicile=null;
        line.rDomicile = rDomicile;
        if(!rExterieur)
          rExterieur = null;
        line.rExterieur = rExterieur;
        if(exterieur_id == 0){
            exterieur_id = null;
            exterieur = "Equipe extérieur";
        }
        line.exterieur_id = exterieur_id;
        line.exterieur = exterieur;
        if(!lieu){
            lieu = "A définir";
        }
        line.lieu = lieu;
        line.calendarLine_id = calendarLine_id;
        line.competition_id = competition_id;

        //console.log(competition_id);
//        console.log(line);

        this.allLine.push(line);


    }
    displayNewCalendarLine(newCalendarLine){

        //console.log(newCalendarLine);
        newCalendarLine = JSON.parse(newCalendarLine);

        var line = $('.table-calendar-admin tr[data-id='+newCalendarLine.calendarLine_id+'] td').empty();
        var div_button = $('<div>').attr("class","edit-calendarline").attr("data-id",newCalendarLine.calendarLine_id).attr("data-competition",newCalendarLine.competition_id);

        div_button.on("click",(event)=>this.OnEditCalendarLineClick(event));

        var icone_edit = $('<i>').attr("class","fas fa-pen");

        $('.table-calendar-admin tr[data-id='+newCalendarLine.calendarLine_id+'] .cell-button').append(div_button);

        div_button.append(icone_edit);

        $('.table-calendar-admin tr[data-id='+newCalendarLine.calendarLine_id+'] .date').text(newCalendarLine.date);
        $('.table-calendar-admin tr[data-id='+newCalendarLine.calendarLine_id+'] .time').text(newCalendarLine.time);
        $('.table-calendar-admin tr[data-id='+newCalendarLine.calendarLine_id+'] .domicile').text(newCalendarLine.domicile);
        $('.table-calendar-admin tr[data-id='+newCalendarLine.calendarLine_id+'] .resultat_domicile').text(newCalendarLine.resultat_domicile);
        $('.table-calendar-admin tr[data-id='+newCalendarLine.calendarLine_id+'] .resultat_exterieur').text(newCalendarLine.resultat_exterieur);
        $('.table-calendar-admin tr[data-id='+newCalendarLine.calendarLine_id+'] .exterieur').text(newCalendarLine.exterieur);
        $('.table-calendar-admin tr[data-id='+newCalendarLine.calendarLine_id+'] .lieu').text(newCalendarLine.lieu);
    //    console.log(newCalendarLine);
    }

    displayLineOfRanking(championshipLine,index){
        $('.table-ranking-admin tbody tr[data-id='+index+'] .classement').text(index);
        $('.table-ranking-admin tbody tr[data-id='+index+'] .name').text(championshipLine.name);
        $('.table-ranking-admin tbody tr[data-id='+index+'] .pts').text(championshipLine.pts);
        $('.table-ranking-admin tbody tr[data-id='+index+'] .J').text(championshipLine.J);
        $('.table-ranking-admin tbody tr[data-id='+index+'] .G').text(championshipLine.G);
        $('.table-ranking-admin tbody tr[data-id='+index+'] .N').text(championshipLine.N);
        $('.table-ranking-admin tbody tr[data-id='+index+'] .P').text(championshipLine.P);
        $('.table-ranking-admin tbody tr[data-id='+index+'] .Butpour').text(championshipLine.Butpour);
        $('.table-ranking-admin tbody tr[data-id='+index+'] .Butcontre').text(championshipLine.Butcontre);
        $('.table-ranking-admin tbody tr[data-id='+index+'] .Diff').text(championshipLine.Diff);
    }
    displayNewRanking(championshipLines){
        //console.log("championshipLines");
        console.log(championshipLines);
        $('.table-ranking-admin tbody td').empty();
        var index = 1;
        for(var championshipLine of championshipLines ){
            //console.log(championshipLine);
            this.displayLineOfRanking(championshipLine,index);
            index++;
        }
    }
    updateRanking(competition_id,calendarLine_id){
        //console.log(this);
         $.getJSON(getRequestUrl() + '/admin/competition/championship/ranking/update?competition_id='+competition_id,(championshipLines)=>this.displayNewRanking(championshipLines));
    }
    OnValidateClick(event){

        this.recupFormForUpdate(event);
        var data = {
            "line" : JSON.stringify(this.allLine)
        }
        var line = this.allLine[0];
        //console.log(line);

        this.allLine = [];
        //console.log(line);
        $.post(getRequestUrl()+"/admin/competition/championship/calendar/update",data,(newCalendarLine)=>this.displayNewCalendarLine(newCalendarLine));
        // console.log(line.domicile_id);
        // console.log(line.rDomicile);
        // console.log(line.exterieur_id);
        // console.log(line.rExterieur);

         if(line.domicile_id && line.rDomicile && line.exterieur_id && line.rExterieur){
             // console.log("remise a zero ranking");
             // console.log(line.competition_id);

             this.updateRanking(line.competition_id,line.calendarLine_id);

        }

        //console.log(newCalendarLine);


    }

}
