<?php

namespace PhantomPdf;

class Options
{
    const ORIENTATION_PORTRAIT = 'portrait';
    const ORIENTATION_LANDSCAPE = 'landscape';

    /**
     * @var string
     */
    private $format = 'A4';

    /**
     * @var string
     */
    private $orientation = self::ORIENTATION_PORTRAIT;

    /**
     * @var array
     */
    private $customHeaders;

    /**
     * @var int
     */
    private $zoomFactor = 1;

    /**
     * @var string
     */
    private $margin;

    /**
     * @var string
     */
    private $headerContent;

    /**
     * @var string
     */
    private $headerHeight;

    /**
     * @var string
     */
    private $footerContent;

    /**
     * @var string
     */
    private $footerHeight;

    /**
     * @var string
     */
    private $pageNumPlaceholder;

    /**
     * @var string
     */
    private $totalPagesPlaceholder;

    /**
     * @return array
     */
    public function toArray()
    {
        $classVars = get_object_vars($this);

        foreach ($classVars as $key => $value) {
            if ($value === null) {
                unset($classVars[$key]);
            }
        }

        return $classVars;
    }

    /**
     * @param string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    public function setOrientationPortrait()
    {
        $this->orientation = self::ORIENTATION_PORTRAIT;
    }

    public function setOrientationLandscape()
    {
        $this->orientation = self::ORIENTATION_LANDSCAPE;
    }

    /**
     * @param array $customHeaders
     */
    public function setCustomHeaders(array $customHeaders)
    {
        $this->customHeaders = $customHeaders;
    }

    /**
     * @param int $zoomFactor
     */
    public function setZoomFactor($zoomFactor)
    {
        $this->zoomFactor = $zoomFactor;
    }

    /**
     * @param int $width
     * @param string $unit
     */
    public function setMargin($width, $unit = 'cm')
    {
        $this->margin = $width . $unit;
    }

    /**
     * @param string $headerContent
     */
    public function setHeaderContent($headerContent)
    {
        $this->headerContent = $headerContent;
    }

    /**
     * @param int $width
     * @param string $unit
     */
    public function setHeaderHeight($width, $unit = 'cm')
    {
        $this->headerHeight = $width . $unit;
    }

    /**
     * @param string $footerContent
     */
    public function setFooterContent($footerContent)
    {
        $this->footerContent = $footerContent;
    }

    /**
     * @param int $width
     * @param string $unit
     */
    public function setFooterHeight($width, $unit = 'cm')
    {
        $this->footerHeight = $width . $unit;
    }

    /**
     * @param string $pageNumPlaceholder
     */
    public function setPageNumPlaceholder($pageNumPlaceholder)
    {
        $this->pageNumPlaceholder = $pageNumPlaceholder;
    }

    /**
     * @param string $totalPagesPlaceholder
     */
    public function setTotalPagesPlaceholder($totalPagesPlaceholder)
    {
        $this->totalPagesPlaceholder = $totalPagesPlaceholder;
    }
}
