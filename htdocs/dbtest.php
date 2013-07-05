<?php

    $url=parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"],1);

    mysql_connect($server, $username, $password, true, MYSQL_CLIENT_SSL | MYSQL_CLIENT_COMPRESS);
    
    mysql_select_db($db);

    echo "connected";
