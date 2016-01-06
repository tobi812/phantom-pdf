# phantom-pdf

## Requirements

PHP 5.4

symfony/process: ~2.6.9

## Installation

Download PhantomJS: http://phantomjs.org/download.html

Update Composer

## Basic Usage


```php

<?php

use PhantomPdf/PdfGenerator;

$pdfGenerator = new PdfGenerator('/path/to/phantomjs-binary');

$htmlString = '<h1>Test Pdf</h1>';
$targetPath = '/path/to/target-file';

$pdfGenerator->renderFileFromHtml($htmlString, $targetPath);


```

Note: Right now it is only possible to build Pdf-Files from raw html-strings!


## Advanced Usage

### Page options:

```php

<?php

use PhantomPdf/PdfGenerator;

$pdfGenerator = new PdfGenerator('/path/to/phantomjs-binary');

$options = new Options();

// Setup Page options
$options->setMargin('1.5cm');
$options->setOrientation('portrait');
$options->setFormat('A5');

$pdfGenerator->renderFileFromHtml($htmlString, $targetPath, $options);

```

### Header & Footer

```php

<?php

// Create a Header that appears on every page.
$options->setHeaderContent('<h1>Header</h1>');
$options->setHeaderHeight('3cm');

// Create a Footer for every page. 
$options->setFooterContent('<div>#pageNum / #totalPages</div>');
$options->setFooterHeight('2cm');

// Use custom Placeholder for PageNumber and TotalPageCount
$options->setPageNumPlaceholder('{{pageNum}}')
$options->setTotalPagesPlaceholder('{{totalPages}}')

```
