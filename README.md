## Description

This is a Laravel Application that uses Cloud Pub/Sub to publish messages:

## Getting started

#### Prerequisites:

- PHP 7.3+
- Composer

#### Setup:

1. Open a new instance of the terminal, navigate to the root directory of the project.
    ```
    $ cd cloud-pub-sub
    ```

2. Install all composer packages included in composer.json
    ```
    $ composer install
    ```

3. Install Cloud Pub/Sub client library.
    ```
    $ composer require google/cloud-pubsub
    ```

4. Create a .env file from the existing .env.example
    ```
    $ cp .env.example .env
    ```

5. Generate a Laravel App Key.
    ```
    $ php artisan key:generate
    ```

6. Add the following variable in your .env file. The value should be the path of the JSON key file used for authentication.
    ```
    GOOGLE_APPLICATION_CREDENTIALS=app/sandbox-cloud-pub-sub.json
    ```
   *note: the JSON key file is the file that you added to your service account `cloud-pub-sub-account` in GCP. 
   For testing purposes make sure the file is in your storage/app folder.*

7. To run your Laravel Application
    ```
    php artisan serve
    ```
8. To publish the message to the topic, send a POST request to `http://127.0.0.1:8000/api/publish`

9. To pull the message, send a POST request to `http://127.0.0.1:8000/api/pull`
