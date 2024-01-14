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

namespace Nexus\CsConfig\Fixer\Comment;

use Nexus\CsConfig\Fixer\AbstractCustomFixer;
use PhpCsFixer\Fixer\DeprecatedFixerInterface;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;

/**
 * Simple comments should have one space after the `//`.
 *
 * @deprecated
 */
final class SpaceAfterCommentStartFixer extends AbstractCustomFixer implements DeprecatedFixerInterface
{
    /**
     * {@inheritDoc}
     */
    public function getDefinition(): FixerDefinitionInterface
    {
        return new FixerDefinition(
            'There should be a single whitespace after the start of a simple comment.',
            [
                new CodeSample("<?php\n    //this is a comment\n"),
                new CodeSample("<?php\n    //  this is another comment\n"),
            ],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getSuccessorsNames(): array
    {
        return ['single_line_comment_spacing'];
    }

    /**
     * {@inheritDoc}
     */
    public function isCandidate(Tokens $tokens): bool
    {
        return $tokens->isTokenKindFound(T_COMMENT);
    }

    /**
     * {@inheritDoc}
     *
     * Must run after NoEmptyCommentFixer
     */
    public function getPriority(): int
    {
        return 3;
    }

    /**
     * {@inheritDoc}
     */
    protected function applyFix(\SplFileInfo $file, Tokens $tokens): void
    {
        for ($index = 1, $count = $tokens->count(); $index < $count; ++$index) {
            /** @var Token $token */
            $token = $tokens[$index];

            if (! $token->isGivenKind(T_COMMENT)) {
                continue;
            }

            $comment = $token->getContent();

            if (substr($comment, 0, 2) !== '//') {
                continue;
            }

            if ('//' === $comment) {
                continue;
            }

            preg_match('/^\/\/(\s*)(.+)/', $comment, $matches);

            if (' ' === $matches[1]) {
                continue;
            }

            if (preg_match('/\-+/', $matches[2]) === 1 || preg_match('/\=+/', $matches[2]) === 1) {
                continue;
            }

            $tokens[$index] = new Token([T_COMMENT, '// '.$matches[2]]);
        }
    }
}
