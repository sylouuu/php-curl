<?php
    namespace sylouuu;

    /**
    * REST Client
    *
    * Lightweight PHP cURL wrapper
    *
    * @author sylouuu
    * @link https://github.com/sylouuu/php-rest-client
    * @version 0.4.0
    * @license MIT
    */
    class RESTClient {

        // Properties
        private $status;
        private $header;
        private $response;

        /**
        * Getter HTTP status code
        *
        * @return integer
        */
        public function getStatus() {
            return $this->status;
        }

        /**
        * Getter HTTP header
        *
        * @return string
        */
        public function getHeader() {
            return $this->header;
        }

        /**
        * Getter response
        *
        * @return mixed
        */
        public function getResponse() {
            return $this->response;
        }

        /**
        * GET request
        *
        * @param array $options
        *
        * @return mixed $this
        */
        public function head($options) {
            // Init cURL
            $handle = curl_init($options['url']);

            // Options
            curl_setopt($handle, CURLOPT_HEADER, true);
            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'HEAD');

            // Setting response
            $this->response = $this->process($handle, $options);

            return $this;
        }

        /**
        * OPTIONS request
        *
        * @param array $options
        *
        * @return mixed $this
        */
        public function options($options) {
            // Init cURL
            $handle = curl_init($options['url']);

            // Options
            curl_setopt($handle, CURLOPT_HEADER, true);
            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'OPTIONS');

            // Setting response
            $this->response = $this->process($handle, $options);

            return $this;
        }

        /**
        * GET request
        *
        * @param array $options
        *
        * @return mixed $this
        */
        public function get($options) {
            // Init cURL
            $handle = curl_init($options['url']);

            // Setting response
            $this->response = $this->process($handle, $options);

            return $this;
        }

        /**
        * POST request
        *
        * @param array $options
        *
        * @return mixed $this
        */
        public function post($options) {
            // Init cURL
            $handle = curl_init($options['url']);

            if(isset($options['data'])) {
                // Options
                curl_setopt($handle, CURLOPT_POSTFIELDS, $options['data']);
                curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'POST');
            } else {
                throw new \InvalidArgumentException('No data provided for that POST request');
            }

            // Setting response
            $this->response = $this->process($handle, $options);

            return $this;
        }

        /**
        * PUT request
        *
        * @param array $options
        *
        * @return mixed $this
        */
        public function put($options) {
            // Init cURL
            $handle = curl_init($options['url']);

            if(isset($options['data'])) {
                // Converting array to an URL-encoded query string
                $options['data'] = http_build_query($options['data'], '', '&');

                // Options
                curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($handle, CURLOPT_POSTFIELDS, $options['data']);
            } else {
                throw new \InvalidArgumentException('No data provided for that PUT request');
            }

            // Setting response
            $this->response = $this->process($handle, $options);

            return $this;
        }

        /**
        * PATCH request
        *
        * @param array $options
        *
        * @return mixed $this
        */
        public function patch($options) {
            // Init cURL
            $handle = curl_init($options['url']);

            if(isset($options['data'])) {
                // Converting array to an URL-encoded query string
                $options['data'] = http_build_query($options['data'], '', '&');

                // Options
                curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'PATCH');
                curl_setopt($handle, CURLOPT_POSTFIELDS, $options['data']);
            } else {
                throw new \InvalidArgumentException('No data provided for that PATCH request');
            }

            // Setting response
            $this->response = $this->process($handle, $options);

            return $this;
        }

        /**
        * DELETE request
        *
        * @param array $options
        *
        * @return mixed $this
        */
        public function delete($options) {
            // Init cURL
            $handle = curl_init($options['url']);

            // Options
            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'DELETE');

            // Setting response
            $this->response = $this->process($handle, $options);

            return $this;
        }

        /**
        * Processes the request
        *
        * @param object $handle
        * @param array $options
        *
        * @return mixed $response
        */
        private function process($handle, $options) {
            // Options
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($handle, CURLINFO_HEADER_OUT, true);

            // Additional headers
            if(isset($options['headers']) && count($options['headers']) > 0) {
                curl_setopt($handle, CURLOPT_HTTPHEADER, $options['headers']);
            }

            // SSL
            if(isset($options['ssl'])) {
                curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, true);
                curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 2);
                curl_setopt($handle, CURLOPT_CAINFO, getcwd() . $options['ssl']);
            }

            // Result
            $response = curl_exec($handle);

            // Retrieving HTTP status code
            $this->status = curl_getinfo($handle, CURLINFO_HTTP_CODE);

            // Retrieving HTTP header
            $this->header = curl_getinfo($handle, CURLINFO_HEADER_OUT);

            // Closing handle
            curl_close($handle);

            return $response;
        }

    }

?>