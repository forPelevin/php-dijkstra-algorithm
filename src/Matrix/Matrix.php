<?php

namespace Otus\Matrix;

class Matrix
{
    /**
     * @var array
     */
    protected $rows;

    /**
     * @param mixed $rows
     *
     * @return Matrix
     */
    public function setRows(array $rows)
    {
        $this->rows = $rows;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * @return array
     */
    public function transpose()
    {
        return array_map(null, ...$this->rows);
    }

    /**
     * Check matrix has valid format.
     */
    public function check(): void
    {
        foreach ($this->rows as $row) {
            if (!is_array($row)) {
                throw new \InvalidArgumentException('The matrix has invalid format.');
            }
        }
    }
}