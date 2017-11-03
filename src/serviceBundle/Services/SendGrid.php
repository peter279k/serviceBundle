<?php

namespace peter\components\serviceBundle\Services;

use peter\components\serviceBundle\Service;

class SendGrid implements Service
{
    private $config;

    public function setConfig($config)
    {
        $this->config = $config;
    }

    public function sendReq()
    {
        $sandboxMode = $this->config['sandbox-mode'] ? true : false;
        $from = new \SendGrid\Email($this->config['from-name'], $this->config['from-email']);
        $to = new \SendGrid\Email($this->config['to-name'], $this->config['to-email']);
        $content = new \SendGrid\Content("text/plain", $this->config['contents']);
        $mail = new \SendGrid\Mail($from, $this->config['subject'], $to, $content);
        $sendGrid = new \SendGrid($this->config['api-key']);
        $sendGrid->client->mail_settings()->setSandboxMode($sandboxMode);
        return $sendGrid->client->mail()->send()->post($mail);
    }
}