<?php

namespace Proxy\Services\SavingFiles;

use Metlar\Proxy\Services\SavingFiles\FileCreator;
use Metlar\Proxy\Services\SavingFiles\FileTypeInterface;
use Metlar\Proxy\Services\SavingFiles\FormatFiles\Json;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FileCreatorTest extends TestCase
{
    /**
     * @var MockObject|FileCreator
     */
    private $fileCreator;

    protected function setUp(): void
    {
        $this->fileCreator = $this->getMockBuilder(FileCreator::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
    public function testCreate()
    {
        $this->fileCreator
            ->method('create')
            ->willReturn($this->createMock(Json::class));

        $this->assertInstanceOf(FileTypeInterface::class, $this->fileCreator->create());
    }
}
