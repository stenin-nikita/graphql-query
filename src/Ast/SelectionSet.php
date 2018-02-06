<?php
/**
 * This file is part of PhpStorm package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Stenin\GraphQLQuery\Ast;

/**
 * Class SelectionSet
 */
class SelectionSet
{
    private $selections;

    public function __construct(array $selections = [])
    {
        $this->selections = $selections;
    }
}
