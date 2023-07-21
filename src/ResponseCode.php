<?php

declare(strict_types=1);

namespace Drewlabs\Txn\TMoney;

class ResponseCode
{
    /**
     * @var int
     */
    const SUCCESS = 200;

    /**
     * @var int
     */
    const APPLICATION_IN_PROCESS = 2000;

    /**
     * @var int
     */
    const CALLBACK_EXECUTED = 2001;

    /**
     * @var int
     */
    const TRANSACTION_COMPLETED = 2002;

    /**
     * @var int
     */
    const REQUEST_ALREADY_SUBMITTED = 4001;

    /**
     * @var int
     */
    const NOT_SIGNED_IN = 403;

    /**
     * @var int
     */
    const TRANSACTION_ERROR = 500;

    /**
     * @var int
     */
    const BAD_PIN = 501;

    /**
     * Returns the reason phrase for transaction response code
     * 
     * @param int $code
     *  
     * @return string 
     */
    public static function getReasonPhrase($code)
    {
        switch (intval($code)) {
            case static::SUCCESS:
                return 'Success';
            case static::APPLICATION_IN_PROCESS:
                return 'Application in process';
            case static::CALLBACK_EXECUTED:
                return 'Callback successfully executed';
            case static::TRANSACTION_COMPLETED:
                return 'Transaction completed';
            case static::REQUEST_ALREADY_SUBMITTED:
                return 'Request already submitted';
            case static::NOT_SIGNED_IN:
                return 'Please sign in before continue';
            case static::TRANSACTION_ERROR:
                return 'Transaction error';
            case static::BAD_PIN:
                return 'Bad pin code';
            default:
                return 'Unknown Server Response';
        }
    }
}
