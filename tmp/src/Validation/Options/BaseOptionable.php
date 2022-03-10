<?php

namespace Ht7\Base\Validation\Options;

/**
 * This interface describes the required methods for a validator option class.
 *
 * @author      Thomas Pluess
 * @version     0.0.1
 * @since       0.0.1
 */
interface BaseOptionable
{

    /**
     * Get the flag "is merged".
     *
     * @return  bool                    If true the ...
     */
    public function getIsMerged();

    /**
     * Get the flag "stop on fail".
     *
     * @return  bool                    If true the validation will stop after
     *                                  the occurance of the first invalid check.
     */
    public function getStopOnFail();

    /**
     * Set the flag "is merged".
     *
     * @param   bool    $isMerged       If true the list items will be merged
     *                                  with the default definitions.
     * @return  void
     */
    public function setIsMerged($isMerged);

    /**
     * Set the flag "stop on fail".
     *
     * @param   bool    $stopOnFail     If true the validation will stop after
     *                                  the occurance of the first invalid check.
     * @return  void
     */
    public function setStopOnFail($stopOnFail);
}
