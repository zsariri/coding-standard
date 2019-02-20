<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace PhpCsFixer\Cache;

/**
 * @author Andreas Möller <am@localheinz.com>
 *
 * @internal
 */
final class Signature implements SignatureInterface
{
    /**
     * @var string
     */
    private $phpVersion;

    /**
     * @var string
     */
    private $fixerVersion;

    /**
     * @var array
     */
    private $rules;

    /**
     * @param string $phpVersion
     * @param string $fixerVersion
     * @param array  $rules
     */
    public function __construct($phpVersion, $fixerVersion, array $rules)
    {
        $this->phpVersion = $phpVersion;
        $this->fixerVersion = $fixerVersion;
        $this->rules = self::utf8Encode($rules);
    }

    public function getPhpVersion()
    {
        return $this->phpVersion;
    }

    public function getFixerVersion()
    {
        return $this->fixerVersion;
    }

    public function getRules()
    {
        return $this->rules;
    }

    public function equals(SignatureInterface $signature)
    {
        return $this->phpVersion === $signature->getPhpVersion()
            && $this->fixerVersion === $signature->getFixerVersion()
            && $this->rules === $signature->getRules();
    }

    private static function utf8Encode(array $data)
    {
        if (!\function_exists('mb_detect_encoding')) {
            return $data;
        }

        array_walk_recursive($data, static function (&$item) {
            if (\is_string($item) && !mb_detect_encoding($item, 'utf-8', true)) {
                $item = utf8_encode($item);
            }
        });

        return $data;
    }
}
