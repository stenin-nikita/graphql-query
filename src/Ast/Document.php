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
 * Class Document
 */
class Document
{
    /**
     * @var array
     */
    private $definitions;

    /**
     * Document constructor.
     * @param array $definitions
     */
    public function __construct(array $definitions = [])
    {
        $this->definitions = $definitions;
    }

    /**
     * @return array
     */
    public function getDefinitions()
    {
        return $this->definitions;
    }
}
