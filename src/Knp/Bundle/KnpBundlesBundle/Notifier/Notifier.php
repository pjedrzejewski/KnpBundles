<?php

namespace Knp\Bundle\KnpBundlesBundle\Notifier;

use Knp\Bundle\KnpBundlesBundle\Entity\Bundle;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class Notifier
{
    private $mailer;
    private $templating;
    private $output;

    /**
     * @param \Swift_Mailer   $mailer
     * @param EngineInterface $engine
     */
    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public function notifyOwnerAboutDiscovery(Bundle $bundle)
    {
        $owner = $bundle->getOwner();
        $content = $this->templating->render('KnpBundlesBundle:Notifications:discovery.html.twig', array(
            'bundle' => $bundle,
            'owner'  => $owner
        ));

        $message = null;

        $this->mailer->send($message);
    }
}

