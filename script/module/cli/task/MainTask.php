<?php
/**
 * Created by PhpStorm.
 * User: cwei
 * Date: 2019-03-20
 * Time: 16:53
 */

namespace Script\Module\Cli\Task;

class MainTask extends \Phalcon\Cli\Task
{
    public function mainAction() {
        $this->logger->log("This is a message");
    }

}