<?php

namespace Proxi\Dpd\Entity\ParcelShop\Response;

use Proxi\Dpd\DataObject\DataObject;
use Proxi\Dpd\DataObject\Annotation\Accessible;

class OpeningHours extends DataObject
{
    /**
     * @Accessible()
     * @var string
     */
    protected $weekday;

    /**
     * @Accessible()
     * @var string
     */
    protected $openMorning;

    /**
     * @Accessible()
     * @var string
     */
    protected $closeMorning;

    /**
     * @Accessible()
     * @var string
     */
    protected $openAfternoon;

    /**
     * @Accessible()
     * @var string
     */
    protected $closeAfternoon;
}
