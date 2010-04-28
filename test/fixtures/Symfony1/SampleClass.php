<?php

class SampleClass
{
  public function __construct()
  {
  }
  
  public function method()
  {
    // This should pass 
  }
  
  function methodWithMissingScope()
  {
    // This should generate a warning
  }
  
  public function method_with_underscores()
  {
    // This should generate an error
  }
}
