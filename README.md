php-bitmap
==========

Bitmap, also called bit array is a data structure that 
compactly store set of values as bits of integer.
More data can be read at http://en.wikipedia.org/wiki/Bit_array.

It is useful when required compact way to represent combination 
of values and simple manipulations with them. One byte can 
represent eight independent values.

lets see example. Errors in PHP represents as constants:

```
E_ERROR = 1 (0);
E_WARNING = 2 (1);
E_PARSE = 4 (2);
E_NOTICE = 8 (3);
E_CORE_ERROR = 16 (4);
E_CORE_WARNING = 32 (5);
E_COMPILE_ERROR = 64 (6);
E_COMPILE_WARNING = 128 (7);
E_USER_ERROR = 256 (8);
E_USER_WARNING = 512 (9);
E_USER_NOTICE = 1024 (10);
E_STRICT = 2048 (11);
E_RECOVERABLE_ERROR = 4096 (12);
E_DEPRECATED = 8192 (13);
E_USER_DEPRECATED = 16384 (14);
E_ALL = 32767 (15);
```

Every error level represent logical "1", and combination of all this 
values may be represent only by two bytes. E_ERROR represent first bit of byte,
E_WARNING - second, etc.

Combination of E_WARNING and E_NOTICE in binary system is "1010" or 10 in decimal system.

Class that represents bitmap of PHP errors:

```php
class PhpError extends \Sokil\Bitmap
{
    /**
     * Show errors
     * Set first bit, which represents E_ERROR, to "1"
     */
    public function showErrors()
    {
        $this->setBit(0);
        return $this;
    }

    /**
     * Hide errors
     * Set first bit, which represents E_ERROR, to "0"
     */
    public function showErrors()
    {
        $this->unsetBit(0);
        return $this;
    }

    /**
     * Check if errors shown
     * Check if first bit set to 1
     */
    public function isErrorsShown()
    {
        return $this->isBitSet(0);
    }

    /**
     * Show warnings
     * Set second bit, which represents E_WARNING, to "1"
     */
    public function showWarnings()
    {
        $this->setBit(1);
        return $this;
    }

    /**
     * Hide warnings
     * Set second bit, which represents E_WARNING, to "0"
     */
    public function showWarnings()
    {
        $this->unsetBit(1);
        return $this;
    }

    /**
     * Check if warnings shown
     * Check if second bit set to 1
     */
    public function isWarningsShown()
    {
        return $this->isBitSet(1);
    }
}
```

Now we can easely manipulate with errors:
```php

// load current error levels
$error = new PhpError(error_reporting());

// enable errors and warnings
$error->showErrors()->showWarnings();

// set error reporting
error_reporting($error->toInt());

// check if warnings shown
var_dump($error->isWarningsShown));

// value may be set by mask
// E_USER_ERROR | E_USER_WARNING is 256 + 512;
$error->setBitsByMask(E_USER_ERROR + E_USER_WARNING);
```