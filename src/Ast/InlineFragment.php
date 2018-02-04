<?php
/**
 * This file is part of GqlQuery package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Stenin\GraphQLQuery\Ast;

/**
 * Class InlineFragment
 */
class InlineFragment
{
    /**
     * @var array
     */
    private $selectionSet;

    /**
     * @var array
     */
    private $directives;

    /**
     * @var null|string
     */
    private $type;

    /**
     * InlineFragment constructor.
     * @param array $selectionSet
     * @param array $directives
     * @param string|null $type
     */
    public function __construct(array $selectionSet, array $directives = [], string $type = null)
    {
        $this->selectionSet = $selectionSet;
        $this->directives = $directives;
        $this->type = $type;
    }
}