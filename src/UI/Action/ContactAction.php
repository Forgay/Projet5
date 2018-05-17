<?php

namespace Src\UI\Action;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Services\ContactService;
use App\Services\ContactBuilder;
use App\Services\ValidatorService;

class ContactAction
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var Session
     */
    private $session;

    /**
     * @var ContactService
     */
    private $contactService;

    /**
     * @var ContactBuilder
     */
    private $contactBuilder;

    /**
     * ContactAction constructor.
     *
     * @param Request $request
     */

    private $validator;


    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->session = new Session();
        $this->contactBuilder = new ContactBuilder();
        $this->validator = new ValidatorService();

    }

    /**
     * Send mail
     *
     * @return Response
     */
    public function __invoke()
    {
        $data = $this->request->request;
        $this->validator->isValid($data,'ListPostView.html.twig');

        $this->contactBuilder->buildContact(
            $this->request->get('firstname'),
            $this->request->get('lastname'),
            $this->request->get('email'),
            $this->request->get('message')
        );

        $this->contactService = new ContactService($this->contactBuilder->getContact());
        $this->contactService->sendMail();
        $this->session->getFlashBag()->add('emailvalid', "Mail Reçu");
        $response = new RedirectResponse('/');
        return $response->send();
    }
}
