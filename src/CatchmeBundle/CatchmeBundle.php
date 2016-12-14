<?php

namespace CatchmeBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CatchmeBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
