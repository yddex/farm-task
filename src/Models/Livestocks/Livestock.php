<?php
namespace Farm\Task\Models\Livestocks;

use Farm\Task\Models\Production\Production;
abstract class Livestock
{
    protected int $serial;
    protected int $minProductionQuantity;
    protected int $maxProductionQuantity;
    protected string $productionType;
    
    public function __construct()
    {
        $this->minProductionQuantity = $this->getMinQuantity();
        $this->maxProductionQuantity = $this->getMaxQuantity();
        $this->productionType = $this->getProduction()::class;
    }

    /**
     * Collecting production by one time
     * @return Production[] 
     */
    public function collectProduction() :array
    {   
        $count = mt_rand($this->minProductionQuantity, $this->maxProductionQuantity);
        $collected = [];
        
        for ($i=0; $i < $count; $i++) { 
            $collected[] = $this->getProduction();
        }
        return $collected;
    }

    /**
     * Minimum quantity of production
     * @return int
     */
    abstract protected function getMinQuantity(): int;

     /**
     * Maximum quantity of production
     * @return int
     */
    abstract protected function getMaxQuantity(): int;

    /**
     * Returns one instance of the Production class
     * @return Production
     */
    abstract public function getProduction(): Production;


    /**
     * Get the value of serial number
     *
     * @return $serial
     */
    public function getSerial()
    {
        return $this->serial;
    }


    /**
     * Set the value of serial number
     *
     * @param int $serial
     *
     */
    public function setSerial(int $serial)
    {
        $this->serial = $serial;
    }



    /**
     * Get the value of productionType
     *
     * @return string
     */
    public function getProductionType(): string
    {
        return $this->productionType;
    }
}