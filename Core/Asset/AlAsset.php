<?php
/*
 * This file is part of the AlphaLemonPageTreeBundle and it is distributed
 * under the MIT License. In addiction, to use this bundle, you must leave
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

namespace AlphaLemon\ThemeEngineBundle\Core\Asset;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * The AlAsset object extracts the asset's full path and the absolute path to the
 * web/bundle's folder
 *
 * @author AlphaLemon <webmaster@alphalemon.com>
 */
class AlAsset
{
    protected $kernel;
    protected $asset = null;
    protected $realPath = null;
    protected $absolutePath = null;

    /**
     * Constructor
     *
     * @param KernelInterface $kernel
     * @param string $asset  The asset
     */
    public function __construct(KernelInterface $kernel, $asset)
    {
        $this->kernel = $kernel;
        $this->asset = $asset;

        $this->setUp();
    }

    /**
     * Returns the asset
     *
     * @return string
     */
    public function getAsset()
    {
        return $this->asset;
    }

    /**
     * Returns the asset's full path
     *
     * @return type
     */
    public function getRealPath()
    {
        return $this->realPath;
    }

    /**
     * Returns the asset's absolute path to web/bundle's folder
     *
     * @return type
     */
    public function getAbsolutePath()
    {
        return $this->absolutePath;
    }

    /**
     * Sets up the asset information
     */
    protected function setUp()
    {
        if (empty($this->asset)) {
            return;
        }
        
        $this->asset = $this->normalizePath($this->asset);
        $this->realPath = $this->locateResource();

        // The asset has not been located, so the full path is the asset itself
        if(null === $this->realPath) $this->realPath = $this->asset;
        $this->absolutePath = $this->retrieveBundleWebFolder();
    }

    /**
     * Retrieves the web bundle folder from the current asset
     *
     * @return null|string
     */
    protected function retrieveBundleWebFolder()
    {
        preg_match('/([^@\/][\w]+Bundle)\/(Resources\/public)?\/(.*)/', $this->asset, $matches);
        if (!empty($matches) && count($matches) == 4) {
            return sprintf('bundles/%s/%s', preg_replace('/bundle$/', '', strtolower($matches[1])), $matches[3]);
        }
        
        preg_match('/[\/]?(bundles?.*)/', strtolower($this->asset), $matches);
        return (!empty($matches)) ? $matches[1] : null;
    }

    /**
     * Locates a resource defined by a relative path
     *
     * @return null!string
     */
    protected function locateResource()
    {
        $asset = $this->normalizePath($this->asset);
        if(\substr($asset, 0, 1) != '@') $asset = '@' . $asset;

        if('@' === \substr($asset, 0, 1))
        {
            try
            {
                return $this->kernel->locateResource($asset);
            }
            catch(\InvalidArgumentException $e)
            {
                return null;
            }
        }
    }

    /**
     * Normalize a path as a unix path
     *
     * @param   string      $path
     * @return  string
     */
    protected function normalizePath($path)
    {
        return preg_replace('/\\\/', '/', $path);
    }
}
