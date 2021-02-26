<?php


namespace Taskforce\Helpers\CSV;


use SplFileObject;

class CSVConverter
{
    private object $source;
    private object $target;
    private string $targetFileName;
    private string $tableName;

    public function __construct(string $sourceFileName, string $targetFileName, string $tableName)
    {
        $this->source = new SplFileObject($sourceFileName, 'r');
        $this->targetFileName = $targetFileName;
        $this->tableName = $tableName;
    }

    private function createTargetFileIfNotExist(): void
    {
        if (!is_file($this->targetFileName)) {
            file_put_contents($this->targetFileName, '');
        }

        $this->target = new SplFileObject($this->targetFileName, 'w');
    }

    private function parse(): string
    {
        $string = "INSERT INTO $this->tableName ";

        while (!$this->source->eof()) {
            $data = $this->source->fgetcsv();

            if (!$data[0]) {
                continue;
            }

            if ($this->source->key() === 0) {
                $string .= '(' . implode(', ', $data) . ')' . ' VALUES ';
            } else {
                $substring = "('" . implode("', '", $data) . "')";

                $this->source->key() === 1 ? $string .= $substring : $string .= ", $substring";
            }
        }

        $string .= ';';

        return $string;
    }

    private function write(string $sqlString): void
    {
        $this->target->fwrite($sqlString);
    }

    public function create(): void
    {
        $this->createTargetFileIfNotExist();
        $this->write($this->parse());
    }
}
