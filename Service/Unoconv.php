<?php
namespace JMD\UnoconvBundle\Service;

use Monolog\Logger;
use Unoconv\Unoconv as UnoconvBase;

class Unoconv
{
    const PDF = 'pdf';
    const TXT = 'txt';
    const DOCX = 'docx';
    const BIB = 'bib';
    const DOC = 'doc';
    const XML = 'xml';
    const HTML = 'html';
    const ODT = 'odt';
    const OTT = 'ott';
    const PDB = 'pdb';
    const PSW = 'psw';
    const RTF = 'rtf';
    const LATEX = 'ltx';
    const SDW = 'sdw';
    const STW = 'stw';
    const SXW = 'sxw';
    const VOR = 'vor';
    const BMD = 'bmp';
    const EMF = 'emf';
    const EPS = 'eps';
    const GIF = 'gif';
    const JPG = 'jpg';
    const MET = 'met';
    const ODD = 'odd';
    const OTG = 'otg';
    const PBM = 'pbm';
    const PCT = 'pct';
    const PGM = 'pgm';
    const PNG = 'png';
    const PPM = 'ppm';
    const RAS = 'ras';
    const STD = 'std';
    const SVG = 'svg';
    const SVM = 'svm';
    const SWF = 'swf';
    const SXD = 'sxd';
    const TIFF = 'tiff';
    const WMF = 'wmf';
    const XHTML = 'xhtml';
    const XPM = 'xpm';
    const ODG = 'odg';
    const ODP = 'odp';
    const POT = 'pot';
    const PPT = 'ppt';
    const PWP = 'pwp';
    const SDA = 'sda';
    const SDD = 'sdd';
    const STI = 'sti';
    const STP = 'stp';
    const SXI = 'sxi';
    const CSV = 'csv';
    const DBF = 'dbf';
    const DIF = 'dif';
    const ODS = 'ods';
    const PTS = 'pts';
    const PXL = 'pxl';
    const SDC = 'sdc';
    const STC = 'stc';
    const SXC = 'sxc';
    const XLS = 'xls';
    const XLT = 'xlt';

    /**
     * @var UnoconvBase
     */
    private $unoconv;

    /**
     * Unoconv constructor.
     * @param array $options
     * @param Logger $logger
     */
    public function __construct(array $options = [], Logger $logger)
    {
        $this->unoconv = UnoconvBase::create($options, $logger);
    }

    /**
     * @param $inputFile
     * @param $format
     * @param null $outputFile
     * @return \Unoconv\Unoconv
     */
    public function convert($inputFile, $format, $outputFile = null)
    {
        if (null === $outputFile) {
            $outputFile = $inputFile . '.' . $format;
        }

        $converter = $this->transcode($inputFile, $format, $outputFile);
        return $converter;
    }

    /**
     * @param $name
     * @param array $arguments
     * @return \Unoconv\Unoconv
     */
    public function __call($name, array $arguments = [])
    {
        return call_user_func_array([ $this->unoconv, $name ], $arguments);
    }
}