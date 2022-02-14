<?php

namespace Proxy\Unit\Services\Console;

use Metlar\Proxy\Services\Console\ConsoleWriter;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ConsoleWriterTest extends TestCase
{
    /**
     * @var \ReflectionClass
     */
    private $reflectionConsoleWriter;

    protected function setUp(): void
    {
        $this->reflectionConsoleWriter = new \ReflectionClass(ConsoleWriter::class);

    }
    public function testWrite(): void
    {
        $this->assertTrue($this->reflectionConsoleWriter->hasMethod('write'));
    }
}
