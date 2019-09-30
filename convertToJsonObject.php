<?php

function convertToJsonObject($array)
{
    if (is_assoc($array)) {
        $output = "JSON_OBJECT(";
        foreach ($array as $arrayKey => $arrayValue) {

            if (is_string($arrayValue)) $arrayValue = "\"".$arrayValue."\"";
            if (is_string($arrayKey)) $arrayKey = "\"".$arrayKey."\"";

            if (is_array($arrayValue) or is_object($arrayValue)) {
                $output .= $arrayKey.",".convertToJsonObject($arrayValue).",";
            } else {
                if (is_bool($arrayValue) and $arrayValue == true) {
                    $output .= $arrayKey . ",true,";
                } elseif (is_bool($arrayValue) and $arrayValue == false) {
                    $output .= $arrayKey . ",false,";
                } else {
                    $output .= $arrayKey .",".$arrayValue.",";
                }
            }
        }
    } else {
        $output = "JSON_ARRAY(";
        foreach ($array as $arrayItem) {
            if (is_string($arrayItem)) $arrayItem = "\"".$arrayItem."\"";
            if (is_array($arrayItem) or is_object($arrayItem)) {
                $output .= convertToJsonObject($arrayItem).",";
            } else {
                $output .= $arrayItem.",";
            }
        }
    }
    $output = substr($output, 0, -1).")";
    return $output;
}

function is_assoc($array){
    return array_values($array)!==$array;
}

?>