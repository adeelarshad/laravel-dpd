<?php

namespace Proxi\Dpd\Entity\Shipment\Request;

use Proxi\Dpd\DataObject\DataObject;
use Proxi\Dpd\DataObject\Annotation\Accessible;

class PrintOptions extends DataObject
{
    /**
     * @Accessible()
     * @var string
     */
    protected $printerLanguage = 'PDF';

    /**
     * @Accessible()
     * @var string
     */
    protected $paperFormat;
}
