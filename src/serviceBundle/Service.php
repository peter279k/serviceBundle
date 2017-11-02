<?php 

namespace peter\components\serviceBundle;

interface Service
{
    public function setConfig($config);
    public function sendReq();
}