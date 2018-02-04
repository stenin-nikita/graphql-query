<?php
/**
 * This file is part of PhpStorm package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Stenin\GraphQLQuery;

/**
 * Class AbstractParser
 */
abstract class AbstractParser
{
    protected $_tokens = [
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

    /**
     * @var int
     */
    const SYMBOL_NONE = -1;

    /**
     * @var int
     */
    protected $tokenToSymbolMapSize;

    /**
     * @var int
     */
    protected $actionTableSize;

    /**
     * @var int
     */
    protected $gotoTableSize;

    /**
     * @var int
     */
    protected $invalidSymbol;

    /**
     * @var int
     */
    protected $errorSymbol;

    /**
     * @var int
     */
    protected $defaultAction;

    /**
     * @var int
     */
    protected $unexpectedTokenRule;

    /**
     * @var int
     */
    protected $YY2TBLSTATE;

    /**
     * @var int
     */
    protected $numNonLeafStates;

    /**
     * @var array
     */
    protected $symbolToName;

    /**
     * @var array
     */
    protected $productions;

    /**
     * @var array
     */
    protected $tokenToSymbol;

    /**
     * @var array
     */
    protected $action;

    /**
     * @var array
     */
    protected $actionCheck;

    /**
     * @var array
     */
    protected $actionBase;

    /**
     * @var array
     */
    protected $actionDefault;

    /**
     * @var array
     */
    protected $goto;

    /**
     * @var array
     */
    protected $gotoCheck;

    /**
     * @var array
     */
    protected $gotoBase;

    /**
     * @var array
     */
    protected $gotoDefault;

    /**
     * @var array
     */
    protected $ruleToNonTerminal;

    /**
     * @var array
     */
    protected $ruleToLength;

    /**
     * @var array
     */
    protected $tokens;

    /**
     * @var mixed
     */
    protected $semValue;

    /**
     * @var array
     */
    protected $semStack;

    /**
     * @var array
     */
    protected $startAttributeStack;

    /**
     * @var array
     */
    protected $endAttributeStack;

    /**
     * @var array
     */
    protected $endAttributes;

    /**
     * @var array
     */
    protected $lookaheadStartAttributes;

    /**
     * @var int
     */
    protected $errorState;

    /**
     * @var array
     */
    protected $reduceCallbacks;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $tokenValue;

    /**
     * AbstractParser constructor.
     */
    public function __construct()
    {
        $this->initReduceCallbacks();
    }

    /**
     * @return void
     */
    abstract protected function initReduceCallbacks();

    /**
     * @return int
     */
    abstract protected function lex(): int;

    /**
     * @param string $code
     * @return mixed
     * @throws \Exception
     */
    public function parse(string $code) {
        $this->code = $code;
        return $this->doParse();
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    protected function doParse()
    {
        $this->semStack = [];
        $stateStack = [];

        $state = 0;
        $symbol = -1;

        $stackPos = 0;
        $stateStack[$stackPos] = 0;
        $this->errorState = 0;

        while (true) {
            $this->traceNewState($state, $symbol);
            if ($this->actionBase[$state] == 0) {
                $rule = $this->actionDefault[$state];
            } else {
                if ($symbol < 0) {
                    if (($symbol = $this->lex()) <= 0) {
                        $symbol = 0;
                    }
                    $symbol = $symbol < $this->tokenToSymbolMapSize ? $this->tokenToSymbol[$symbol] : $this->invalidSymbol;
                    $this->traceRead($symbol);
                }

                if ((($rule = $this->actionBase[$state] + $symbol) >= 0 && $rule < $this->actionTableSize && $this->actionCheck[$rule] == $symbol || ($state < $this->YY2TBLSTATE && ($rule = $this->actionBase[$state + $this->numNonLeafStates] + $symbol) >= 0 && $rule < $this->actionTableSize && $this->actionCheck[$rule] == $symbol)) && ($rule = $this->action[$rule]) != $this->defaultAction) {
                    /*
                     * >= YYNLSTATE: shift and reduce
                     * > 0: shift
                     * = 0: accept
                     * < 0: reduce
                     * = -$this->unexpectedTokenRule: error
                     */
                    if ($rule > 0) {
                        /* shift */
                        $this->traceShift($symbol);

                        ++$stackPos;
                        $stateStack[$stackPos] = $state = $rule;
                        $this->semStack[$stackPos] = $this->tokenValue;

                        $symbol = self::SYMBOL_NONE;

                        if ($this->errorState > 0) {
                            $this->errorState--;
                        }

                        if ($rule < $this->numNonLeafStates) {
                            continue;
                        }

                        /* $rule >= $this->numNonLeafStates means shift-and-reduce */
                        $rule -= $this->numNonLeafStates;
                    } else {
                        $rule = -$rule;
                    }
                } else {
                    $rule = $this->actionDefault[$state];
                }
            }

            while (true) {
                /* reduce/error */
                if ($rule == 0) {
                    /* accept */
                    $this->traceAccept();
                    return $this->semValue;
                } else if ($rule != $this->unexpectedTokenRule) {
                    /* reduce */
                    $this->traceReduce($rule);
                    $this->reduceCallbacks[$rule]($stackPos);

                    /* Goto - shift nonterminal */
                    $stackPos -= $this->ruleToLength[$rule];
                    $nonTerminal = $this->ruleToNonTerminal[$rule];
                    $idx = $this->gotoBase[$nonTerminal] + $stateStack[$stackPos];

                    if ($idx >= 0 && $idx < $this->gotoTableSize && $this->gotoCheck[$idx] === $nonTerminal) {
                        $state = $this->goto[$idx];
                    } else {
                        $state = $this->gotoDefault[$nonTerminal];
                    }

                    ++$stackPos;
                    $stateStack[$stackPos] = $state;
                    $this->semStack[$stackPos] = $this->semValue;
                } else {
                    /* error */
                    if ($this->errorState === 0) {
                        throw new \Exception("syntax error");
                    }

                    switch ($this->errorState) {
                        case 1:
                        case 2:
                            $this->errorState = 3;
                            /* Pop until error-expecting state uncovered */

                            while (!(($rule = $this->actionBase[$state] + $this->errorSymbol) >= 0
                                && $rule < $this->actionTableSize && $this->actionCheck[$rule] == $this->errorSymbol
                                || ($state < $this->YY2TBLSTATE
                                    && ($rule = $this->actionBase[$state + $this->numNonLeafStates] + $this->errorSymbol) >= 0
                                    && $rule < $this->actionTableSize && $this->actionCheck[$rule] == $this->errorSymbol))) {
                                if ($stackPos <= 0) {
                                    return 1;
                                }
                                $state = $stateStack[--$stackPos];
                                $this->tracePop($state);
                            }
                            $rule = $this->action[$rule];
                            $this->traceShift($this->errorSymbol);
                            $stateStack[++$stackPos] = $state = $rule;
                            break;

                        case 3:
                            $this->traceDiscard($symbol);
                            if ($symbol == 0) {
                                return 1;
                            }
                            $symbol = -1;
                            break;
                    }
                }

                if ($state < $this->numNonLeafStates) {
                    break;
                }

                /* >= $this->numNonLeafStates means shift-and-reduce */
                $rule = $state - $this->numNonLeafStates;
            }
        }

        throw new \RuntimeException('Reached end of parser loop');
    }

    /*
     * Tracing functions used for debugging the parser.
     */

    protected function traceNewState($state, $symbol) {
        echo '% State ' . $state
            . ', Lookahead ' . ($symbol == self::SYMBOL_NONE ? '--none--' : $this->symbolToName[$symbol]) . "\n";
    }

    protected function traceRead($symbol) {
        echo '% Reading ' . $this->symbolToName[$symbol] . "\n";
    }

    protected function traceShift($symbol) {
        echo '% Shift ' . $this->symbolToName[$symbol] . "\n";
    }

    protected function traceAccept() {
        echo "% Accepted.\n";
    }

    protected function traceReduce($n) {
        echo '% Reduce by (' . $n . ') ' . $this->productions[$n] . "\n";
    }

    protected function tracePop($state) {
        echo '% Recovering, uncovered state ' . $state . "\n";
    }

    protected function traceDiscard($symbol) {
        echo '% Discard ' . $this->symbolToName[$symbol] . "\n";
    }
}
