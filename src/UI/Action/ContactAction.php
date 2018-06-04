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
     * @var ValidatorService
     */
    private $validator;

    /**
     * ContactAction constructor.
     *
     * @param Request $request
     */

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

        if (empty($this->request->request->all())) {
            $this->session->getFlashBag()->add('vides', 'les champs sont vides');
            $response = new RedirectResponse("/");
            return $response->send();
        }
        $this->request->request->remove('submit');
        $violations = $this->validator->validate($this->request->request->all(), ['is_string', 'empty', 'email']);

        if (\count(array_values($violations)) > 0) {
            foreach ($violations as $key => $value) {
                foreach($value as $item =>$val) {
                    $this->session->getFlashBag()->add($key,$val);
                }
            }

            $response = new RedirectResponse("/");
            return $response->send();
        }

        $this->contactBuilder->buildContact(
            htmlspecialchars($this->request->get('firstname')),
            htmlspecialchars($this->request->get('lastname')),
            htmlspecialchars($this->request->get('email')),
            htmlspecialchars($this->request->get('message'))
        );
        $this->contactService = new ContactService($this->contactBuilder->getContact());
        $this->contactService->sendMail();
        $this->session->getFlashBag()->add('emailvalid', "Mail Reçu");
        $response = new RedirectResponse("/");
        return $response->send();
    }
}
