<?php
/*
 * This file is part of the AlphaLemonThemeEngineBundle and it is distributed
 * under the MIT License. To use this bundle you must leave
 * intact this copyright notice.
 *
 * Copyright (c) AlphaLemon <webmaster@alphalemon.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * For extra documentation and help please visit http://alphalemon.com
 * 
 * @license    MIT License
 */

namespace AlphaLemon\ThemeEngineBundle\Core\Autoloader;

use AlphaLemon\ThemeEngineBundle\Core\Autoloader\Base\BundlesAutoloader;

/**
 * Instantiates the themes 
 *
 * @author AlphaLemon
 */
class ThemesAutoloader extends BundlesAutoloader
{
    /**
     * @inheritDoc
     */
    protected function  configure()
    {
        return array('AlphaLemon\Theme' => array(__DIR__ . '/../../../../../../../src/AlphaLemon/Theme', 'composer'));
    }
}