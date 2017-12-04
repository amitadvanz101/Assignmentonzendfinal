<?php
/*
 * Devloped By : Navin Bhandari
 * Created At : 27-09-2016
 * Descriptiopn: type cast in sql query
 */
namespace DoctrineExtensions\Query\Mysql;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

class Cast extends FunctionNode
{
    public $stringPrimary;
    public $str = null;
    
    public function getSql(SqlWalker $sqlWalker)
    {
        $field=$this->stringPrimary->dispatch($sqlWalker);
        $str=trim($this->str->dispatch($sqlWalker),"'");
        return "CAST($field $str)";
    }


    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->stringPrimary = $parser->StringPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->str = $parser->InParameter();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}