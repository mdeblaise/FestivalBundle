<?php

namespace MMC\FestivalBundle\Services;

use Symfony\Component\Templating\EngineInterface;

class RegisterProcessor
{
    protected $mailer;

    protected $templating;

    protected $receiver;

    protected $sender;

    protected $template;

    protected $subject;

    public function __construct(
        \Swift_Mailer $mailer,
        EngineInterface $templating,
        $sender,
        $receiver,
        $template,
        $subject
    ) {
        $this->mailer = $mailer;

        $this->templating = $templating;

        $this->sender = $sender;

        $this->receiver = $receiver;

        $this->template = $template;

        $this->subject = $subject;
    }

    public function process($contact)
    {
        $from = $contact->getEmail();

        $body = $this->templating->render($this->template, ['contact' => $contact]);

        $mail = \Swift_Message::newInstance();

        $mail
            ->setFrom($this->sender)
            ->setReplyTo($contact->getEmail())
            ->setTo($this->receiver)
            ->setSubject($this->subject)
            ->setBody($body)
            ->setContentType('text/html');

        $this->mailer->send($mail);
    }
}
