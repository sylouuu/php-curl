<?php

    /**
    * REST Client (test)
    *
    * Submit REST requests over HTTP
    *
    * @author sylouuu
    * @link https://github.com/sylouuu/php-rest-client
    * @license MIT
    */
    class RESTClientTest extends PHPUnit_Framework_TestCase {

        /**
        * Properties
        */
        private $rest_client;
        private $endpoint;

        public function setUp() {
            /**
            * Including the class to test
            */
            include_once('RESTClient.class.php');

            /**
            * Instanciating the class to test
            */
            $this->rest_client = new RESTClient();

            /**
            * Settings endpoint URL
            */
            $this->endpoint['default'] = 'http://ip.jsontest.com/';
            $this->endpoint['headers'] = 'http://headers.jsontest.com/';
        }

        // Exceptions
        // ------------------------------------------------------------------------------------------------------

        /**
        * Standard POST request without data
        *
        * @expectedException InvalidArgumentException
        * @expectedExceptionMessage No data provided for that POST request
        */
        public function testPostRequestWithoutData() {
            $this->rest_client->post([
                'url' => $this->endpoint['default']
            ]);
        }

        /**
        * Standard PUT request without data
        *
        * @expectedException InvalidArgumentException
        * @expectedExceptionMessage No data provided for that PUT request
        */
        public function testPutRequestWithoutData() {
            $this->rest_client->put([
                'url' => $this->endpoint['default']
            ]);
        }

        // Success
        // ------------------------------------------------------------------------------------------------------

        /**
        * Standard GET request
        */
        public function testGetRequest() {
            $result = $this->rest_client->get([
                'url' => $this->endpoint['default']
            ]);

            $this->assertArrayHasKey('ip', json_decode($result, true));
        }

        /**
        * Standard GET request with specific header
        */
        public function testGetRequestWithHeader() {
            $result = $this->rest_client->get([
                'url'       => $this->endpoint['headers'],
                'headers'   => [
                    'Authorization: foobar'
                ]
            ]);

            $this->assertArrayHasKey('Authorization', json_decode($result, true));
        }

        /**
        * Standard POST request with data
        */
        public function testPostRequest() {
            $result = $this->rest_client->post([
                'url'       => $this->endpoint['default'],
                'data'      => [
                    'foo' => 'bar'
                ]
            ]);

            $this->assertArrayHasKey('ip', json_decode($result, true));
        }

        /**
        * Standard POST request with data
        */
        public function testPostRequestdata() {
            $result = $this->rest_client->post([
                'url'       => $this->endpoint['headers'],
                'data'      => [
                    'foo' => 'bar'
                ]
            ]);

            var_dump($result);

            $this->assertArrayHasKey('ip', json_decode($result, true));
        }

        /**
        * Standard POST request with data & specific header
        */
        public function testPostRequestWithHeader() {
            $result = $this->rest_client->post([
                'url'       => $this->endpoint['headers'],
                'headers'   => [
                    'Authorization: foobar'
                ],
                'data'      => [
                    'foo' => 'bar'
                ]
            ]);

            $this->assertArrayHasKey('Authorization', json_decode($result, true));
        }

        // Errors
        // ------------------------------------------------------------------------------------------------------

        /**
        * Standard PUT request with data
        *
        * This endpoint disables PUT request
        * so that it checks the error message
        */
        public function testPutRequest() {
            $result = $this->rest_client->put([
                'url'       => $this->endpoint['default'],
                'data'      => [
                    'foo' => 'bar'
                ]
            ]);

            $this->assertEquals(true, $result = strpos($result, 'PUT'));
        }

        /**
        * Standard DELETE request with data
        *
        * This endpoint disables DELETE request
        * so that it checks the error message
        */
        public function testDeleteRequest() {
            $result = $this->rest_client->delete([
                'url' => $this->endpoint['default']
            ]);

            $this->assertEquals(true, strpos($result, 'DELETE'));
        }

    }

?>