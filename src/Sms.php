<?php

namespace Bluora\LaravelTwilio;

use Log;
use Twilio\Rest\Client;

class Sms
{
    /**
     * Twilio client.
     *
     * @var Twilio\Rest\Client
     */
    private $client;

    /**
     * Last message.
     *
     * @var Twilio\Rest\Api\V2010\Account\MessageInstance
     */
    private $message;

    /**
     * Create client.
     *
     * @return void
     */
    private function client()
    {
        if (is_null($this->client)) {
            $this->client = new Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));
        }
    }

    /**
     * Prepare number for sending.
     *
     * @return string
     */
    private function prepareNumber($number)
    {
        $number = preg_replace('/[^0-9+]*/', '', $number);

        if (substr($number, 0, 1) !== '+') {
            $number = '+'.$number;
        }

        return $number;
    }

    /**
     * Send an SMS.
     *
     * @param string      $to_number
     * @param string      $body
     * @param bool|string $from
     *
     * @return bool
     *
     * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
     */
    public function send($to_number, $body, $from_number = false)
    {
        $this->client();
        $this->message = null;

        $to_number = $this->prepareNumber($to_number);
        $from_number = $this->prepareNumber($from_number === false ? env('TWILIO_NUMBER') : $from_number);

        try {
            $this->message = $this->client->messages->create(
                $to_number,
                [
                    'body' => $body,
                    'from' => $from_number,
                ]
            );
            Log::info('Message sent to '.$to_number);

            return true;
        } catch (\Exception $e) {
            Log::error(
                'Could not send SMS. '.$e->getMessage()
            );
        }

        return false;
    }

    /**
     * Get the value from the sent messages for the given key.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get($key)
    {
        if (!is_null($this->message)) {
            try {
                return $this->message->$key;
            } catch (\Exception $e) {
            }
        }
    }
}
