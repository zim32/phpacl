<?php

use PhpAcl\IOOperation;

return [
    [['socket_bind'], function($socket, $addr) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->type = IOOperation::TYPE_BIND;
        $operation->setSrc($addr);
        $processRules($operation);
    }],
    [['socket_connect'], function($socket, $addr) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->type = IOOperation::TYPE_CONNECT;
        $operation->setSrc($addr);
        $processRules($operation);
    }],
];