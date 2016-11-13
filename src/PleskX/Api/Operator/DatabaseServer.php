<?php
// Copyright 1999-2016. Parallels IP Holdings GmbH.

namespace PleskX\Api\Operator;
use PleskX\Api\Struct\DatabaseServer as Struct;


class DatabaseServer extends \PleskX\Api\Operator
{

    protected $_wrapperTag = 'db_server';

    /**
     * @return array
     */
    public function getSupportedTypes()
    {
        $response = $this->request('get-supported-types');
        return (array)$response->type;
    }

    /**
     * @param string $field
     * @param integer|string $value
     * @return Struct\Info
     */
    public function get($field, $value)
    {
        $customers = $this->_get($field, $value);
        return reset($customers);
    }

    /**
     * @return Struct\Info[]
     */
    public function getAll()
    {
        return $this->_get();
    }

    /**
     * @param string|null $field
     * @param integer|string|null $value
     * @return Struct\Info|Struct\Info[]
     */
    private function _get($field = null, $value = null)
    {
        $packet = $this->_client->getPacket();
        $getTag = $packet->addChild('db_server')->addChild('get');

        $filterTag = $getTag->addChild('filter');
        if (!is_null($field)) {
            $filterTag->addChild($field, $value);
        }

        $response = $this->_client->request($packet, \PleskX\Api\Client::RESPONSE_FULL);

        $items = [];
        foreach ($response->xpath('//result') as $xmlResult) {
            $items[] = new Struct\Info($xmlResult->data);
        }

        return $items;
    }

}
