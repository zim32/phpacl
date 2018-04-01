<?php

use PhpAcl\IOOperation;

return [
    [['stream_get_contents', 'stream_get_line'], function($src) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_STREAMIO);
        $operation->type = IOOperation::TYPE_READ;
        $operation->setSrc($src);
        $processRules($operation);
    }],
    [['stream_copy_to_stream'], function($src, $dst) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_STREAMIO);
        $operation->type = IOOperation::TYPE_COPY;
        $operation->setSrc($src);
        $operation->setDst($dst);
        $processRules($operation);
    }],
];