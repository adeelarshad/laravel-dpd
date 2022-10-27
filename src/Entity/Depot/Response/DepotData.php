<?php

namespace Proxi\Dpd\Entity\Depot\Response;

use Proxi\Dpd\DataObject\DataObject;
use Proxi\Dpd\DataObject\Annotation\Accessible;

class DepotData extends DataObject
{
    /**
     * @Accessible()
     * @var string
     */
    protected $depot;

    /**
     * @Accessible()
     * @var string
     */
    protected $name;

    /**
     * @Accessible()
     * @var string
     */
    protected $street;

    /**
     * @Accessible()
     * @var string
     */
    protected $zipCode;

    /**
     * @Accessible()
     * @var string
     */
    protected $city;

    /**
     * @Accessible()
     * @var string
     */
    protected $country;

    /**
     * @Accessible()
     * @var string
     */
    protected $phone;

    /**
     * @Accessible()
     * @var string
     */
    protected $fax;
}
