<?php

namespace Proxi\Dpd\Entity\Shipment\Response;

use Proxi\Dpd\DataObject\DataObject;
use Proxi\Dpd\DataObject\Annotation\Accessible;

class ParcelInformation extends DataObject
{
    /**
     * @Accessible()
     * @var string
     */
    protected $parcelLabelNumber;
}
