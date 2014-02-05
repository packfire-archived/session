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

/**
 * A session storage abstraction
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Session
 * @since 1.0-sofia
 */
interface StorageInterface extends BucketInterface
{
    /**
     * Regenerate the session
     * @param bool $delete Set if the previous session should be deleted
     * @since 1.0-sofia
     */
    public function regenerate($delete = false);

    /**
     * Register a bucket into the session storage
     * @param Packfire\Session\BucketInterface $bucket The bucket to be registered.
     * @since 1.0-sofia
     */
    public function register($bucket);

    /**
     * Get the bucket in the storage by the ID
     * @param string $id The identifier of the storage
     * @return Packfire\Session\BucketInterface Returns the session bucket
     * @since 1.0-sofia
     */
    public function bucket($id);
}
