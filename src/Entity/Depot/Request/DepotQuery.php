<?php

namespace Proxi\Dpd\Entity\Depot\Request;

use Proxi\Dpd\DataObject\DataObject;
use Proxi\Dpd\DataObject\Annotation\Accessible;
use Proxi\Dpd\DataObject\Annotation\Required;

class DepotQuery extends DataObject
{
    /**
     * @Accessible()
     * @Required()
     * @var string
     */
    protected $depot;

    /**
     * @Accessible()
     * @var string
     */
    protected $zipCode;

    /**
     * @Accessible()
     * @var string
     */
    protected $country;
}
