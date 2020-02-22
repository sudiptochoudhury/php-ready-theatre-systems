<?php


namespace SudiptoChoudhury\Rts\Support;

use \Exception;
use \Throwable;

class RtsDataException extends Exception
{
    public $data = [];

    /***
     * RtsDataException constructor.
     *
     * @param string          $message
     * @param int             $code
     * @param \Throwable|null $previous
     * @param array           $data
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null, $data = [])
    {
        $this->data = $data;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param $response
     *
     * @throws \SudiptoChoudhury\Rts\Support\RtsDataException
     */
    public static function make($response)
    {
        if (!empty($response['Code'])) {
            $description = $response['Description'] ?? '';
            $data = explode(':', $description);
            $message = trim($data[2]) ?? 'Unknown RTS SQL error!';
            throw new RtsDataException($message, $response['Code'], null, $response);
        }
    }
}
