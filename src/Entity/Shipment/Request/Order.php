<?php

namespace Proxi\Dpd\Entity\Shipment\Request;

use Proxi\Dpd\DataObject\DataObject;
use Proxi\Dpd\DataObject\Annotation\Accessible;

class Order extends DataObject
{
    /**
     * @Accessible()
     * @var GeneralShipmentData
     */
    protected $generalShipmentData;

    /**
     * @Accessible()
     * @var Parcel
     */
    protected $parcels;

    /**
     * @Accessible()
     * @var ProductAndServiceData
     */
    protected $productAndServiceData;
}
