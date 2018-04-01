<?php

namespace Tests\DesignPatterns\Structural;


use DesignPatterns\Structural\Decorator\Backup;
use DesignPatterns\Structural\Decorator\Transfers\BackupByFtp;
use DesignPatterns\Structural\Decorator\Transfers\BackupToFolder;
use PHPUnit\Framework\TestCase;

class DecoratorTest extends TestCase
{

    protected $path_to_backup;

    public function __construct(string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->path_to_backup = __DIR__ . '/../../../temp/folder_to_backup';
        if (!file_exists($this->path_to_backup)) {
            mkdir($this->path_to_backup, 0777, true);
        }

        $file_path = $this->path_to_backup . '/file1.txt';
        if (!file_exists($file_path)) {
            $person = "Some content for file 1\n";
            file_put_contents($file_path, $person, FILE_APPEND | LOCK_EX);
        }

        $file_path = $this->path_to_backup . '/file2.txt';
        if (!file_exists($file_path)) {
            $person = "Some content for file 2\n";
            file_put_contents($file_path, $person, FILE_APPEND | LOCK_EX);
        }

    }

    public function testBackup()
    {
        $file_name = 'simple_backup.zip';
        $backup = new Backup($this->path_to_backup, $file_name);
        $backup->make();

        $this->assertFileExists($this->path_to_backup . '/../' . $file_name);
    }

    public function testBackupToFolder()
    {
        $file_name = 'to_folder_backup.zip';
        $save_backup_folder = $this->path_to_backup . '/../save_to';
        $backup = new BackupToFolder(new Backup($this->path_to_backup, $file_name), ['path' => $save_backup_folder, 'remove' => true]);
        $backup->make();

        $this->assertFileExists($save_backup_folder . '/' . $file_name);
        $this->assertFileNotExists($this->path_to_backup . '/../' . $file_name);

    }


    public function testBackupToTwoFolder()
    {
        $file_name = 'to_folder_backup2.zip';
        $save_backup_folder_1 = $this->path_to_backup . '/../save_to_2/1';
        $save_backup_folder_2 = $this->path_to_backup . '/../save_to_2/2';
        $backup = new BackupToFolder(
            new BackupToFolder(
                new Backup(
                    $this->path_to_backup,
                    $file_name
                ),
                ['path' => $save_backup_folder_1]
            ),
            ['path' => $save_backup_folder_2, 'remove' => true]
        );
        $backup->make();

        $this->assertFileExists($save_backup_folder_1 . '/' . $file_name);
        $this->assertFileExists($save_backup_folder_2 . '/' . $file_name);
        $this->assertFileNotExists($this->path_to_backup . '/../' . $file_name);

    }


}