<?php

namespace Sokil;

class Bitmap
{
    private $_bitmap;
    
    public function __construct($bitmap = 0)
    {
        $this->_bitmap = (int) $bitmap;
    }
    
    public function isBitSet($index)
    {
        return (bool) ($this->_bitmap & (1 << $index));
    }
    
    public function setBit($index)
    {
        $this->_bitmap = $this->_bitmap | (1 << $index);
        return $this;
    }
    
    public function setBits(array $indexList)
    {
        $mask = 0;
        foreach($indexList as $index) {
            $mask = $mask | (1 << $index);
        }
        
        $this->setBitsByMask($mask);
        
        return $this;
    }
    
    public function setBitsByMask($mask)
    {
        $this->_bitmap = $this->_bitmap | $mask;
        return $this;
    }
    
    public function unsetBit($index)
    {
        $this->_bitmap = $this->_bitmap & ~(1 << $index);
        return $this;
    }
    
    public function unsetBits(array $indexList)
    {
        $mask = 0;
        foreach($indexList as $index) {
            $mask = $mask | (1 << $index);
        }
        
        $this->unsetBitsByMask($mask);
        
        return $this;
    }
    
    public function unsetBitsByMask($mask)
    {
        $this->_bitmap = $this->_bitmap & ~$mask;
        return $this;
    }
    
    public function invert()
    {
        $this->_bitmap = ~$this->_bitmap;
        return $this;
    }
    
    public function getInt()
    {
        return $this->_bitmap;
    }
    
    public function getBinary()
    {
        return decbin($this->_bitmap);
    }
}
