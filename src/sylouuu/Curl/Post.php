<?php
    namespace sylouuu\Curl;

    /**
    * Post
    *
    * @author sylouuu
    * @link https://github.com/sylouuu/php-curl
    * @version 0.5.0
    * @license MIT
    */
    class Post extends Curl
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
                // Options
                $this->setCurlOption(CURLOPT_POSTFIELDS, $this->options['data']);
                $this->setCurlOption(CURLOPT_CUSTOMREQUEST, 'POST');
            } else {
                throw new \InvalidArgumentException('No data provided for that POST request');
            }
        }
    }
