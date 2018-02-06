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
 * Class OperationDefinition
 */
class OperationDefinition
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $name;

    /**
     * @var SelectionSet
     */
    private $selectionSet;

    /**
     * @var array
     */
    private $variables;

    /**
     * @var array
     */
    private $directives;

    /**
     * OperationDefinition constructor.
     * @param string $type
     * @param string $name
     * @param SelectionSet|null $selectionSet
     * @param array $variables
     * @param array $directives
     */
    public function __construct(
        string $type, string $name = '', SelectionSet $selectionSet = null, array $variables = [], array $directives = []
    )
    {
        $this->type = $type;
        $this->name = $name;
        $this->selectionSet = $selectionSet ?? new SelectionSet();
        $this->variables = $variables;
        $this->directives = $directives;
    }
}
