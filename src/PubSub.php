<?php

namespace LazariBr\GcpPubsub;

use Closure;
use Exception;
use Google\Cloud\PubSub\PubSubClient;
use Google\Cloud\PubSub\Subscription;

class PubSub
{
    /**
     * @param string $topicName
     * @param mixed $message
     * @return string
     */
    public static function publishMessage(string $topicName, mixed $message): string
    {
        $topic = (new PubSubClient())->topic($topicName);
        $topic->publish(['data' => json_encode($message)]);
        return "Message published to topic: " . $topicName;
    }

    /**
     * @param string $subscriptionName
     * @param Closure $callback
     * @return void
     */
    public static function listenSubscription(string $subscriptionName, Closure $callback) : void
    {
        $subscription = (new PubSubClient())->subscription($subscriptionName);
        self::listenForMessages($subscription, $callback);
    }

    /**
     * @param Subscription $subscription
     * @param Closure $callback
     * @return void
     */
    private static function listenForMessages(Subscription $subscription, Closure $callback) : void
    {
        $retryAfter = $_ENV["GOOGLE_PUBSUB_RETRY_INTERVAL"] ?? 0;
        while (true) {
            foreach ($subscription->pull() as $message) {
                try {
                    call_user_func($callback, $message);
                    $subscription->acknowledge($message);
                } catch (Exception $e) {
                    error_log($e->getMessage());
                    $subscription->modifyAckDeadline($message, $retryAfter);
                }
            }
        }
    }
}