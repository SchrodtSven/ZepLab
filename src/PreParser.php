#!/usr/bin/env php
<?php

/**
 * Parser class - to be used before Zephir build
 * 
 * 
 * @TODO 
 * - parsing single file to be get from CLI arg
 *      <code>ze_parse path/to/file</code>
 * 
 * - parsing directory recursively - to be get from CLI arg
 *      <code>ze_parse dir/</code>
 * 
 */

class PreParser
{
    private bool $colorize = true;

    private bool $stopOnError = true; // whether to stop

    private int $errors = 0;

    private const int EXT_ERR = 12 + 11;

    public function __construct(private string|array $file)
    {
        if (is_array($file)) {
            foreach($file as $itm) {
                printf("%s%s", $this->getMsg($this->parse($itm), $itm), PHP_EOL);
                if($this->stopOnError && $this->errors >0)
                    exit(self::EXT_ERR);
            }
        } else {
             printf("%s%s", $this->getMsg($this->parse($file), $file), PHP_EOL);
        }

    }

    public function parse(string $file) 
    {
        return  zephir_parse_file(file_get_contents($file), $file);
    }
    
    public function getMsg(array $ret, string $file): string
    {
        $msg = "";
        if (array_key_exists('type', $ret)) {
            $msg = "ERROR! {$ret['message']} file: {$ret['file']} ln/ch: {$ret['line']}/{$ret['char']}";
            $msg = $this->colorize ?  CliColor::error($msg) : $msg;
            $this->errors ++;
        } else {
            $msg = "OK! {$file}";
            $msg = $this->colorize ?  CliColor::success($msg) : $msg;
        }

        return $msg;
    }

    /**
     * Get the value of colorize
     *
     * @return bool
     */
    public function getColorize(): bool
    {
        return $this->colorize;
    }

    /**
     * Set the value of colorize
     *
     * @param bool $colorize
     *
     * @return self
     */
    public function setColorize(bool $colorize): self
    {
        $this->colorize = $colorize;

        return $this;
    }

    /**
     * Get the value of stopOnError
     *
     * @return bool
     */
    public function getStopOnError(): bool
    {
        return $this->stopOnError;
    }

    /**
     * Set the value of stopOnError
     *
     * @param bool $stopOnError
     *
     * @return self
     */
    public function setStopOnError(bool $stopOnError): self
    {
        $this->stopOnError = $stopOnError;

        return $this;
    }

    /**
     * Get the value of errors
     *
     * @return int
     */
    public function getErrors(): int
    {
        return $this->errors;
    }

    /**
     * Set the value of errors
     *
     * @param int $errors
     *
     * @return self
     */
    public function setErrors(int $errors): self
    {
        $this->errors = $errors;

        return $this;
    }

    public function count(): int
    {
        return count($this->file);
    }
}
