<?php

namespace App\Core\Jobs;

use App\Modules\Email\Email;
use App\Modules\Email\EmailFacade;

class EmailJob {
    private EmailFacade $emailFacade;
    public function __construct(private object $payload) {
        $this->emailFacade = new EmailFacade();
    }
    public function handle() {
        $this->emailFacade->send(new Email($this->payload->to, $this->payload->subject, $this->payload->content));
    }
}