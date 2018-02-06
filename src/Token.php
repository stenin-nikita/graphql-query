<?php
/**
 * This file is part of GraphQLQuery package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Stenin\GraphQLQuery;

/**
 * Class Tokens
 */
class Token
{
    public const LIST = [
        'T_QUERY' => [
            'query\\b',
            true,
        ],
        'T_MUTATION' => [
            'mutation\\b',
            true,
        ],
        'T_SUBSCRIPTION' => [
            'subscription\\b',
            true,
        ],
        'T_FRAGMENT' => [
            'fragment\\b',
            true,
        ],
        'T_NON_NULL' => [
            '!',
            true,
        ],
        'T_VAR' => [
            '\\$',
            true,
        ],
        'T_PARENTHESIS_OPEN' => [
            '\\(',
            true,
        ],
        'T_PARENTHESIS_CLOSE' => [
            '\\)',
            true,
        ],
        'T_THREE_DOTS' => [
            '\\.\\.\\.',
            true,
        ],
        'T_COLON' => [
            ':',
            true,
        ],
        'T_EQUAL' => [
            '=',
            true,
        ],
        'T_DIRECTIVE_AT' => [
            '@',
            true,
        ],
        'T_BRACKET_OPEN' => [
            '\\[',
            true,
        ],
        'T_BRACKET_CLOSE' => [
            '\\]',
            true,
        ],
        'T_BRACE_OPEN' => [
            '{',
            true,
        ],
        'T_BRACE_CLOSE' => [
            '}',
            true,
        ],
        'T_ON' => [
            'on\\b',
            true,
        ],
        'T_NUMBER_VALUE' => [
            '\\-?(0|[1-9][0-9]*)(\\.[0-9]+)?([eE][\\+\\-]?[0-9]+)?\\b',
            true,
        ],
        'T_BOOL_TRUE' => [
            'true\\b',
            true,
        ],
        'T_BOOL_FALSE' => [
            'false\\b',
            true,
        ],
        'T_NULL' => [
            'null\\b',
            true,
        ],
        'T_MULTILINE_STRING' => [
            '"""(?:\\\\"""|(?!""").|\\s)+"""',
            true,
        ],
        'T_STRING' => [
            '"[^"\\\\]+(\\\\.[^"\\\\]*)*"',
            true,
        ],
        'T_DIRECTIVE' => [
            'directive\\b',
            true,
        ],
        'T_NAME' => [
            '([_A-Za-z][_0-9A-Za-z]*)',
            true,
        ],
        'T_WHITESPACE' => [
            '[\\xfe\\xff|\\x20|\\x09|\\x0a|\\x0d]+',
            false,
        ],
        'T_COMMENT' => [
            '#[^\\n]*',
            false,
        ],
        'T_COMMA' => [
            ',',
            false,
        ],
    ];
}