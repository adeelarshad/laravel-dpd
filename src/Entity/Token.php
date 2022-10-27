<?php

namespace Proxi\Dpd\Entity;

use Proxi\Dpd\DataObject\DataObject;
use Proxi\Dpd\DataObject\Annotation\Accessible;

class Token extends DataObject
{
    /**
     * @Accessible()
     * @var string
     */
    protected $authToken;

    /**
     * @Accessible()
     * @var integer
     */
    protected $authTokenExpiration;
}
