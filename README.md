# DPD Integration Service PHP Bindings

PHP Library to use DPD Integration Services.

## Implementation status

| Service                                               | Status                    |
| ----------------------------------------------------- | ------------------------- |
| Login Service                                         | alpha                     |
| Parcel Shop Finder Service                            | alpha                     |
| Shipment Service                                      | alpha                     |
| Depot Data Service                                    | alpha                     |
| Parcel LifeCycle Service                              | alpha                     |

## Install instructions

```
composer require proxi/proxi/laravel-dpd
```

## Example

### Create Shipment Label

```
$delisId = 'YOUR_DELIS_ID'
$password = 'YOUR_PASSWORD';
$messageLanguage = 'en_EN';
$staging = true;

$cachedToken = null; // or load from storage

// API Init
$dpd = new \Proxi\Dpd\Api($delisId, $password, $messageLanguage, $cachedToken, $staging);

$printOptions = \Proxi\Dpd\Entity\Shipment\Request\PrintOptions::fromDataArray([
        'paperFormat' => 'A6'
]);

$order = \Proxi\Dpd\Entity\Shipment\Request\Order::fromDataArray([
        'generalShipmentData' => [
            'sendingDepot' => '0522',
            'product' => 'CL',
            'sender' => [
                'name1' => 'CustomerIT',
                'street' => 'Tormentil',
                'houseNo' => '10',
                'country' => 'NL',
                'zipCode' => '5684PK',
                'city' => 'Best'
            ],
            'recipient' => [
                'name1' => 'Receiver',
                'street' => 'streetname',
                'houseNo' => '123',
                'country' => 'NL',
                'zipCode' => '5684PK',
                'city' => 'Best'
            ],
        ],
        'parcels' => [
            'customerReferenceNumber1' => 'CustRef1',
            'weight' => 360
        ],
        'productAndServiceData' => [
            'orderType' => 'consignment'
        ]
]);

// Create Label call
$orderResult = $dpd->storeOrders($printOptions, $order);

$trackingNumber = $orderResult
    ->getShipmentResponses()
    ->getParcelInformation()
    ->getParcelLabelNumber();

$labelBinary = $orderResult->getParcellabelsPDF();

file_put_contents($trackingNumber . '.pdf', $labelBinary);
```
