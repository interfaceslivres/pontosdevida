<?php

    $db_connection = pg_connect("host=localhost dbname=PontosDeVida user=postgres  password=pontosdevida");
    $result = pg_query($db_connection, "SELECT * FROM usuario");
    $data = pg_fetch_array($result, NULL, PGSQL_ASSOC);
    echo "Nome from DB was: ".$data['email'];
    
?>

