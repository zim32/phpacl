<?php

use PhpAcl\IOOperation;

return [
    [[
        ['SplFileObject', 'fwrite'],
        ['SplFileObject', 'fputcsv'],
        ['SplFileObject', 'ftruncate'],
        ['SplFileObject', 'fflush'],
        ['SplFileObject', 'fputcsv']
    ], function() use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_FILEIO);
        $operation->type = IOOperation::TYPE_WRITE;
        $operation->setSrc($this->getPath());
        $processRules($operation);
    }],
    [[
        ['SplFileObject', 'current'],
        ['SplFileObject', 'fgetc'],
        ['SplFileObject', 'fgetcsv'],
        ['SplFileObject', 'fgets'],
        ['SplFileObject', 'fgetss'],
        ['SplFileObject', 'fpassthru'],
        ['SplFileObject', 'fread'],
        ['SplFileObject', 'fscanf'],
        ['SplFileObject', 'fpassthru'],
        ['SplFileObject', 'fpassthru'],
        ['SplFileObject', '__toString'],
    ], function() use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_FILEIO);
        $operation->type = IOOperation::TYPE_READ;
        $operation->setSrc($this->getPath());
        $processRules($operation);
    }],
    [[
        ['SplFileInfo', 'openFile'],
    ], function() use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_FILEIO);
        $operation->type = IOOperation::TYPE_OPEN;
        $operation->setSrc($this->getPath());
        $processRules($operation);
    }]
];