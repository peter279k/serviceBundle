<?php

namespace peter\components\serviceBundle\Services;

use SendGrid\Email;
use SendGrid\Content;
use SendGrid\Mail;
use peter\components\serviceBundle\Service;

class SendGrid extends Service
{
    public function sendReq()
    {
        $sandboxMode = $this->config['sandbox-mode'] ? true : false;
        $from = new Email($this->config['from-name'], $this->config['from-email']);
        $to = new Email($this->config['to-name'], $this->config['to-email']);
        $content = new Content("text/plain", $this->config['contents']);
        $mail = new Mail($from, $this->config['subject'], $to, $content);
        $sendGrid = new \SendGrid($this->config['api-key']);
        $sendGrid->client->mail_settings()->setSandboxMode($sandboxMode);
        return $sendGrid->client->mail()->send()->post($mail);
    }
}
