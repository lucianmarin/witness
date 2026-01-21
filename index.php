<?php
    include 'app/context.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $content = $_POST['content'];

        if (isset($content) and trim($content)) {
            $content = stripslashes($content);
            $post['content'] = $content;
            $post['created'] = time();

            $posts = restore('posts');
            array_push($posts, $post);
            store('posts', $posts);

            $mentions = getHandles($content);
            $witnesses = restore('witnesses');

            foreach ($mentions as $mention) {
                foreach ($witnesses as $witness) {
                    if ($mention === $witness['handle']) {
                        $params = array('content' => $content,
                                    'rpc' => getRPC(),
                                    'created' => time());
                        $response = httpPost($witness['source'], $params);
                    }
                }
            }

            header('Location: /');
            exit;
        }
    }

    $posts = getSlice(restore('posts'));
?>

<? include 'template/header.php'; ?>
<? include 'template/menu.php'; ?>

<div class="post">
    <div class="center">
        <form method="post" autocomplete="off">
            <input type="text" name="content" placeholder="Anything new?" autofocus />
        </form>
    </div>
</div>

<div class="main">
	<div class="center">
		<? foreach ($posts as $post): ?>
		    <div class="entry">
    		    <div class="avatar">
        		    <img src="/static/icon.png" width="32" height="32" />
    		    </div>
    	        <p class="meta"><?= humanTiming($post['created']) ?> ago</p>
                <div class="content"><?= htmlspecialchars($post['content']) ?></div>
		    </div>
		<? endforeach; ?>
	</div>
</div>

<? include 'template/footer.php'; ?>
