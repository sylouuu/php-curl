<?php
    namespace sylouuu\Curl;

    /**
    * Options
    *
    * @author sylouuu
    * @link https://github.com/sylouuu/php-curl
    * @version 0.5.0
    * @license MIT
    */
    class Options extends Curl
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
            // Options
            $this->setCurlOption(CURLOPT_CUSTOMREQUEST, 'OPTIONS');
        }
    }
