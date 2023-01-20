<?php
namespace Farm\Task\Models\Farm;

use Farm\Task\Models\Livestocks\Livestock;

interface IFarm
{   
    /**
     * Register new livestock to farm
     * @param Livestock $livestock
     * @return void
     */
    public function register(Livestock $livestock) :void;

    /**
     * Collecting production per cycle
     * @return array ['LivestockType' => ['count' => count, 'production' => array]]
     */
    public function getProduction(): array;

    /**
     * Get assoc array with count of every livestock in farm
     * @return array|int ['livestock' => count] Or 0 
     */
    public function getPopulation() :array | int;


}