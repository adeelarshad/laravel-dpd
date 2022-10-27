<?php

namespace Proxi\Dpd\Entity\Shipment\Request;

use Proxi\Dpd\DataObject\DataObject;
use Proxi\Dpd\DataObject\Annotation\Accessible;

class Predict extends DataObject
{
    const CHANNEL_EMAIL = 1;
    const CHANNEL_SMS = 3;
    /**
     * @Accessible()
     * @var int
     */
    protected $channel;

    /**
     * @Accessible()
     * @var string
     */
    protected $value;

    /**
     * @Accessible()
     * @var string
     */
    protected $language = 'EN';
}
