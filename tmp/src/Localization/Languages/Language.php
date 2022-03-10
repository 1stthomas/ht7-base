<?php

namespace Ht7\Base\Localization\Languages;

/**
 * Description of Locale
 *
 * @author Thomas Pluess
 */
class Language
{

    protected $language;

    public function __construct(string $language)
    {
        $this->language = $language;
    }

}
