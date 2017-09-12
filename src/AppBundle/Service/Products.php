<?php

namespace AppBundle\Service;

use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;

class Products
{    
    private $mailer;
    private $templating;
    
    public function __construct(EntityManager $entityManager, \Swift_Mailer $mailer, ContainerInterface $container, LoggerInterface $logger){
        $this->em = $entityManager;
        $this->container = $container;
        $this->mailer = $mailer;
        $this->logger = $logger;
        $this->templating = $container->get('templating');
    }

    public function save($product) {
        $this->logger->info('Saving product');
        $this->em->persist($product);
        $this->em->flush();
        $this->logger->info('Saved product');
    }

    public function sendMail($product) {
        $this->logger->info('Sending email');        
        //TODO: body with html and twig template. 
        $mail = \Swift_Message::newInstance()
            ->setSubject($this->container->getParameter('product_email_subject'))
            ->setFrom($this->container->getParameter('product_email_from'))
            ->setTo($this->container->getParameter('product_email_to'))
            ->setBody(
                $this->templating->render(
                    'emails/product_email.html.twig',
                     array('product' => $product)
                ),
                'text/html'
            );

        $this->mailer->send($mail);
    }
}