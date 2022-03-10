<?php

namespace Ht7\Base\Localization;

use \Ht7\Base\Localization\Adapters\Adapterable;
use \Ht7\Base\Localization\Adapters\AdapterList;

//use \Ht7\Base\Localization\Adapters\;

/**
 * This class tries to find a registered translation adapter. If there can not
 * be found one, the function <code>sprintf()</code> will be used to combine the
 * several text parts.
 *
 * @author Thomas Plüss
 */
class Translator
{

    /**
     * The object which defines the mapping for the translation methods.
     *
     * @var AdapterList
     */
    protected $adapterList;

    public function __construct(array $adapters = [], array $options = [])
    {
        // Initialize the adapter list with the default adapters.
        $this->createAdapterList();
        // Override existing and add new ones.
        $this->getAdapterList()->load($adapters);
    }

    /**
     * Create an adapter list with the default adapters.
     */
    public function createAdapterList()
    {
        $adapters = [
            'default' => ''
        ];

        $this->adapterList = new AdapterList($adapters);
    }

    /**
     * Get the current translation adapter.
     *
     * In case this property was not set, an instance of this class will be returned.
     *
     * @return AdapterList
     */
    public function getAdapterList()
    {
        return $this->adapterList;
    }

    /**
     * Translate a given text pattern with placeholders into a full text.
     * This method supports only singular forms.
     *
     * @param   string  $str            For simple and context translation types
     *                                  there is only one text pattern needed.
     * @param   array   $parameters
     * @param   string  $context        The context of the translation. This is
     *                                  only needed for contextual translations.
     * @return  string                  The translated string.
     */
    public static function t($str, array $parameters = [], $context = '')
    {
        if (empty($context)) {
            $adapter = $this->getAdapterList()->get('default');
        } else {
            $adapter = $this->getAdapterList()->get($context);
        }

        return $adapter->t($str, $parameters);
    }

    /**
     *
     * @param   string      $str1       Singular string to translate.
     * @param   string      $str2       Plural string to translate.
     * @param   array       $parameters
     * @param   string      $context    The context of the translation. This is
     *                                  only needed for contextual translations.
     * @return  string                  The translated string.
     */
    public static function t2($str1, $str2, $count, array $parameters = [], $context = '')
    {
        $adapter = static::getAdapter();

        if (empty($context)) {
            $return = $adapter->t2($str1, $str2, $count, $parameters);
        } else {
            $return = $adapter->t4($context, $str1, $str2, $count, $parameters);
        }

        return $return;
    }

}
