<?php

    use \sylouuu\Curl\Method as Curl;

    /**
    * Curl Tests
    *
    * Lightweight PHP cURL wrapper
    *
    * @author sylouuu
    * @link https://github.com/sylouuu/php-curl
    * @version 0.7.0
    * @license MIT
    */
    class CurlTest extends \PHPUnit_Framework_TestCase
    {

        // Properties
        private $endpoint;

        /**
        * Considers as a constructor
        */
        public function setUp()
        {
            // Setting endpoint URL
            $this->endpoint = 'http://headers.jsontest.com/';
        }

        /**
        * getCurlOptions()
        */
        public function testOptionsGetter()
        {
            $request = new Curl\Post($this->endpoint, [
                'data' => [
                    'name' => 'foo',
                    'email' => 'foo@domain.com'
                ]
            ]);

            $options = $request->getCurlOptions();

            $this->assertEquals('foo', $options[10015]['name']);
            $this->assertEquals('foo@domain.com', $options[10015]['email']);
            $this->assertEquals('POST', $options[10036]);

            $request->send();

            $options = $request->getCurlOptions();

            $this->assertEquals('foo', $options[10015]['name']);
            $this->assertEquals('foo@domain.com', $options[10015]['email']);
            $this->assertEquals('POST', $options[10036]);
            $this->assertEquals(true, $options[19913]);
            $this->assertEquals(true, $options[2]);
        }

        /**
        * setCurlOption()
        */
        public function testOptionsSetter()
        {
            $request = new Curl\Get($this->endpoint);

            $options = $request->getCurlOptions();

            $this->assertEquals(null, $options[27]);

            $request->setCurlOption(CURLOPT_CRLF, true);

            $options = $request->getCurlOptions();

            $this->assertEquals(true, $options[27]);
        }

        /**
        * getCurlInfo()
        */
        public function testCurlInfoGetter()
        {
            $request = new Curl\Get($this->endpoint, [
                'autoclose' => false
            ]);

            $request->send();

            $code = $request->getCurlInfo(CURLINFO_HTTP_CODE);

            $request->close();

            $this->assertEquals(200, $code);
        }

    }
