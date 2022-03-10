<?php

namespace Ht7\Base\Localization\Adapters;

use \Ht7\Base\Lists\Hashable;
use \Ht7\Base\Storage\Models\StorageModelable;

/**
 * Interface to be used as a translation adapter.
 *
 * @author Thomas Pluess
 */
interface Adapterable extends Hashable
{

    /**
     * Get the storage type instance.
     *
     * @return  StorageModelable                    The storage model.
     */
    public function getStorageType();

    /**
     *
     * @param   StorageModelable    $storageModel   The storage model.
     * @return  void
     */
    public function setStorageType(StorageModelable $storageModel);

    /**
     * Translate a single text.
     *
     * @param   string  $str        The text to translate.
     * @param   array   $args       Indexed array of elements which should be
     *                              inserted where placeholders are.
     * @return  string              The translated string.
     */
    public function t($str, array $args = []);

    /**
     * Translate a plural text with context.
     *
     * This method requires in minimum 2 text patterns, one for the singular and
     * the second for the plural. A context corresponding context is needed as too.
     *
     * @param   string  $str1       The text to translate in singular.
     * @param   string  $str2       The text to translate in plural.
     * @param   int     $count      The count of the target parameter.
     * @param   array   $args       Indexed array of elements which should be
     *                              inserted where placeholders are.
     * @return  string              The translated string.
     */
    public function t2($str1, $str2, $count = 1, array $args = []);
}
