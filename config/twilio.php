<?php

return [
    'account_sid'   => env('TWILIO_ACCOUNT_SID', false),
    'account_token' => env('TWILIO_ACCOUNT_TOKEN', false),

    'messages' => [
        'messaging_sid'  => env('TWILIO_MESSAGING_SID', false),
        'default_number' => env('TWILIO_MESSAGING_DEFAULT_NUMBER', false),
        'callback'       => env('TWILIO_MESSAGING_STATUS_CALLBACK', false),
    ],
];
