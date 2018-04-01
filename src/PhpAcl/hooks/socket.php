<?php

use PhpAcl\IOOperation;

return [
    [['socket_create', 'socket_create_pair'], function($domain, $type) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_SOCKIO);
        $operation->type = IOOperation::TYPE_SOCK_INIT;
        $operation->setSrc($domain);
        $processRules($operation);
    }],
    [['socket_bind'], function($socket, $addr) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_SOCKIO);
        $operation->type = IOOperation::TYPE_SOCK_INIT;
        $operation->setSrc($addr);
        $processRules($operation);
    }],
    [['socket_connect'], function($socket, $addr) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_SOCKIO);
        $operation->type = IOOperation::TYPE_SOCK_INIT;
        $operation->setSrc($addr);
        $processRules($operation);
    }],
    [['socket_create_listen'], function($port) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_SOCKIO);
        $operation->type = IOOperation::TYPE_SOCK_INIT;
        $operation->setSrc($port);
        $processRules($operation);
    }],
    [['socket_listen'], function($socket) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_SOCKIO);
        $operation->type = IOOperation::TYPE_SOCK_INIT;
        socket_getsockname($socket, $src);
        $operation->setSrc($src);
        $processRules($operation);
    }],
    [['socket_accept'], function($socket) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_SOCKIO);
        $operation->type = IOOperation::TYPE_SOCK_ACCEPT;
        socket_getsockname($socket, $src);
        $operation->setSrc($src);
        $processRules($operation);
    }],
    [['socket_import_stream'], function($stream) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_SOCKIO);
        $operation->type = IOOperation::TYPE_SOCK_INIT;
        $operation->setSrc($stream);
        $processRules($operation);
    }],
    [['socket_read', 'socket_recv', 'socket_recvfrom', 'socket_recvmsg'], function($socket) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_SOCKIO);
        $operation->type = IOOperation::TYPE_SOCK_READ;
        socket_getsockname($socket, $src);
        $operation->setSrc($src);
        $processRules($operation);
    }],
    [['socket_write', 'socket_send', 'socket_sendmsg', 'socket_sendto'], function($socket) use($processRules) {
        $operation = new IOOperation();
        $operation->setCallStack(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
        $operation->setGroup(\PhpAcl\IOOperation::GROUP_SOCKIO);
        $operation->type = IOOperation::TYPE_SOCK_WRITE;
        socket_getsockname($socket, $src);
        $operation->setSrc($src);
        $processRules($operation);
    }],
];