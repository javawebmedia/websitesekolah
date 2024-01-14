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
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Token;
use PhpCsFixer\Tokenizer\Tokens;

/**
 * Removes code separator comments except when used as section boundary.
 */
final class NoCodeSeparatorCommentFixer extends AbstractCustomFixer
{
    /**
     * {@inheritDoc}
     */
    public function getDefinition(): FixerDefinitionInterface
    {
        return new FixerDefinition(
            'There should not be any code separator comments.',
            [new CodeSample(
                <<<'EOF'
                    <?php

                    $code = 'a';

                    //------------------------

                    $arr = [];

                    EOF,
            )],
        );
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
     * Must run before NoEmptyCommentFixer, SpaceAfterCommentStartFixer
     */
    public function getPriority(): int
    {
        return 2;
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

            if (! $this->isCodeSeparatorComment($token->getContent())) {
                continue;
            }

            if ($this->isCommentBlockBoundary($tokens, $index)) {
                continue;
            }

            $tokens->removeLeadingWhitespace($index);
            $tokens->clearTokenAndMergeSurroundingWhitespace($index);
        }
    }

    /**
     * Checks if the recurring code separator comment is part of a comment
     * boundary that serves as a logical division between sections of code.
     *
     * ```
     * //================================== <-- this is used as a boundary
     * // SECTION
     * //================================== <-- this is used as a boundary
     *
     * //================================== <-- this is NOT a boundary
     *
     * ```
     */
    private function isCommentBlockBoundary(Tokens $tokens, int $index): bool
    {
        $prevIndex = $tokens->getPrevNonWhitespace($index);
        $nextIndex = $tokens->getNextNonWhitespace($index);

        /** @var Token $prevToken */
        $prevToken = $tokens[$prevIndex];
        $prevTokenIsRegularComment = $prevToken->isGivenKind(T_COMMENT)
            && ! $this->isCodeSeparatorComment($prevToken->getContent());

        /** @var Token $nextToken */
        $nextToken = $tokens[$nextIndex];
        $nextTokenIsRegularComment = $nextToken->isGivenKind(T_COMMENT)
            && ! $this->isCodeSeparatorComment($nextToken->getContent());

        return $prevTokenIsRegularComment || $nextTokenIsRegularComment;
    }

    private function isCodeSeparatorComment(string $comment): bool
    {
        return preg_match('/^\/\/\s*[-|=]+$/', $comment) === 1;
    }
}
