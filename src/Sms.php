<?php

namespace Bluora\LaravelTwilio;

use Log;
use Twilio\Rest\Client;
use TwilioException;

class Sms
{
    /**
     * Twilio client.
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
     * @param  string       $to
     * @param  string       $body
     * @param  bool|string  $from 
     * 
     * @return bool
     */
    public function send($to, $body, $from = false)
    {
        $this->client();

        $from = $from === false ? env('TWILIO_NUMBER') : $from;

        try {
            $this->client->messages->create(
                $to,
                [
                    'body' => $body,
                    'from' => $from
                ]
            );
            Log::info('Message sent to ' . $to);

            return true;
        } catch (TwilioException $e) {
            Log::error(
                'Could not send SMS notification.' .
                ' Twilio replied with: ' . $e
            );
        }

        return false;
    }
}
