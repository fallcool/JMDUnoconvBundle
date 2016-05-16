# JMDUnoconvBundle
This bundle provide gateway near [php-unoconv/php-unoconv](https://github.com/alchemy-fr/PHP-Unoconv) and [symfony 2](http://symfony.com).

## Installation
```bash
composer require jmd/unoconv-bundle
```

```php
// app/AppKernel.php
$bundles = array(
            ...
            new JMD\UnoconvBundle\JMDUnoconvBundle(),
            ...
        );
```

## Configuration
```yaml
jmd_unoconv:
    config:
        timeout: 42
        binaries: /usr/bin/unoconv
```

## Usage
```php
$unoconv = $this->get('jmd_unoconv');
$unoconv->transcode($inputFile, $format, $outputFile);
```
