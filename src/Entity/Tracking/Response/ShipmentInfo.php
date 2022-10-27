<?php

namespace Proxi\Dpd\Entity\Tracking\Response;

use Proxi\Dpd\DataObject\DataObject;
use Proxi\Dpd\DataObject\Annotation\Accessible;

class ShipmentInfo extends DataObject
{
    /**
     * @Accessible()
     * @var string
     */
    protected $status;

    /**
     * @Accessible()
     * @var Phrase
     */
    protected $label;

    /**
     * @Accessible()
     * @var Description
     */
    protected $description;

    /**
     * @Accessible()
     * @var boolean
     */
    protected $statusHasBeenReached;

    /**
     * @Accessible()
     * @var boolean
     */
    protected $isCurrentStatus;

    /**
     * @Accessible()
     * @var boolean
     */
    protected $showContactInfo;

    /**
     * @Accessible()
     * @var Description
     */
    protected $serviceDescription;
}
