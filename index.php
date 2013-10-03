<?php
/**
 * Created by Thibaud BARDIN (Irvyne)
 * This code is under the MIT License (https://github.com/Irvyne/license/blob/master/MIT.md)
 */

require __DIR__.'/autoload.php';
require __DIR__.'/config/config.php';

$myPDO = new MyPDO($config);
$pdo = $myPDO->getPDO();

$movie = new Movie(array(
    'title'     => 'Eastern Promises',
    'director'  => 'David Cronenberg',
    'actors'    => array('Naomi Watts', 'Viggo Mortensen'),
));

$movie->addActor('Thibaud Bardin');
$movie->removeActor('Viggo Mortensen');

$movieManager = new MovieManager($pdo);
$movieManager->add($movie);

$movie = $movieManager->find(1);
$movie->setDirector('New Director');
$movieManager->update($movie);
var_dump($movie);