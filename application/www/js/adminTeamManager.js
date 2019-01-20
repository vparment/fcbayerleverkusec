class adminTeamManager {
        constructor(){
            $(".delete-player").on("click",(event)=>this.OnDeletePlayerClick(event));

            $(".edit-player").on("click",(event)=>this.OnEditPlayerClick(event));
        }
// On delete player
        OnDeletePlayerClick(event){
            var player_id = $(event.currentTarget).data('id');
            $.getJSON(getRequestUrl() + '/admin/team?action=delete-player&player_id='+player_id,this.getNewTablePlayers.bind(this)) ;
        }
        getNewTablePlayers(newListPlayers){
            $('.table-team-admin tbody').empty();

            for (var player of newListPlayers){
                this.getLineListPlayers(player);
            }
        }
        getLineListPlayers(player){
            var tr_player = $('<tr>');
            var td_position = $('<td>');
            var td_number = $('<td>');
            var td_name = $('<td>');
            var td_pseudo = $('<td>');
            var td_description = $('<td>');
            var td_button = $('<td>');
            var div_edit = $('<div>');
            var i_edit = $('<i>');
            var div_delete = $('<div>');
            var i_delete = $('<i>');

            $('.table-team-admin tbody').append(tr_player);

            tr_player.append(td_position).append(td_number).append(td_name).append(td_pseudo).append(td_description).append(td_button);

            td_button.attr("class","cell-button").append(div_edit).append(div_delete);

            div_edit.attr("class","edit-player").attr("data-id", player.player_id).append(i_edit);
            div_delete.attr("class","delete-player").attr("data-id", player.player_id).append(i_delete);

            $(".delete-player").on("click",(event)=>this.OnDeletePlayerClick(event));
            $(".edit-player").on("click",(event)=>this.OnEditPlayerClick(event));

            i_edit.attr("class","fas fa-pen");
            i_delete.attr("class","fas fa-trash-alt");

            td_position.text(player.position);
            td_number.text(player.number);
            td_name.text(player.name);
            td_pseudo.text(player.pseudo);
            td_description.text(player.description);

        }
// On edit player
        OnEditPlayerClick(event){
            var player_id = $(event.currentTarget).data('id');
            $.getJSON(getRequestUrl() + '/admin/team?action=edit-player&player_id='+player_id,this.getNewFormPlayer.bind(this));
        }
        getNewFormPlayer(player){
            var button_edit = $('<button>');
            var button_cancel = $('<button>');

            $('.div-button').empty();
            $('.fieldset-team-admin form').attr("action",getRequestUrl() + '/admin/team?action=update-player&player_id='+player.player_id);

            $(".fieldset-team-admin legend").text("Modifier un joueur");
            $(".fieldset-team-admin input[name=name]").attr("value",player.name);

            $(".fieldset-team-admin input[name=pseudo]").attr("value",player.pseudo);
            $(".fieldset-team-admin input[name=description]").attr("value",player.description);
            $(".fieldset-team-admin input[name=number]").attr("value",player.number);

            $(".fieldset-team-admin select[name=position] option[value="+player.position_id+"]").attr("selected","selected")

            $(".div-button").append(button_edit).append(button_cancel);

            button_edit.text("Modifier le joueur").attr("data-id", player.player_id).attr("class","insert-player");
            button_cancel.text("Annuler");

        }

}
