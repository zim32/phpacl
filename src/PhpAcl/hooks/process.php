<?php

use PhpAcl\ProcessOperation;

return [
    [['exec', 'proc_open', 'shell_exec', 'system', 'passthru'], function($command) use($processRules) {
        $operation = new ProcessOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setCommand($command);
        $processRules($operation);
    }]
];