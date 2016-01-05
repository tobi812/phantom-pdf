<?php

namespace PhantomPdf;

use Symfony\Component\Process\Exception\RuntimeException;
use Symfony\Component\Process\Process;

class PdfGenerator
{
    const HTML_EXTENSION = 'html';
    const PDF_EXTENSION = 'pdf';

    /**
     * @var string
     */
    private $binaryPath;

    /**
     * @var int
     */
    private $timeout = null;

    /**
     * @var string
     */
    private $tempDirectory;

    /**
     * @var array
     */
    private $tempFiles = [];

    /**
     * @var array
     */
    private $commandLineOptions;

    /**
     * @param string $html
     * @param string $targetPath
     * @param array|Options|null options
     */
    public function renderFileFromHtml($html, $targetPath, $options = null)
    {
        $tmpFilePath = $this->createTempFilePath(self::HTML_EXTENSION);
        $this->createFile($html, $tmpFilePath);

        $prepareOptions = $this->prepareOptions($options);

        $this->convertToPdf($tmpFilePath, $targetPath, $prepareOptions);
    }

    /**
     * @param string $html
     * @param array|Options|null options
     *
     * @return string
     */
    public function renderOutputFromHtml($html, $options = null)
    {
        $tmpHtmlFilePath = $this->createTempFilePath(self::HTML_EXTENSION);
        $this->createFile($html, $tmpHtmlFilePath);

        $tmpPdfFilePath = $this->createTempFilePath(self::PDF_EXTENSION);
        $this->convertToPdf($tmpHtmlFilePath, $tmpPdfFilePath, $options);

        return file_get_contents($tmpPdfFilePath);
    }

    public function __destruct()
    {
        foreach ($this->tempFiles as $tempFile) {
            if (file_exists($tempFile)) {
                unlink($tempFile);
            }
        }
    }

    /**
     * @param string $binaryPath
     */
    public function setBinaryPath($binaryPath)
    {
        $this->binaryPath = $binaryPath;
    }

    /**
     * @param $commandLineOption
     */
    public function setCommandLineOption($commandLineOption)
    {
        $this->commandLineOptions[] = $commandLineOption;
    }

    /**
     * @param array $commandLineOptions
     */
    public function setCommandLineOptions(array $commandLineOptions)
    {
        foreach ($commandLineOptions as $commandLineOption) {
            $this->setCommandLineOption($commandLineOption);
        }
    }

    /**
     * @param string $content
     * @param string $filePath
     */
    protected function createFile($content, $filePath)
    {
        file_put_contents($content, $filePath);
    }

    /**
     * @param $extension
     *
     * @return string
     */
    protected function createTempFilePath($extension)
    {
        $tempDirectory = $this->getTempDirectory();
        $uniqueId = uniqid('phantom-pdf', true);

        $filePath = sprintf(
            '%s/%s.%s',
            [
                $tempDirectory,
                $uniqueId,
                $extension
            ]
        );

        $this->tempFiles[] = $filePath;

        return $filePath;
    }

    /**
     * @param null $options
     *
     * @return array|null
     */
    protected function prepareOptions($options = null)
    {
        if (is_array($options)) {
            return $options;
        } elseif ($options instanceof Options) {
            return $options->toArray();
        } else {
            $defaultOptions = $this->getDefaultOptions();

            return $defaultOptions->toArray();
        }
    }

    /**
     * @param string $resourcePath
     * @param string $targetPath
     * @param array $options
     */
    protected function convertToPdf($resourcePath, $targetPath, array $options)
    {
        $command = $this->createCommand($resourcePath, $targetPath, $options);
        $process = new Process($command);

        if ($this->timeout !== null) {
            $process->setTimeout($this->timeout);
        }

        $process->run();
    }

    /**
     * @param string $resourcePath
     * @param string $targetPath
     *
     * @return string
     */
    protected function createCommand($resourcePath, $targetPath, $options)
    {
        $commandLineOptions = implode(' ', $this->commandLineOptions);
        $encodedOptions = escapeshellarg(json_decode($options));

        return implode(' ', [
            $this->binaryPath,
            $commandLineOptions,
            '../js/phantom-pdf.js',
            $resourcePath,
            $targetPath,
            $encodedOptions
        ]);
    }

    /**
     * @return string
     */
    protected function getTempDirectory()
    {
        if ($this->tempDirectory === null) {
            $this->tempDirectory = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'phantom-pdf';
        }

        if (!is_dir($this->tempDirectory)) {
            mkdir($this->tempDirectory);
        }

        return $this->tempDirectory;
    }

    /**
     * @return Options
     */
    protected function getDefaultOptions()
    {
        $defaultOptions = new Options();

        $defaultOptions->setOrientation('Portrait');
        $defaultOptions->setFormat('A4');
        $defaultOptions->setZoomFactor(1);
        $defaultOptions->setMargin('1cm');

        return $defaultOptions;
    }

}