<?php
    include 'app/context.php';

    $feed = array();
    $witneses = restore('witnesses');

    foreach ($witneses as $witness) {
        $url = $witness['rpc'];
        $json = @file_get_contents($url);
        if ($json) {
            $posts = json_decode($json, true);
            $temp = array();
            foreach ($posts as $post) {
                $post['rpc'] = $url;
                $post['avatar'] = getAvatar($url);
                $post['handle'] = $witness['handle'];
                array_push($temp, $post);
            }
            $posts = $temp;
        } else {
            $posts = array();
        }
        $feed = array_merge($feed, $posts);
    }

    usort($feed, 'cmp');
    $feed = getSlice($feed);
?>

<? include 'template/header.php'; ?>
<? include 'template/menu.php'; ?>

<div class="main">
	<div class="center">
		<? foreach ($feed as $post): ?>
		    <div class="entry">
    		    <div class="avatar">
        		    <img src="<?= $post['avatar'] ?>" width="32" height="32" />
    		    </div>
    	        <p class="meta">
        	        <?= humanTiming($post['created']) ?> ago by
        	        @<?= $post['handle'] ?>
        	    </p>
                <p class="content"><?= htmlspecialchars($post['content']) ?></p>
		    </div>
		<? endforeach; ?>
	</div>
</div>

<? include 'template/footer.php'; ?>
