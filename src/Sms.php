<?php

declare(strict_types=1);

namespace HnhDigital\LaravelTwilio;

use Log;
use Twilio\Rest\Client;

class Sms
{
    const MODE_NUMBER = 0;
    const MODE_MSG_SERVICE = 1;

    /**
     * Callback url.
     *
     * @var string
     */
    private $callback;

    /**
     * Twilio client.
     *
     * @var Twilio\Rest\Client
     */
    private $client;

    /**
     * From number.
     *
     * @var string
     */
    private $from_number;

    /**
     * Last message.
     *
     * @var Twilio\Rest\Api\V2010\Account\MessageInstance
     */
    private $message;

    /**
     * Error message.
     *
     * @var string
     */
    private $error_message;

    /**
     * Messaging service.
     *
     * @var string
     */
    private $messaging_sid;

    /**
     * Sending mode.
     *
     * @var bool
     */
    private $mode;

    /**
     * Set defaults.
     */
    public function __construct() : void
    {
        $this->client = new Client(
            config('hnhdigital.messages.account_sid'),
            config('hnhdigital.messages.account_token')
        );

        $this->callback(config('hnhdigital.messages.callback', ''));
        $this->fromNumber(config('hnhdigital.messages.default_number', ''));
        $this->fromMessagingService(config('hnhdigital.messages.messaging_sid', ''));
    }

    /**
     * Set the callback.
     */
    public function callback(string $url) : Sms
    {
        $this->callback = $url;

        return $this;
    }

    /**
     * Set the from number.
     */
    public function fromNumber(string $from_number = '') : Sms
    {
        if (!empty($from_number)) {
            $this->from_number = $from_number;
            $this->mode = self::MODE_NUMBER;
        } elseif (!empty(config('hnhdigital.messages.default_number', ''))) {
            $this->from_number = config('hnhdigital.messages.default_number', '');
            $this->mode = self::MODE_NUMBER;
        }

        return $this;
    }

    /**
     * Set the messaging service sid.
     */
    public function fromMessagingService(string $messaging_sid = '') : Sms
    {
        if (!empty($messaging_sid)) {
            $this->messaging_sid = $messaging_sid;
            $this->mode = self::MODE_MSG_SERVICE;
        } elseif (!empty(config('hnhdigital.messages.messaging_sid', ''))) {
            $this->messaging_sid = config('hnhdigital.messages.messaging_sid', '');
            $this->mode = self::MODE_MSG_SERVICE;
        }

        return $this;
    }

    /**
     * Send an SMS.
     */
    public function send(string $to_number, string $body) : bool
    {
        $this->message = null;
        $this->error_message = null;

        $to_number = $this->prepareNumber($to_number);

        $data = ['body' => $body];

        if ($this->mode === self::MODE_NUMBER) {
            $data['from'] = $this->prepareNumber($this->from_number);
        } elseif ($this->mode === self::MODE_MSG_SERVICE) {
            $data['messagingServiceSid'] = $this->messaging_sid;
        }

        if (!isset($data['from']) && !isset($data['messagingServiceSid'])) {
            return false;
        }

        if (!empty($this->callback)) {
            $data['statusCallback'] = $this->callback;
        }

        try {
            $this->message = $this->client->messages->create($to_number, $data);
            Log::info('Message sent to '.$to_number);

            return $this->message;
        } catch (\Exception $e) {
            Log::error('Could not send SMS. '.$e->getMessage());
            $this->error_message = $e->getMessage();
        }

        return false;
    }

    /**
     * Prepare number for sending.
     */
    private function prepareNumber(string $number) : string
    {
        // Remove non-numbers
        $number = preg_replace('/[^0-9+]*/', '', $number);

        // Remove 0 from start of number
        if (substr($number, 0, 1) === '0') {
            $number = substr($number, 1);
        }

        // Add missing + from number
        if (substr($number, 0, 1) !== '+') {
            $number = '+'.$number;
        }

        return $number;
    }

    /**
     * Get the error message.
     */
    public function getError() : string
    {
        return $this->error_message;
    }
}
