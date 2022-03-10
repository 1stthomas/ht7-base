<?php

namespace Ht7\Base\Localization\Locales;

use \Ht7\Base\Localization\Language;

/**
 * Description of Locale
 *
 * @author Thomas Pluess
 */
class Locale
{

    protected $language;
    protected $locale;

    public function __construct(string $locale)
    {
        $this->locale = $locale;
        $this->language = $this->createLanguageFromLocaleString($locale);
    }

    public function createLanguageFromLocaleString(string $locale)
    {
        return new Language(substr($locale, 0, 2));
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function getLanguage()
    {
        return $this->language;
    }

}
