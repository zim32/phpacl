<?php

use PhpAcl\IOOperation;

return [
    [['ftp_put', 'ftp_nb_put', 'ftp_fput', 'ftp_nb_fput'], function($stream, $remoteFile) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_FTPIO);
        $operation->type = IOOperation::TYPE_COPY;
        $operation->setSrc($stream);
        $operation->setDst($remoteFile);
        $processRules($operation);
    }],
    [['ftp_get', 'ftp_nb_get', 'ftp_fget', 'ftp_nb_fget'], function($stream, $localFile) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_FTPIO);
        $operation->type = IOOperation::TYPE_COPY;
        $operation->setSrc($stream);
        $operation->setDst($localFile);
        $processRules($operation);
    }],
    [['ftp_rename'], function($stream) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_FTPIO);
        $operation->type = IOOperation::TYPE_RENAME;
        $operation->setSrc($stream);
        $processRules($operation);
    }],
    [['ftp_delete', 'ftp_rmdir'], function($stream, $dst) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_FTPIO);
        $operation->type = IOOperation::TYPE_DELETE;
        $operation->setSrc($stream);
        $operation->setDst($dst);
        $processRules($operation);
    }],
    [['ftp_mkdir'], function($stream, $dir) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_FTPIO);
        $operation->type = IOOperation::TYPE_CREATE;
        $operation->setSrc($stream);
        $operation->setDst($dir);
        $processRules($operation);
    }],
];