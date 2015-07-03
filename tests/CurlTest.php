<?php

    use \sylouuu\Curl\Method as Curl;

    /**
     * Curl Tests
     *
     * Lightweight PHP cURL wrapper
     *
     * @author sylouuu
     * @link https://github.com/sylouuu/php-curl
     * @version 0.8.0
     * @license MIT
     */
    class CurlTest extends \PHPUnit_Framework_TestCase
    {

        private $endpoint = 'http://headers.jsontest.com/';

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

            $this->assertTrue(strpos($options[10015], 'foo') !== false);
            $this->assertTrue(strpos($options[10015], 'domain.com') !== false);
            $this->assertEquals('POST', $options[10036]);

            $request->send();

            $options = $request->getCurlOptions();

            $this->assertTrue(strpos($options[10015], 'foo') !== false);
            $this->assertTrue(strpos($options[10015], 'domain.com') !== false);
            $this->assertEquals('POST', $options[10036]);
            $this->assertTrue($options[19913]);
            $this->assertTrue($options[2]);
        }

        /**
         * getCurlOptions()
         */
        public function testOptionsGetterWithPayload()
        {
            $request = new Curl\Post($this->endpoint, [
                'data' => [
                    'name' => 'foo',
                    'email' => 'foo@domain.com'
                ],
                'is_payload' => true,
                'headers' => [
                    'Authorization: foobar'
                ]
            ]);

            $request->send();

            $options = $request->getCurlOptions();

            $this->assertEquals('POST', $options[10036]);
            $this->assertEquals(1, $options[47]);
            $this->assertEquals('{"name":"foo","email":"foo@domain.com"}', $options[10015]);
            $this->assertEquals('Authorization: foobar', $options[10023][0]);
            $this->assertEquals('Content-Type: application/json', $options[10023][1]);
            $this->assertEquals('Content-Length: 39', $options[10023][2]);
        }

        /**
         * setCurlOption()
         */
        public function testOptionsSetter()
        {
            $request = new Curl\Get($this->endpoint);

            $options = $request->getCurlOptions();

            $this->assertNull($options[27]);

            $request->setCurlOption(CURLOPT_CRLF, true);

            $options = $request->getCurlOptions();

            $this->assertTrue($options[27]);
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
