<?php
use Farm\Task\Models\Farm\Farm;
use Farm\Task\Models\Livestocks\Chicken;
use Farm\Task\Models\Livestocks\Cow;
use Farm\Task\Models\Production\Egg;
use Farm\Task\Models\Production\Milk;

require_once __DIR__ . '/autoload.php';

$farm = new Farm();
$farm->setDaysInCycle(7);

//register cows
for ($i=0; $i < 10; $i++) {
    $farm->register(new Cow);
}
//register chickens
for($i=0; $i < 20; $i++)
{
    $farm->register(new Chicken);
}


//$population = $farm->getPopulation();
echo $farm->getReportOnPopulation() . PHP_EOL;

$productions = $farm->getProduction();
echo $farm->getReportOnLastCollecting() . PHP_EOL;


$farm->register(new Cow);
for($i = 0; $i < 5; $i++)
{
    $farm->register(new Chicken);
}
echo $farm->getReportOnPopulation() . PHP_EOL;

$productions = $farm->getProduction();
echo $farm->getReportOnLastCollecting() . PHP_EOL;