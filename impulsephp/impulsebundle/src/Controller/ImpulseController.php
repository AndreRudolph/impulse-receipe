<?php
namespace App\Controller;
use Impulse\ImpulseBundle\Kernel\RequestHandler;
use Impulse\ImpulseBundle\Request\ImpulseRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * author André Rudolph <rudolph[at]impulse-php.com>
 */
class ImpulseController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    protected RequestHandler $requestHandler;

    protected string $template = 'impulse.html.twig';

    public function __construct(RequestHandler $requestHandler)
    {
        $this->requestHandler = $requestHandler;
    }

    /**
     * No ajax route
     *
     * @param Request $request
     * @return Response
     * @throws Throwable
     */
    public function index(Request $request): Response
    {
        $jsResponse = $this->requestHandler->handle(new ImpulseRequest($request, ImpulseRequest::INDEX_REQUEST));
        return $this->render($this->template, ['jsResponse' => $jsResponse]);
    }

    /**
     * Ajax event route
     *
     * @param Request $request
     * @return Response
     * @throws Throwable
     */
    public function event(Request $request): Response
    {
        $jsData = $this->requestHandler->handle(new ImpulseRequest($request, ImpulseRequest::EVENT_REQUEST));
        return new JsonResponse($jsData);
    }

    /**
     * Ajax sync route
     *
     * @param Request $request
     * @return Response
     * @throws Throwable
     */
    public function sync(Request $request): Response
    {
        $jsData = $this->requestHandler->handle(new ImpulseRequest($request, ImpulseRequest::SYNC_REQUEST));
        return new JsonResponse($jsData);
    }
}