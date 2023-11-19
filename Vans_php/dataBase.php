<?php
$env = parse_ini_file('.env');
$servername =  $env['DB_HOST'];
$port= $env['DB_PORT'];
$username = $env['DB_USERNAME'];
$password = $env['DB_PASSWORD'];
$dbname = $env['DB_DATABASE'];

$servername_mac =  $env['DB_HOST_MAC'];
$port_mac= $env['DB_PORT_MAC'];
$username_mac = $env['DB_USERNAME_MAC'];
$password_mac = $env['DB_PASSWORD_MAC'];
$dbname_mac = $env['DB_DATABASE_MAC'];

    try{
        //windows
        $dbh = new PDO("mysql:dbname=$dbname;host=$servername;charset=utf8;port=$port", $username, $password);
    } catch (Exception $e) {

        // Mac
        $dbh = new PDO("mysql:dbname=$dbname_mac;host=$servername_mac;charset=utf8;port=$port_mac", $username_mac, $password_mac);
        // Ou si on veut le message, $e->message
    }