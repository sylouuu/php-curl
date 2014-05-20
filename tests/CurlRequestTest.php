<?php

    /**
    * Curl Request Tests
    *
    * Lightweight PHP cURL wrapper
    *
    * @author sylouuu
    * @link https://github.com/sylouuu/php-curl
    * @version 0.5.0
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

        // Exceptions
        // ------------------------------------------------------------------------------------------------------

        /**
        * Standard POST request without data
        *
        * @expectedException \InvalidArgumentException
        * @expectedExceptionMessage No data provided for that POST request
        */
        public function testExceptionPostRequestWithoutData()
        {
            $request = new \sylouuu\Curl\Post([
                'url' => $this->endpoint
            ]);
        }

        /**
        * Standard PUT request without data
        *
        * @expectedException \InvalidArgumentException
        * @expectedExceptionMessage No data provided for that PUT request
        */
        public function testExceptionPutRequestWithoutData()
        {
            $request = new \sylouuu\Curl\Put([
                'url' => $this->endpoint
            ]);
        }

        /**
        * Standard PATCH request without data
        *
        * @expectedException \InvalidArgumentException
        * @expectedExceptionMessage No data provided for that PATCH request
        */
        public function testExceptionPatchRequestWithoutData()
        {
            $request = new \sylouuu\Curl\Patch([
                'url' => $this->endpoint
            ]);
        }

        // Success
        // ------------------------------------------------------------------------------------------------------

        /**
        * Standard OPTIONS request
        */
        public function testHeadRequest()
        {
            $request = new \sylouuu\Curl\Head([
                'url' => $this->endpoint
            ]);

            $request->send();

            $this->assertEquals(200, $request->getStatus());
            $this->assertEquals(true, (strpos($request->getResponse(), 'Server') !== false));
        }

        /**
        * Standard OPTIONS request
        */
        public function testOptionsRequest()
        {
            $request = new \sylouuu\Curl\Options([
                'url' => $this->endpoint .'user'
            ]);

            $request->send();

            $this->assertEquals(200, $request->getStatus());
            $this->assertArrayHasKey('Allow', json_decode($request->getResponse(), true));
        }

        /**
        * Standard GET request
        */
        public function testGetRequest()
        {
            $request = new \sylouuu\Curl\Get([
                'url' => $this->endpoint .'ip'
            ]);

            $request->send();

            $this->assertEquals(200, $request->getStatus());
            $this->assertArrayHasKey('ip', json_decode($request->getResponse(), true));
        }

        /**
        * Standard GET request with specific header
        */
        public function testGetRequestWithHeader()
        {
            $request = new \sylouuu\Curl\Get([
                'url'       => $this->endpoint .'ip',
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
            $request = new \sylouuu\Curl\Post([
                'url' => $this->endpoint .'user',
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
            $request = new \sylouuu\Curl\Put([
                'url' => $this->endpoint .'user/1',
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
            $request = new \sylouuu\Curl\Patch([
                'url' => $this->endpoint .'user/1',
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
            $request = new \sylouuu\Curl\Delete([
                'url' => $this->endpoint .'user/1'
            ]);

            $request->send();

            $this->assertEquals(200, $request->getStatus());
        }

    }
