<?php
    namespace sylouuu\Curl;

    /**
     * Curl abstracted class
     *
     * @author sylouuu
     * @link https://github.com/sylouuu/php-curl
     * @version 0.8.1
     * @license MIT
     */
    abstract class Curl
    {

        // Curl
        protected $ch;
        protected $curl_options;

        // Input
        protected $options;

        // Output
        protected $status;
        protected $header;
        protected $response;

        /**
         * Constructor
         *
         * @param string $url
         * @param array $options
         */
        public function __construct($url, $options = null)
        {
            if(isset($url)) {
                $this->options = $options;

                $this->options['request_headers'] = [];

                // Init cURL
                $this->ch = curl_init($url);
            }
        }

        /**
         * Getter HTTP status code
         *
         * @return integer
         */
        public function getStatus()
        {
            return $this->status;
        }

        /**
         * Getter HTTP header
         *
         * @return string
         */
        public function getHeader()
        {
            return $this->header;
        }

        /**
         * Getter response
         *
         * @return mixed
         */
        public function getResponse()
        {
            return $this->response;
        }

        /**
         * Getter Curl options
         *
         * @return null|array
         */
        public function getCurlOptions()
        {
            return $this->curl_options;
        }

        /**
         * Setter Curl option
         *
         * See options list: http://php.net/manual/en/function.curl-setopt.php
         *
         * @param const $option
         * @param mixed $value
         * @return mixed
         */
        public function setCurlOption($option, $value)
        {
            curl_setopt($this->ch, $option, $value);

            $this->curl_options[$option] = $value;

            return $this;
        }

        /**
         * Getter Curl info
         *
         * See info list: http://php.net/manual/en/function.curl-getinfo.php
         *
         * @param const $info
         * @return mixed
         */
        public function getCurlInfo($info)
        {
            return curl_getinfo($this->ch, $info);
        }

        /**
         * Sends the request
         *
         * @return $this
         */
        public function send()
        {
            // Default options
            $this->setCurlOption(CURLOPT_RETURNTRANSFER, true);
            $this->setCurlOption(CURLINFO_HEADER_OUT, true);

            // Additional headers
            if(isset($this->options['headers']) && count($this->options['headers']) > 0) {
                $this->options['request_headers'] = array_merge($this->options['request_headers'], $this->options['headers']);
            }

            // SSL
            if(isset($this->options['ssl'])) {
                $this->setCurlOption(CURLOPT_SSL_VERIFYPEER, true);
                $this->setCurlOption(CURLOPT_SSL_VERIFYHOST, 2);
                $this->setCurlOption(CURLOPT_CAINFO, getcwd() . $this->options['ssl']);
            }

            // Payload
            if(isset($this->options['is_payload']) && $this->options['is_payload'] === true) {
                // Appropriate headers for sending a JSON object
                $this->options['request_headers'] = array_merge($this->options['request_headers'], [
                    'Content-Type: application/json',
                    'Content-Length: ' . ((isset($this->options['data'])) ? strlen(json_encode($this->options['data'])) : 0)
                ]);
            }

            // Set headers
            if (count($this->options['request_headers']) > 0) {
                $this->setCurlOption(CURLOPT_HTTPHEADER, $this->options['request_headers']);
            }

            // Retrieving HTTP response body
            $this->response = curl_exec($this->ch);

            // Retrieving HTTP status code
            $this->status = $this->getCurlInfo(CURLINFO_HTTP_CODE);

            // Retrieving HTTP header
            $this->header = $this->getCurlInfo(CURLINFO_HEADER_OUT);

            // Autoclose handle
            if(!isset($this->options['autoclose']) || (isset($this->options['autoclose']) && $this->options['autoclose'] !== false)) {
                $this->close();
            }

            return $this;
        }

        /**
         * Closes the handle
         */
        public function close()
        {
            curl_close($this->ch);
        }

    }
