<?php

namespace Control;

use General\Widgets\Dialog\Message;
use General\Control\Page;

class ExemploMessageControl extends Page
{
        public function __construct()
        {
            new Message('info', 'This is a info message');
            new Message('error', 'This is a error message 1');
        }
}