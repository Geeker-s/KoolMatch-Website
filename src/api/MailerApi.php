<?php

namespace App\api;

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\RawMessage;
use Symfony\Component\Mime\Email;

class MailerApi
{





    /**
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function sendEmail(MailerInterface $mailer,string $from , string $to , string $subject,string $body ){
        $email = (new Email())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->text($body);



        $mailer->send($email);


    }
}