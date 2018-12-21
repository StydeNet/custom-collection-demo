<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;

class TransactionCollection extends Collection
{
    public function total()
    {
        return $this->sum('amount');
    }
}
