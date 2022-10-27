<?php

namespace Proxi\Dpd\Entity\ParcelShop\Request;

use Proxi\Dpd\DataObject\DataObject;
use Proxi\Dpd\DataObject\Annotation\Accessible;

class GeoData extends DataObject
{
    /**
     * @Accessible()
     * @var string
     */
    protected $availabilityDate;

    /**
     * @Accessible()
     * @var boolean
     */
    protected $consigneePickupAllowed;

    /**
     * @Accessible()
     * @var string
     */
    protected $countryISO;

    /**
     * @Accessible()
     * @var float
     */
    protected $latitude;

    /**
     * @Accessible()
     * @var float
     */
    protected $longitude;


    /**
     * @Accessible()
     * @var boolean
     */
    protected $prepaidAllowed;

    /**
     * @Accessible()
     * @var boolean
     */
    protected $returnAllowed;

    /**
     * @Accessible()
     * @var integer
     */
    protected $limit;
}
