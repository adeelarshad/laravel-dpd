<?php

namespace Proxi\Dpd\Entity\Shipment\Response;

use Proxi\Dpd\DataObject\DataObject;
use Proxi\Dpd\DataObject\Annotation\Accessible;

class OrderResult extends DataObject
{
    /**
     * @Accessible()
     */
    protected $parcellabelsPDF;

    /**
     * @Accessible()
     * @var ShipmentResponse
     */
    protected $shipmentResponses;
}
