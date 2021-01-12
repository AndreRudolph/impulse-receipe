<?php
namespace App\Controller;
use Impulse\ImpulseBundle\Controller\AbstractController;
use Impulse\ImpulseBundle\Execution\Events\Event;
use Impulse\ImpulseBundle\UI\Components\Div;

class IndexController extends AbstractController
{
    /** @var Div */ private $contentContainer;

    public function afterCreate(Event $event)
    {
        parent::afterCreate($event);
        $this->importView('app/welcome.html.twig', $this->contentContainer);
    }
}