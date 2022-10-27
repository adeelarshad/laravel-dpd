<?php

namespace Proxi\Dpd\Entity\Shipment\Response;

use Proxi\Dpd\DataObject\DataObject;
use Proxi\Dpd\DataObject\Annotation\Accessible;

class ShipmentResponse extends DataObject
{
    /**
     * @Accessible()
     * @var string
     */
    protected $mpsId;

    /**
     * @Accessible()
     * @var ParcelInformation
     */
    protected $parcelInformation;
}
