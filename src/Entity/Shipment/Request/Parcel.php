<?php

namespace Proxi\Dpd\Entity\Shipment\Request;

use Proxi\Dpd\DataObject\DataObject;
use Proxi\Dpd\DataObject\Annotation\Accessible;

class Parcel extends DataObject
{
    /**
     * @Accessible()
     * @var string
     */
    protected $customerReferenceNumber1;

    /**
     * @Accessible()
     * @var string
     */
    protected $customerReferenceNumber2;

    /**
     * @Accessible()
     * @var string
     */
    protected $customerReferenceNumber3;

    /**
     * @Accessible()
     * @var string
     */
    protected $customerReferenceNumber4;

    /**
     * @Accessible()
     * @var int
     */
    protected $volume;

    /**
     * @Accessible()
     * @var int
     */
    protected $weight;

    /**
     * @Accessible()
     * @var boolean
     */
    protected $returns = false;
}
