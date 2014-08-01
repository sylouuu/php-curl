<?php
    namespace sylouuu\Curl\Method;

    /**
    * Post
    *
    * @author sylouuu
    * @link https://github.com/sylouuu/php-curl
    * @version 0.7.0
    * @license MIT
    */
    class Post extends \sylouuu\Curl\Curl
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
            // Option
            $this->setCurlOption(CURLOPT_CUSTOMREQUEST, 'POST');

            if(isset($this->options['data'])) {
                // Data
                $this->setCurlOption(CURLOPT_POSTFIELDS, $this->options['data']);
            }
        }
    }
