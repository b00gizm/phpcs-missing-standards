phpcs-missing-standards
=======================

b00giZm's missing standards for PHP_CodeSniffer
-----------------------------------------------

**Contents**

* **Symfony1** Coding standards defined for symfony 1.x (as seen at [symfony Wiki](http://trac.symfony-project.org/wiki/HowToContributeToSymfony#CodingStandards))

**Requirements**

* PHP Version 5.1.2 or greater
* A working installation of [PHP_Sniffer](http://pear.php.net/package/PHP_CodeSniffer). You can install it via **PEAR**:

    `pear install PHP_CodeSniffer`
    
**Installation**

    $ mkdir -p /path/to/phpcs-missing-standards
    
    $ cd /path/to/phpcs-missing-standards
    
    $ git clone git://github.com/b00giZm/phpcs-missing-standards.git
    
    $ ln -s /path/to/phpcs-missing-standards/src/<StandardName> /path/to/PHP/CodeSniffer/Standards/<StandardName>
    
**Usage**

    $ phpcs --standard=<StandardName> /path/to/FileToSniff.php
