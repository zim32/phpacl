<?php

use PhpAcl\IOOperation;

return [
    [['fwrite', 'file_put_contents'], function($src) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->type = IOOperation::TYPE_WRITE;
        $operation->setSrc($src);
        $processRules($operation);
    }],
    [['fread', 'fgets', 'fgetss', 'fgetc', 'fgetcsv'], function($fd) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->type = IOOperation::TYPE_READ;
        $operation->setSrc($fd);
        $processRules($operation);
    }],
    [['file_get_contents'], function($src) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->type = IOOperation::TYPE_READ;
        $operation->setSrc($src);
        $processRules($operation);
    }],
    [['fopen'], function($src) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->type = IOOperation::TYPE_OPEN;
        $operation->setSrc($src);
        $processRules($operation);
    }],
    [['file'], function($src) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->type = IOOperation::TYPE_READ;
        $operation->setSrc($src);
        $processRules($operation);
    }]
];