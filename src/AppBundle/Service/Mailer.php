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
    const SUBJECT = 'Réservation Flyaround';
    const FROM = 'reservations@flyaround.com';

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
     * Send Email.
     *
     * @param $recipient
     * @param string $type
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendMail($recipient, $type)
    {
        switch ($type) {
            case 'notification': /* Pilot */
                $message = (new \Swift_Message(self::SUBJECT))
                    ->setFrom(self::FROM)
                    ->setTo($recipient)
                    ->setBody($this->templating->render('mailer/notification.html.twig'), 'text/html');
                $this->mailer->send($message);
                break;

            case 'confirmation': /* Passenger */
                $message = (new \Swift_Message(self::SUBJECT))
                    ->setFrom(self::FROM)
                    ->setTo($recipient)
                    ->setBody($this->templating->render('mailer/confirmation.html.twig'), 'text/html');
                $this->mailer->send($message);
                break;
        }
    }
}