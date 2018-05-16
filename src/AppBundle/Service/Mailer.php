<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 16/05/18
 * Time: 16:16
 */

namespace AppBundle\Service;

class Mailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var \Twig_Environment
     */
    private $templating;

    /**
     * Mailer constructor.
     *
     * @param \Swift_Mailer $mailer
     * @param \Twig_Environment $templating
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    /**
     * @param $recipient
     * @param string $type
     */
    public function sendMail($recipient, $type)
    {
        switch ($type) {
            case 'notification': /* Pilot */
                $message = (new \Swift_Message('Réservation Flyaround'))
                    ->setFrom('reservations@flyaround.com')
                    ->setTo($recipient)
                    ->setBody('Quelqu\'un vient de réserver une place sur votre vol.<br/>Merci de voyager avec Flyaround', 'text/html');
                $this->mailer->send($message);
                break;

            case 'confirmation': /* Passenger */
                $message = (new \Swift_Message('Réservation Flyaround'))
                    ->setFrom('reservations@flyaround.com')
                    ->setTo($recipient)
                    ->setBody('Votre réservation est enregistrée.<br/>Merci de voyager avec Flyaround', 'text/html');
                $this->mailer->send($message);
                break;
        }
    }
}