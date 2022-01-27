<?php

defined('BASEPATH') or exit('No direct script access allowed');

use SimpleExcel\SimpleExcel;

class Excel_php extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Modules instalation.
     *
     * @return JSON
     **/
    public function module()
    {
        $module = [
                    'name' => 'PHP to Excel',
                    'menu_link' => [
                                     'excel_php/excel' => 'Generate Excel',
                                   ],
                    'table' => '',
                    'description' => 'PHP to Excel by faisalman install composer <code>"faisalman/simple-excel-php": "dev-master"</code>',
                  ];

        return $module;
    }

    public function excel()
    {
        $excel = new SimpleExcel('xml'); // instantiate new object (will automatically construct the parser & writer type as XML)

        $excel->writer->setData(
            array(
                array('ID', 'Name', 'Kode'),
                array('1', 'Kab. Bogor', '1'),
                array('2', 'Kab. Cianjur', '1'),
                array('3', 'Kab. Sukabumi', '1'),
                array('4', 'Kab. Tasikmalaya', '2'),
            )
        ); // add some data to the writer
        $excel->writer->saveFile('example'); // save the file with specified name (example.xml)
        // and specified target (default to browser)
    }
}

/* End of file Excel_php.php */
/* Location: ./excel_php/controllers/Excel_php.php */
