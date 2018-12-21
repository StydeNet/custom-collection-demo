<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use App\{Transaction, TransactionCollection};
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    function it_gets_the_transactions_in_the_given_month()
    {
        $transactionInMay31 = $this->createTransactionAt(2018, 5, 31);
        $transactionInJune1 = $this->createTransactionAt(2018, 6, 1);
        $transactionInJune30 = $this->createTransactionAt(2018, 6, 30);
        $transactionInJuly1 = $this->createTransactionAt(2018, 7, 1);

        $transactions = Transaction::reportFor(2018, 6);

        $this->assertFalse($transactions->contains($transactionInMay31));
        $this->assertTrue($transactions->contains($transactionInJune1));
        $this->assertTrue($transactions->contains($transactionInJune30));
        $this->assertFalse($transactions->contains($transactionInJuly1));
    }

    protected function createTransactionAt($year, $month, $day)
    {
        return factory(Transaction::class)->create([
            'created_at' => Carbon::createFromDate($year, $month, $day),
        ]);
    }
    
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
