<?php

namespace Tests\Feature;

use App\Http\Controllers\PublisherController;
use Google\Cloud\PubSub\PubSubClient;
use Google\Cloud\PubSub\Topic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Mockery;

class PublishControllerTest extends TestCase
{
    /**
     * @test
     * @group PublishController
     */
    public function shouldGetTopicAndPublishMessage()
    {
        $pubSubClient = Mockery::mock(PubSubClient::class)->makePartial();

        $topic = Mockery::mock(Topic::class);

        $pubSubClient->shouldReceive('topic')
            ->with('topic-test')
            ->once()
            ->andReturn($topic);

        $publishToTopicHandler = new PublisherController($pubSubClient);

        $topic->shouldReceive('publish')
            ->with([
                'data' => 'This is the first message sent to the topic',
                'attributes' => [
                    'location' => 'Sydney'
                ]
            ])->once();

        $publishToTopicHandler->publish();
    }
}
