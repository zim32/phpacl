<?php

namespace PhpAcl;


class BaseOperationInfo
{
    protected $callStack = [];

    protected $calledFile = '';

    public function setCallStack(array $stack)
    {
        $this->callStack  = $stack;
        $this->calledFile = $stack[0]['file'];
    }

    public function getCalledFile()
    {
        return $this->calledFile;
    }

    public function getCallStack()
    {
        return $this->callStack;
    }

}