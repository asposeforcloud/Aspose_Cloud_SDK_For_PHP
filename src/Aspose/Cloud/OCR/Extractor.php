<?php
/**
 * Deals with OCR or HOCR Text extraction from Images.
 */
namespace Aspose\Cloud\OCR;

use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Common\Utils;

class Extractor
{

    /**
     * Extract OCR or HOCR Text from Images.
     *
     * @param string $useDefaultDictionaries Allows to correct text after
     * recognition using default dictionaries.
     * @param string $folder Folder with image to recognize.
     * @param string $language Language of document to recognize.
     * @param integer $rectX
     * @param integer $rectY
     * @param integer $rectWidth
     * @param integer $rectHeight
     *
     * @return object
     */
    public function extractText()
    {
        $numOfArgs = func_get_args();
        switch (count($numOfArgs)) {
            case 1:
                $imageFileName = $numOfArgs[0];
                $strURI = Product::$baseProductUri . '/ocr/' . $imageFileName . '/recognize?useDefaultDictionaries=true';
                $signedURI = Utils::sign($strURI);
                $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
                $json = json_decode($responseStream);
                return $json;
                break;
            case 2:
                $imageFileName = $numOfArgs[0];
                $folder = $numOfArgs[1];
                if ($folder === '' || $folder === null) {
                    $strURI = Product::$baseProductUri . '/ocr/' . $imageFileName . '/recognize';
                } else {
                    $strURI = Product::$baseProductUri . '/ocr/' . $imageFileName . '/recognize?folder=' . $folder;
                }
                $signedURI = Utils::sign($strURI);
                $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
                $json = json_decode($responseStream);
                return $json;
                break;
            case 3:
                $stream = $numOfArgs[0];
                $language = $numOfArgs[1];
                $useDefaultDictionaries = $numOfArgs[2];
                $strURI = Product::$baseProductUri . '/ocr/recognize?language=' . $language . '/recognize' . '&useDefaultDictionaries=';
                $strURI .= ($useDefaultDictionaries) ? 'true' : 'false';
                $signedURI = Utils::sign($strURI);
                $responseStream = Utils::processCommand($signedURI, 'POST', '', $stream);
                $json = json_decode($responseStream);
                return $json;
                break;
            case 4:
                $imageFileName = $numOfArgs[0];
                $folder = $numOfArgs[1];
                $language = $numOfArgs[2];
                $useDefaultDictionaries = $numOfArgs[3];
                if ($folder === '' || $folder === null) {

                    $strURI = Product::$baseProductUri . '/ocr/' . $imageFileName . '/recognize?language=' . $language . '&useDefaultDictionaries=';
                    $strURI .= ($useDefaultDictionaries) ? 'true' : 'false';
                } else {

                    $strURI = Product::$baseProductUri . '/ocr/' . $imageFileName . '/recognize?language=' . $language . '&useDefaultDictionaries=';
                    $strURI .= ($useDefaultDictionaries) ? 'true' : 'false';
                    $strURI .= '&folder=' . $folder;
                }
                $signedURI = Utils::sign($strURI);
                $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
                $json = json_decode($responseStream);
                return $json;
                break;
            case 8:
                $imageFileName = $numOfArgs[0];
                $language = $numOfArgs[1];
                $useDefaultDictionaries = $numOfArgs[2];
                $x = $numOfArgs[3];
                $y = $numOfArgs[4];
                $height = $numOfArgs[5];
                $width = $numOfArgs[6];
                $folder = $numOfArgs[7];
                $strURI = Product::$baseProductUri;
                $strURI .= '/ocr/';
                $strURI .= $imageFileName;
                $strURI .= '/recognize?language=';
                $strURI .= $language;
                $strURI .= (($x >= 0 && $y >= 0 && $width > 0 && $height > 0) ? '&rectX=' . $x . '&rectY=' . $y . '&rectWidth=' . $width . '&rectHeight=' . $height : '');
                $strURI .= '&useDefaultDictionaries=';
                $strURI .= (($useDefaultDictionaries) ? 'true' : 'false');
                $strURI .= (($folder === '') ? '' : '&folder=' . $folder);
                $signedURI = Utils::sign($strURI);
                $responseStream = Utils::processCommand($signedURI, 'GET', '', '');
                $json = json_decode($responseStream);
                return $json;
                break;
            default :
                return 'Wrong numbers of arguments';
                break;
        }
    }

    /**
     * Extract OCR or HOCR Text from Images without using Storage.
     *
     * @param string $localFile Filename of image.
     * @param string $language Language of document to recogniize.
     * @param string $useDefaultDictionaries Allows to correct text after
     * recognition using default dictionaries.
     *
     * @return object
     */
    public function extractTextFromLocalFile($localFile, $language, $useDefaultDictionaries)
    {
        $strURI = Product::$baseProductUri . '/ocr/recognize?language=' . $language . '&useDefaultDictionaries=';
        $strURI .= ($useDefaultDictionaries) ? 'true' : 'false';
        $signedURI = Utils::sign($strURI);
        $stream = file_get_contents($localFile);
        $responseStream = Utils::processCommand($signedURI, 'POST', 'json', $stream);
        $json = json_decode($responseStream);
        return $json;
    }

    /**
     * Extract OCR or HOCR Text from image url.
     *
     * @param string $url URL of the image.
     * @param string $language Language of document to recogniize.
     * @param string $useDefaultDictionaries Allows to correct text after
     * recognition using default dictionaries.
     *
     * @return object
     */
    public function extractTextFromUrl($url, $language, $useDefaultDictionaries)
    {
        $strURI = Product::$baseProductUri . '/ocr/recognize?url=' . $url . '&language=' . $language . '&useDefaultDictionaries=' . $useDefaultDictionaries;
        $signedURI = Utils::sign($strURI);
        $responseStream = Utils::processCommand($signedURI);
        $json = json_decode($responseStream);
        return $json;
    }

}
