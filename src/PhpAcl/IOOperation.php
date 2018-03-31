<?php

namespace PhpAcl;


class IOOperation extends BaseOperationInfo
{
    const TYPE_READ    = 'read';
    const TYPE_WRITE   = 'write';
    const TYPE_OPEN    = 'open';
    const TYPE_DELETE  = 'delete';
    const TYPE_BIND    = 'bind';
    const TYPE_CONNECT = 'connect';

    /**
     * Raw IO src
     * Can be resource, path, socket address, etc, depending on function
     *
     * @var string | resource
     */
    protected $src;

    /**
     * Raw IO dst
     * Only should be present for COPY operations
     * Can be resource, path, socket address, etc, depending on function
     *
     * @var string | resource
     */
    protected $dst;

    public $type;

    /**
     * @param resource | string $src
     */
    public function setSrc($src)
    {
        $this->src = $src;
    }

    /**
     * @param resource | string $dst
     */
    public function setDst($dst)
    {
        $this->dst = $dst;
    }

    /**
     * @return string | boolean
     */
    public function getSrc()
    {
        if (is_string($this->src)) {
            return $this->src;
        }

        if (is_resource($this->src)) {
            $metadata = stream_get_meta_data($this->src);
            return $metadata['uri'];
        }

        return false;
    }

    /**
     * @param string $path
     * @return bool
     */
    public function srcStartsWith(string $path)
    {
        return strpos($this->getSrc(), $path) === 0;
    }

    /**
     * @param string $path
     * @return bool
     */
    public function callerStartsWith(string $path)
    {
        return strpos($this->getCalledFile(), $path) === 0;
    }

    /**
     * @return string | boolean
     */
    public function getDst()
    {
        if (is_string($this->dst)) {
            return $this->dst;
        }

        if (is_resource($this->dst)) {
            $metadata = stream_get_meta_data($this->dst);
            return $metadata['uri'];
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isSrcLocal()
    {
        return stream_is_local($this->getSrc());
    }

    /**
     * @return bool
     */
    public function isDstLocal()
    {
        return stream_is_local($this->getDst());
    }

    /**
     * @return bool
     */
    public function isReadOperation()
    {
        return $this->type === self::TYPE_READ;
    }

    /**
     * @return bool
     */
    public function isWriteOperation()
    {
        return $this->type === self::TYPE_WRITE;
    }

    /**
     * @return bool
     */
    public function isOpenOperation()
    {
        return $this->type === self::TYPE_OPEN;
    }

    /**
     * @return bool
     */
    public function isConnectOperation()
    {
        return $this->type === self::TYPE_CONNECT;
    }

    /**
     * @return bool
     */
    public function isBindOperation()
    {
        return $this->type === self::TYPE_BIND;
    }

    /**
     * @return bool
     */
    public function isDeleteOperation()
    {
        return $this->type === self::TYPE_DELETE;
    }

    /**
     * @return bool
     */
    public function isReadOrOpenOperation()
    {
        return $this->isReadOperation() || $this->isOpenOperation();
    }

    /**
     * @return bool
     */
    public function isWriteOrOpenOperation()
    {
        return $this->isWriteOperation() || $this->isOpenOperation();
    }

}