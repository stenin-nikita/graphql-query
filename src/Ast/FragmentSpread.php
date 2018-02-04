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
 * Class FragmentSpread
 */
class FragmentSpread
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array|null
     */
    private $directives;

    /**
     * FragmentSpread constructor.
     * @param string $name
     * @param array|null $directives
     */
    public function __construct(string $name, array $directives = null)
    {
        $this->name = $name;
        $this->directives = $directives;
    }
}