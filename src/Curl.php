<?php
    namespace sylouuu\Curl;

    /**
     * Curl abstracted class
     *
     * @author sylouuu
     * @link https://github.com/sylouuu/php-curl
     * @version 0.7.1
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
            try 
            {
                // Default options
                $this->setCurlOption(CURLOPT_RETURNTRANSFER, true);
                $this->setCurlOption(CURLINFO_HEADER_OUT, true);

                // Additional headers
                if(isset($this->options['headers']) && count($this->options['headers']) > 0) {
                    $this->setCurlOption(CURLOPT_HTTPHEADER, $this->options['headers']);
                }

                // SSL
                if(isset($options['ssl'])) {
                    $this->setCurlOption(CURLOPT_SSL_VERIFYPEER, true);
                    $this->setCurlOption(CURLOPT_SSL_VERIFYHOST, 2);
                    $this->setCurlOption(CURLOPT_CAINFO, getcwd() . $options['ssl']);
                }

                // Retrieving HTTP response body
                $this->response = curl_exec($this->ch);
                if(false === $this->response)
                    throw new \Exception(curl_error($this->ch), curl_errno($this->ch));
                    

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
            catch(\Exception $e) 
            {
                trigger_error(sprintf(
                'Curl failed with error #%d: %s',
                $e->getCode(), $e->getMessage()),
                E_USER_ERROR);
            }
        }

        /**
         * Closes the handle
         */
        public function close()
        {
            curl_close($this->ch);
        }

    }
