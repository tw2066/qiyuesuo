<?php
namespace test;

use Qiyuesuo\Util;
use Qiyuesuo\sdk\request\TemplateCreateByWordRequest;

header("Content-Type: text/html; charset=utf-8");
    /**
    * 合同自定义创建接口   简单流程测试
    */
    // echo file_exists(dirname(__FILE__).'/'."../vendor/autoload.php");
    require_once(dirname(__FILE__).'/'."../vendor/autoload.php");
    require_once(dirname(__FILE__).'/'."ContractCreate.func.php");
    // require_once(dirname(__FILE__).'/'."../qiyuesuoSDK/com/qiyuesuo/Util.php");
    // require_once(dirname(__FILE__).'/'."ContractCreate.func.php");
    $qiyuesuoClint = new Util('xUVCqGNsOC','vIHYO10UWT9nBDWTzVyJr9dQvmVCyS','dev');
    $sdkClient = $qiyuesuoClint->getSDk();
    print("===自定义签署方创建合同草稿==="."\n");
    $baseRequest = new TemplateCreateByWordRequest();
    $baseRequest->setTitle('你好');

    $file_path = __DIR__.'/111.docx';
    $file_path = iconv("UTF-8", "GBK", realpath($file_path));
    $file = new \CURLFile($file_path);
    $baseRequest->setFile($file);
    $res = $sdkClient->service($baseRequest);
    exit;
    $result = testDraftContract($sdkClient);
    if($result == false) {
        exit(0);
    }
    // 合同ID
    $contractId = $result['result']['id'];
    // 业务ID
    if(isset($result['result']['bizId'])){
        $bizId = $result['result']['bizId'];
    } else {
        $bizId = null;
    }
    // 个人签署方ID
    $signatoryId = $result['result']['signatories'][1]['id'];
    // 公章签署节点ID
    $companyActionId = $result['result']['signatories'][0]['actions'][0]['id'];
    // 法人签署节点ID
    // $lpActionId = $result['result']['signatories'][0]['actions'][1]['id'];

    /** 添加合同文档（根据本地文件） */
    $result = testDocumentAddByFile($contractId, $bizId, $sdkClient);
    if($result == false) {
        exit(0);
    }
    $documentId1 = $result['result']['documentId'];
    /** 添加合同文档（根据文件模板） */
    // $result = testDocumentAddByTemplate($contractId, $bizId, $sdkClient);
    // if($result == false) {
    //     exit(0);
    // }
    // $documentId2 = $result['result']['documentId'];
    // /** 发起合同 */
    $result = testSendContract($contractId, $bizId, $documentId1, $signatoryId, $companyActionId, 0, $sdkClient);
    if($result == false) {
        exit(0);
    }
    /** 公章签署 */
    $result = testCompanysign($contractId, $bizId, $documentId1, $sdkClient);
    if($result == false) {
        exit(0);
    }
    /** 法人章签署 */
    // $result = testLpSign($contractId, $bizId, $documentId1, $sdkClient);
    // if($result == false) {
    //     exit(0);
    // }
    /** 获取合同签署页面 */
    $result = testContractPage($contractId, $bizId, $sdkClient);
    if($result == false) {
        exit(0);
    }
    /** 下载合同压缩包 */
    $result = testContractDownload($contractId, $bizId, $sdkClient, "D://contract.zip");
    exit(0);