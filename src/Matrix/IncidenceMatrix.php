<?php

namespace Otus\Matrix;

class IncidenceMatrix extends Matrix
{
    /**
     * @inheritdoc
     */
    public function check(): void
    {
        parent::check();

        $matrixFormatMessage = "The incidence matrix format is invalid. It must be like {n} x {m}, where {n} is nodes and {m} is edges. At the intersection of {n} and {m} in the presence of incidence should be the value of the weight (with a minus sign, if the direction enters the node) or 0 in the absence of incidence.";

        // Transpose matrix for easy checking.
        $transposed = $this->transpose();

        foreach ($transposed as $columns) {
            $notZeroValues = array_filter($columns, function ($column) {
                return $column !== 0;
            });

            // In the incidence matrix must contain exactly 2 values in the one column.
            if (sizeof($notZeroValues) !== 2) {
                throw new \InvalidArgumentException($matrixFormatMessage);
            }

            $notZeroValues = array_values($notZeroValues);

            if ($notZeroValues[0] !== -$notZeroValues[1]) {
                throw new \InvalidArgumentException($matrixFormatMessage);
            }
        }
    }
}