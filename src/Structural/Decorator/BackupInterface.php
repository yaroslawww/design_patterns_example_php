<?php

namespace DesignPatterns\Structural\Decorator;


interface BackupInterface
{

    public function make();

    /**
     * @return Backup
     */
    public function getBackupObject();

}