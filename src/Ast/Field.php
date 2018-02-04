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
 * Class Field
 */
class Field
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $arguments;

    /**
     * @var array
     */
    private $directives;

    /**
     * @var array
     */
    private $selectionSet;

    /**
     * @var string
     */
    private $alias;

    /**
     * Field constructor.
     * @param string $name
     * @param array $arguments
     * @param array $directives
     * @param array $selectionSet
     * @param string|null $alias
     */
    public function __construct(
        string $name, array $arguments = [], array $directives = [], array $selectionSet = [], string $alias = null
    )
    {
        $this->name = $name;
        $this->arguments = $arguments;
        $this->directives = $directives;
        $this->selectionSet = $selectionSet;
        $this->alias = $alias;
    }
}
