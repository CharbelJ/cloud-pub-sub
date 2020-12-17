<?php

namespace App\Http\Controllers;

use Google\Cloud\PubSub\PubSubClient;

class SubscriberController extends Controller
{
    /**
     * @var PubSubClient
     */
    protected $pubSubClient;

    /**
     * SubscriberController constructor.
     *
     * @param PubSubClient $pubSubClient
     */
    public function __construct(PubSubClient $pubSubClient)
    {
        $this->pubSubClient = $pubSubClient;
    }

    /**
     * POST /pull
     * Pull and acknowledge the messages that were sent to the topic
     *
     * @return void
     */
    public function pull()
    {
        $subscription = $this->pubSubClient->subscription('subscription-test');

        $messages = $subscription->pull();

        foreach ($messages as $message) {
            $subscription->acknowledge($message);
        }
    }
}
