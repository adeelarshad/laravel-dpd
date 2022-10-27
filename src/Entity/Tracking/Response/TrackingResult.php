<?php

namespace Proxi\Dpd\Entity\Tracking\Response;

use Proxi\Dpd\DataObject\DataObject;
use Proxi\Dpd\DataObject\Annotation\Accessible;

class TrackingResult extends DataObject
{
    /**
     * @Accessible()
     * @var ShipmentInfo
     */
    protected $shipmentInfo;

    /**
     * @Accessible()
     * @var ShipmentInfo[]
     */
    protected $statusInfo;

    /**
     * @Accessible()
     * @var Description[]
     */
    protected $contactInfo;
}
