<?php

namespace Otus\Files;

class JsonFile extends File
{
    /**
     * {@inheritdoc}
     */
    public function parse()
    {
        parent::parse();

        $this->content = json_decode($this->content);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('The given file must be JSON formatted');
        }

        return $this;
    }
}