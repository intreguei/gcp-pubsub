# PuSub as broadcast

This library offers a way to use the subscription of GCP pubsub as broadcast using the [google/cloud-pubsub](https://github.com/googleapis/google-cloud-php-pubsub) library.

A fully-managed real-time messaging service that allows you to send and receive messages between independent applications.

### Installation

To begin, install the preferred dependency manager for PHP, [Composer](https://getcomposer.org/).

Now to install just this library:

```sh
$ composer require intreguei/gcp-pubsub
```

### Authentication

This library use the [Google Cloud PHP](https://github.com/googleapis/google-cloud-php) authentication. See the [Authentication guide](https://github.com/googleapis/google-cloud-php/blob/main/AUTHENTICATION.md) for more information
on authenticating your client. Once authenticated, you'll be ready to start making requests.

### Samples

#### Publish message on topic:

```php
require 'vendor/autoload.php';

use Intreguei\GcpPubsub\PubSub;

$callback = function ($message) {
    //method to use message from topic
} 

PubSub::listenSubscription('your_topic_name', $callback);

```

#### Listen to subscription:

```php
require 'vendor/autoload.php';

use Intreguei\GcpPubsub\PubSub;

$dataToPublish = [
    'key_1' => 'data_1',
    'key_2' => 'data_2',
];

PubSub::publishMessage('your_topic_name', $dataToPublish); 

}
```

### References

1. Google CLoud [official documentation](https://cloud.google.com/pubsub/docs/).
2. Take a look at Google Cloud [in-depth usage samples](https://github.com/GoogleCloudPlatform/php-docs-samples/tree/master/pubsub/).

### Authors

[Clezer Aragon](https://github.com/clezeraragon) & [Leandro Lazari](https://github.com/lazari-br/)