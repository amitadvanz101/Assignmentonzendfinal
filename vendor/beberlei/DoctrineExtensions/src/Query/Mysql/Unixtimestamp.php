<?php
namespace DoctrineExtensions\Query\Mysql;

use Doctrine\ORM\Query\AST\Functions\FunctionNode,
    Doctrine\ORM\Query\Lexer;

/**
 * @author Navin Bhandari <navinbhandari7@gmail.com>
 * Created At : 28-10-2016
 * Descriptiopn: get unix_timestamp No. from date
 * return Int
 */
class Unixtimestamp extends FunctionNode
{
    public $date;

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return "UNIX_TIMESTAMP(" . $sqlWalker->walkArithmeticPrimary($this->date) . ")";
    }

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        $this->date = $parser->ArithmeticPrimary();

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
