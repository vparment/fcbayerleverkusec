<?php

class PostController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {

        $postControl  = new PostModel();
        if (isset($_GET['action'])) {
            if($_GET['action'] == "delete-post"){
            $postControl->deletePost($_GET['post_id']);
            $posts = $postControl->selectAllPosts();
            echo json_encode($posts);
            exit();
            }
            if($_GET['action'] == "edit-post" && isset($_GET['post_id'])){
                $post = $postControl->selectOnePost($_GET['post_id']);
                echo json_encode($post);
                exit();
            }
        }
        $posts = $postControl->selectAllPosts();
        return ["posts"=>$posts];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        $postControl  = new PostModel();
        if (isset($_GET['action'])) {
            if($_GET['action'] == "insert-post")
            {
                $postControl->insertPost($_POST['title'],$_POST['content'],$_POST['description']);
            }
            if($_GET['action'] == "update-post" && !empty($_POST)){
                $postControl->updatePost($_POST['title'],$_POST['content'],$_POST['description'],$_GET['post_id']);
            }
        }
        $posts = $postControl->selectAllPosts();
        return ["posts"=>$posts];

    }
}
