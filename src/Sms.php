<?php

namespace Bluora\LaravelTwilio;

use Log;
use Twilio\Rest\Client;
use TwilioException;

class Sms
{
    /**
     * Twilio client.
     *
     * @var Twilio\Rest\Client
     */
    private $client;

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

        $from_number = $from_number === false ? env('TWILIO_NUMBER') : $from_number;

        try {
            $this->client->messages->create(
                $to_number,
                [
                    'body' => $body,
                    'from' => $from_number,
                ]
            );
            Log::info('Message sent to '.$to_number);

            return true;
        } catch (TwilioException $e) {
            Log::error(
                'Could not send SMS notification.'.
                ' Twilio replied with: '.$e
            );
        }

        return false;
    }
}
