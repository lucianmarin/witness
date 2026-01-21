<?php
    include 'app/context.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $rpc = $_POST['rpc'];
        $handle = $_POST['handle'];

        if (isset($rpc) and isset($handle) and trim($rpc) and trim($handle)) {
            $witness['rpc'] = stripslashes(trim($rpc));
            $witness['handle'] = stripcslashes(trim($handle));
            $witness['created'] = time();

            $witnesses = restore('witnesses');
            array_push($witnesses, $witness);
            store('witnesses', $witnesses);

            header('Location: /witnesses.php');
            exit;
        }
    }

    $witnesses = restore('witnesses');
?>

<? include 'template/header.php'; ?>
<? include 'template/menu.php'; ?>

<div class="post">
    <div class="center">
        <form method="post" autocomplete="off">
            <input type="url" name="rpc" placeholder="RPC link" autofocus />
            <input type="text" name="handle" placeholder="Handle" autofocus />
            <input type="submit" value="Add" />
        </form>
    </div>
</div>

<div class="main">
	<div class="center">
		<? foreach ($witnesses as $witness): ?>
		    <div class="entry">
    		    <div class="avatar">
        		    <img src="<?= getAvatar($witness['rpc']) ?>" width="32" height="32" />
    		    </div>
    	        <p class="meta">
        	        <?= humanTiming($witness['created']) ?> ago as
        	        @<?= $witness['handle'] ?>
    	        </p>
                <p class="content"><?= $witness['rpc'] ?></p>
		    </div>
		<? endforeach; ?>
	</div>
</div>

<? include 'template/footer.php'; ?>
