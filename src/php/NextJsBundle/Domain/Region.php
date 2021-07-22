<?php

namespace Frontastic\Catwalk\NextJsBundle\Domain;

use Frontastic\Catwalk\FrontendBundle\Domain\Region\Configuration as OriginalRegionConfiguration;
use Frontastic\Catwalk\FrontendBundle\Domain\Cell as OriginalCell;

use Kore\DataObject\DataObject;

class Region extends DataObject
{
    /**
     * @var string
     * @required
     */
    public $regionId;

    /**
     * Not in use, yet, so we remove it for now.
     *
     * @var OriginalRegionConfiguration
     * @required
     * @fixme Is that actually in use?
     */
    // public $configuration;

    /**
     * @deprecated Migrating to $layoutElements
     */
    // public $elements = [];

    /**
     * @replaces $cells
     * @var OriginalCell[]
     * @fixme Rename Cell!
     */
    public $layoutElements = [];
}
