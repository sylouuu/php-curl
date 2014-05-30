<?php

    /**
    * Curl Request Tests
    *
    * Lightweight PHP cURL wrapper
    *
    * @author sylouuu
    * @link https://github.com/sylouuu/php-curl
    * @version 0.6.1
    * @license MIT
    */
    class CurlRequestTest extends \PHPUnit_Framework_TestCase
    {

        // Properties
        private $endpoint;

        /**
        * Considers as a constructor
        */
        public function setUp()
        {
            // Setting endpoint URL
            $this->endpoint = 'http://chez-syl.fr/yaapi/api/';
        }

        /**
        * Standard OPTIONS request
        */
        public function testHeadRequest()
        {
            $request = new \sylouuu\Curl\Head($this->endpoint);

            $request->send();

            $this->assertEquals(200, $request->getStatus());
            $this->assertEquals(true, (strpos($request->getResponse(), 'Server') !== false));
        }

        /**
        * Standard OPTIONS request
        */
        public function testOptionsRequest()
        {
            $request = new \sylouuu\Curl\Options($this->endpoint .'user');

            $request->send();

            $this->assertEquals(200, $request->getStatus());
            $this->assertArrayHasKey('Allow', json_decode($request->getResponse(), true));
        }

        /**
        * Standard GET request
        */
        public function testGetRequest()
        {
            $request = new \sylouuu\Curl\Get($this->endpoint .'ip');

            $request->send();

            $this->assertEquals(200, $request->getStatus());
            $this->assertArrayHasKey('ip', json_decode($request->getResponse(), true));
        }

        /**
        * Standard GET request with specific header
        */
        public function testGetRequestWithHeader()
        {
            $request = new \sylouuu\Curl\Get($this->endpoint .'ip', [
                'headers'   => [
                    'Authorization: foobar'
                ]
            ]);

            $request->send();

            $this->assertEquals(200, $request->getStatus());
            $this->assertEquals(true, (strpos($request->getHeader(), 'Authorization: foobar') !== false));
        }

        /**
        * Standard POST request with data
        */
        public function testPostRequest()
        {
            $request = new \sylouuu\Curl\Post($this->endpoint .'user', [
                'data' => [
                    'name' => 'foo',
                    'email' => 'foo@domain.com'
                ]
            ]);

            $request->send();

            $this->assertEquals(201, $request->getStatus());
        }

        /**
        * Standard PUT request with data
        */
        public function testPutRequest()
        {
            $request = new \sylouuu\Curl\Put($this->endpoint .'user/1', [
                'data' => [
                    'name' => 'foo'
                ]
            ]);

            $request->send();

            $this->assertEquals(200, $request->getStatus());
        }

        /**
        * Standard PATCH request with data
        */
        public function testPatchRequest()
        {
            $request = new \sylouuu\Curl\Patch($this->endpoint .'user/1', [
                'data' => [
                    'name' => 'foo'
                ]
            ]);

            $request->send();

            $this->assertEquals(200, $request->getStatus());
        }

        /**
        * Standard DELETE request
        */
        public function testDeleteRequest()
        {
            $request = new \sylouuu\Curl\Delete($this->endpoint .'user/1');

            $request->send();

            $this->assertEquals(200, $request->getStatus());
        }

    }
