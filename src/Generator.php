<?php
/**
 * This file is part of PhpStorm package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Stenin\GraphQLQuery;

use PhpYacc\Generator as YaccGenerator;
use PhpYacc\Grammar\Context;

/**
 * Class Parser
 */
class Generator
{
    /**
     * @var bool|string
     */
    private $grammar;

    /**
     * @var bool|string
     */
    private $skeleton;

    /**
     * Parser constructor.
     */
    public function __construct()
    {
        $this->grammar = \file_get_contents(__DIR__ . '/resources/grammar.phpy');
        $this->skeleton = \file_get_contents(__DIR__. '/resources/parser.template');
    }

    /**
     * @param string $className
     * @param string $path
     * @return void
     * @throws \PhpYacc\Exception\LexingException
     * @throws \PhpYacc\Exception\LogicException
     * @throws \PhpYacc\Exception\ParseException
     * @throws \PhpYacc\Exception\TemplateException
     */
    public function saveTo(string $className, string $path)
    {
        $context = new Context();
        $context->className = $className;

        $generator = new YaccGenerator();
        $generator->generate($context, $this->grammar, $this->skeleton, $path);
    }
}
