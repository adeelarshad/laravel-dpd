<?php

namespace Proxi\Dpd;

use Proxi\Dpd\Entity\Token;
use Proxi\Dpd\Entity\Shipment\Request\PrintOptions;
use Proxi\Dpd\Entity\ParcelShop\Request\GeoData;
use Proxi\Dpd\Entity\ParcelShop\Response\ParcelShop;
use Proxi\Dpd\Entity\Shipment\Request\Order;
use Proxi\Dpd\Entity\Shipment\Response\OrderResult;
use Proxi\Dpd\Entity\Depot\Request\DepotQuery;
use Proxi\Dpd\Entity\Depot\Response\DepotData;
use Proxi\Dpd\Entity\Tracking\Response\TrackingResult;
use Proxi\Dpd\Exception\ApiException;

class Api
{
    const BASE_URL = 'https://wsshipper.dpd.nl/';
    const BASE_URL_STAGING = 'https://public-dis-stage.dpd.nl/';
    const LOGIN_SERVICE = 'soap/WSDL/LoginServiceV20.wsdl';
    const LOGIN_SERVICE_STAGING = 'Services/LoginService.svc?singlewsdl';
    const SHIPMENT_SERVICE = 'soap/WSDL/ShipmentServiceV33.wsdl';
    const SHIPMENT_SERVICE_STAGING = 'Services/ShipmentService.svc?singlewsdl';
    const DEPOTDATA_SERVICE = 'Services/DepotDataService.svc?singlewsdl';
    const PARCELSHOP_FINDER_SERVICE = 'Services/ParcelShopFinderService.svc?singlewsdl';
    const PARCELSHOP_LIFECYCLE_SERVICE = 'Services/ParcelLifeCycleService.svc?singlewsdl';

    const SOAPHEADER_NS = 'http://dpd.com/common/service/types/Authentication/2.0';

    const TOKEN_EXPIRATION = 24 * 60 * 60; // 24h

    /**
     * @var string
     */
    protected $delisId;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $messageLanguage;

    /**
     * @var Token
     */
    protected $token;

    /**
     * @var boolean
     */
    protected $staging;

    /**
     * @var boolean
     */
    protected $isTokenChanged = false;

    /**
     * @var string
     */
    protected $customerUid;

    /**
     * @var string
     */
    protected $depot;

    public function __construct(
        $delisId,
        $password,
        $messageLanguage = 'en_EN',
        Token $token = null,
        $staging = false
    ) {
        $this->delisId = $delisId;
        $this->password = $password;
        $this->messageLanguage = $messageLanguage;
        $this->token = $token;
        $this->staging = $staging;

        $this->authenticate(); // refresh token if expired
    }

    protected function isTokenValid()
    {
        return $this->token && ($this->token->getAuthTokenExpiration() - 10 * 60 > time()); // offset 10 minutes
    }

    protected function getSoapUrl($path)
    {
        return ($this->staging ? self::BASE_URL_STAGING : self::BASE_URL) . $path;
    }

    protected function getSoapService($path, $setAuthHeader = true)
    {
        $client = new \SoapClient($this->getSoapUrl($path), [
            'cache_wsdl' => WSDL_CACHE_NONE,
            'trace' => 1
        ]);

        if ($setAuthHeader) {
            $header = new \SoapHeader(self::SOAPHEADER_NS, 'authentication', [
                'delisId' => $this->delisId,
                'authToken' => $this->token->getAuthToken(),
                'messageLanguage' => $this->messageLanguage
            ]);
            $client->__setSoapHeaders($header);
        }

        return $client;
    }

    protected function getLoginService()
    {
        return $this->getSoapService($this->staging ? self::LOGIN_SERVICE_STAGING : self::LOGIN_SERVICE, false);
    }

    protected function getParcelShopFinderService()
    {
        return $this->getSoapService(self::PARCELSHOP_FINDER_SERVICE);
    }

    protected function getShipmentService()
    {
        return $this->getSoapService($this->staging ? self::SHIPMENT_SERVICE_STAGING : self::SHIPMENT_SERVICE);
    }

    protected function getDepotDataService()
    {
        return $this->getSoapService(self::DEPOTDATA_SERVICE);
    }

    protected function getParcelLifeCycleService()
    {
        return $this->getSoapService(self::PARCELSHOP_LIFECYCLE_SERVICE);
    }

    protected function checkFault($fault, $client)
    {
        if (isset($fault->detail->authenticationFault)) {
            $code = $fault->detail->authenticationFault->errorCode;
            $message = $fault->detail->authenticationFault->errorMessage;
        } elseif (isset($fault->detail->faultCodeType)) {
            $code = $fault->detail->faultCodeType->faultCodeField;
            $message = $fault->detail->faultCodeType->messageField;
        } else {
            throw new ApiException("Unknown Fault", $client, $fault);
        }
        throw new ApiException("$code - $message", $client);
    }

    protected function authenticate()
    {
        if (!$this->isTokenValid()) {
            $client = $this->getLoginService();

            try {
                $response = $client->getAuth([
                    'delisId' => $this->delisId,
                    'password' => $this->password,
                    'messageLanguage' => $this->messageLanguage
                ]);

                $this->customerUid = $response->return->customerUid;
                $this->depot = $response->return->depot;
                $this->token = Token::fromDataArray([
                    'authToken' => $response->return->authToken,
                    'authTokenExpiration' => time() + self::TOKEN_EXPIRATION
                ]);

                $this->isTokenChanged = true;
            } catch (\SoapFault $e) {
                $this->checkFault($e, $client);
            }
        }
    }

    /**
     *
     * @return Token|null
     */
    public function getNewToken()
    {
        return $this->isTokenChanged ? $this->token : null;
    }

    /**
     *
     * @param GeoData $geoData
     *
     * @return array
     */
    public function findParcelShopsByGeoData(GeoData $geoData)
    {
        $client = $this->getParcelShopFinderService();

        try {
            $response = $client->findParcelShopsByGeoData($geoData->toDataArray());

            $shops = array();

            foreach ($response->parcelShop as $parcelShop) {
                $shop = ParcelShop::fromStdClass($parcelShop);
                $shops[] = $shop;
            }

            return $shops;
        } catch (\SoapFault $e) {
            $this->checkFault($e, $client);
        }
    }

    /**
     *
     * @param PrintOptions $printOptions
     * @param Order $order
     *
     * @return OrderResult
     */
    public function storeOrders(PrintOptions $printOptions, Order $order)
    {
        $client = $this->getShipmentService();

        try {
            $response = $client->storeOrders([
                'printOptions' => $printOptions->toDataArray(),
                'order' => $order->toDataArray()
            ]);

            return OrderResult::fromStdClass($response->orderResult);
        } catch (\SoapFault $e) {
            $this->checkFault($e, $client);
        }
    }

    /**
     *
     * @param DepotQuery $depotQuery
     *
     * @return DepotData
     */
    public function getDepotData(DepotQuery $depotQuery)
    {
        $client = $this->getDepotDataService();

        try {
            $response = $client->getDepotData($depotQuery->toDataArray());

            return DepotData::fromStdClass($response->DepotData);
        } catch (\SoapFault $e) {
            $this->checkFault($e, $client);
        }
    }

    /**
     *
     * @param string $parcelLabelNumber
     *
     * @return TrackingResult
     */
    public function getTrackingData($parcelLabelNumber)
    {
        $client = $this->getParcelLifeCycleService();

        try {
            $response = $client->getTrackingData([
                'parcelLabelNumber' => $parcelLabelNumber,
            ]);

            return TrackingResult::fromStdClass($response->TrackingResult);
        } catch (\SoapFault $e) {
            $this->checkFault($e, $client);
        }
    }
}
