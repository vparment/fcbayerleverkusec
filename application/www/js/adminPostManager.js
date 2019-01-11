'use strict';

class adminPostManager {
        constructor(){

            $(".delete-post").on("click",(event)=>this.OnDeletePostClick(event));
            $(".edit-post").on("click",(event)=>this.OnEditPostClick(event));
        }
        OnDeletePostClick(event){
            console.log(event);

            //console.log(event);
            var post_id = $(event.currentTarget).data('id');
            //$.getJSON('search_post.php?word='+beginning_title_post,GetListPost);
            $.getJSON(getRequestUrl() + '/admin/post?action=delete-post&post_id='+post_id,this.getNewTablePosts.bind(this)) ;
            //$.getJSON('admin.php?action=delete-post&id='+post_id,(reponseAjax)=>this.getNewTablePosts(reponseAjax)) ;
        }
        OnEditPostClick(event){
            console.log(event);
            var post_id = $(event.currentTarget).data('id');

            //$.getJSON('search_post.php?word='+beginning_title_post,GetListPost);
//getRequestUrl() + '/admin
            $.getJSON(getRequestUrl() + '/admin/post?action=edit-post&post_id='+post_id,this.getNewFormPost.bind(this));
            //$.getJSON('admin.php?action=delete-post&id='+post_id,(reponseAjax)=>this.getNewTablePosts(reponseAjax)) ;    getRequestUrl() + '/order/payment?id='
        }

        getLineListPosts(post){
            var tr_post = $('<tr>');
            var td_title = $('<td>');
            var td_content = $('<td>');
            var td_description = $('<td>');
            var td_button = $('<td>');
            var div_edit = $('<div>');
            var i_edit = $('<i>');
            var div_delete = $('<div>');
            var i_delete = $('<i>');

            $('.table-post-admin tbody').append(tr_post);
            tr_post.append(td_title).append(td_content).append(td_description).append(td_button);

            td_button.attr("class","cell-button").append(div_edit).append(div_delete);

            div_edit.attr("class","edit-post").attr("data-id", post.post_id).append(i_edit);
            div_delete.attr("class","delete-post").attr("data-id", post.post_id).append(i_delete);

            $(".delete-post").on("click",(event)=>this.OnDeletePostClick(event));
            $(".edit-post").on("click",(event)=>this.OnEditPostClick(event));

            i_edit.attr("class","fas fa-pen");
            i_delete.attr("class","fas fa-trash-alt");

            td_title.text(post.title);
            td_content.text(post.content);
            td_description.text(post.description);
        }
        getNewFormPost(post){
            console.log(post);
            console.log(post.post_id);
            $('.div-button').empty();
            $('.fieldset-post-admin form').attr("action",getRequestUrl() + '/admin/post?action=update-post&post_id='+post.post_id);
            var button_edit = $('<button>');
            var button_cancel = $('<button>')

            $(".fieldset-post-admin legend").text("Modifier un article");
            $(".fieldset-post-admin input[name=title]").attr("value",post.title);
            $(".fieldset-post-admin textarea").text(post.content);
            $(".fieldset-post-admin input[name=description]").attr("value",post.description);

            $(".div-button").append(button_edit).append(button_cancel);

            button_edit.text("Modifier l'article").attr("data-id", post.post_id).attr("class","insert-post");

            button_cancel.text("Annuler");

        }
        getNewTablePosts(newListPosts){
            $('.table-post-admin tbody').empty();
            for (var post of newListPosts){
                //console.log(this.bind(adminManager));
                this.getLineListPosts(post);
            }
        }
}
