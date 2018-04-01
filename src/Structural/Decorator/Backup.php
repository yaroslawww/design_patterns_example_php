<?php

namespace DesignPatterns\Structural\Decorator;


use ZipArchive;

class Backup implements BackupInterface
{

    protected $backup_path;
    protected $backup_name;
    protected $zip_file_path;

    public function __construct($backup_path, $backup_name)
    {
        $this->backup_path = $backup_path;
        $this->backup_name = $backup_name;
    }

    public function make()
    {
        $this->zip_file_path = $this->backup_path . '/../' . $this->backup_name;
        if(file_exists($this->zip_file_path)) {
            unlink($this->zip_file_path);
        }

        $path_info = pathInfo($this->backup_path);
        $parent_path = $path_info['dirname'];
        $dir_name = $path_info['basename'];

        $z = new ZipArchive();
        $z->open($this->zip_file_path, ZIPARCHIVE::CREATE);
        $z->addEmptyDir($dir_name);
        self::folderToZip($this->backup_path, $z, strlen("$parent_path/"));
        $z->close();
    }

    /**
     * @return Backup
     */
    public function getBackupObject()
    {
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBackupPath()
    {
        return $this->backup_path;
    }

    /**
     * @return string|null
     */
    public function getBackupName()
    {
        return $this->backup_name;
    }

    /**
     * @return string|null
     */
    public function getZipFilePath()
    {
        return $this->zip_file_path;
    }

    /**
     * Helper function convert folder to zip file
     *
     * @param $folder
     * @param $zipFile
     * @param $exclusiveLength
     */
    private static function folderToZip($folder, &$zipFile, $exclusiveLength) {
        $handle = opendir($folder);
        while (false !== $f = readdir($handle)) {
            if ($f != '.' && $f != '..') {
                $filePath = "$folder/$f";
                // Remove prefix from file path before add to zip.
                $localPath = substr($filePath, $exclusiveLength);
                if (is_file($filePath)) {
                    $zipFile->addFile($filePath, $localPath);
                } elseif (is_dir($filePath)) {
                    // Add sub-directory.
                    $zipFile->addEmptyDir($localPath);
                    self::folderToZip($filePath, $zipFile, $exclusiveLength);
                }
            }
        }
        closedir($handle);
    }

}