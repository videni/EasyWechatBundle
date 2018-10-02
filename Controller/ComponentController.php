<?php

namespace Videni\Bundle\EasyWechatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EasyWeChat\OpenPlatform\Application;

class ComponentController extends Controller
{
    private $openPlatform;

    public function __construct(Application $openPlatform)
    {
        $this->openPlatform = $openPlatform;
    }

    public function verifyTicket()
    {
        return $this->openPlatform->server->serve();
    }
}
