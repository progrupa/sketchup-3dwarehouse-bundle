<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AuthorizeController
 * @package Progrupa\Sketchup3DWarehouseBundle\Controller
 * @Route("/progrupa/sketchup3dwarehouse")
 */
class AuthorizeController extends Controller
{
    /**
     * @Route("/login", name="progrupa_3dwarehouse_auth_init")
     * @Template
     */
    public function authInitAction(Request $request)
    {
        if ($request->getMethod() == Request::METHOD_POST) {

            $openid = $request->get('sketchup_openid');

            $consumer = new \Auth_OpenID_Consumer(new \Auth_OpenID_FileStore(sys_get_temp_dir()));

            // Begin the OpenID authentication process.
            $auth_request = $consumer->begin($openid);
            // No auth request means we can't begin OpenID.
            if (!$auth_request) {
                return ['error' => "Authentication error; not a valid OpenID."];
            }

            $sreg_request = \Auth_OpenID_SRegRequest::build(['email'], []);

            if ($sreg_request) {
                $auth_request->addExtension($sreg_request);
            }
            $policy_uris = null;
            $pape_request = new \Auth_OpenID_PAPE_Request($policy_uris);
            if ($pape_request) {
                $auth_request->addExtension($pape_request);
            }

            // Redirect the user to the OpenID server for authentication.
            // Store the token for this authentication so we can verify the
            // response.
            // For OpenID 1, send a redirect.  For OpenID 2, use a Javascript
            // form to send a POST request to the server.
            if ($auth_request->shouldSendRedirect()) {
                $redirect_url = $auth_request->redirectURL(getTrustRoot(), getReturnTo());
                // If the redirect URL can't be built, display an erro message.
                if (\Auth_OpenID::isFailure($redirect_url)) {
                    return ['error' =>"Could not redirect to server: " . $redirect_url->message];
                } else {
                    // Send redirect.
                    return new RedirectResponse($redirect_url);
                }
            } else {
                // Generate form markup and render it.
                $form_id = 'openid_message';
                $form_html = $auth_request->htmlMarkup(getTrustRoot(), getReturnTo(), false, array('id' => $form_id));
                // Display an error if the form markup couldn't be generated otherwise, render the HTML.
                if (\Auth_OpenID::isFailure($form_html)) {
                    return ['error' => "Could not redirect to server: " . $form_html->message];
                } else {
                    return new Response($form_html);
                }
            }
        }
        return [];
    }

    /**
     * @Route("/process", name="progrupa_3dwarehouse_auth_process")
     * @Template
     */
    public function authProcessAction(Request $request)
    {

    }
}
