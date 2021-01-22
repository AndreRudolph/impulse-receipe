<?php
namespace App\Controller;
use Impulse\ImpulseBundle\Controller\AbstractController;
use Impulse\ImpulseBundle\Controller\Annotations\Listen;
use Impulse\ImpulseBundle\Execution\Events\ClickEvent;
use Impulse\ImpulseBundle\Execution\Events\Event;
use Impulse\ImpulseBundle\UI\Components\Div;
use Impulse\ImpulseBundle\UI\Components\Navitem;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class NavigationController extends AbstractController
{
    private Div $contentContainer;
    private Navitem $navSecuredArea;
    private Navitem $navLogout;
    private Navitem $navRegistration;
    private Navitem $navLogin;

    public function afterCreate(Event $event)
    {
        parent::afterCreate($event);

        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->navLogin->detach();
            $this->navRegistration->detach();
        } else {
            $this->navLogout->detach();
            $this->navSecuredArea->detach();
        }
    }

    /**
     * @Listen(event="click", components="{navIndex, navLogin, navRegistration, navSecuredArea}")
     */
    public function onNavigate(ClickEvent $event)
    {
        $event->getTarget()->setClass('active');
        $this->importView($event->getTarget()->getTarget(), $this->contentContainer);
    }

    private function hasRoute(string $route)
    {
        try {
            $this->container->get('router')->generate($route);
        } catch (RouteNotFoundException $exception) {
            return false;
        }

        return true;
    }
}
