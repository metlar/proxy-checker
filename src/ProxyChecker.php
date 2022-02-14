<?php

namespace Metlar\Proxy;

class ProxyChecker
{
    /**
     * @var integer
     */
    private $thread = 5;
    /**
     * @var array
     */
    private $proxy;

    /**
     * @var ProxyCheckerOperations
     */
    private $checkerOperations;

    /**
     * ProxyChecker constructor.
     * @param ProxyCheckerOperations $checkerOperations
     */
    public function __construct(ProxyCheckerOperations $checkerOperations)
    {
        $this->checkerOperations = $checkerOperations;
    }

    public function setProxy(array $proxy): ProxyChecker
    {
        $this->proxy = $proxy;

        return $this;
    }

    /**
     * @param int $thread
     * @return $this
     */
    public function thread(int $thread): ProxyChecker
    {
        $this->thread = $thread;

        return $this;
    }

    /**
     * @param string $format
     * @return ProxyChecker
     */
    public function saveFormat(string $format): ProxyChecker
    {
        $this->checkerOperations->setFormat($format);
        $this->checkerOperations->setThread($this->thread);
        $this->checkerOperations->setProxy($this->proxy);
        $this->checkerOperations->operation();

        return $this;
    }

    /**
     * @return array
     */
    public function getArray(): array
    {
        $this->checkerOperations->setThread($this->thread);
        $this->checkerOperations->setProxy($this->proxy);

        return $this->checkerOperations->getResultArray();
    }
}