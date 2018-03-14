<?php

namespace Otus\Files;

class File
{
    /**
     * Path to the file
     *
     * @var string
     */
    protected $path;

    /**
     * Content of the file
     *
     * @var
     */
    protected $content;

    /**
     * File constructor.
     *
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * Gets the file's content
     *
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Checks the file exists
     *
     * @return bool
     */
    public function exists()
    {
        return file_exists($this->path);
    }

    /**
     * Gets path to the file
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Parses the file content
     */
    public function parse()
    {
        $this->content = file_get_contents($this->path);

        return $this;
    }
}