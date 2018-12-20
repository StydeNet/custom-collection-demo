<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\{Transaction, TransactionCollection};
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    function it_returns_a_custom_collection()
    {
        $transactions = Transaction::all();

        $this->assertInstanceOf(TransactionCollection::class, $transactions);
    }

    /** @test */
    function it_gets_the_total_amount_in_the_transactions_collection()
    {
        factory(Transaction::class)->create(['amount' => 10]);
        factory(Transaction::class)->create(['amount' => 20]);
        factory(Transaction::class)->create(['amount' => 30]);

        $transactions = Transaction::all();

        $this->assertSame(60, $transactions->total());
    }
}
