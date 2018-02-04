<?php
/**
 * This file is part of Stenin/GraphQL package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Stenin\GraphQLQuery;

use Railt\Compiler\Lexer;
use Stenin\GraphQLQuery\Ast\Document;
use Stenin\GraphQLQuery\Ast\OperationDefinition;
use Stenin\GraphQLQuery\Ast\Field;
use Stenin\GraphQLQuery\Ast\Argument;
use Stenin\GraphQLQuery\Ast\Directive;
use Stenin\GraphQLQuery\Ast\Variable;
use Stenin\GraphQLQuery\Ast\FragmentDefinition;
use Stenin\GraphQLQuery\Ast\FragmentSpread;
use Stenin\GraphQLQuery\Ast\InlineFragment;


/**
 * This is an automatically GENERATED file, which should not be manually edited.
 *
 * Class QueryParser
 */
class QueryParser extends AbstractParser
{
    /**
     * @var int
     */
    const SYMBOL_NONE = -1;

    /**
     * @var int
     */
    protected $tokenToSymbolMapSize = 281;

    /**
     * @var int
     */
    protected $actionTableSize = 44;

    /**
     * @var int
     */
    protected $gotoTableSize = 48;

    /**
     * @var int
     */
    protected $invalidSymbol = 26;

    /**
     * @var int
     */
    protected $errorSymbol = 1;

    /**
     * @var int
     */
    protected $defaultAction = -32766;

    /**
     * @var int
     */
    protected $unexpectedTokenRule = 32767;

    /**
     * @var int
     */
    protected $YY2TBLSTATE = 20;

    /**
     * @var int
     */
    protected $numNonLeafStates = 54;

    /**
     * @var array
     */
    protected $symbolToName = [
        "EOF",
        "error",
        "T_QUERY",
        "T_MUTATION",
        "T_SUBSCRIPTION",
        "T_FRAGMENT",
        "T_ON",
        "T_NON_NULL",
        "T_VAR",
        "T_PARENTHESIS_OPEN",
        "T_PARENTHESIS_CLOSE",
        "T_THREE_DOTS",
        "T_COLON",
        "T_EQUAL",
        "T_DIRECTIVE_AT",
        "T_BRACKET_OPEN",
        "T_BRACKET_CLOSE",
        "T_BRACE_OPEN",
        "T_BRACE_CLOSE",
        "T_NUMBER_VALUE",
        "T_BOOL_TRUE",
        "T_BOOL_FALSE",
        "T_NULL",
        "T_MULTILINE_STRING",
        "T_STRING",
        "T_NAME"
/* YY:29 */    ];

    /**
     * @var array
     */
    protected $tokenToSymbol = [
            0,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,   26,   26,   26,   26,
           26,   26,   26,   26,   26,   26,    1,    2,    3,    4,
            5,    6,    7,    8,    9,   10,   11,   12,   13,   14,
           15,   16,   17,   18,   19,   20,   21,   22,   23,   24,
           25
/* YY:29 */    ];

    /**
     * @var array
     */
    protected $action = [
           33,   66,   67,   68,   21,    0,   33,   52,  116,   53,
           23,  100,  101,  102,  105,  103,  104,  133,   10,  127,
          128,   80,    2,   46,   49,   69,  -75,  133,    4,    7,
           79,    0,    3,    0,   31,    0,    8,    0,  126,  108,
            0,   44,    0,  111
/* YY:29 */    ];

    /**
     * @var array
     */
    protected $actionCheck = [
            8,    2,    3,    4,    5,    0,    8,   15,   10,   17,
            6,   19,   20,   21,   22,   23,   24,   25,   11,    7,
            7,   10,   12,    9,    9,   18,   17,   25,   12,   12,
           12,   -1,   13,   -1,   14,   -1,   15,   -1,   16,   16,
           -1,   17,   -1,   18
/* YY:29 */    ];

    /**
     * @var array
     */
    protected $actionBase = [
            0,   23,   -8,   -8,   -8,   -1,    7,   21,   21,   14,
            4,   20,   20,   18,   20,   20,   -2,   20,   11,   25,
           24,    2,    2,    2,   15,   15,    4,    2,   24,   20,
           24,    2,   20,    2,   19,    2,    5,    9,   17,   10,
           12,   13,   22,   16,    0,    0,    0,    0,    0,    0,
            0,    0,    0,    0,    0,   -8,    0,    0,    0,   24,
            2,    2,    2,   24,    2,   24,   24,   15,   24,   24,
            0,   24,    2,    2
/* YY:29 */    ];

    /**
     * @var array
     */
    protected $actionDefault = [
            3,32767,32767,32767,32767,    2,32767,32767,32767,   76,
           76,   16,   16,   27,32767,32767,32767,32767,32767,32767,
           76,32767,   80,32767,   27,   27,32767,32767,32767,32767,
        32767,32767,   32,32767,   66,   43,32767,   77,32767,32767,
           68,   69,32767,32767,   18,   76,   63,   76,   76,   29,
           76,   76,   55,   58
/* YY:29 */    ];

    /**
     * @var array
     */
    protected $goto = [
           13,  125,  125,   15,   89,   85,  121,  114,   51,  132,
           42,   78,   39,   43,   38,   89,  135,  125,   26,   90,
           37,   24,   61,    0,   30,   25,   62,  115,    0,  107,
            0,   91,   87,   45,   88,    0,    0,   63,   14,    0,
           32,   17,    0,   11,   12,   64,    0,   65
/* YY:29 */    ];

    /**
     * @var array
     */
    protected $gotoCheck = [
           18,   18,   18,   20,   18,   25,   25,   25,   19,   19,
           42,   13,   18,   18,   29,   18,   18,   18,   26,   28,
           46,   18,    7,   -1,   11,   18,    7,   18,   -1,   18,
           -1,    7,    7,   27,    7,   -1,   -1,    7,   20,   -1,
           20,   20,   -1,   20,   20,    7,   -1,    7
/* YY:29 */    ];

    /**
     * @var array
     */
    protected $gotoBase = [
            0,    0,    0,    0,    0,    0,    0,   17,    0,    0,
            0,    4,    0,   -1,    0,    0,    0,    0,   -6,  -16,
           -7,    0,    0,    0,    0,    3,   -3,    7,   -4,   -2,
            0,    0,    0,    0,    0,    0,    0,    0,    0,    0,
            0,    0,    2,    0,    0,    0,   -9
/* YY:29 */    ];

    /**
     * @var array
     */
    protected $gotoDefault = [
        -32768,   36,   55,    5,   58,   59,   60,   71,   22,    9,
           20,   28,    6,   77,   73,   74,   75,   76,  106,   50,
           29,   27,   82,   18,   84,  110,   47,   48,   40,   92,
           93,   94,   95,   96,   35,   98,   99,    1,   19,  113,
           16,  118,   34,  119,   41,  124,  131
/* YY:29 */    ];

    /**
     * @var array
     */
    protected $ruleToNonTerminal = [
            0,    1,    2,    3,    3,    4,    4,    5,    5,    5,
            5,    5,    8,    8,    8,    7,   13,   13,   12,   12,
           14,   14,   14,   15,   15,   21,   22,   19,   19,   23,
           23,   24,   16,   17,   17,   26,   27,    6,   25,   25,
           25,   25,   25,   25,   25,   25,   30,   32,   32,   31,
           31,   33,   34,   34,   35,   37,   37,   36,   38,   38,
           39,   29,   10,   40,   40,   41,   43,   43,   42,   42,
           42,   28,   44,   45,   45,   11,   20,   20,   46,   18,
            9,    9
/* YY:29 */    ];

    /**
     * @var array
     */
    protected $ruleToLength = [
            1,    1,    1,    0,    2,    1,    1,    1,    3,    4,
            4,    5,    1,    1,    1,    3,    0,    1,    0,    2,
            1,    1,    1,    4,    5,    2,    3,    0,    1,    0,
            2,    3,    3,    3,    4,    1,    2,    5,    1,    1,
            1,    1,    1,    1,    1,    1,    1,    1,    1,    1,
            1,    1,    1,    2,    3,    0,    2,    3,    0,    2,
            3,    2,    3,    0,    2,    4,    0,    2,    1,    1,
            1,    1,    3,    2,    2,    2,    0,    2,    3,    1,
            0,    1
/* YY:29 */    ];

    /**
     * @var array
     */
    protected $productions = array(
        "\$start : start",
        "start : Document",
        "Document : Definitions",
        "Definitions : /* empty */",
        "Definitions : Definitions Definition",
        "Definition : OperationDefinition",
        "Definition : FragmentDefinition",
        "OperationDefinition : SelectionSet",
        "OperationDefinition : OperationType NameOpt SelectionSet",
        "OperationDefinition : OperationType NameOpt VariableDefinitions SelectionSet",
        "OperationDefinition : OperationType NameOpt Directives SelectionSet",
        "OperationDefinition : OperationType NameOpt VariableDefinitions Directives SelectionSet",
        "OperationType : T_QUERY",
        "OperationType : T_MUTATION",
        "OperationType : T_SUBSCRIPTION",
        "SelectionSet : T_BRACE_OPEN SelectionList T_BRACE_CLOSE",
        "SelectionSetOpt : /* empty */",
        "SelectionSetOpt : SelectionSet",
        "SelectionList : /* empty */",
        "SelectionList : SelectionList Selection",
        "Selection : Field",
        "Selection : FragmentSpread",
        "Selection : InlineFragment",
        "Field : Name ArgumentsOpt DirectivesOpt SelectionSetOpt",
        "Field : Alias Name ArgumentsOpt DirectivesOpt SelectionSetOpt",
        "Alias : Name T_COLON",
        "Arguments : T_PARENTHESIS_OPEN ArgumentsList T_PARENTHESIS_CLOSE",
        "ArgumentsOpt : /* empty */",
        "ArgumentsOpt : Arguments",
        "ArgumentsList : /* empty */",
        "ArgumentsList : ArgumentsList Argument",
        "Argument : Name T_COLON Value",
        "FragmentSpread : T_THREE_DOTS FragmentName DirectivesOpt",
        "InlineFragment : T_THREE_DOTS DirectivesOpt SelectionSet",
        "InlineFragment : T_THREE_DOTS TypeCondition DirectivesOpt SelectionSet",
        "FragmentName : Name",
        "TypeCondition : T_ON NamedType",
        "FragmentDefinition : T_FRAGMENT FragmentName TypeCondition DirectivesOpt SelectionSet",
        "Value : Variable",
        "Value : Number",
        "Value : String",
        "Value : Boolean",
        "Value : Nullable",
        "Value : Enum",
        "Value : List",
        "Value : Object",
        "Number : T_NUMBER_VALUE",
        "Boolean : T_BOOL_TRUE",
        "Boolean : T_BOOL_FALSE",
        "String : T_MULTILINE_STRING",
        "String : T_STRING",
        "Nullable : T_NULL",
        "Enum : Name",
        "Enum : Enum Name",
        "List : T_BRACKET_OPEN ValueList T_BRACKET_CLOSE",
        "ValueList : /* empty */",
        "ValueList : ValueList Value",
        "Object : T_BRACE_OPEN ObjectFieldList T_BRACE_CLOSE",
        "ObjectFieldList : /* empty */",
        "ObjectFieldList : ObjectFieldList ObjectField",
        "ObjectField : Name T_COLON Value",
        "Variable : T_VAR Name",
        "VariableDefinitions : T_PARENTHESIS_OPEN VariableDefinitionList T_PARENTHESIS_CLOSE",
        "VariableDefinitionList : /* empty */",
        "VariableDefinitionList : VariableDefinitionList VariableDefinition",
        "VariableDefinition : Variable T_COLON Type DefaultValue",
        "DefaultValue : /* empty */",
        "DefaultValue : T_EQUAL Value",
        "Type : NamedType",
        "Type : ListType",
        "Type : NonNullType",
        "NamedType : Name",
        "ListType : T_BRACKET_OPEN Type T_BRACKET_CLOSE",
        "NonNullType : NamedType T_NON_NULL",
        "NonNullType : ListType T_NON_NULL",
        "Directives : DirectivesOpt Directive",
        "DirectivesOpt : /* empty */",
        "DirectivesOpt : DirectivesOpt Directive",
        "Directive : T_DIRECTIVE_AT Name ArgumentsOpt",
        "Name : T_NAME",
        "NameOpt : /* empty */",
        "NameOpt : Name"
/* YY:29 */    );

    /**
     * @var array
     */
    protected $tokens = [
        'YYERRTOK' => 256,
        'T_QUERY' => 257,
        'T_MUTATION' => 258,
        'T_SUBSCRIPTION' => 259,
        'T_FRAGMENT' => 260,
        'T_ON' => 261,
        'T_NON_NULL' => 262,
        'T_VAR' => 263,
        'T_PARENTHESIS_OPEN' => 264,
        'T_PARENTHESIS_CLOSE' => 265,
        'T_THREE_DOTS' => 266,
        'T_COLON' => 267,
        'T_EQUAL' => 268,
        'T_DIRECTIVE_AT' => 269,
        'T_BRACKET_OPEN' => 270,
        'T_BRACKET_CLOSE' => 271,
        'T_BRACE_OPEN' => 272,
        'T_BRACE_CLOSE' => 273,
        'T_NUMBER_VALUE' => 274,
        'T_BOOL_TRUE' => 275,
        'T_BOOL_FALSE' => 276,
        'T_NULL' => 277,
        'T_MULTILINE_STRING' => 278,
        'T_STRING' => 279,
        'T_NAME' => 280,
/* YY:30 */    ];

    /**
     * @var bool
     */
    protected $init = false;

    /**
     * @var Lexer
     */
    protected $lexer;

    /**
     * @return void
     */
    protected function initReduceCallbacks() {
        $this->reduceCallbacks = [
            0 => function ($stackPos) {
                $this->semValue = $this->semStack[$stackPos];
            },
            1 => function ($stackPos) {
                $this->semValue = $this->semStack[$stackPos];
            },
            2 => function ($stackPos) {
/* YY:34 */                 $this->semValue = new Document($this->semStack[$stackPos-(1-1)]); 
            },
            3 => function ($stackPos) {
/* YY:38 */                 $this->semValue = []; 
            },
            4 => function ($stackPos) {
/* YY:39 */                 $this->semValue = $this->append($this->semStack[$stackPos-(2-1)], $this->semStack[$stackPos-(2-2)]); 
            },
            5 => function ($stackPos) {
/* YY:43 */                 $this->semValue = $this->semStack[$stackPos-(1-1)]; 
            },
            6 => function ($stackPos) {
/* YY:44 */                 $this->semValue = $this->semStack[$stackPos-(1-1)]; 
            },
            7 => function ($stackPos) {
/* YY:47 */                 $this->semValue = new OperationDefinition('query', '', $this->semStack[$stackPos-(1-1)]); 
            },
            8 => function ($stackPos) {
/* YY:48 */                 $this->semValue = new OperationDefinition($this->semStack[$stackPos-(3-1)], $this->semStack[$stackPos-(3-2)], $this->semStack[$stackPos-(3-3)]); 
            },
            9 => function ($stackPos) {
/* YY:49 */                 $this->semValue = new OperationDefinition($this->semStack[$stackPos-(4-1)], $this->semStack[$stackPos-(4-2)], $this->semStack[$stackPos-(4-4)], $this->semStack[$stackPos-(4-3)]); 
            },
            10 => function ($stackPos) {
/* YY:50 */                 $this->semValue = new OperationDefinition($this->semStack[$stackPos-(4-1)], $this->semStack[$stackPos-(4-2)], $this->semStack[$stackPos-(4-4)], null, $this->semStack[$stackPos-(4-3)]); 
            },
            11 => function ($stackPos) {
/* YY:51 */                 $this->semValue = new OperationDefinition($this->semStack[$stackPos-(5-1)], $this->semStack[$stackPos-(5-2)], $this->semStack[$stackPos-(5-5)], $this->semStack[$stackPos-(5-3)], $this->semStack[$stackPos-(5-4)]); 
            },
            12 => function ($stackPos) {
                $this->semValue = $this->semStack[$stackPos];
            },
            13 => function ($stackPos) {
                $this->semValue = $this->semStack[$stackPos];
            },
            14 => function ($stackPos) {
                $this->semValue = $this->semStack[$stackPos];
            },
            15 => function ($stackPos) {
/* YY:65 */                 $this->semValue = $this->semStack[$stackPos-(3-2)]; 
            },
            16 => function ($stackPos) {
/* YY:69 */                 $this->semValue = []; 
            },
            17 => function ($stackPos) {
                $this->semValue = $this->semStack[$stackPos];
            },
            18 => function ($stackPos) {
/* YY:74 */                 $this->semValue = []; 
            },
            19 => function ($stackPos) {
/* YY:75 */                 $this->semStack[$stackPos-(2-1)][] = $this->semStack[$stackPos-(2-2)]; $this->semValue = $this->semStack[$stackPos-(2-1)]; 
            },
            20 => function ($stackPos) {
/* YY:79 */                 $this->semValue = $this->semStack[$stackPos-(1-1)]; 
            },
            21 => function ($stackPos) {
/* YY:80 */                 $this->semValue = $this->semStack[$stackPos-(1-1)]; 
            },
            22 => function ($stackPos) {
/* YY:81 */                 $this->semValue = $this->semStack[$stackPos-(1-1)]; 
            },
            23 => function ($stackPos) {
/* YY:89 */                 $this->semValue = new Field($this->semStack[$stackPos-(4-1)], $this->semStack[$stackPos-(4-2)], $this->semStack[$stackPos-(4-3)], $this->semStack[$stackPos-(4-4)]); 
            },
            24 => function ($stackPos) {
/* YY:90 */                 $this->semValue = new Field($this->semStack[$stackPos-(5-2)], $this->semStack[$stackPos-(5-3)], $this->semStack[$stackPos-(5-4)], $this->semStack[$stackPos-(5-5)], $this->semStack[$stackPos-(5-1)]); 
            },
            25 => function ($stackPos) {
/* YY:94 */                 $this->semValue = $this->semStack[$stackPos-(2-1)]; 
            },
            26 => function ($stackPos) {
/* YY:102 */                 $this->semValue = $this->semStack[$stackPos-(3-2)]; 
            },
            27 => function ($stackPos) {
/* YY:106 */                 $this->semValue = []; 
            },
            28 => function ($stackPos) {
                $this->semValue = $this->semStack[$stackPos];
            },
            29 => function ($stackPos) {
/* YY:111 */                 $this->semValue = []; 
            },
            30 => function ($stackPos) {
/* YY:112 */                 $this->semStack[$stackPos-(2-1)][$this->semStack[$stackPos-(2-2)]->getName()] = $this->semStack[$stackPos-(2-2)]; $this->semValue = $this->semStack[$stackPos-(2-1)]; 
            },
            31 => function ($stackPos) {
/* YY:116 */                 $this->semValue = new Argument($this->semStack[$stackPos-(3-1)], $this->semStack[$stackPos-(3-3)]); 
            },
            32 => function ($stackPos) {
/* YY:124 */                 $this->semValue = new FragmentSpread($this->semStack[$stackPos-(3-2)], $this->semStack[$stackPos-(3-3)]); 
            },
            33 => function ($stackPos) {
/* YY:128 */                 $this->semValue = new InlineFragment($this->semStack[$stackPos-(3-3)], $this->semStack[$stackPos-(3-2)]); 
            },
            34 => function ($stackPos) {
/* YY:129 */                 $this->semValue = new InlineFragment($this->semStack[$stackPos-(4-4)], $this->semStack[$stackPos-(4-3)], $this->semStack[$stackPos-(4-2)]); 
            },
            35 => function ($stackPos) {
                $this->semValue = $this->semStack[$stackPos];
            },
            36 => function ($stackPos) {
/* YY:137 */                 $this->semValue = $this->semStack[$stackPos-(2-2)]; 
            },
            37 => function ($stackPos) {
/* YY:141 */                 $this->semValue = new FragmentDefinition($this->semStack[$stackPos-(5-2)], $this->semStack[$stackPos-(5-3)], $this->semStack[$stackPos-(5-5)], $this->semStack[$stackPos-(5-4)]); 
            },
            38 => function ($stackPos) {
                $this->semValue = $this->semStack[$stackPos];
            },
            39 => function ($stackPos) {
                $this->semValue = $this->semStack[$stackPos];
            },
            40 => function ($stackPos) {
                $this->semValue = $this->semStack[$stackPos];
            },
            41 => function ($stackPos) {
                $this->semValue = $this->semStack[$stackPos];
            },
            42 => function ($stackPos) {
                $this->semValue = $this->semStack[$stackPos];
            },
            43 => function ($stackPos) {
                $this->semValue = $this->semStack[$stackPos];
            },
            44 => function ($stackPos) {
                $this->semValue = $this->semStack[$stackPos];
            },
            45 => function ($stackPos) {
                $this->semValue = $this->semStack[$stackPos];
            },
            46 => function ($stackPos) {
/* YY:160 */                 $this->semValue = $this->semStack[$stackPos-(1-1)] + 0; 
            },
            47 => function ($stackPos) {
/* YY:164 */                 $this->semValue = true; 
            },
            48 => function ($stackPos) {
/* YY:165 */                 $this->semValue = false; 
            },
            49 => function ($stackPos) {
/* YY:169 */                 $this->semValue = \mb_substr($this->semStack[$stackPos-(1-1)], 3, -3); 
            },
            50 => function ($stackPos) {
/* YY:170 */                 $this->semValue = \mb_substr($this->semStack[$stackPos-(1-1)], 1, -1); 
            },
            51 => function ($stackPos) {
/* YY:174 */                 $this->semValue = null; 
            },
            52 => function ($stackPos) {
/* YY:178 */                 $this->semValue = $this->semStack[$stackPos-(1-1)]; 
            },
            53 => function ($stackPos) {
/* YY:179 */                 $this->semValue = $this->semStack[$stackPos-(2-2)]; 
            },
            54 => function ($stackPos) {
/* YY:187 */                 $this->semValue = $this->semStack[$stackPos-(3-2)]; 
            },
            55 => function ($stackPos) {
/* YY:191 */                 $this->semValue = []; 
            },
            56 => function ($stackPos) {
/* YY:192 */                 $this->semStack[$stackPos-(2-1)][] = $this->semStack[$stackPos-(2-2)]; $this->semValue = $this->semStack[$stackPos-(2-1)]; 
            },
            57 => function ($stackPos) {
/* YY:200 */                 $this->semValue = $this->semStack[$stackPos-(3-2)]; 
            },
            58 => function ($stackPos) {
/* YY:204 */                 $this->semValue = []; 
            },
            59 => function ($stackPos) {
/* YY:205 */                 $this->semStack[$stackPos-(2-1)][$this->semStack[$stackPos-(2-2)][0]] = $this->semStack[$stackPos-(2-2)][1]; $this->semValue = $this->semStack[$stackPos-(2-1)]; 
            },
            60 => function ($stackPos) {
/* YY:208 */                 $this->semValue = [$this->semStack[$stackPos-(3-1)], $this->semStack[$stackPos-(3-3)]]; 
            },
            61 => function ($stackPos) {
/* YY:216 */                 $this->semValue = $this->semStack[$stackPos-(2-1)].$this->semStack[$stackPos-(2-2)]; 
            },
            62 => function ($stackPos) {
/* YY:220 */                 $this->semValue = $this->semStack[$stackPos-(3-2)]; 
            },
            63 => function ($stackPos) {
/* YY:224 */                 $this->semValue = []; 
            },
            64 => function ($stackPos) {
/* YY:225 */                 $this->semStack[$stackPos-(2-1)][] = $this->semStack[$stackPos-(2-2)]; $this->semValue = $this->semStack[$stackPos-(2-1)]; 
            },
            65 => function ($stackPos) {
/* YY:228 */                 $this->semValue = new Variable($this->semStack[$stackPos-(4-1)], $this->semStack[$stackPos-(4-3)], $this->semStack[$stackPos-(4-4)]); 
            },
            66 => function ($stackPos) {
/* YY:232 */                 $this->semValue = null; 
            },
            67 => function ($stackPos) {
/* YY:233 */                 $this->semValue = $this->semStack[$stackPos-(2-2)]; 
            },
            68 => function ($stackPos) {
                $this->semValue = $this->semStack[$stackPos];
            },
            69 => function ($stackPos) {
                $this->semValue = $this->semStack[$stackPos];
            },
            70 => function ($stackPos) {
                $this->semValue = $this->semStack[$stackPos];
            },
            71 => function ($stackPos) {
                $this->semValue = $this->semStack[$stackPos];
            },
            72 => function ($stackPos) {
/* YY:251 */                 $this->semValue = $this->semStack[$stackPos-(3-2)]; 
            },
            73 => function ($stackPos) {
/* YY:255 */                 $this->semValue = $this->semStack[$stackPos-(2-1)]; 
            },
            74 => function ($stackPos) {
/* YY:256 */                 $this->semValue = $this->semStack[$stackPos-(2-1)]; 
            },
            75 => function ($stackPos) {
/* YY:264 */                 $this->semStack[$stackPos-(2-1)][] = $this->semStack[$stackPos-(2-2)]; $this->semValue = $this->semStack[$stackPos-(2-1)]; 
            },
            76 => function ($stackPos) {
/* YY:268 */                 $this->semValue = []; 
            },
            77 => function ($stackPos) {
/* YY:269 */                 $this->semStack[$stackPos-(2-1)][] = $this->semStack[$stackPos-(2-2)]; $this->semValue = $this->semStack[$stackPos-(2-1)]; 
            },
            78 => function ($stackPos) {
/* YY:273 */                 $this->semStack[$stackPos-(3-1)][] = $this->semStack[$stackPos-(3-2)]; $this->semValue = $this->semStack[$stackPos-(3-1)]; 
            },
            79 => function ($stackPos) {
/* YY:281 */                 $this->semValue = $this->semStack[$stackPos-(1-1)]; 
            },
            80 => function ($stackPos) {
/* YY:285 */                 $this->semValue = ''; 
            },
            81 => function ($stackPos) {
/* YY:286 */                 $this->semValue = $this->semStack[$stackPos-(1-1)]; 
            },
/* YY:31 */        ];
    }

    /**
     * @return int
     * @throws \Exception
     */
    protected function lex(): int
    {
        if (! $this->init) {
            $this->init = true;
            $lexer = new \Railt\Compiler\Lexer($this->code, $this->_tokens);
            $this->lexer = $lexer->getIterator();
        }

        $current = $this->lexer->current();

        if (isset($this->tokens[$current['token']])) {
            $this->tokenValue = $current['value'];
            $ret = $this->tokens[$current['token']];
        } elseif ($current['token'] === 'EOF') {
            $this->tokenValue = "\0";
            $ret = 0;
        } else {
            throw new \Exception('Unexpected token');
        }

        $this->lexer->next();

        return $ret;
    }

    private function append($first, $second)
    {
        $first[] = $second;
        return $first;
    }
}
/* YY:31 */