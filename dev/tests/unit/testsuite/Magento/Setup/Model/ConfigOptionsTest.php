<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Setup\Model;

class ConfigOptionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ConfigOptions
     */
    private $object;

    /**
     * @var ConfigDataGenerator|\PHPUnit_Framework_MockObject_MockObject
     */
    private $generator;

    protected function setUp()
    {
        $this->generator = $this->getMock('Magento\Setup\Model\ConfigDataGenerator', [], [], '', false);
        $this->object = new ConfigOptions($this->generator);
    }

    public function testGetOptions()
    {
        $options = $this->object->getOptions();
        $this->assertInstanceOf('Magento\Framework\Setup\Option\TextConfigOption', $options[0]);
        $this->assertSame('Encryption key', $options[0]->getDescription());
        $this->assertInstanceOf('Magento\Framework\Setup\Option\SelectConfigOption', $options[1]);
        $this->assertSame('Session save location', $options[1]->getDescription());
        $this->assertInstanceOf('Magento\Framework\Setup\Option\SelectConfigOption', $options[2]);
        $this->assertSame('Type of definitions used by Object Manager', $options[2]->getDescription());
        $this->assertInstanceOf('Magento\Framework\Setup\Option\TextConfigOption', $options[3]);
        $this->assertSame('Database server host', $options[3]->getDescription());
        $this->assertInstanceOf('Magento\Framework\Setup\Option\TextConfigOption', $options[4]);
        $this->assertSame('Database name', $options[4]->getDescription());
        $this->assertInstanceOf('Magento\Framework\Setup\Option\TextConfigOption', $options[5]);
        $this->assertSame('Database server username', $options[5]->getDescription());
        $this->assertInstanceOf('Magento\Framework\Setup\Option\TextConfigOption', $options[6]);
        $this->assertSame('Database server password', $options[6]->getDescription());
        $this->assertInstanceOf('Magento\Framework\Setup\Option\TextConfigOption', $options[7]);
        $this->assertSame('Database table prefix', $options[7]->getDescription());
        $this->assertInstanceOf('Magento\Framework\Setup\Option\TextConfigOption', $options[8]);
        $this->assertSame('Database type', $options[8]->getDescription());
        $this->assertInstanceOf('Magento\Framework\Setup\Option\TextConfigOption', $options[9]);
        $this->assertSame('Database  initial set of commands', $options[9]->getDescription());
        $this->assertEquals(10, count($options));
    }

    public function testCreateOptions()
    {
        $configDataMock = $this->getMock('Magento\Framework\Config\Data\ConfigData', [], [], '', false);
        $this->generator->expects($this->once())->method('createInstallConfig')->willReturn($configDataMock);
        $this->generator->expects($this->once())->method('createCryptConfig')->willReturn($configDataMock);
        $this->generator->expects($this->once())->method('createModuleConfig')->willReturn($configDataMock);
        $this->generator->expects($this->once())->method('createSessionConfig')->willReturn($configDataMock);
        $this->generator->expects($this->once())->method('createDefinitionsConfig')->willReturn($configDataMock);
        $this->generator->expects($this->once())->method('createDbConfig')->willReturn($configDataMock);
        $this->generator->expects($this->once())->method('createResourceConfig')->willReturn($configDataMock);
        $configData = $this->object->createConfig([]);
        $this->assertEquals(7 ,count($configData));
    }

    public function testCreateOptionsWithOptionalNull()
    {
        $configDataMock = $this->getMock('Magento\Framework\Config\Data\ConfigData', [], [], '', false);
        $this->generator->expects($this->once())->method('createInstallConfig')->willReturn($configDataMock);
        $this->generator->expects($this->once())->method('createCryptConfig')->willReturn($configDataMock);
        $this->generator->expects($this->once())->method('createModuleConfig')->willReturn(null);
        $this->generator->expects($this->once())->method('createSessionConfig')->willReturn($configDataMock);
        $this->generator->expects($this->once())->method('createDefinitionsConfig')->willReturn(null);
        $this->generator->expects($this->once())->method('createDbConfig')->willReturn($configDataMock);
        $this->generator->expects($this->once())->method('createResourceConfig')->willReturn($configDataMock);
        $configData = $this->object->createConfig([]);
        $this->assertEquals(5 ,count($configData));
    }
}
