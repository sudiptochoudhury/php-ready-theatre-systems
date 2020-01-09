<?php


namespace SudiptoChoudhury\Rts;


class Constants
{
    public const SEAT_CODE = [
        '0' => ['name' => 'Normal'],
        '1' => ['name' => 'Handicapped'],
        '2' => ['name' => 'Aisle', 'isLayoutObject' => true], // the aisle, NOT an aisle-seat
        '3' => ['name' => 'House'],
        '4' => ['name' => 'Companion'],
        '5' => ['name' => 'Pillar', 'isLayoutObject' => true],
        '6' => ['name' => 'Table', 'isLayoutObject' => true],
        '7' => ['name' => 'Beanbag'],
        '8' => ['name' => 'Loveseat'],
        '9' => ['name' => 'Rocker'],
        '10' => ['name' => 'Recliner'],
    ];
    public const FILM_INFO1 = [
        '1' => 'RTN Display',
        '2' => 'RTN Sell',
        '4' => 'Kiosk Display',
        '8' => 'No Passes',
        '16' => 'Dolby Digital',
        '32' => 'THX',
        '64' => 'DLP',
        '128' => 'Dubbed in English',
        '256' => 'Subtitled in English',
        '512' => 'DTS',
        '1024' => 'No Discounts',
        '2048' => 'Stadium Seating',
        '4096' => '3D',
        '8192' => '16MM',
        '16384' => '35MM',
    ];

    public const FILM_INFO2 = [
        '1' => 'Movietickets.com Display',
        '2' => 'Movietickets.com Sell',
        '4' => 'Rentrak Transfer',
        '8' => 'IMAX',
        '16' => 'Flat',
        '32' => 'Digital',
        '64' => 'Descriptive Video Service',
        '128' => 'Subtitled in French',
        '256' => 'Dubbed in French',
        '512' => 'French Language Film',
        '1024' => '70MM',
        '2048' => 'Open Caption',
        '4096' => 'Closed Caption',
        '8192' => 'Special Advanced Screening',
        '16384' => 'Adults Only',

    ];

    public const FILM_INFO3 = [
        '1' => 'Sign Display',
        '2' => 'NOT USED',
        '4' => 'NOT USED',
        '8' => 'Directors Hall',
        '16' => 'RWC',
        '32' => 'Reserved Seating',
        '64' => 'Gallery',
        '128' => 'Lux Level',
        '256' => 'Premier',
        '512' => 'Cine Capri',
        '1024' => 'Cine Art',
        '2048' => 'Showcase Art',
        '4096' => 'Surround Sound',
        '8192' => 'Scope',
        '16384' => 'DBOX',
        '32768' => 'PLF',
        '65536' => 'Dolby Atmos',
        '131072' => 'RealD 3D',
        '262144' => 'Sony 4K',
        '524288' => 'DTSX',
        '1048576' => 'Auro 3D',
        '2097152' => 'Fedelio',
        '4194304' => 'Captiview',
        '8388608' => 'Audio Description',
        '16777216' => 'Hearing Impaired Track',
        '33554432' => 'Sensory Show',

    ];

    public const FILM_INFO4 = [
        '1' => 'Reserved',
    ];

    public const ERROR_CODE = [
        '100' => 'No data packet was decrypted (possible encryption error)',
        '101' => 'No Payment nodes specified',
        '102' => 'Gift request received, but user does not have rights to sell gifts cards',
        '103' => 'Films request received, but user does not have rights to sell tickets',
        '104' => 'No films, gifts, or items in request',
        '106' => 'Invalid PerformanceID format',
        '107' => 'Could not find film for PerformanceID',
        '108' => 'No tickets for film in request',
        '110' => 'Auditorium is oversold',
        '111' => 'Charge amount does not match calculated amount by POS',
        '113' => 'Bad username or password',
        '114' => 'No gift card prefixes are configured',
        '115' => 'No gift purchase amount in request',
        '116' => 'POS could not allocate gift certificate number',
        '117' => 'Can\'t add points to a non registered card',
        '118' => 'Invalid gift card number',
        '119' => 'Unable to create HostedCheckout PaymentId',
        '120' => 'Invalid ProcessCompletePostData Format',
        '121' => 'Invalid HostedCheckout Processor',
        '122' => 'HostedCheckout Transaction Expired',
        '123' => 'MPS Payment Not Valid',
        '124' => 'HostedCheckout Purchase Failed',
        '125' => 'Invalid HostedCheckout PaymentId',
        '126' => 'Multiple Payment Validations Error',
        '127' => 'Charge Amount is Neg',
        '128' => 'Ticket fee item not configured',
        '129' => 'Extra fee item not configured',
        '130' => 'Adjust item not configured',
        '131' => 'Unknown Ticket Class In Request',
        '132' => 'Ticket class in not enabled for internet ticketing',
        '133' => 'Zero Priced Ticket in Request',
        '134' => 'Payments are specified during check sales tax request',
        '135' => 'No PickupNumber specified',
        '136' => 'Refund, Reverse, or Redeem error',
        '137' => 'Performance is no longer scheduled',
        '138' => 'Non-secure payment on tokenized account',
        '139' => 'Ticket not available for performance',
        '140' => 'Reserved ticket purchase error',
        '140' => 'Reserved ticket purchase error',
        '141' => 'Transaction does not balance error',
        '142' => 'Reserved ticket purchase error',
        '143' => 'Malformed gift purchase packet',
        '144' => 'Unable to validate GiftCardPIN',

        '500' => 'POS could not allocate cash register control (possibly server too busy)',
        '700' => 'Unknown error during sale',
        '701' => 'Not enough money on gift card',
        '702' => 'Invalid credit card number/expiration, or card declined',
        '703' => 'Invalid performance',
        '704' => 'Ticket type is disabled',
        '705' => 'Ticket serial number file is invalid',
        '706' => 'Concession item not setup – check ticket/concession link items',
        '707' => 'Reserved seat sale failed – check the seating chart',

        '5000' => 'Exception Error',
        '9000' => 'POS Not Licensed',
        '9001' => 'Packet Parse Error',

    ];

    /**
     * @param array $movie
     *
     * @return array
     */
    private static function getInfo($movie = [])
    {
        $info = [];
        $info[] = $movie['Info1'] ?? '';
        $info[] = $movie['Info2'] ?? '';
        $info[] = $movie['Info3'] ?? '';
        $info[] = $movie['Info4'] ?? '';
        return $info;
    }

    private static function getInfoDefs($isFlipped = false)
    {
        $infos = [];
        $infos[] = Constants::FILM_INFO1;
        $infos[] = Constants::FILM_INFO2;
        $infos[] = Constants::FILM_INFO3;
        $infos[] = Constants::FILM_INFO4;

        if ($isFlipped) {
            $infos = array_map(function ($item) {
                return array_flip($item);
            }, $infos);
        }
        return $infos;
    }

    public static function probe($movie = [])
    {
        $those = [];
        $movieInfos = self::getInfo($movie);
        $infos = self::getInfoDefs();

        foreach ($infos as $key => $info) {
            $movieInfo = $movieInfos[$key] ?? null;
            if ($movieInfo) {
                foreach ($info as $bit => $name) {
                    if (!!($movieInfo & $bit)) {
                        $those[] = $name;
                    }
                }
            }
        }
        return $those;
    }

    public static function isIt($that = '', $movie = [])
    {
        $those = self::probe($movie);
        return $that && in_array($that, $those);
    }

    public static function getMessage($code = '')
    {
        return self::ERROR_CODE[$code] ?? null;
    }
}