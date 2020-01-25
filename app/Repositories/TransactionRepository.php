<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class TransactionRepository
{

    public function getTransactions() 
    {
        $results = DB::table('transactions')->get();
    	
        return $results;
    }

	public function getTransactionsArray() 
    {
        return json_decode(json_encode($this->getTransactions()), true);
    }    

}
