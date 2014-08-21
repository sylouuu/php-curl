<?php

    use \sylouuu\Curl\Method as Curl;

    /**
    * Curl Request Tests
    *
    * Lightweight PHP cURL wrapper
    *
    * @author sylouuu
    * @link https://github.com/sylouuu/php-curl
    * @version 0.7.0
    * @license MIT
    */
    class CurlRequestTest extends \PHPUnit_Framework_TestCase
    {

        /**
        * Standard GET request
        */
        public function testGetRequest()
        {
            $request = new Curl\Get('http://ip.jsontest.com/');

            $request->send();

            $this->assertEquals(200, $request->getStatus());
            $this->assertArrayHasKey('ip', json_decode($request->getResponse(), true));
        }

        /**
        * Standard GET request with specific header
        */
        public function testGetRequestWithHeader()
        {
            $request = new Curl\Get('http://headers.jsontest.com/', [
                'headers'   => [
                    'Authorization: foobar'
                ]
            ]);

            $request->send();

            $this->assertEquals(200, $request->getStatus());
            $this->assertEquals(true, (strpos($request->getHeader(), 'Authorization: foobar') !== false));
        }

    }
