<?php

declare(strict_types=1);

/**
 * This file is part of Nexus CS Config.
 *
 * (c) 2020 John Paul E. Balandan, CPA <paulbalandan@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Nexus\CsConfig;

use PhpCsFixer\Finder;
use PhpCsFixer\Fixer\FixerInterface;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Provides a generator of custom fixers for registration in `PhpCsFixer\Config`.
 *
 * @implements \IteratorAggregate<FixerInterface>
 */
final class FixerGenerator implements \IteratorAggregate
{
    private function __construct(private string $path, private string $vendor) {}

    /**
     * @throws \RuntimeException
     */
    public static function create(string $path, string $vendor): self
    {
        if ('' === $path) {
            throw new \RuntimeException('Path to custom fixers cannot be empty.');
        }

        if (! is_dir($path)) {
            throw new \RuntimeException(sprintf('Path "%s" is not a valid directory.', $path));
        }

        if ('' === $vendor) {
            throw new \RuntimeException('Vendor namespace cannot be empty.');
        }

        if (preg_match('/^[A-Z][a-zA-Z0-9\\\\]+$/', $vendor) !== 1) {
            throw new \RuntimeException(sprintf('Vendor namespace "%s" is not valid.', $vendor));
        }

        return new self($path, $vendor);
    }

    /**
     * @return \Traversable<FixerInterface>
     */
    public function getIterator(): \Traversable
    {
        $finder = Finder::create()
            ->files()
            ->in($this->path)
            ->notName('/Abstract(\S+)\.php$/')
            ->notName('/(\S+)(?<!Fixer)\.php$/')
            ->sortByName()
        ;

        $fixers = array_filter(array_map(
            function (SplFileInfo $file): object {
                $fixer = sprintf(
                    '%s\\%s%s%s',
                    trim($this->vendor, '\\'),
                    strtr($file->getRelativePath(), \DIRECTORY_SEPARATOR, '\\'),
                    $file->getRelativePath() !== '' ? '\\' : '',
                    $file->getBasename('.'.$file->getExtension()),
                );

                return new $fixer();
            },
            iterator_to_array($finder, false),
        ), static fn(object $fixer): bool => $fixer instanceof FixerInterface);

        yield from $fixers;
    }
}
