<?php
    namespace sylouuu\Curl;

    /**
    * Put
    *
    * @author sylouuu
    * @link https://github.com/sylouuu/php-curl
    * @version 0.5.0
    * @license MIT
    */
    class Put extends Curl
    {
        /**
        * Constructor
        *
        * @param array $options
        */
        public function __construct($options)
        {
            parent::__construct($options);

            $this->prepare();
        }

        /**
        * Prepare the request
        */
        public function prepare()
        {
            if(isset($this->options['data'])) {
                // Converting array to an URL-encoded query string
                $this->options['data'] = http_build_query($this->options['data'], '', '&');

                // Options
                $this->setCurlOption(CURLOPT_CUSTOMREQUEST, 'PUT');
                $this->setCurlOption(CURLOPT_POSTFIELDS, $this->options['data']);
            } else {
                throw new \InvalidArgumentException('No data provided for that PUT request');
            }
        }
    }
