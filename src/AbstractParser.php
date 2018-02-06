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
 * Class AbstractParser
 */
abstract class AbstractParser
{
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
        $symbol = self::SYMBOL_NONE;
        $state = 0;
        $stackPos = 0;

        $stateStack = [$state];
        $this->semStack = [];

        $this->errorState = 0;

        for (;;) {
            $this->traceNewState($state, $symbol);
            if ($this->actionBase[$state] === 0) {
                $rule = $this->actionDefault[$state];
            } else {
                if ($symbol === self::SYMBOL_NONE) {
                    $tokenId = $this->lex();

                    $symbol = $tokenId >= 0 && $tokenId < $this->tokenToSymbolMapSize
                        ? $this->tokenToSymbol[$tokenId]
                        : $this->invalidSymbol;

                    if ($symbol === $this->invalidSymbol) {
                        throw new \RangeException(sprintf(
                            'The lexer returned an invalid token (id=%d, value=%s)',
                            $tokenId, $this->tokenValue
                        ));
                    }

                    $this->traceRead($symbol);
                }

                $idx = $this->actionBase[$state] + $symbol;
                if ((($idx >= 0 && $idx < $this->actionTableSize && $this->actionCheck[$idx] === $symbol)
                        || ($state < $this->YY2TBLSTATE
                            && ($idx = $this->actionBase[$state + $this->numNonLeafStates] + $symbol) >= 0
                            && $idx < $this->actionTableSize && $this->actionCheck[$idx] === $symbol))
                    && ($action = $this->action[$idx]) !== $this->defaultAction) {

                    if ($action > 0) {
                        $this->traceShift($symbol);

                        ++$stackPos;
                        $stateStack[$stackPos] = $state = $action;
                        $this->semStack[$stackPos] = $this->tokenValue;

                        $symbol = self::SYMBOL_NONE;

                        if ($this->errorState) {
                            --$this->errorState;
                        }

                        if ($action < $this->numNonLeafStates) {
                            continue;
                        }

                        $rule = $action - $this->numNonLeafStates;
                    } else {
                        $rule = -$action;
                    }
                } else {
                    $rule = $this->actionDefault[$state];
                }
            }
            for (;;) {
                if ($rule === 0) {
                    $this->traceAccept();
                    return $this->semValue;
                } elseif ($rule !== $this->unexpectedTokenRule) {
                    $this->traceReduce($rule);

                    try {
                        $this->reduceCallbacks[$rule]($stackPos);
                    } catch (\Exception $e) {
                        throw $e;
                    }

                    $stackPos -= $this->ruleToLength[$rule];
                    $nonTerminal = $this->ruleToNonTerminal[$rule];
                    $idx = $this->gotoBase[$nonTerminal] + $stateStack[$stackPos];

                    if ($idx >= 0 && $idx < $this->gotoTableSize && $this->gotoCheck[$idx] === $nonTerminal) {
                        $state = $this->goto[$idx];
                    } else {
                        $state = $this->gotoDefault[$nonTerminal];
                    }

                    ++$stackPos;
                    $stateStack[$stackPos]     = $state;
                    $this->semStack[$stackPos] = $this->semValue;
                } else {
                    switch ($this->errorState) {
                        case 0:
                            throw new \Exception($this->getErrorMessage($symbol, $state));
                            // Break missing intentionally
                        case 1:
                        case 2:
                            $this->errorState = 3;

                            while (!(
                                    (($idx = $this->actionBase[$state] + $this->errorSymbol) >= 0
                                        && $idx < $this->actionTableSize && $this->actionCheck[$idx] === $this->errorSymbol)
                                    || ($state < $this->YY2TBLSTATE
                                        && ($idx = $this->actionBase[$state + $this->numNonLeafStates] + $this->errorSymbol) >= 0
                                        && $idx < $this->actionTableSize && $this->actionCheck[$idx] === $this->errorSymbol)
                                ) || ($action = $this->action[$idx]) === $this->defaultAction) {
                                if ($stackPos <= 0) {
                                    return null;
                                }
                                $state = $stateStack[--$stackPos];
                                $this->tracePop($state);
                            }
                            $this->traceShift($this->errorSymbol);
                            ++$stackPos;
                            $stateStack[$stackPos] = $state = $action;
                            break;
                        case 3:
                            if ($symbol === 0) {
                                return null;
                            }
                            $this->traceDiscard($symbol);
                            $symbol = self::SYMBOL_NONE;
                            break 2;
                    }
                }
                if ($state < $this->numNonLeafStates) {
                    break;
                }

                $rule = $state - $this->numNonLeafStates;
            }
        }

        throw new \RuntimeException('Reached end of parser loop');
    }

    /**
     * @param int $symbol
     * @param int $state
     * @return string
     */
    private function getErrorMessage(int $symbol, int $state) : string
    {
        $expectedString = '';

        if ($expected = $this->getExpectedTokens($state)) {
            $expectedString = ', expecting ' . \implode(' or ', $expected);
        }

        return 'Syntax error, unexpected ' . $this->symbolToName[$symbol] . $expectedString;
    }

    /**
     * @param int $state
     * @return string[]
     */
    private function getExpectedTokens(int $state) : array
    {
        $expected = [];
        $base = $this->actionBase[$state];

        foreach ($this->symbolToName as $symbol => $name) {
            $idx = $base + $symbol;

            if ($idx >= 0 && $idx < $this->actionTableSize && $this->actionCheck[$idx] === $symbol
                || $state < $this->YY2TBLSTATE
                && ($idx = $this->actionBase[$state + $this->numNonLeafStates] + $symbol) >= 0
                && $idx < $this->actionTableSize && $this->actionCheck[$idx] === $symbol
            ) {
                if ($this->action[$idx] !== $this->unexpectedTokenRule
                    && $this->action[$idx] !== $this->defaultAction
                    && $symbol !== $this->errorSymbol
                ) {
                    if (\count($expected) === 4) {
                        return [];
                    }

                    $expected[] = $name;
                }
            }
        }

        return $expected;
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
