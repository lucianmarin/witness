<!DOCTYPE html>
<html>
	<head>
	    <title>Witness</title>
	    <meta charset="utf-8" />
	    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0" />
	    <link rel="apple-touch-icon" type="image/png" href="/static/icon.png" />
	    <link rel="icon" sizes="192x192" type="image/png" href="/static/icon.png" />

	    <? if (isset($_COOKIE['theme']) and $_COOKIE['theme'] === 'black'): ?>
	        <link rel="stylesheet" type="text/css" href="/static/black.css" />
	    <? else: ?>
	        <link rel="stylesheet" type="text/css" href="/static/white.css" />
	    <? endif; ?>

	    <link rel="stylesheet" type="text/css" href="/static/style.css" />
	    <script type="text/javascript" src="/static/script.js" defer></script>
	</head>
<body>
