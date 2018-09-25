<?php

return [
    /*
     |------------------------------------------------------
     | Set sandbox mode
     | ------------------------------------------------------
     | Specify whether this is a test app or production app
     | Sandbox base url: https://sandbox.safaricom.co.ke
     | Production base url: https://api.safaricom.co.ke
     |
     */
    'sandbox' => true,
    /*
   |--------------------------------------------------------------------------
   | Cache credentials
   |--------------------------------------------------------------------------
   |
   | If you decide to cache credentials, they will be kept in your app cache
   | configuration for sometime. Reducing the need for many requests for
   | generating credentials
   |
   */
    'cache_credentials' => true,
    /*
     * Configure slack notifications to receive mpesa events and callbacks
     */
    'notifications' => [
        /*
         * Slack webhook URL
         * https://my.slack.com/services/new/incoming-webhook/
         */
        'slack_web_hook' => 'https://hooks.slack.com/services/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',
        /*
         * Get only important notifications
         * You wont be notified for failed stk push transactions
         */
        'only_important' => false,
    ],
];
