<?php

use PhpAcl\IOOperation;

return [
    [['curl_init', 'curl_multi_init', 'curl_share_init'], function() use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_CURLIO);
        $operation->type = IOOperation::TYPE_CURL_INIT;
        $operation->setSrc('');
        $processRules($operation);
    }],
    [['curl_exec', 'curl_multi_exec'], function($resource) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_CURLIO);
        $operation->type = IOOperation::TYPE_CURL_EXEC;
        $operation->setSrc($resource);
        $processRules($operation);
    }],
];