<?php

/**
 * (c) Dmytro Sokil <dmytro.sokil@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sokil;

/**
 * Instance of binary map
 */
class Bitmap
{
    /**
     * @var int
     */
    private $bitmap;

    /**
     * @param int $bitmap
     */
    public function __construct($bitmap = 0)
    {
        $this->bitmap = (int)$bitmap;
    }

    /**
     * @param int $index
     * @return bool
     */
    public function isBitSet($index)
    {
        return (bool) ($this->bitmap & (1 << $index));
    }

    /**
     * @param int $index
     * @return $this
     */
    public function setBit($index)
    {
        $this->bitmap = $this->bitmap | (1 << $index);
        return $this;
    }

    /**
     * @param [] $indexList
     * @return $this
     */
    public function setBits(array $indexList)
    {
        $mask = 0;
        foreach($indexList as $index) {
            $mask = $mask | (1 << $index);
        }
        
        $this->setBitsByMask($mask);
        
        return $this;
    }

    /**
     * @param int $mask
     * @return $this
     */
    public function setBitsByMask($mask)
    {
        $this->bitmap = $this->bitmap | $mask;
        return $this;
    }

    /**
     * @param int $index
     * @return $this
     */
    public function unsetBit($index)
    {
        $this->bitmap = $this->bitmap & ~(1 << $index);
        return $this;
    }

    /**
     * @param int[] $indexList
     * @return $this
     */
    public function unsetBits(array $indexList)
    {
        $mask = 0;
        foreach($indexList as $index) {
            $mask = $mask | (1 << $index);
        }
        
        $this->unsetBitsByMask($mask);
        
        return $this;
    }

    /**
     * @param int $mask
     * @return $this
     */
    public function unsetBitsByMask($mask)
    {
        $this->bitmap = $this->bitmap & ~$mask;
        return $this;
    }

    /**
     * @return $this
     */
    public function invert()
    {
        $this->bitmap = ~$this->bitmap;
        return $this;
    }

    /**
     * @return int
     */
    public function getInt()
    {
        return $this->bitmap;
    }

    /**
     * @return string
     */
    public function getBinary()
    {
        return decbin($this->bitmap);
    }
}
