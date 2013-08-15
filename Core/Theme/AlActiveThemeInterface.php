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

namespace RedKiteLabs\ThemeEngineBundle\Core\Theme;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defined the methods the active theme manager object must defin
 * 
 * @author RedKite Labs <webmaster@redkite-labs.com>
 */
interface AlActiveThemeInterface
{
    /**
     * Returns the active theme
     * @return null|string
     */
    public function getActiveTheme();

    /**
     * Writes the active theme
     * @param string $themeName
     */
    public function writeActiveTheme($themeName);
}