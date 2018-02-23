<?php

namespace Sokil;

use PHPUnit\Framework\TestCase;

class BitmapTest extends TestCase
{
    public function testIsAnyBitSetByMask()
    {
        $bitmap = new Bitmap(E_USER_ERROR | E_USER_WARNING | E_USER_DEPRECATED);
        $this->assertTrue($bitmap->isAnyMaskBitSet(E_USER_ERROR | E_ERROR));
        $this->assertFalse($bitmap->isAnyMaskBitSet(E_NOTICE | E_ERROR));
    }

    public function testIsAllBitsSetByMask()
    {
        $bitmap = new Bitmap(E_USER_ERROR | E_USER_WARNING | E_USER_DEPRECATED);
        $this->assertTrue($bitmap->isAllMaskBitsSet(E_USER_ERROR | E_USER_WARNING));
        $this->assertFalse($bitmap->isAllMaskBitsSet(E_USER_ERROR | E_ERROR));
    }

    public function testIsBitSet()
    {
        // 5 => 101
        $bitmap = new Bitmap(5);
        
        $this->assertTrue($bitmap->isBitSet(2));
    }
    
    public function testSetBit()
    {
        $bitmap = new Bitmap();

        // 8 => 1000
        $this->assertEquals(
            8,
            $bitmap->setBit(3)->getInt()
        );
    }
    
    public function testSetBits()
    {
        $bitmap = new Bitmap();

        // 10 => 1010
        $this->assertEquals(
            10,
            $bitmap->setBits(array(1, 3))->getInt()
        );
    }
    
    public function testSetBitsByMask()
    {
        $bitmap = new Bitmap();

        // 10 => 1010
        $this->assertEquals(
            10,
            $bitmap->setBitsByMask(10)->getInt()
        );
    }
    
    public function testUnsetBit()
    {
        $bitmap = new Bitmap(5);

        // 4 => 100
        $this->assertEquals(
            4,
            $bitmap->unsetBit(0)->getInt()
        );
    }
    
    public function testUnsetBits()
    {
        // 5 => 101
        $bitmap = new Bitmap(5);

        // 4 => 100
        $this->assertEquals(
            4,
            $bitmap->unsetBits(array(0, 1))->getInt()
        );
    }
    
    public function testUnsetBitsByMask()
    {
        // 5 => 101
        // 4 => 100
        $bitmap = new Bitmap(5);
        
        $this->assertEquals(
            1,
            $bitmap->unsetBitsByMask(4)->getInt()
        );
    }
    
    public function testInvert()
    {
        // 5 => 101
        $bitmap = new Bitmap(5);
        $bitmap->invert();

        // -6 => 1111111111111111111111111111111111111111111111111111111111111010 (64 bit)
        $this->assertEquals(
            -6,
            $bitmap->getInt()
        );
    }
    
    public function testGetInt()
    {
        $bitmap = new Bitmap();
        $bitmap->setBit(0); // 1
        $bitmap->setBit(2); // 101 => 5
        
        $this->assertEquals(
            5,
            $bitmap->getInt()
        );
    }
    
    public function testGetBinary()
    {
        $bitmap = new Bitmap();
        $bitmap->setBit(0); // 1
        $bitmap->setBit(2); // 101
        
        $this->assertEquals(
            '101',
            $bitmap->getBinary()
        );
    }

    public function testEquals()
    {
        $bitmap42 = new Bitmap(42);

        $this->assertTrue(
            $bitmap42->equals(new Bitmap(42))
        );

        $this->assertFalse(
            $bitmap42->equals(new Bitmap(43))
        );
    }

    public function testAdd()
    {
        $bitmap10 = new Bitmap(10);
        $bitmap42 = new Bitmap(42);
        $bitmap52 = $bitmap10->add($bitmap42);

        $this->assertEquals(52, $bitmap52->getInt());
    }
}
