<?php

namespace Proxi\Dpd\Entity\Shipment\Request;

use Proxi\Dpd\DataObject\DataObject;
use Proxi\Dpd\DataObject\Annotation\Accessible;

class GeneralShipmentData extends DataObject
{
    /**
     * @Accessible()
     * @var string
     */
    protected $mpsId;

    /**
     * @Accessible()
     * @var string
     */
    protected $cUser;

    /**
     * @Accessible()
     * @var string
     */
    protected $mpsCustomerReferenceNumber1;

    /**
     * @Accessible()
     * @var string
     */
    protected $mpsCustomerReferenceNumber2;

    /**
     * @Accessible()
     * @var string
     */
    protected $mpsCustomerReferenceNumber3;

    /**
     * @Accessible()
     * @var string
     */
    protected $mpsCustomerReferenceNumber4;

    /**
     * @Accessible()
     * @var string
     */
    protected $identificationNumber;

    /**
     * @Accessible()
     * @var string
     */
    protected $sendingDepot;

    /**
     * @Accessible()
     * @var string
     */
    protected $product;

    /**
     * @Accessible()
     * @var Address
     */
    protected $sender;

    /**
     * @Accessible()
     * @var Address
     */
    protected $recipient;
}
