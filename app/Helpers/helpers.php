<?php

if (!function_exists('human_readable_number')) {
    function human_readable_number($number)
    {
        if ($number >= 1000000) {
            return number_format($number / 1000000, 1) . 'M';
        }
        if ($number >= 1000) {
            return number_format($number / 1000, 1) . 'K';
        }
        return number_format($number);
    }
}


if (!function_exists('getCurrencySign')) {
    /**
     * Get the currency sign based on the currency code.
     *
     * @param string $currency
     * @return string
     */
    function getCurrencySign($currency)
    {
        switch (strtoupper($currency)) {
            case 'GBP':
                return '£';
            case 'USD':
                return '$';
            case 'EUR':
                return '€';
            default:
                return '';
        }
    }
}

if (!function_exists('prt')) {
    /**
     * Print data in a readable format and terminate the script.
     *
     * @param mixed $data The data to print
     * @return void
     */
    function prt($data)
    {
        echo "<pre>";
        print_r($data);
        die;
    }
}
