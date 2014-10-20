<?php

namespace Sokil;

class Bitmap
{
    private $_bitmap;
    
    public function __construct($bitmap = 0)
    {
        $this->_bitmap = (int) $bitmap;
    }
    
    public function isSet($index)
    {
        return 0 !== $this->_bitmap & (1 << $index);
    }
}
