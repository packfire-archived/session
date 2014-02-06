<?php

/**
 * Packfire Framework for PHP
 * By Sam-Mauris Yong
 *
 * Released open source under New BSD 3-Clause License.
 * Copyright (c) Sam-Mauris Yong <sam@mauris.sg>
 * All rights reserved.
 */

namespace Packfire\Session;

use Packfire\FuelBlade\ConsumerInterface;

/**
 * Performs loading for the session and its storage method
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Session
 * @since 1.0-sofia
 */
class Loader implements ConsumerInterface
{
    public function __invoke($c)
    {
        $storageId = 'Packfire\\Session\\StorageInterface';
        if (!isset($c[$storageId])) {
            $c[$storageId] = $c->share(
                function () {
                    return new Storage();
                }
            );
        }
        if (isset($c['Packfire\\Config\\ConfigInterface'])) {
            /* @var $config Packfire\Config\Config */
            $config = $c['Packfire\\Config\\ConfigInterface'];
            session_name($config->get('session', 'name'));
            session_set_cookie_params(
                $config->get('session', 'lifetime'),
                $config->get('session', 'path'),
                $config->get('session', 'domain'),
                $config->get('session', 'secure'),
                $config->get('session', 'http')
            );
        }
        $c['Packfire\\Session\\SessionInterface'] = $c->share(
            function ($c) use ($storageId) {
                if (Session::detectCookie()) {
                    session_start();
                }

                return new Session($c[$storageId]);
            }
        );

        return $this;
    }
}
