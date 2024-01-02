<?php
namespace test;

use Qiyuesuo\sdk\SDKClient;
use Qiyuesuo\sdk\bean\Contract;
use Qiyuesuo\sdk\bean\Category;
use Qiyuesuo\sdk\bean\Signatory;
use Qiyuesuo\sdk\bean\User;
use Qiyuesuo\sdk\bean\Action;
use Qiyuesuo\sdk\bean\TemplateParam;
use Qiyuesuo\sdk\bean\Stamper;
use Qiyuesuo\sdk\request\ContractDraftRequest;
use Qiyuesuo\sdk\request\DocumentAddByFileRequest;
use Qiyuesuo\sdk\request\DocumentAddByTemplateRequest;
use Qiyuesuo\sdk\request\ContractSendRequest;
use Qiyuesuo\sdk\request\ContractAuditRequest;
use Qiyuesuo\sdk\request\ContractCompanySignRequest;
use Qiyuesuo\sdk\request\ContractLpSignRequest;
use Qiyuesuo\sdk\request\ContractPageRequest;
use Qiyuesuo\sdk\request\ContractDownloadRequest;
header("Content-Type: text/html; charset=utf-8");

    /**
     * 创建合同草稿
     */
    function testDraftContract(SDKClient $sdkClient){
        /** 合同基本信息 */
        $contract = new Contract();
        $contract->setSubject("V2业务分类预设 - 创建合同");
        $contract->setSend(true);

        $category = new Category();
        $category->setName("V2业务分类预设");
        $contract->setCategory($category);

        /**公司签署方**/
        $companySignatory = new Signatory();
        $companySignatory->setTenantType("COMPANY");
        $companySignatory->setTenantName("思晨教育");
        $companySignatory->setSerialNo(1);

        /**个人签署方**/
        $personalSignatory = new Signatory();
        $personalSignatory->setTenantType("PERSONAL");
        $personalSignatory->setTenantName("李四");
        $personalUser = new User();
        $personalUser->setContact("150****0000");
        $personalUser->setContactType("MOBILE");
        $personalSignatory->setReceiver($personalUser);
        $personalSignatory->setSerialNo(2);



        /**公司签署方-》个人签署方**/
        $signatories = array();
        array_push($signatories, $companySignatory);
        array_push($signatories, $personalSignatory);

        $contract->setSignatories($signatories);

        $param1 = new TemplateParam();
        $param1->setName("乙方姓名");
        $param1->setValue("张三");

        $param2 = new TemplateParam();
        $param2->setName("身份证号");
        $param2->setValue("123456789");

        $templates = array();
        array_push($templates, $param1);
        array_push($templates, $param2);

        $contract->setTemplateParams($templates);

        $baseRequest = new ContractDraftRequest($contract);
        $result = $sdkClient->service($baseRequest);
        if(!$result) {
            return false;
        }
        if(!isset($result['code']) || $result['code'] != 0) {
            print_r($result);
            return false;
        }
        print("创建合同成功，合同ID：".$result['result']['id']."\n");
        return $result;
    }

    /**
     * 根据文件添加文档
     * @param SDKClient $sdkClient
     * @return mixed|null|string
     */
    function testDocumentAddByFile($contractId, $bizId, SDKClient $sdkClient){

        $documentAddByFileRequest = new DocumentAddByFileRequest();
        $documentAddByFileRequest->setContractId($contractId);
        $documentAddByFileRequest->setBizId($bizId);

        $file_path = "C:/Users/QYS/Desktop/Test/劳动合同_带参数.docx";

        $file_path = iconv("UTF-8", "GBK", realpath($file_path));

        $file = new \CURLFile($file_path);

        $documentAddByFileRequest->setFile($file);
        $documentAddByFileRequest->setFileSuffix('docx');
        $documentAddByFileRequest->setTitle('V2添加文档1');
        $result = $sdkClient->service($documentAddByFileRequest);
        if(!$result) {
            return false;
        }
        if(!isset($result['code']) || $result['code'] != 0) {
            print_r($result);
            return false;
        }
        print("根据文件添加合同文档成功，文档ID：".$result['result']['documentId']."\n");
        return $result;
    }

    /**
     * 根据模板添加文档
     * @param SDKClient $sdkClient
     * @return mixed|null|string
     */
    function testDocumentAddByTemplate($contractId, $bizId, SDKClient $sdkClient){

        $documentAddByTemplateRequest = new DocumentAddByTemplateRequest();
        $documentAddByTemplateRequest->setContractId($contractId);
        $documentAddByTemplateRequest->setBizId($bizId);
        $documentAddByTemplateRequest->setTitle('V2添加模板文档');
        $documentAddByTemplateRequest->setTemplateId('2558597440364655396');
        /**填写模板参数**/
        $templateParam1 = new TemplateParam();
        $templateParam1->setName("乙方姓名");
        $templateParam1->setValue("张三");

        $templateParams = array();
        array_push($templateParams, $templateParam1);

        $documentAddByTemplateRequest->setTemplateParams($templateParams);
        $result = $sdkClient->service($documentAddByTemplateRequest);
        if(!$result) {
            return false;
        }
        if(!isset($result['code']) || $result['code'] != 0) {
            print_r($result);
            return false;
        }
        print("根据模板添加合同文档成功，文档ID：".$result['result']['documentId']."\n");
        return $result;
    }

    /**
     * 发起合同
     * @param SDKClient $sdkClient
     * @return mixed|null|string
     */
    function testSendContract($contractId, $bizId, $documentId, $actionId, SDKClient $sdkClient){

        $contractSendRequest = new ContractSendRequest();
        $contractSendRequest->setContractId($contractId);
        $contractSendRequest->setBizId($bizId);

        $stamper1 = new Stamper();
        $stamper1->setType('COMPANY');
        $stamper1->setActionId($actionId);
        $stamper1->setDocumentId($documentId);
        $stamper1->setSealId('2566229349702860958');
        $stamper1->setKeyword('劳动');
        $stamper1->setKeywordIndex('2');
        $stamper1->setOffsetX('0.1');
        $stamper1->setOffsetY('-0.1');

        $stamper2 = new Stamper();
        $stamper2->setType('COMPANY');
        $stamper2->setActionId($actionId);
        $stamper2->setDocumentId($documentId);
        $stamper2->setSealId('2566229349702860958');
        $stamper2->setPage('1');
        $stamper2->setOffsetX('0.5');
        $stamper2->setOffsetY('0.5');

        $stampers = array();
        array_push($stampers, $stamper1);
        array_push($stampers, $stamper2);

        $contractSendRequest->setStampers($stampers);
        $result = $sdkClient->service($contractSendRequest);
        if(!$result) {
            return false;
        }
        if(!isset($result['code']) || $result['code'] != 0) {
            print_r($result);
            return false;
        }
        print("发起合同成功"."\n");
        return $result;
    }

    /**
     * 审批合同
     * @param $sdkClient
     * @return mixed
     */
    function testContractAudit($contractId, $bizId, SDKClient $sdkClient){
        $contractAuditRequest = new ContractAuditRequest();
        $contractAuditRequest->setContractId($contractId);
        $contractAuditRequest->setBizId($bizId);

        $audutOperator = new User();
        $audutOperator->setContact('150****0000');
        $audutOperator->setContactType('MOBILE');
        $contractAuditRequest->setEmployee($audutOperator);
        $contractAuditRequest->setPass(true);
        $contractAuditRequest->setComment('同意');
        $result = $sdkClient->service($contractAuditRequest);
        if(!$result) {
            return false;
        }
        if(!isset($result['code']) || $result['code'] != 0) {
            print_r($result);
            return false;
        }
        print("审批合同成功"."\n");
        return $result;
    }

    /**
     * 公司公章签署
     * @param $sdkClient
     * @return mixed
     */
    function testCompanysign($contractId, $bizId, $documentId, SDKClient $sdkClient){
        $contractCompanySignRequest = new ContractCompanySignRequest();
        $contractCompanySignRequest->setContractId($contractId);
        $contractCompanySignRequest->setBizId($bizId);
        $result = $sdkClient->service($contractCompanySignRequest);
        if(!$result) {
            return false;
        }
        if(!isset($result['code']) || $result['code'] != 0) {
            print_r($result);
            return false;
        }
        print("公章签署成功"."\n");
        return $result;
    }

    /**
     * 法人签署
     * @param SDKClient $sdkClient
     * @return mixed|null|string
     */
    function testLpSign($contractId, $bizId, $documentId, SDKClient $sdkClient){
        $contractLpSignRequest = new ContractLpSignRequest();
        $contractLpSignRequest->setContractId($contractId);
        $contractLpSignRequest->setBizId($bizId);
        $result = $sdkClient->service($contractLpSignRequest);
        if(!$result) {
            return false;
        }
        if(!isset($result['code']) || $result['code'] != 0) {
            print_r($result);
            return false;
        }
        print("法人签署成功"."\n");
        return $result;
    }

    /**
     * 合同签署页面
     * @param SDKClient $sdkClient
     * @return mixed|null|string
     */
    function testContractPage($contractId, $bizId, SDKClient $sdkClient){
        $contractPageRequest = new ContractPageRequest();
        $contractPageRequest->setContractId($contractId);
        $contractPageRequest->setBizId($bizId);

        $user = new User();
        $user->setContact("150****0000");
        $user->setContactType("MOBILE");

        $contractPageRequest->setUser($user);
        $result = $sdkClient->service($contractPageRequest);
        print("获取合同签署页面成功，签署页面链接：".$result['result']['pageUrl']);
        return $result;
    }
