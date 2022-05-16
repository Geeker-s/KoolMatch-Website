<?php

namespace App\api;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client ;
use function PHPUnit\Framework\throwException;

class TwilioApi
{
    /**
     * @var Client
     */
    private $client;
    /**
     * @var string
     */
    private $auth_token;
    /**
     * @var string
     */
    private $account_sid;
    /**
     * @var string
     */
    private $twilio_number;


    /**
     * @param string $account_sid
     * @param string $auth_token
     * @param string $twilio_number
     * @param $client
     */
    public function __construct(string $account_sid, string $auth_token, string $twilio_number)
    {
        $this->account_sid = $account_sid;
        $this->auth_token = $auth_token;
        $this->twilio_number = $twilio_number;
        $this->client = new Client($account_sid ,$auth_token);
    }


    public function sendSMS(string $phoneNumber , string $message){

        try {
            $this->client->messages->create($phoneNumber,array('from'=>$this->twilio_number,'body'=> $message));
            echo 'sms sent successfully';
        }
        catch (TwilioException $e){
            echo 'error sending sms';
            echo $e->getMessage();
            throwException($e);
        }

    }


}