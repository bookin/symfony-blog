<?php

namespace Blog\BlogBundle\Controller;

use Blog\BlogBundle\Entity\Contact;
use Blog\BlogBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('BlogBlogBundle:Page:index.html.twig');
    }


    public function aboutAction()
    {
        return $this->render('BlogBlogBundle:Page:about.html.twig');
    }

    public function contactAction(Request $request)
    {
        $model = new Contact();

        $form = $this->createForm(ContactType::class, $model);

        if($request->isMethod($request::METHOD_POST)){
            $form->handleRequest($request);

            if ($form->isValid()) {
                //Send message
                $message = \Swift_Message::newInstance()
                    ->setSubject('Contact from my blog')
                    ->setFrom($model->getEmail())
                    ->setTo($this->getParameter('blog.admin_email'))
                    ->setBody($this->renderView('BlogBlogBundle:Email:contact.txt.twig', ['model' => $model]));

                $this->get('mailer')->send($message);

                $this->get('session')->getFlashBag()->add('blog-notice', 'Your contact enquiry was successfully sent. Thank you!');

                return $this->redirect($this->generateUrl('BlogBlogBundle_contact'));
            }
        }

        return $this->render('BlogBlogBundle:Page:contact.html.twig', [
            'form'=>$form->createView()
        ]);
    }

}
