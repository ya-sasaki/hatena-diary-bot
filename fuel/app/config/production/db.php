<?php
/**
 * The production database settings.
 */
$services_json = json_decode(getenv("VCAP_SERVICES"),true);
$mysql_config = $services_json["mysql-5.1"][0]["credentials"];
$username = $mysql_config["username"];
$password = $mysql_config["password"];
$hostname = $mysql_config["hostname"];
$port = $mysql_config["port"];
$db = $mysql_config["name"];

return array(
    'default' => array(
        'connection'  => array(
            'dsn'        => "mysql:host=".$hostname.";port=".$port.";dbname=".$db,
            'username'   => $username,
            'password'   => $password,
        ),
    ),
);
