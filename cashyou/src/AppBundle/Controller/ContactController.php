<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ContactForm;
use AppBundle\Form\TelType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactController extends Controller
{
    public function formAction()
    {
        $session = $this->get('session');
        $previousRequest = $session->get('previousRequest');
        $session->remove('previousRequest');

        $contactForm = new ContactForm();
        $form = $this->getForm($contactForm);

        if ($previousRequest) {
            $form->handleRequest($previousRequest);
        }
        
        $successMessage = $session->get('contactFormSuccessMsg');
        $session->remove('contactFormSuccessMsg');
        
        $errorMessage = $session->get('contactFormErrorMsg');
        $session->remove('contactFormErrorMsg');
        
        return $this->render('contact/form.html.twig', [
            'form' => $form->createView(),
            'successMessage' => $successMessage,
            'errorMessage' => $errorMessage,
        ]);
        
    }
    
    public function formSubmitAction(Request $request)
    {
        $referer = $request->headers->get('referer');
        
        if (!$referer) {
            return $this->createNotFoundException();
        }

        $session = $this->get('session');
        $contactForm = new ContactForm();
        $form = $this->getForm($contactForm);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $translator = $this->get('translator');
            $message = (new \Swift_Message())
                ->setSubject($translator->trans('Новое обращение через форму обратной связи'))
                ->setFrom($this->getParameter('contact_form_email'))
                ->setTo($this->getParameter('contact_to_email'))
                ->setBody(
                    $this->renderView(
                        'emails/contact-form-submission.txt.twig',
                        array(
                            'name' => $contactForm->getName(),
                            'phone' => $contactForm->getPhone(),
                            'message' => $contactForm->getMessage(),
                        )
                    )
                )
            ;
            
            try {
                if ($this->get('mailer')->send($message)) {
                    $session->set( 'contactFormSuccessMsg', $translator->trans('Спасибо, ваше сообщение отправлено') );

                    return $this->redirect($referer);
                }
            }
            catch (\Exception $e){
                $session->set( 'contactFormErrorMsg', $translator->trans('При отправке сообщения возникла ошибка') );
            }
        }
        
        $session->set( 'previousRequest', $request );

        return $this->redirect($referer);
    }

    protected function getForm(ContactForm $contactForm)
    {
        return $this->createFormBuilder($contactForm)
            ->setAction($this->generateUrl('app.contact.form.submit'))
            ->add('name', null, [
                'label' => 'Имя',
            ])
            ->add('phone', TelType::class, [
                'label' => 'Телефон',
                'attr' => array(
                    'placeholder' => '+38 (___) ___-__-__',
                    'data-mask' => '+38 (099) 999-99-99'
                )
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Сообщение',
            ])
            ->getForm();
    }
}