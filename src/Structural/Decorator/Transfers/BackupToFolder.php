<?php

namespace DesignPatterns\Structural\Decorator\Transfers;


use DesignPatterns\Structural\Decorator\AbstractDecorator;

class BackupToFolder extends AbstractDecorator
{

    /**
     * @throws \Exception
     */
    public function make()
    {
        $this->backup->make();

        $this->backup_object = $this->backup->getBackupObject();

        if (isset($this->data['path'])) {
            if (!file_exists($this->data['path'])) {
                mkdir($this->data['path'], 0777, true);
            }
            if (!copy(
                $this->backup_object->getZipFilePath(),
                $this->data['path'] . '/' . $this->backup_object->getBackupName()
            )) {
                throw new \Exception("Failed to copy " . $this->backup_object->getZipFilePath() . "...\n");
            }
            if(isset($this->data['remove']) && $this->data['remove']) {
                unlink($this->backup_object->getZipFilePath());
            }
        }
    }
}