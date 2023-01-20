<?php
namespace Farm\Task\Models\Livestocks;

use Farm\Task\Models\Production\Production;
use Farm\Task\Models\Production\Egg;
class Chicken extends Livestock
{
    protected function getMinQuantity(): int
    {
        return 0;
    }

    protected function getMaxQuantity(): int
    {
        return 1;
    }

    public function getProduction(): Production
    {
        return new Egg;
    }
}