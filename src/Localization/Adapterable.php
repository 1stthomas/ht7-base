<?php

namespace Ht7\Base\Localization;

/**
 * Interface to be used as a translation adapter.
 *
 * @author Thomas Pluess
 */
interface Adapterable
{

    /**
     * Translate a singular text.
     *
     * This is for a simple translation, without context or further plural forms
     *
     * @param   string  $str        The text to translate.
     * @param   array   $args       Indexed array of elements which should be
     *                              inserted where placeholders are.
     * @return  string              The translated string.
     */
    public function t1($str, array $args = []);

    /**
     * Translate a plural text.
     *
     * This kind needs in minimum 2 text patterns, one for the singular and the
     * second for the plural.
     *
     * @param   string  $str1       The text to translate in singular.
     * @param   string  $str2       The text to translate in plural.
     * @param   array   $args       Indexed array of elements which should be
     *                              inserted where placeholders are.
     * @return  string              The translated string.
     */
    public function t2($str1, $str2, $count = 1, array $args = []);

    /**
     * Translate a singular text with context.
     *
     * This is a translation by context, to be able to use same texts for several
     * different translations.
     *
     * @param   string  $context    The translation context.
     * @param   string  $str        The text to translate.
     * @param   array   $args       Indexed array of elements which should be
     *                              inserted where placeholders are.
     * @return  string              The translated string.
     */
    public function t3($context, $str, array $args = []);

    /**
     * Translate a plural text with context.
     *
     * This method requires in minimum 2 text patterns, one for the singular and
     * the second for the plural. A context corresponding context is needed as too.
     *
     * @param   string  $context    The translation context.
     * @param   string  $str1       The text to translate in singular.
     * @param   string  $str2       The text to translate in plural.
     * @param   array   $args       Indexed array of elements which should be
     *                              inserted where placeholders are.
     * @return  string              The translated string.
     */
    public function t4($context, $str1, $str2, $count = 1, array $args = []);
}
