<?php 

namespace peter\components\serviceBundle;

interface Service
{
    public function sendReq();
    public function setConfigs($configs);
}