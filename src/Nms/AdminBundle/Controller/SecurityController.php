<?php

// src/Nms/Admin/Controller/SecurityController.php;

namespace Nms\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller
{
    public function loginAction() {
        $request = $this->getRequest();
        $session = $request->getSession();
        $logger = $this->get('logger');
//      get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
//            $logger->info('login failed');
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
//            $logger->info('login successful');
        }

        $csrfToken = $this->container->has('form.csrf_provider') ? $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate') : null;

        return $this->render(
                    'NmsAdminBundle:Security:login.html.twig', array(
//                  last username entered by the user
                    'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                    'error' => $error,
                    'csrf_token' => $csrfToken,
                    )
        );
    }

    public function logoutAction() {
        // The security layer will intercept this request
    }

}
