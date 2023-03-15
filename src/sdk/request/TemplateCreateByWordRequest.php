<?php
namespace Qiyuesuo\sdk\request;

use Qiyuesuo\sdk\param\ParamSwitcher;
use Qiyuesuo\sdk\http\HttpParameter;
class TemplateCreateByWordRequest extends SdkRequest {

    const SEND_URL = "/v3/template/createbyword";
    private $title;
    private $file;
    // private $stampers;

    public function getUrl() {
        return self::SEND_URL;
    }

    public function getHttpParamers() {
        $paramSwitcher = ParamSwitcher::instanceParam();
        $paramSwitcher->addParam('title', $this->title);
        $paramSwitcher->addParam('file', $this->file);
        $paramSwitcher->addParam('allUser', true);
        $paramSwitcher->addParam('status', 'ENABLED');

        $httpParameter = HttpParameter::httpPostParamer();
        $httpParameter->setParams($paramSwitcher->getParams());
        return $httpParameter;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

}