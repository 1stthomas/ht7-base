<?php

namespace Ht7\Base\Messages\Options;

use \Ht7\Base\Messages\Translators\Translatorable;

/**
 *
 * @author Thomas Pluess
 */
interface Optionable
{

    /**
     * Get the default values.
     *
     * @return  array                       Assoc array with the variable name
     *                                      as key and the variable value as
     *                                      array item value.
     */
    public function getDefaults();

    /**
     * Get the option class definition.
     *
     * @return  string                      The option class definition.
     */
    public function getOptionsClass();

    /**
     * Get the pattern class definition.
     *
     * @return  string                      The pattern class definition.
     */
    public function getPatternsClass();

    /**
     * Get the translator instance.
     *
     * @return  Translatorable              The translator instance.
     */
    public function getTranslator();

    /**
     * Get the message type.
     *
     * @return  integer                     The message type.
     */
    public function getType();

    /**
     * Get the message type class definition.
     *
     * @return  string                      The message type class definition.
     */
    public function getTypeClass();

    /**
     * Set the option class definition.
     *
     * @param   string  $optionsClass       The option class definition.
     */
    public function setOptionsClass(string $optionsClass);

    /**
     * Set the pattern class definition.
     *
     * @param   string  $patternsClass      The pattern class definition.
     */
    public function setPatternsClass(string $patternsClass);

    /**
     * Set the translator instance.
     *
     * @param   string  $translator         The translator instance.
     */
    public function setTranslator($translator);

    /**
     * Set the message type.
     *
     * @param   int     $type               The message type. Take one of the
     *                                      constants defined in <code>Ht7\Base\Messages\MessageTypes</code>.
     */
    public function setType(int $type);

    /**
     * Set the type class definition.
     *
     * @param   string  $typeClass          The type class definition.
     */
    public function setTypeClass(string $typeClass);
}
