<?php
    namespace sylouuu\Curl;

    /**
    * Options
    *
    * @author sylouuu
    * @link https://github.com/sylouuu/php-curl
    * @version 0.6.1
    * @license MIT
    */
    class Options extends Curl
    {
        /**
        * Constructor
        *
        * @param array $options
        */
        public function __construct($url, $options = null)
        {
            parent::__construct($url, $options);

            $this->prepare();
        }

        /**
        * Prepare the request
        */
        public function prepare()
        {
            // Options
            $this->setCurlOption(CURLOPT_CUSTOMREQUEST, 'OPTIONS');
        }
    }
