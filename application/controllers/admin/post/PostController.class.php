<?php

class PostController
{
    public function __construct(){
        $this->postControl  = new PostModel();
    }
    public function httpGetMethod(Http $http, array $queryFields)
    {
        if (isset($_GET['action'])) {
            if($_GET['action'] == "delete-post"){
                $this->postControl->deletePost($_GET['post_id']);
                $posts = $this->postControl->selectAllPosts();
                echo json_encode($posts);
                exit();
            }
            if($_GET['action'] == "edit-post" && isset($_GET['post_id'])){
                $post = $this->postControl->selectOnePost($_GET['post_id']);
                echo json_encode($post);
                exit();
            }
        }
        $posts = $this->postControl->selectAllPosts();
        return ["posts"=>$posts];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        if (isset($_GET['action'])) {
            if($_GET['action'] == "insert-post")
            {
                $this->postControl->insertPost($_POST['title'],$_POST['content'],$_POST['description']);
            }
            if($_GET['action'] == "update-post" && !empty($_POST)){
                $this->postControl->updatePost($_POST['title'],$_POST['content'],$_POST['description'],$_GET['post_id']);
            }
        }
        $posts = $this->postControl->selectAllPosts();
        return ["posts"=>$posts];
    }
}
