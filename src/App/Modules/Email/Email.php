<?php

namespace App\Modules\Email;

class Email
{
    public function __construct(
        private string $toEmail,
        private string $subject,
        private string $content,
        private string $replyToEmail = EMAIL_FROM_EMAIL,
        private string $replyToName = EMAIL_FROM_NAME,
        private string $fromEmail = EMAIL_FROM_EMAIL,
        private string $fromName = EMAIL_FROM_NAME,
    ) {
    }

    public function getToEmail(): string {
        return $this->toEmail;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getReplyToEmail(): string
    {
        return $this->replyToEmail;
    }

    public function getReplyToName(): string
    {
        return $this->replyToName;
    }

    public function getFromEmail(): string
    {
        return $this->fromEmail;
    }

    public function getFromName(): string
    {
        return $this->fromName;
    }
}
