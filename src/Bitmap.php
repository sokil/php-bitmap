<?php

declare(strict_types=1);

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
    public function __construct(int $bitmap = 0)
    {
        $this->bitmap = $bitmap;
    }

    /**
     * @param int $index
     * @return bool
     */
    public function isBitSet(int $index): bool
    {
        return (bool)($this->bitmap & (1 << $index));
    }

    /**
     * @param int $mask
     * @return bool
     */
    public function isAnyMaskBitSet(int $mask): bool
    {
        return ($this->bitmap & $mask) > 0;
    }

    /**
     * @param int $mask
     * @return bool
     */
    public function isAllMaskBitsSet(int $mask): bool
    {
        return $mask === ($this->bitmap & $mask);
    }

    /**
     * @param int $index
     * @return Bitmap
     */
    public function setBit(int $index): Bitmap
    {
        $this->bitmap = $this->bitmap | (1 << $index);
        return $this;
    }

    /**
     * @param int[] $indexList
     * @return Bitmap
     */
    public function setBits(array $indexList): Bitmap
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
     * @return Bitmap
     */
    public function setBitsByMask(int $mask): Bitmap
    {
        $this->bitmap = $this->bitmap | $mask;
        return $this;
    }

    /**
     * @param int $index
     * @return Bitmap
     */
    public function unsetBit(int $index): Bitmap
    {
        $this->bitmap = $this->bitmap & ~(1 << $index);
        return $this;
    }

    /**
     * @param int[] $indexList
     * @return Bitmap
     */
    public function unsetBits(array $indexList): Bitmap
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
     * @return Bitmap
     */
    public function unsetBitsByMask(int $mask): Bitmap
    {
        $this->bitmap = $this->bitmap & ~$mask;
        return $this;
    }

    /**
     * @return Bitmap
     */
    public function invert(): Bitmap
    {
        $this->bitmap = ~$this->bitmap;
        return $this;
    }

    /**
     * @return int
     */
    public function getInt(): int
    {
        return $this->bitmap;
    }

    /**
     * @return string
     */
    public function getBinary(): string
    {
        return decbin($this->bitmap);
    }

    /**
     * @param Bitmap $bitmap
     *
     * @return bool
     */
    public function equals(Bitmap $bitmap): bool
    {
        return $this->bitmap === $bitmap->getInt();
    }

    /**
     * Add two bitmaps.
     *
     * @param Bitmap $bitmap
     * 
     * @return Bitmap
     */
    public function add(Bitmap $bitmap): Bitmap
    {
        return new Bitmap($this->bitmap + $bitmap->getInt());
    }
}
