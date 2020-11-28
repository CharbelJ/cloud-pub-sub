<?php

namespace App\Http\Controllers;

use Google\Cloud\PubSub\PubSubClient;

class PublisherController extends Controller
{
    /**
     * POST /publish
     * Send a message to the topic
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function publish()
    {
        $pubSubClient = new PubSubClient([
            'keyFile' => json_decode(file_get_contents(storage_path(env('GOOGLE_APPLICATION_CREDENTIALS'))), true)
        ]);

        $topic = $pubSubClient->topic('topic-test');

        $topic->publish([
            'data' => 'This is the first message sent to the topic',
            'attributes' => [
                'location' => 'Sydney'
            ]
        ]);

        return response()->json('Success', 200);
    }
}
