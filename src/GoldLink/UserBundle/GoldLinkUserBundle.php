<?php

namespace GoldLink\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GoldLinkUserBundle extends Bundle
{
    public function getParent(){
        return 'FOSUserBundle';
    }
}
