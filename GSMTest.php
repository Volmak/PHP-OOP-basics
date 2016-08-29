<?php

require_once 'e02/Call.php';
require_once 'e02/GSM.php';
use e02\GSM;
use e02\Call;

$ivans = new GSM('CAT C40');
$vaskos = new GSM('BlackBerry');

echo 'Call 1:' . PHP_EOL;
$ivans->call($vaskos, 60, $error);
$error ? print $error . PHP_EOL : false;

echo PHP_EOL . 'Call 2:' . PHP_EOL;
$vaskos->insertSimCard('+359 884/34-29-84');
$ivans->call($vaskos, 60, $error);
$error ? print $error . PHP_EOL : false;

echo PHP_EOL . 'Call 3:' . PHP_EOL;
$ivans->insertSimCard('0885352254');
$ivans->call($vaskos, 13.60, $error);
$error ? print $error . PHP_EOL : false;

echo PHP_EOL . 'Call 4:' . PHP_EOL;
$ivans->call($vaskos, '2:10', $error);
$error ? print $error . PHP_EOL : false;

echo PHP_EOL . 'Call 5:' . PHP_EOL;
$vaskos->call($ivans, '53.59', $error);
$error ? print $error . PHP_EOL : false;


echo PHP_EOL . 'Call object:' . PHP_EOL;
$call = new Call($ivans, $vaskos, 13.59);
echo $call->getCaller()->getSumForCalls() . PHP_EOL;
echo $call->getReceiver()->getOutgoingCallsDuration() . PHP_EOL;
echo $call->getDuration() . PHP_EOL;

$call->setPriceForAMinute(1);
Call::$priceForAMinute = 2;

$ivans->call($vaskos, '2|25');
$vaskos->call($ivans, '33-13');

echo PHP_EOL . 'Info for the last calls:' . PHP_EOL;
$ivans->printInfoForTheLastIncomingCall();
$vaskos->printInfoForTheLastOutgoingCall();

$ivans->getSumForCalls();