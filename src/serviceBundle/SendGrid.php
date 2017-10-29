<?php

namespace peter\components\serviceBundle;

class SendGrid implements serviceBundle
{
    public function sendReq()
    {
        $sandboxMode = $this->configs['sandbox-mode'] ? true : false;
        $from = new \SendGrid\Email($this->configs['from-name'], $this->configs['from-email']);
        $to = new \SendGrid\Email($this->configs['to-name'], $this->configs['to-email']);
        $content = new \SendGrid\Content("text/plain", $this->configs['contents']);
        $mail = new \SendGrid\Mail($from, $this->configs['subject'], $to, $content);
        $sg = new \SendGrid($this->configs['api-key']);
        $sg->client->mail_settings()->setSandboxMode($sandboxMode);
        return $sg->client->mail()->send()->post($mail);
    }
}