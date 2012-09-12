<?php
/*
 * This file is part of the AlphaLemon FrontendBundle and it is distributed
 * under the GPL LICENSE Version 2.0. To use this application you must leave
 * intact this copyright notice.
 *
 * Copyright (c) AlphaLemon <webmaster@alphalemon.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * For extra documentation and help please visit http://www.alphalemon.com
 *
 * @license    GPL LICENSE Version 2.0
 *
 */

namespace AlphaLemon\ThemeEngineBundle\Core\Rendering\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use AlphaLemon\ThemeEngineBundle\Core\Rendering\Event\PageRenderer\BeforePageRenderingEvent;
use AlphaLemon\ThemeEngineBundle\Core\Rendering\Event\PageRendererEvents;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Defines the base controller application should inherit from
 *
 * @author alphalemon <webmaster@alphalemon.com>
 */
abstract class BaseFrontendController extends Controller
{
    protected function dispatchEvents(Request $request, Response $response)
    {
        $dispatcher = $this->container->get('event_dispatcher');

        // Dispatches the pre rendering events for current language and page
        $event = new BeforePageRenderingEvent($response);
        $dispatcher->dispatch(PageRendererEvents::BEFORE_RENDER_PAGE, $event);
        $response = $event->getResponse();

        $eventName = sprintf('page_renderer.before_%s_rendering', $request->getLocale());
        $dispatcher->dispatch($eventName, $event);
        $response = $event->getResponse();

        $eventName = sprintf('page_renderer.before_%s_rendering', $request->get('page'));
        $dispatcher->dispatch($eventName, $event);
        $response = $event->getResponse();

        return $response;
    }
}

