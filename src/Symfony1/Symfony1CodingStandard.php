<?php

/**
 * Symfony 1.x Coding Standards
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Pascal Cremer <b00gizm@gmail.com>
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
 
if (class_exists('PHP_CodeSniffer_Standards_CodingStandard', true) === false) {
     throw new PHP_CodeSniffer_Exception('Class PHP_CodeSniffer_Standards_CodingStandard not found');
}

/**
 * Symfony 1.x Coding Standards
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Pascal Cremer <b00gizm@gmail.com>
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
 
class PHP_CodeSniffer_Standards_Symfony1_Symfony1CodingStandard extends PHP_CodeSniffer_Standards_CodingStandard
{
  /**
   * Return a list of external sniffs to include with this standard.
   *
   * @return array
   */
  public function getIncludedSniffs()
  {
    return array(
            'Generic/Sniffs/Functions/OpeningFunctionBraceBsdAllmanSniff.php',
            'Generic/Sniffs/NamingConventions/ConstructorNameSniff.php',
            'Generic/Sniffs/PHP/DisallowShortOpenTagSniff.php',
            'Generic/Sniffs/PHP/LowerCaseConstantSniff.php',
            'Generic/Sniffs/Whitespace/DisallowTabIndentSniff.php',
           );  
  }
}
