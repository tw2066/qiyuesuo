<?php
namespace Qiyuesuo\sdk\request;

use Qiyuesuo\sdk\param\ParamSwitcher;
use Qiyuesuo\sdk\http\HttpParameter;
class ContractCompanySignRequest extends SdkRequest {

    const COMPANYSIGN_URL = "/v2/contract/companysign";

    private $contractId;
    private $bizId;
    private $stampers;
    private $tenantName;

    public function getUrl() {
        return self::COMPANYSIGN_URL;
    }

    public function getHttpParamers() {
        $paramSwitcher = ParamSwitcher::instanceParam();
        $paramSwitcher->addParam('contractId', $this->contractId);
        $paramSwitcher->addParam('bizId', $this->bizId);
        $paramSwitcher->addParam('stampers', $this->stampers);
        $paramSwitcher->addParam('tenantName', $this->tenantName);

        $httpParameter = HttpParameter::httpPostParamer();
        $httpParameter->setJsonParams(json_encode($paramSwitcher->getParams()));
        return $httpParameter;
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
     * @return mixed
     */
    public function getStampers()
    {
        return $this->stampers;
    }

    /**
     * @param mixed $stampers
     */
    public function setStampers($stampers)
    {
        $this->stampers = $stampers;
    }

    /**
     * @return mixed
     */
    public function getTenantName()
    {
        return $this->tenantName;
    }

    /**
     * @param mixed $tenantName
     */
    public function setTenantName($tenantName): void
    {
        $this->tenantName = $tenantName;
    }

}