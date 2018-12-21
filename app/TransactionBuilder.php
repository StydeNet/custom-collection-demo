<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class TransactionBuilder extends Builder
{
    public function reportFor($year, $month)
    {
        return $this->whereBetween('created_at', [
            Carbon::create($year, $month)->startOfMonth(),
            Carbon::create($year, $month)->endOfMonth()
        ])->get();
    }
}