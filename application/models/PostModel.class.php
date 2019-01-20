<?php

class PostModel{
    function selectAllPosts(){
        $database = new Database();
        $posts = $database->query("
            SELECT  *
            FROM post
            WHERE 1
            ORDER BY date DESC
        ");
        return $posts;
    }
    function selectLimitPosts(){
        $database = new Database();
        $limitPosts = $database->query("
            SELECT  *
            FROM post
            ORDER BY date DESC
            LIMIT 5
        ");
        return $limitPosts;
    }
    function selectOnePost($post_id){
        $database = new Database();
        $post = $database->queryOne("
            SELECT  *
            FROM post
            WHERE post_id=?
        ",[$post_id]);
        return $post;
    }
    function insertPost($title,$content,$description){
        $database = new Database();
        $database->executeSql("
            INSERT INTO post (title,content,description,date)
            VALUES (?,?,?,NOW())
        ",[$title,$content,$description]);
    }
    function updatePost($title,$content,$description,$post_id){
        $database = new Database();
        $database->executeSql("
            UPDATE post
            SET title=?, content=?, description=? , date=NOW()
            WHERE post_id=?
        ",[$title,$content,$description,$post_id]);
    }
    function deletePost($post_id){
        $database = new Database();
        $database->executeSql("
            DELETE FROM post WHERE post_id=?
        ",[$post_id]);
    }
}
?>
