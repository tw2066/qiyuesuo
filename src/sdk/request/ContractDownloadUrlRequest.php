<?php
namespace Qiyuesuo\sdk\request;

use Qiyuesuo\sdk\param\ParamSwitcher;
use Qiyuesuo\sdk\http\HttpParameter;
class ContractDownloadUrlRequest extends SdkRequest {

    const CONTRACT_DOWNLOAD = "/v2/contract/downloadurl";  // 获取合同与附属文件下载链接

    private $contractId;        // 合同ID
    private $bizId;             // 业务ID

    private $compress;          // 是否压缩成zip格式

    public function getUrl() {
        return self::CONTRACT_DOWNLOAD;
    }

    public function getHttpParamers() {
        $paramSwitcher = ParamSwitcher::instanceParam();
        $paramSwitcher->addParam('contractId', $this->contractId);
        $paramSwitcher->addParam('bizId', $this->bizId);
        $paramSwitcher->addParam('compress', $this->compress);

        $httpParameters = HttpParameter::httpGetParamer();
        $httpParameters->setParams($paramSwitcher->getParams());
        return $httpParameters;

    }

    /**
     * @return mixed
     */
    public function getContractId()
    {
        return $this->contractId;
    }

    /**
     * @param mixed $contractId
     */
    public function setContractId($contractId)
    {
        $this->contractId = $contractId;
    }

    /**
     * @return mixed
     */
    public function getBizId()
    {
        return $this->bizId;
    }

    /**
     * @param mixed $bizId
     */
    public function setBizId($bizId)
    {
        $this->bizId = $bizId;
    }

    /**
     * @return bool
     */
    public function getCompress()
    {
        return $this->compress;
    }

    /**
     * @param bool $compress
     */
    public function setCompress($compress): void
    {
        $this->compress = $compress;
    }

}