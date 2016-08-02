<?php
namespace Db;

/**
 * Db工厂数据类
 *
 * @author  zxcvdavid@gmail.com
 *
 */


class Factory {

    static public function create($which = 'master') {

        $db_config = \Yaf\Registry::get('config')->database;

        $class_name = '\Db\\' . ucfirst(strtolower( $db_config->driver ) );

        $db = $class_name::getInstance( $db_config );

        return ($db instanceof DbInterface) ? $db : false;

    }

}