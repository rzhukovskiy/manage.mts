<?php
/**
 * Created by PhpStorm.
 * User: dsamotoy
 * Date: 02.04.2016
 * Time: 16:19
 */
$config['db']['connectionString'] = 'mysql:host=localhost;dbname=mts';
$config['db']['username'] = 'root';
$config['db']['password']  = '';

$db = setDbAdapter($config);

/**
 * Инициализация экхемпляра PDO для доступа к БД.
 */
function setDbAdapter($config) {
    try {
        $db = new PDO($config['db']['connectionString'], $config['db']['username'], $config['db']['password']);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
    $db->query('SET NAMES UTF8');

    return $db;
}
