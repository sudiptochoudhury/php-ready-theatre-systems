<?php

namespace SudiptoChoudhury\Rts;

use GuzzleHttp\Psr7;
use Psr\Http\Message\RequestInterface;

use SudiptoChoudhury\Support\Forge\Api\Client as ApiForge;

/**
 * Class SqlApi
 *
 * @inheritdoc
 *
 * @package SudiptoChoudhury\Rts
 */
class SqlApi extends ApiForge
{

    protected $DEFAULT_API_JSON_PATH = './config/rts-sql.json';
    protected $loggerFile = __DIR__ . '/rts-sql-api-calls.log';

    protected $DEFAULTS = [
        'data_password' => 'test',
        'theatre' => '5',
        'client' => [
            'base_uri' => 'https://{{theatre}}.formovietickets.com:2235/rts.ASP',
            'decode_content' => 'gzip',
            'verify' => false,
            'headers' => [
                'Accept-Encoding' => 'gzip',
                'Content-Type' => 'application/xml',
            ],
        ],
        'settings' => [
            'responseHandler' => null,
            'requestHandler' => null,
        ],
        'log' => false,
    ];

    protected $theatre = 5;
    protected $password = 'test';

    /**
     * SqlApi constructor.
     *
     * @param array $config
     */
    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->password = $config['data_password'] ?? $config['password'] ?? 'test';
    }


    protected function requestHandler(RequestInterface $request)
    {
        $body = $request->getBody();
        $content = '' . $body->getContents();
        if (stripos($content, '[CDATA[') !== false) {
            $newContent = preg_replace('/(\<Query\>)\<\!\[CDATA\[/', "$1", $content);
            $newContent = preg_replace('/\]\]\>(\<\/Query\>)/', "$1", $newContent);
            $newBody = Psr7\stream_for($newContent);
            $request = $request->withBody($newBody);
        }
        return $request;
    }

    /**
     * @param $query   string
     * @param $options array
     *
     * @return mixed
     */
    public function query($query = '', $options = [])
    {
        $api = $this->consumer;
        $payload = ['DatabaseREQ' => ['Query' => $query], 'DataTransferPassword' => $this->password];
        $response = $api->query($payload);
        $responseArray = $response->toArray();
        $encodedString = $responseArray['Data'] ?? null;
        $decodedString = base64_decode($encodedString);

        if ($options['asString'] ?? false) {
            return $decodedString;
        }

        $data = null;
        if ($decodedString) {
            $data = simplexml_load_string($decodedString);

            if (!($options['asXML'] ?? false)) {
                $json = json_encode($data);
                $data = json_decode($json, true);

                if (!($options['asRawArray'] ?? false)) {
                    $data = $this->assocify($data);
                }
            }
        }
        return $data;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    private function assocify($data = [])
    {
        if (!empty($data)) {
            $oldData = $data;
            $fieldDefs = $oldData['Fields']['Field'];
            if (isset($fieldDefs['Name'])) {
                $fieldDefs = [$fieldDefs];
            }
            $fields = array_map(function ($item) {
                return $item['Name'] ?? null;
            }, $fieldDefs);

            $recordDefs = $oldData['Recs']['Rec'];

            if (isset($recordDefs['Value'])) {
                $recordDefs = [$recordDefs];
            }

            $data = [];
            foreach ($recordDefs as $recordDef) {
                $valuesDef = $recordDef['Value'] ?? [];
                if (!is_array($valuesDef)) {
                    $valuesDef = [$valuesDef];
                }
                $values = array_map(function ($v) {
                    if (is_array($v) && empty($v)) {
                        $v = null;
                    }
                    return $v;
                }, $valuesDef);
                $data[] = array_combine($fields, $values);
            }
        }
        return $data;
    }
}
