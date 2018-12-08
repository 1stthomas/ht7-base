<?php

namespace Ht7\Base;

/**
 *
 * @author 1stthomas
 */
interface OrOptionsInterface
{

    /**
     * Add an property name to the export varible names.
     *
     * @param   string  $name   The name of the property which should be
     *                          exported.
     */
    public function addExportVar($name);

    /**
     * Return an array of property names.
     *
     * All present properties will be returned by calling one of the export
     * methods which the host of this class supports.
     *
     * @return  array       An indexed array of all properties which should be
     *                      returned by the export methods such as
     *                      <code>jsonSerialize()</code>.
     */
    public function getExportVars();

    /**
     * Set the export variables.
     *
     * All present property names will be exported by the available export
     * methods of the current instance of the host of this instance.
     *
     * @param   array   $arr    An indexed array of property names.
     */
    public function setExportVars(array $arr);
}
