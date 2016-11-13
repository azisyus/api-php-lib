<?php
// Copyright 1999-2016. Parallels IP Holdings GmbH.

namespace PleskX\Api\Struct\DatabaseServer;

class Info extends \PleskX\Api\Struct
{
    /** @var integer */
    public $id;

    /** @var string */
    public $host;

    /** @var integer */
    public $port;

    /** @var string */
    public $type;

    public function __construct($apiResponse)
    {
        $this->_initScalarProperties($apiResponse, [
            'id',
            'host',
            'port',
            'type',
        ]);
    }
}