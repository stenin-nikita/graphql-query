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
 * Class FragmentDefinition
 */
class FragmentDefinition
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var array
     */
    private $directives;

    /**
     * @var array
     */
    private $selectionSet;

    public function __construct(string $name, string $type, array $selectionSet, array $directives = [])
    {
        $this->name = $name;
        $this->type = $type;
        $this->selectionSet = $selectionSet;
        $this->directives = $directives;
    }
}
