<?php
    namespace sylouuu\Curl\Method;

    /**
    * Head
    *
    * @author sylouuu
    * @link https://github.com/sylouuu/php-curl
    * @version 0.7.0
    * @license MIT
    */
    class Head extends \sylouuu\Curl\Curl
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
            $this->setCurlOption(CURLOPT_HEADER, true);
            $this->setCurlOption(CURLOPT_CUSTOMREQUEST, 'HEAD');
        }
    }
