<?php
    namespace sylouuu\Curl\Method;

    /**
     * Get
     *
     * @author sylouuu
     * @link https://github.com/sylouuu/php-curl
     * @version 0.8.1
     * @license MIT
     */
    class Get extends \sylouuu\Curl\Curl
    {
        /**
         * Constructor
         *
         * @param string $url
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
        public function prepare() {}
    }
