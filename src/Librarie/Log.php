<?php 

namespace XWallet\Librarie;

class Log {
    protected $resource;
    protected $settings;

    public function __construct()
    {
        $this->settings = array(
                      'path' => LOGSPATH,
               'name_format' => 'Y-m-d',
            'message_format' => '%label% - %date% - %message%'
        );
    }

    public function write($msg, $level = 0)
    {
        switch ($level) {
        case 1:
            $label = 'FATAL';
            break;
        case 2:
            $label = 'ERROR';
            break;
        case 3:
            $label = 'WARN';
            break;
        case 4:
            $label = 'DEBUG';
            break;
        default:
            $label = 'INFO';
            break;
        }
        if (is_array($msg)) {
            $msg = json_encode($msg);
        }
        $message = str_replace(array('%label%', '%date%', '%message%'), array($label, date('Y-m-d H:i:s'), $msg), $this->settings['message_format']);
        if (!$this->resource) {
            $filename       = date($this->settings['name_format'], time()) . '.log';
            $this->resource = fopen($this->settings['path'] . $filename, 'a');
        }
        fwrite($this->resource, $message . PHP_EOL);
    }
}