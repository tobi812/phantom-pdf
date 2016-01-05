# phantom-pdf

## Requirements

PHP 5.4

## Installation

Download PhantomJS: http://phantomjs.org/download.html

Update Composer

## Usage

```php

<?php

use PhantomPdf/PdfGenerator;

$pdfGenerator = new PdfGenerator('/path/to/phantomjs-binary');

$htmlString = "<h1>Test Pdf</h1>";
$targetPath = '/path/to/target-file';

$pdfGenerator->renderFileFromHtml($htmlString, $targetPath);



```
