<?php

namespace Drewlabs\Txn\TMoney;

use Drewlabs\Txn\ProcessorLibraryInterface;
use Drewlabs\Txn\TransactionPaymentInterface;

// TODO: Provide implementation for sending request to TMoney servers

class Client implements ProcessorLibraryInterface
{

    public function __construct()
    {
    }

    public function toProcessTransactionResult($response)
    {
    }

    public function processTransaction(TransactionPaymentInterface $transaction)
    {
    }
}
