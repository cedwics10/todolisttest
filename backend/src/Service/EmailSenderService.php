<?php

namespace App\Service;

use App\Entity\Member;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailSenderService
{
    public function __construct(
        private MailerInterface $mailer
    ) {
    }

    public function send(Member $member): bool
    {
        return false;

        $email = (new Email())
            ->from('noreply@ourplatform.com')
            ->to($member->getMail())
            ->subject('Welcome to our platform')
            ->text('Welcome to our platform!');

        $this->mailer->send($email);
    }
}
