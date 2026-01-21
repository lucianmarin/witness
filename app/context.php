<?php
    error_reporting(-1);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    date_default_timezone_set('Europe/Bucharest');

    $self = $_SERVER['PHP_SELF'];
    $password = '95192c98732387165bf8e396c0f2dad2';
    $date_format = 'M j, Y G:i:s';

    $auth = False;
    if (isset($_COOKIE['user']) and $_COOKIE['user'] === $password) {
        $auth = True;
    }

    function cmp($a, $b) { return $b['created'] - $a['created']; }

    function restore($type) {
        if (in_array($type, array('posts', 'mentions', 'witnesses'), true)) {
            $file = 'data/'.$type.'.json';
            $posts = json_decode(file_get_contents($file), true);
            usort($posts, 'cmp');
            return $posts;
        }
    }

    function store($type, $input) {
        if (in_array($type, array('posts', 'mentions', 'witnesses'), true)) {
            $file = 'data/'.$type.'.json';
            file_put_contents($file, json_encode($input));
        }
    }

    function httpPost($url, $data) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    function humanTiming($time) {
        $time = time() - $time; // to get the time since that moment
        $time = ($time<1)? 1 : $time;
        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
        }
    }

    function getRPC() {
        if (isset($_SERVER['HTTPS']) and $_SERVER['HTTPS']) {
            $from = 'https://'.$_SERVER['SERVER_NAME'].'/rpc.php';
        } else {
            $from = 'http://'.$_SERVER['SERVER_NAME'].'/rpc.php';
        }
        return $from;
    }

    function domainName($url) {
        $parse = parse_url($url);
        return $parse['host'];
    }

    function getHandles($content) {
        $words = explode(' ', $content);
        $handles = array();
        foreach ($words as $word) {
            if (trim($word) and 0 === strpos($word, '@')) {
                $handle = substr($word, 1, strlen($word) - 1);
                if (ctype_lower($handle)) {
                    array_push($handles, $handle);
                    // echo('<p>'.$handle.'</p>');
                }
            }
        }
        return $handles;
    }

    function getAvatar($rpcURL) {
        return chop($rpcURL, 'rpc.php').'static/icon.png';
    }

    function getSlice($array) {
        return array_slice($array, 0, 10, true);
    }
?>
