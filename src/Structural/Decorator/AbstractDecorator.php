<?php

namespace DesignPatterns\Structural\Decorator;


abstract class AbstractDecorator implements BackupInterface
{

    protected $backup;
    protected $backup_object;
    protected $data;

    public function __construct(BackupInterface $backup, array $data)
    {
        $this->backup = $backup;
        $this->data = $data;
    }

    abstract public function make();

    /**
     * @return Backup
     */
    public function getBackupObject()
    {
        return $this->backup_object;
    }

}