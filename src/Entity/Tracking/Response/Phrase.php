<?php

namespace Proxi\Dpd\Entity\Tracking\Response;

use Proxi\Dpd\DataObject\DataObject;
use Proxi\Dpd\DataObject\Annotation\Accessible;

class Phrase extends DataObject
{
    /**
     * @Accessible()
     * @var string
     */
    protected $content;

    /**
     * @Accessible()
     * @var boolean
     */
    protected $bold;

    /**
     * @Accessible()
     * @var boolean
     */
    protected $paragraph;
}
