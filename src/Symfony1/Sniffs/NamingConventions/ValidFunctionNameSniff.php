<?php

class Symfony1_Sniffs_NamingConventions_ValidFunctionNameSniff extends PHP_CodeSniffer_Standards_AbstractScopeSniff
{
  /**
   * A list of all PHP magic methods.
   *
   * @var array
   */
  protected $magicMethods = array(
                             'construct',
                             'destruct',
                             'call',
                             'callStatic',
                             'get',
                             'set',
                             'isset',
                             'unset',
                             'sleep',
                             'wakeup',
                             'toString',
                             'set_state',
                             'clone',
                            );

  /**
   * A list of all PHP magic functions.
   *
   * @var array
   */
  protected $magicFunctions = array('autoload');
  
  public function __construct()
  {
      parent::__construct(array(T_CLASS, T_INTERFACE), array(T_FUNCTION), true);
  }
  
  protected function processTokenWithinScope(PHP_CodeSniffer_File $phpcsFile, $stackPtr, $currScope)
  {
    $className  = $phpcsFile->getDeclarationName($currScope);
    $methodName = $phpcsFile->getDeclarationName($stackPtr);
    
    // Only magic methods should be prefixed with "__"
    if (preg_match('|^__|', $methodName) !== 0) 
    {
      $magicPart = substr($methodName, 2);
      if (in_array($magicPart, $this->magicMethods) === false) 
      {
        $error = sprintf("Method name \"%s::%s\" is invalid; only PHP magic methods should be prefixed with a double underscore", $className, $methodName);
        $phpcsFile->addError($error, $stackPtr);
      }

      return;
    }
    
    // There should be given a valid scope
    $methodProperties = $phpcsFile->getMethodProperties($stackPtr);
    if ($methodProperties['scope_specified'] !== true)
    {
      $error = sprintf("No scope declaration for method \"%s::%s\" found", $className, $methodName);
      $phpcsFile->addWarning($error, $stackPtr);
      
      return;
    }
    
    // Method names should be camel-cased and not underscored
    if (PHP_CodeSniffer::isCamelCaps($methodName, false, true, false) === false)
    {
      $error = sprintf("Method name \"%s::%s\" is not in camel caps format", $className, $methodName);
      $phpcsFile->addError($error, $stackPtr);
      
      return;
    }
  }
  
  protected function processTokenOutsideScope(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
  {
    $functionName = $phpcsFile->getDeclarationName($stackPtr);
    if ($functionName === null) {
        // Ignore closures.
        return;
    }

    // Only magic methods should be prefixed with "__"
    if (preg_match('|^__|', $functionName) !== 0) 
    {
      $magicPart = substr($methodName, 2);
      if (in_array($magicPart, $this->magicFunctions) === false) 
      {
        $error = sprintf("Function name \"%s\" is invalid; only PHP magic methods should be prefixed with a double underscore", $functionName);
        $phpcsFile->addError($error, $stackPtr);
      }
      
      return;
    }
    
    $underscorePos = strrpos($functionName, '_');
    if ($underscorePos === false)
    {
      // If no underscores were found, the function name must begin lower-case with camel caps
      if ($functionName{0} == strtoupper($functionName{0}))
      {
        $error = sprintf("Function name \"%s\" is not in lower-cased format", $functionName);
        $phpcsFile->addError($error, $stackPtr);

        return;
      }
      
      if (PHP_CodeSniffer::isCamelCaps($functionName, false, true, false) === false)
      {
        $error = sprintf("Function name \"%s\" is not in camel caps format", $functionName);
        $phpcsFile->addError($error, $stackPtr);

        return;
      }
    }
    else
    {
      // Allow underscored function names for symfony <= 1.0
      $parts = explode('_', $functionName);
      
      $validFunctionName = true;
      foreach ($parts as $part)
      {
        if ($part{0} == strtoupper($part{0}))
        {
          $validFunctionName = false;
          continue;
        }
      }
      
      if (!$validFunctionName)
      {
        $error = sprintf("Function name \"%s\" is not in valid. Try \"%s\" instead", $functionName, strtolower($functionName));
        $phpcsFile->addError($error, $stackPtr);

        return;
      }
    }
  }
}
