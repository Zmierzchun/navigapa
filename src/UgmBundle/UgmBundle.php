<?php

namespace UgmBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class UgmBundle extends Bundle
{

    public function getParent()
    {
        //parent::getParent(); // TODO: Change the autogenerated stub
        return 'FOSUserBundle';
    }

}