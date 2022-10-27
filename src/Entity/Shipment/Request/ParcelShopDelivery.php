<?php

namespace Proxi\Dpd\Entity\Shipment\Request;

use Proxi\Dpd\DataObject\DataObject;
use Proxi\Dpd\DataObject\Annotation\Accessible;

class ParcelShopDelivery extends DataObject
{
    /**
     * @Accessible()
     * @var string
     */
    protected $parcelShopId;
}
