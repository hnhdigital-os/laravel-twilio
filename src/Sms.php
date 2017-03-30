<?php

namespace Bluora\LaravelTwilio;

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
     * Messaging service.
     *
     * @var string
     */
    private $messaging_service_sid;

    /**
     * Sending mode.
     *
     * @var boolean
     */
    private $mode;

    /**
     * Set the callback.
     *
     * @return void
     */
    public function callback($url)
    {
        $this->callback = $url;

        return $this;
    }

    /**
     * Set the from number.
     *
     * @param  boolean|string $from_number
     *
     * @return void
     */
    public function fromNumber($from_number = false)
    {
        $this->mode = self::MODE_NUMBER;
        if ($number !== false) {
            $this->from_number = $from_number;

            return;
        }

        $this->from_number = env('TWILIO_NUMBER');
    }

    /**
     * Set the messaging service sid.
     *
     * @param  boolean|string $messaging_service_sid
     *
     * @return void
     */
    public function fromMessagingService($messaging_service_sid = false)
    {
        $this->mode = self::MODE_MSG_SERVICE;
        if ($messaging_service_sid !== false) {
            $this->messaging_service_sid = $messaging_service_sid;

            return;
        }

        $this->messaging_service_sid = env('TWILIO_MESSAGING_SERVICE');
    }

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

        $this->callback = env('TWILIO_MESSAGE_STATUS_CALLBACK', null);

        if (is_null($this->mode)) {
            if (env('TWILLO_MESSAGE_MODE', self::MODE_NUMBER) == self::MODE_NUMBER
                && env('TWILIO_NUMBER', false)) {
                $this->fromNumber();
            } elseif (env('TWILIO_MESSAGING_SERVICE', false)) {
                $this->fromMessagingService();
            } else {
                throw new TwilioException('Missing default number or messaging service sid');
            }
        }
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

    /**
     * Prepare number for sending.
     *
     * @return string
     */
    private function prepareNumber($number)
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
     * Send an SMS.
     *
     * @param string      $to_number
     * @param string      $body
     *
     * @return bool
     */
    public function send($to_number, $body)
    {
        $this->client();
        $this->message = null;

        $to_number = $this->prepareNumber($to_number);

        $data = ['body' => $body];

        if ($this->mode === self::MODE_NUMBER) {
            $data['from'] = $this->prepareNumber($this->from_number);
        } elseif ($this->mode === self::MODE_MSG_SERVICE) {
            $data['messagingServiceSid'] = $this->messaging_service_sid;
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

            return true;
        } catch (\Exception $e) {
            Log::error('Could not send SMS. '.$e->getMessage());
        }

        return false;
    }
}
