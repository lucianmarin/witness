<?php
    include 'app/context.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        header('Content-Type: application/json');
        if  (isset($_POST['content']) and isset($_POST['from'])) {
            foreach($_POST as $key => $post) {
                echo '<p>'.$key.': '.$post.'</p>';
            }
            $mention['content'] = stripslashes($_POST['content']);
            $mention['rpc'] = stripslashes($_POST['rpc']);
            $mention['created'] = intval($_POST['created']);
            $mention['viewed'] = false;

            $mentions = restore('mentions');
            array_push($mentions, $mention);
            store('mentions', $mentions);

            echo json_encode("OK");
        } else {
            echo json_encode("NOT OK");
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $posts = restore('posts');
        $posts = array_slice($posts, 0, 10, true);
        header('Content-Type: application/json');
        echo json_encode($posts);
    }
?>
