<?php

class DesktopAdmin extends \Phalcon\Mvc\Model
{
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource() {
        return 'desktop_admin';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     *
     * @return Modes[]|Modes|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null) {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     *
     * @return Modes|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null) {
        return parent::findFirst($parameters);
    }
}
