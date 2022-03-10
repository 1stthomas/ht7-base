<?php

namespace Ht7\Base\Validation\Options;

use \Ht7\Base\Models\AbstractLoadableModel;
use \Ht7\Base\Validation\Options\BaseOptionable;

/**
 * Base validation option class. This class is a model of all base validation
 * options.
 *
 * @author Thomas Pluess
 */
class BaseOptions extends AbstractLoadableModel implements BaseOptionable
{

    /**
     * @var     boolean
     */
    protected $isMerged = true;

    /**
     * @var     boolean
     */
    protected $stopOnFail = false;

    /**
     * {@inheritdoc}
     */
    public function getIsMerged()
    {
        return $this->isMerged;
    }

    /**
     * {@inheritdoc}
     */
    public function getStopOnFail()
    {
        return $this->stopOnFail;
    }

    /**
     * {@inheritdoc}
     */
    public function setIsMerged($isMerged)
    {
        $this->isMerged = $isMerged ? true : false;
    }

    /**
     * {@inheritdoc}
     */
    public function setStopOnFail($stopOnFail)
    {
        $this->stopOnFail = $stopOnFail ? true : false;
    }

}
