<?php

    use \sylouuu\Curl\Method as Curl;

    /**
     * Curl Request Tests
     *
     * Lightweight PHP cURL wrapper
     *
     * @author sylouuu
     * @link https://github.com/sylouuu/php-curl
     * @version 0.7.1
     * @license MIT
     */
    class CurlRequestTest extends \PHPUnit_Framework_TestCase
    {

        private $endpoint = 'http://reqr.es/api/';

        /**
         * Standard GET request
         */
        public function testGetUser()
        {
            $request = new Curl\Get($this->endpoint .'users/2');

            $request->send();

            $this->assertEquals(200, $request->getStatus());

            $response = json_decode($request->getResponse(), true);

            $this->assertArrayHasKey('data', $response);
            $this->assertEquals(2, $response['data']['id']);
            $this->assertEquals('lucille', $response['data']['first_name']);
            $this->assertEquals('bluth', $response['data']['last_name']);
        }

        /**
         * Standard GET request with specific header
         */
        public function testGetWithHeader()
        {
            $request = new Curl\Get($this->endpoint .'users?page=2', [
                'headers'   => [
                    'Authorization: foobar'
                ]
            ]);

            $request->send();

            $this->assertEquals(200, $request->getStatus());
            $this->assertTrue(strpos($request->getHeader(), 'Authorization: foobar') !== false);
        }

        /**
         * Standard not found GET request
         */
        public function testGetNotFoundUser()
        {
            $request = new Curl\Get($this->endpoint .'users/23');

            $request->send();

            $this->assertEquals(404, $request->getStatus());
        }

        /**
         * Standard POST request
         */
        public function testPostUser()
        {
            $request = new Curl\Post($this->endpoint .'users', [
                'data' => [
                    'name' => 'morpheus',
                    'job' => 'leader'
                ]
            ]);

            $request->send();

            $this->assertEquals(201, $request->getStatus());

            $response = json_decode($request->getResponse(), true);

            $this->assertEquals('morpheus', $response['name']);
            $this->assertEquals('leader', $response['job']);
            $this->assertArrayHasKey('id', $response);
        }

        /**
         * Standard PUT request
         */
        public function testPutUser()
        {
            $request = new Curl\Put($this->endpoint .'users/2', [
                'data' => [
                    'name' => 'morpheus',
                    'job' => 'zion resident'
                ]
            ]);

            $request->send();

            $this->assertEquals(200, $request->getStatus());

            $response = json_decode($request->getResponse(), true);

            $this->assertEquals('morpheus', $response['name']);
            $this->assertEquals('zion resident', $response['job']);
        }

        /**
         * Standard DELETE request
         */
        public function testDeleteUser()
        {
            $request = new Curl\Delete($this->endpoint .'users/2');

            $request->send();

            $this->assertEquals(204, $request->getStatus());
        }

    }
