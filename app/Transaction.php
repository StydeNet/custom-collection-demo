<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function newEloquentBuilder($query)
    {
        return new TransactionBuilder($query);
    }

    public function newCollection(array $models = [])
    {
        return new TransactionCollection($models);
    }
}
