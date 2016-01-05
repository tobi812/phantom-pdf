<?php

namespace PhantomPdf;

class Options
{

    /**
     * @var string
     */
    private $format;

    /**
     * @var string
     */
    private $orientation;

    /**
     * @var string
     */
    private $customHeaders;

    /**
     * @var string
     */
    private $zoomFactor;

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
        $className = get_class($this);
        $classVars = get_class_vars($className);

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

    /**
     * @param string $orientation
     */
    public function setOrientation($orientation)
    {
        $this->orientation = $orientation;
    }

    /**
     * @param string $customHeaders
     */
    public function setCustomHeaders($customHeaders)
    {
        $this->customHeaders = $customHeaders;
    }

    /**
     * @param string $zoomFactor
     */
    public function setZoomFactor($zoomFactor)
    {
        $this->zoomFactor = $zoomFactor;
    }

    /**
     * @param string $margin
     */
    public function setMargin($margin)
    {
        $this->margin = $margin;
    }

    /**
     * @param string $headerContent
     */
    public function setHeaderContent($headerContent)
    {
        $this->headerContent = $headerContent;
    }

    /**
     * @param string $headerHeight
     */
    public function setHeaderHeight($headerHeight)
    {
        $this->headerHeight = $headerHeight;
    }

    /**
     * @param string $footerContent
     */
    public function setFooterContent($footerContent)
    {
        $this->footerContent = $footerContent;
    }

    /**
     * @param string $footerHeight
     */
    public function setFooterHeight($footerHeight)
    {
        $this->footerHeight = $footerHeight;
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
