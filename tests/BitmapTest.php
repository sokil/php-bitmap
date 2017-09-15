<?php

namespace Sokil;

class BitmapTest extends \PHPUnit_Framework_TestCase
{
    public function testIsBitSet()
    {
        // 5 => 101
        $bitmap = new Bitmap(5);
        
        $this->assertTrue($bitmap->isBitSet(2));
    }
    
    public function testSetBit()
    {
        $bitmap = new Bitmap();
        
        $this->assertEquals(8, $bitmap->setBit(3)->getInt());
    }
    
    public function testSetBits()
    {
        $bitmap = new Bitmap();
        
        $this->assertEquals(10, $bitmap->setBits(array(1, 3))->getInt());
    }
    
    public function testSetBitsByMask()
    {
        $bitmap = new Bitmap();
        
        $this->assertEquals(10, $bitmap->setBitsByMask(10)->getInt());
    }
    
    public function testUnsetBit()
    {
        $bitmap = new Bitmap(5);
        
        $this->assertEquals(4, $bitmap->unsetBit(0)->getInt());
    }
    
    public function testUnsetBits()
    {
        $bitmap = new Bitmap(5);
        
        $this->assertEquals(4, $bitmap->unsetBits(array(0, 1))->getInt());
    }
    
    public function testUnsetBitsByMask()
    {
        $bitmap = new Bitmap(5);
        
        $this->assertEquals(1, $bitmap->unsetBitsByMask(4)->getInt());
    }
    
    public function testInvert()
    {
        $bitmap = new Bitmap(5);
        $bitmap->invert();
        
        $this->assertEquals(-6, $bitmap->getInt());
    }
    
    public function testGetInt()
    {
        $bitmap = new Bitmap();
        $bitmap->setBit(0);
        $bitmap->setBit(2);
        
        $this->assertEquals(5, $bitmap->getInt());
    }
    
    public function testBitmap()
    {
        $bitmap = new Bitmap();
        $bitmap->setBit(0);
        $bitmap->setBit(2);
        
        $this->assertEquals('101', $bitmap->getBinary());
    }
}
