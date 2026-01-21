<?php
    include 'app/context.php';
    $mentions = getSlice(restore('mentions'));
?>

<? include 'template/header.php'; ?>
<? include 'template/menu.php'; ?>

<div class="main">
	<div class="center">
		<? foreach ($mentions as $mention): ?>
		    <div class="entry">
    		    <div class="avatar">
        		    <img src="<?= getAvatar($mention['rpc']) ?>" width="32" height="32" />
    		    </div>
    	        <p class="meta">
        	        <?= humanTiming($mention['created']) ?> ago from
        	        <?= domainName($mention['rpc']) ?>
    	        </p>
                <p class="content"><?= $mention['content'] ?></p>
		    </div>
		<? endforeach; ?>
	</div>
</div>

<? include 'template/footer.php'; ?>
