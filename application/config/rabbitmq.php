<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Config for Rabbit MQ Library
 */
$config['rabbitmq'] = array(
    'host' => 'birmingham.package7.com',    // <- Your Host     (default: localhost)
    'port' => 5672,           // <- Your Port     (default: 5672)
    'user' => 'test',     // <- Your User     (default: guest)
    'pass' => 'test',     // <- Your Password (default: guest)
    'vhost' => '/'            // <- Your Vhost    (default: /)
);

?>