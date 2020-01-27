<?php

namespace Ht7\Base\Localization;

use \Ht7\Base\Enum;

/**
 * Definition of the supported translation types.
 *
 * @author Thomas Pluess
 */
class TranslationTypes extends Enum
{

    /**
     * This is for a simple translation, without context or further plural forms.
     */
    const TRANSLATION_TYPE_SIMPLE = 1;

    /**
     * This is a translation by context, to be able to use same texts for several
     * different translations.
     */
    const TRANSLATION_TYPE_CONTEXT = 2;

    /**
     * This kind needs in minimum 2 text patterns, one for the singular and the
     * second for the plural.
     */
    const TRANSLATION_TYPE_PLURAL = 3;

}
