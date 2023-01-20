<?php
namespace Farm\Task\Models\Farm;

use Farm\Task\Models\Livestocks\Chicken;
use Farm\Task\Models\Livestocks\Cow;
use Farm\Task\Models\Production\Egg;
use Farm\Task\Models\Production\Milk;

trait FarmReportTrait
{   

    /**
     * Get report about population in readable string
     * @return string
     */
    public function getReportOnPopulation() :string
    {   
        $population = $this->getPopulation();
        $cows = $population[Cow::class] ?? 0 ;
        $chickens = $population[Chicken::class] ?? 0;

        $report =   
        'Коров на ферме: ' .$cows . PHP_EOL .
        'Куриц на ферме: ' . $chickens  . PHP_EOL;
        
        return $report;
    }

    /**
     * Get a report on the latest collection in readable string
     * @return string
     */
    public function getReportOnLastCollecting() :string
    {
        $productions = $this->storeStatsByCycles[count($this->storeStatsByCycles) - 1];
        $milk =  $productions[Milk::class]['count'] ?? 0;
        $eggs =  $productions[Egg::class]['count'] ?? 0;

        $report = 
        'За неделю полученно: ' . PHP_EOL .
        $milk . ' литров молока.' . PHP_EOL .
        $eggs . ' яиц' . PHP_EOL;

        return $report;
    }    

}