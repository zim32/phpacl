<?php

namespace PhpAcl;


class ACLComponent
{

    protected static $instance;

    protected $config;

    protected function __construct()
    {
        if (!extension_loaded('uopz')) {
            throw new \Exception('PhpAcl\\ACLComponent requires uopz extension to be loaded');
        }
    }

    /**
     * @return ACLComponent
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function init(array $config)
    {
        $this->config = $config;

        $this->initIOAcl();
        $this->initProcessAcl();

        // deadlock to make it impossible to revert old hooks
        uopz_set_hook('uopz_unset_hook', function(){
            die('uopz_unset_hook denied');
        });

        uopz_set_hook('uopz_set_hook', function(){
            die('uopz_set_hook denied');
        });
    }

    protected function initIOAcl()
    {
        if (
            !isset($this->config['io']) ||
            !isset($this->config['io']['rules'])
        ) {
            return;
        }

        if (!$this->config['io']['enabled']) {
            return;
        }

        /** @var IOOperation $operation */
        $operation = null;

        $processRules = function (IOOperation $operation) {
            foreach ($this->config['io']['rules'] as $rule) {
                if ($rule($operation)) {
                    return true;
                }
            }
            // TODO: display nice message and information
            die(var_dump($operation));
        };

        $standartFsWrappers = require __DIR__ . '/hooks/fs.standart.php';
        $splFsWrappers      = require __DIR__ . '/hooks/fs.spl.php';
        $streamWrappers     = require __DIR__ . '/hooks/stream.php';
        $socketWrappers     = require __DIR__ . '/hooks/socket.php';
        $ftpWrappers        = require __DIR__ . '/hooks/fs.ftp.php';

        $wrappers = [];
        $wrappers = array_merge($wrappers, $standartFsWrappers);
        $wrappers = array_merge($wrappers, $splFsWrappers);
        $wrappers = array_merge($wrappers, $streamWrappers);
        $wrappers = array_merge($wrappers, $socketWrappers);
        $wrappers = array_merge($wrappers, $ftpWrappers);


        // activate hooks
        foreach ($wrappers as $feWrappers) {
            $hook = $feWrappers[1];
            foreach ($feWrappers[0] as $functionName) {
                if (is_array($functionName)) {
                    // class method
                    uopz_set_hook($functionName[0], $functionName[1], $hook);
                } else {
                    // plain function
                    uopz_set_hook($functionName, $hook);
                }
            }
        }
    }

    protected function initProcessAcl()
    {
        if (
            !isset($this->config['process']) ||
            !isset($this->config['process']['rules'])
        ) {
            return;
        }

        if (!$this->config['process']['enabled']) {
            return;
        }

        /** @var IOOperation $operation */
        $operation = null;

        $processRules = function (ProcessOperation $operation) {
            foreach ($this->config['process']['rules'] as $rule) {
                if ($rule($operation)) {
                    return true;
                }
            }
            // TODO: display nice message and information
            die(var_dump($operation));
        };

        $standartWrappers = require __DIR__ . '/hooks/process.php';

        $wrappers = [];
        $wrappers = array_merge($wrappers, $standartWrappers);

        // activate hooks
        foreach ($wrappers as $feWrappers) {
            $hook = $feWrappers[1];
            foreach ($feWrappers[0] as $functionName) {
                if (is_array($functionName)) {
                    // class method
                    uopz_set_hook($functionName[0], $functionName[1], $hook);
                } else {
                    // plain function
                    uopz_set_hook($functionName, $hook);
                }
            }
        }
    }


}