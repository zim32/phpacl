<?php

use PhpAcl\IOOperation;

return [
    [['fwrite', 'fputs', 'fputcsv', 'file_put_contents'], function($src) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_FILEIO);
        $operation->type = IOOperation::TYPE_WRITE;
        $operation->setSrc($src);
        $processRules($operation);
    }],
    [['fread', 'fgets', 'fgetss', 'fgetc', 'fgetcsv', 'highlight_file'], function($fd) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_FILEIO);
        $operation->type = IOOperation::TYPE_READ;
        $operation->setSrc($fd);
        $processRules($operation);
    }],
    [['file_get_contents'], function($src) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_FILEIO);
        $operation->type = IOOperation::TYPE_READ;
        $operation->setSrc($src);
        $processRules($operation);
    }],
    [['fopen'], function($src) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_FILEIO);
        $operation->type = IOOperation::TYPE_OPEN;
        $operation->setSrc($src);
        $processRules($operation);
    }],
    [['file'], function($src) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_FILEIO);
        $operation->type = IOOperation::TYPE_READ;
        $operation->setSrc($src);
        $processRules($operation);
    }],
    [['unlink'], function($src) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_FILEIO);
        $operation->type = IOOperation::TYPE_DELETE;
        $operation->setSrc($src);
        $processRules($operation);
    }],
    [['mkdir', 'touch'], function($src) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_FILEIO);
        $operation->type = IOOperation::TYPE_CREATE;
        $operation->setSrc($src);
        $processRules($operation);
    }],
    [['tmpfile'], function() use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_FILEIO);
        $operation->type = IOOperation::TYPE_CREATE;
        $operation->setSrc('');
        $processRules($operation);
    }]
];