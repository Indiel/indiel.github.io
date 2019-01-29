<?php

namespace AppBundle\Entity;

trait ApiExportable {

    public function apiExport()
    {
        $data = array();

        foreach (get_object_vars($this) as $key => $value) {
            $exportedValue = $this->exportValue($value);
            if ($exportedValue !== null) {
                $data[ucfirst($key)] = $exportedValue;
            }
        }

        return !empty($data) ? $data : null;
    }

    private function exportValue($value)
    {
        if ($value instanceof Enum) {
            return $value->getValue();
        }

        if ($value instanceof ApiExportableInterface) {
            return $value->apiExport();
        }

        if ($value instanceof \DateTime) {
            return $value->format('c');
        }

        if (is_bool($value)) {
            return intval($value);
        }

        return $value;
    }
}