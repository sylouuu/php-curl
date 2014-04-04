<?php

    /**
    * REST Client
    *
    * Submit REST requests over HTTP
    *
    * @author sylouuu
    * @link https://github.com/sylouuu/php-rest-client
    * @version 0.2.0
    * @license MIT
    */
    class RESTClient {

        /**
        * Properties
        */
        private $status;
        private $json;

        /**
        * Getter HTTP status code
        *
        * @return integer
        */
        public function getStatus() {
            return $this->status;
        }

        /**
        * Getter JSON result
        *
        * @return json
        */
        public function getJSON() {
            return $this->json;
        }

        /**
        * GET request
        *
        * @param array $options The options
        *
        * @return json
        */
        public function get($options) {
            /**
            * Init cURL
            */
            $handle = curl_init($options['url']);

            /**
            * Setting JSON result
            */
            $this->json = $this->process($handle, $options);

            return $this;
        }

        /**
        * POST request
        *
        * @param array $options The options
        *
        * @return json
        */
        public function post($options) {
            /**
            * Init cURL
            */
            $handle = curl_init($options['url']);

            /**
            * Adding data
            */
            if(isset($options['data'])) {
                /**
                * POST option
                */
                curl_setopt($handle, CURLOPT_POSTFIELDS, $options['data']);
            } else {
                throw new InvalidArgumentException('No data provided for that POST request');
            }

            /**
            * Adding the method name to cURL
            */
            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'POST');

            /**
            * Setting JSON result
            */
            $this->json = $this->process($handle, $options);

            return $this;
        }

        /**
        * PUT request
        *
        * @param array $options The options
        *
        * @return json
        */
        public function put($options) {
            /**
            * Init cURL
            */
            $handle = curl_init($options['url']);

            /**
            * Adding data
            */
            if(isset($options['data'])) {
                /**
                * Converting array to an URL-encoded query string
                */
                $options['data'] = http_build_query($options['data'], '', '&');

                /**
                * Opening PHP memory
                */
                $memory = fopen('php://temp', 'rw+');
                fwrite($memory, $options['data']);
                rewind($memory);

                /**
                * Simulating file upload
                */
                curl_setopt($handle, CURLOPT_INFILE, $memory);
                curl_setopt($handle, CURLOPT_INFILESIZE, strlen($options['data']));
                curl_setopt($handle, CURLOPT_PUT, true);
            } else {
                throw new InvalidArgumentException('No data provided for that PUT request');
            }

            /**
            * Adding the method name to cURL
            */
            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'PUT');

            /**
            * Setting JSON result
            */
            $this->json = $this->process($handle, $options);

            return $this;
        }

        /**
        * DELETE request
        *
        * @param array $options The options
        *
        * @return json
        */
        public function delete($options) {
            /**
            * Init cURL
            */
            $handle = curl_init($options['url']);

            /**
            * Adding the method name to cURL
            */
            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'DELETE');

            /**
            * Setting JSON result
            */
            $this->json = $this->process($handle, $options);

            return $this;
        }

        /**
        * Executes the request
        *
        * @param object $handle The cURL resource
        *
        * @return json
        */
        private function process($handle, $options) {
            /**
            * Basic options
            */
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

            if(isset($options['headers']) && count($options['headers']) > 0) {
                curl_setopt($handle, CURLOPT_HTTPHEADER, $options['headers']);
            }

            /**
            * Result
            */
            $json = curl_exec($handle);

            /**
            * Setting HTTP status code
            */
            $this->status = curl_getinfo($handle, CURLINFO_HTTP_CODE);

            /**
            * Closing handle
            */
            curl_close($handle);

            return $json;
        }

    }

?>