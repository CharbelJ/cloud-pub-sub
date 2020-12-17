<?php

namespace App\Http\Controllers;

use Google\Cloud\PubSub\PubSubClient;

class PublisherController extends Controller
{
    /**
     * @var PubSubClient
     */
    protected $pubSubClient;

    /**
     * PublisherController constructor.
     *
     * @param PubSubClient $pubSubClient
     */
    public function __construct(PubSubClient $pubSubClient)
    {
        $this->pubSubClient = $pubSubClient;
    }

    /**
     * POST /publish
     * Send a message to the topic
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function publish()
    {
        $this->pubSubClient->topic('topic-test')
            ->publish([
                'data' => 'This is the first message sent to the topic',
                'attributes' => [
                    'location' => 'Sydney'
                ]
            ]);

        return response()->json('Success', 200);
    }
}
