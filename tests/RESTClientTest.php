<?php
    namespace sylouuu;

    /**
    * REST Client (unit tests)
    *
    * Lightweight PHP cURL wrapper
    *
    * @author sylouuu
    * @link https://github.com/sylouuu/php-rest-client
    * @version 0.4.0
    * @license MIT
    */
    class RESTClientTest extends \PHPUnit_Framework_TestCase {

        // Properties
        private $rest_client;
        private $endpoint;

        /**
        * Considers as a constructor
        */
        public function setUp() {
            // Including the class to test
            include_once('./src/RESTClient.php');

            // Instanciating the class to test
            $this->rest_client = new \sylouuu\RESTClient();

            // Setting endpoint URL
            $this->endpoint['default']  = 'http://ip.jsontest.com/';
            $this->endpoint['headers']  = 'http://headers.jsontest.com/';
        }

        // Exceptions
        // ------------------------------------------------------------------------------------------------------

        /**
        * Standard POST request without data
        *
        * @expectedException \InvalidArgumentException
        * @expectedExceptionMessage No data provided for that POST request
        */
        public function testExceptionPostRequestWithoutData() {
            $this->rest_client->post([
                'url' => $this->endpoint['default']
            ]);
        }

        /**
        * Standard PUT request without data
        *
        * @expectedException \InvalidArgumentException
        * @expectedExceptionMessage No data provided for that PUT request
        */
        public function testExceptionPutRequestWithoutData() {
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
            $request = $this->rest_client->get([
                'url' => $this->endpoint['default']
            ]);

            $this->assertEquals(200, $request->getStatus());
            $this->assertArrayHasKey('ip', json_decode($request->getResponse(), true));
        }

        /**
        * Standard GET request with specific header
        */
        public function testGetRequestWithHeader() {
            $request = $this->rest_client->get([
                'url'       => $this->endpoint['headers'],
                'headers'   => [
                    'Authorization: foobar'
                ]
            ]);

            $this->assertEquals(200, $request->getStatus());
            $this->assertArrayHasKey('Authorization', json_decode($request->getResponse(), true));
        }

        /**
        * Standard POST request with data
        */
        public function testPostRequest() {
            $request = $this->rest_client->post([
                'url'       => $this->endpoint['default'],
                'data'      => [
                    'foo' => 'bar'
                ]
            ]);

            $this->assertEquals(200, $request->getStatus());
            $this->assertArrayHasKey('ip', json_decode($request->getResponse(), true));
        }

        /**
        * Standard POST request with data & specific header
        */
        public function testPostRequestWithHeader() {
            $request = $this->rest_client->post([
                'url'       => $this->endpoint['headers'],
                'headers'   => [
                    'Authorization: foobar'
                ],
                'data'      => [
                    'foo' => 'bar'
                ]
            ]);

            $this->assertEquals(200, $request->getStatus());
            $this->assertArrayHasKey('Authorization', json_decode($request->getResponse(), true));
        }

    }

?>