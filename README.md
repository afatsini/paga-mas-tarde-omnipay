Omnipay: Paga+Tarde
===============

**[Paga+Tarde](http://docs.pagamastarde.com/)  driver for the Omnipay PHP payment processing library**

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements [Paga+Tarde](http://docs.pagamastarde.com/) support for Omnipay.

Installation
------------

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it to your `composer.json` file:

```
composer require ebisbe/paga-mas-tarde-omnipay
```


Basic Usage
-----------

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

Aditional Parameter
-----------

If you want to avoid having to multiply the value by 100 just add a new parameter ( multiply=true ) to the purchase function. 
