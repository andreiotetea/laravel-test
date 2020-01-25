<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\TransactionRepository;
use App\Repositories\CsvRepository;

class TransactionController extends Controller
{

    protected $transactionRepository;
    protected $csvRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        TransactionRepository $transactionRepository,
        CsvRepository $csvRepository
    )
    {
        //$this->middleware('auth');
        $this->transactionRepository = $transactionRepository;
        $this->csvRepository = $csvRepository;
    }

    // get transactions
    public function getTransactions() 
    {
        $transactions = array_merge($this->transactionRepository->getTransactionsArray(), $this->csvRepository->getTransactions());

        return response()->json($transactions);
    }

}
