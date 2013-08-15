<?php
/**
 * This file is part of the RedKiteLabsThemeEngineBundle and it is distributed
 * under the MIT License. In addiction, to use this bundle, you must leave
 * intact this copyright notice.
 *
 * Copyright (c) RedKite Labs <webmaster@redkite-labs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * For extra documentation and help please visit http://alphalemon.com
 *
 * @license    MIT License
 */

namespace RedKiteLabs\ThemeEngineBundle\Core\Asset;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines the methods to add and remove one or more items from the
 * AlAssetsCollect
 *
 * @author RedKite Labs <webmaster@redkite-labs.com>
 */
interface AlAssetsCollectionInterface extends \Iterator, \Countable
{

    /**
     * Adds an asset to the collection
     *
     * @param type $asset
     */
    public function add($asset);

    /**
     * Adds a range of asset to the collection
     *
     * @param type $asset
     */
    public function addRange(array $assets);

    /**
     * Removes an asset from the collection
     *
     * @param type $asset
     */
    public function remove($asset);
}
