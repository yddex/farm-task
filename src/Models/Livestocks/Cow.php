<?php
namespace Farm\Task\Models\Livestocks;

use Farm\Task\Models\Production\Production;
use Farm\Task\Models\Production\Milk;
class Cow extends Livestock
{
    protected function getMinQuantity(): int
    {
        return 8;
    }

    protected function getMaxQuantity(): int
    {
        return 12;
    }

    public function getProduction(): Production
    {
        return new Milk;
    }
}

