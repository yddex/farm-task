<?php

namespace Farm\Task\Models\Farm;

use Farm\Task\Models\Livestocks\Livestock;

class Farm implements IFarm
{

    use FarmReportTrait;
    protected int $livestocksCount;
    protected array $livestocks;
    //Storage statistics about every cycle
    protected array $storeStatsByCycles;
    protected int $daysInCycle = 1;

    public function __construct()
    {
        $this->livestocksCount = 0;
    }

    public function register(Livestock $livestock): void
    {
        $type = $livestock::class;
        if(!isset($this->livestocks[$type])){
            $this->livestocks[$type] = [];
        }
        $this->livestocksCount++;

        $livestock->setSerial($this->getSerial());
        $this->livestocks[$type][] = $livestock;
    }
    

    public function getPopulation(): array | int
    {
        if(!count($this->livestocks))
        {
            return 0;
        }

        $population = [];
        foreach($this->livestocks as $type => $livestocks)
        {
            $population[$type] = count($livestocks); 
        }
        return $population;
    }

    public function getProduction(): array
    {
        $cycleResult = [];

        for ($i=0; $i < $this->daysInCycle; $i++) { 
            $this->collectingWithSort($cycleResult);
        }

        $cycleResult['date'] = date('d-m-Y');
        $this->storeStatsByCycles[] = $cycleResult;

        return $cycleResult;
    }

    protected function collectingWithSort(array &$cycleResult)
    {
        foreach($this->livestocks as $livestocks)
        {   
            //init structure in result
            $type = $livestocks[0]->getProductionType();
            if(!isset($cycleResult[$type])){
                $cycleResult[$type] = 
                [
                    'production' => [],
                    'count' => 0
                ];
            }

            //Collecting production of every animal  
            foreach($livestocks as $livestock)
            {
                array_push($cycleResult[$type]['production'], ...$livestock->collectProduction());
            }

            $cycleResult[$type]['count'] = count($cycleResult[$type]['production']);
        }

    }

    /**
     * Generate some serial number for this farm
     * @return int
     */
    protected function getSerial() :int
    {   
        return $this->livestocksCount * 100;
    }

    /**
     * Set the value of daysInCycle
     *
     * @param int $daysInCycle
     *
     */
    public function setDaysInCycle(int $daysInCycle) :void
    {
        $this->daysInCycle = $daysInCycle;
    }
}