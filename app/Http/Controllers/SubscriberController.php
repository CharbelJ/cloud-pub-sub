<?php

namespace App\Http\Controllers;

use Google\Cloud\PubSub\PubSubClient;

class SubscriberController extends Controller
{
    /**
     * POST /pull
     * Pull and acknowledge the messages that were sent to the topic
     *
     * @return void
     */
    public function pull()
    {
        $pubSubClient = new PubSubClient([
            'keyFile' => json_decode(file_get_contents(storage_path(env('GOOGLE_APPLICATION_CREDENTIALS'))), true)
        ]);

        $subscription = $pubSubClient->subscription('subscription-test');

        $messages = $subscription->pull();

        foreach ($messages as $message) {
            $subscription->acknowledge($message);
        }
    }
}
