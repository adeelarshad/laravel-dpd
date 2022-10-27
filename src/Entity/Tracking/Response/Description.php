<?php

namespace Proxi\Dpd\Entity\Tracking\Response;

use Proxi\Dpd\DataObject\DataObject;
use Proxi\Dpd\DataObject\Annotation\Accessible;

class Description extends DataObject
{
    /**
     * @Accessible()
     * @var Phrase
     */
    protected $label;

    /**
     * @Accessible()
     * @var Phrase
     */
    protected $content;

    /**
     * @Accessible()
     * @var string
     */
    protected $linkTarget;
}
