<?php
namespace Qiyuesuo;
use Qiyuesuo\sdk\SDKClient;


/**
 *
 * 契约锁SDK配置类
 *
 */
// require_once (dirname(__FILE__).'/sdk/param/'.'ParamSwitcher.php');
// require_once (dirname(__FILE__).'/sdk/http/'.'HttpHeader.php');
// require_once (dirname(__FILE__).'/sdk/http/'.'HttpConnection.php');
// require_once (dirname(__FILE__).'/sdk/http/'.'HttpParameter.php');
// require_once (dirname(__FILE__).'/sdk/http/'.'HttpMethod.php');
// require_once (dirname(__FILE__).'/sdk/http/'.'HttpClient.php');
// require_once (dirname(__FILE__).'/sdk/'.'SDKClient.php');
// require_once (dirname(__FILE__).'/sdk/request/'.'SdkRequest.php');

// require_once(dirname(__FILE__) . '/sdk/bean/'."Action.php");
// require_once(dirname(__FILE__) . '/sdk/bean/'."Attachment.php");
// require_once(dirname(__FILE__) . '/sdk/bean/'."Audit.php");
// require_once(dirname(__FILE__) . '/sdk/bean/'."Category.php");
// require_once(dirname(__FILE__) . '/sdk/bean/'."Company.php");
// require_once(dirname(__FILE__) . '/sdk/bean/'."Contract.php");
// require_once(dirname(__FILE__) . '/sdk/bean/'."Document.php");
// require_once(dirname(__FILE__) . '/sdk/bean/'."Employee.php");
// require_once (dirname(__FILE__). '/sdk/bean/'."Seal.php");
// require_once(dirname(__FILE__) . '/sdk/bean/'."Signatory.php");
// require_once(dirname(__FILE__) . '/sdk/bean/'."Stamper.php");
// require_once(dirname(__FILE__) . '/sdk/bean/'."Template.php");
// require_once(dirname(__FILE__) . '/sdk/bean/'."TemplateParam.php");
// require_once(dirname(__FILE__) . '/sdk/bean/'."User.php");

// require_once (dirname(__FILE__).'/sdk/request/'."AttachmentDownloadRequest.php");
// require_once (dirname(__FILE__).'/sdk/request/'."CategoryListRequest.php");
// require_once (dirname(__FILE__).'/sdk/request/'."CompanyDetailRequest.php");
// require_once (dirname(__FILE__).'/sdk/request/'."ContractAuditRequest.php");
// require_once (dirname(__FILE__).'/sdk/request/'."ContractCompanySignRequest.php");
// require_once (dirname(__FILE__).'/sdk/request/'."ContractDetailRequest.php");
// require_once (dirname(__FILE__).'/sdk/request/'."ContractDownloadRequest.php");
// require_once (dirname(__FILE__).'/sdk/request/'."ContractDraftRequest.php");
// require_once (dirname(__FILE__).'/sdk/request/'."ContractInvalidRequest.php");
// require_once (dirname(__FILE__).'/sdk/request/'."ContractLpSignRequest.php");
// require_once (dirname(__FILE__).'/sdk/request/'."ContractNoticeRequest.php");
// require_once (dirname(__FILE__).'/sdk/request/'."ContractPageRequest.php");
// require_once (dirname(__FILE__).'/sdk/request/'."ContractSendRequest.php");
// require_once (dirname(__FILE__).'/sdk/request/'."DocumentAddByFileRequest.php");
// require_once (dirname(__FILE__).'/sdk/request/'."DocumentAddByTemplateRequest.php");
// require_once (dirname(__FILE__).'/sdk/request/'."DocumentDownloadRequest.php");
// require_once (dirname(__FILE__).'/sdk/request/'."EmployeeCreateRequest.php");
// require_once (dirname(__FILE__).'/sdk/request/'."EmployeeListRequest.php");
// require_once (dirname(__FILE__).'/sdk/request/'."EmployeeRemoveRequest.php");
// require_once (dirname(__FILE__).'/sdk/request/'."EmployeeUpdateRequest.php");
// require_once (dirname(__FILE__).'/sdk/request/'."SealImageRequest.php");
// require_once (dirname(__FILE__).'/sdk/request/'."SealListRequest.php");
// require_once (dirname(__FILE__).'/sdk/request/'."TemplateListRequest.php");
// require_once (dirname(__FILE__).'/sdk/request/'."TemplatePageRequest.php");

class Util {

    private $url = "https://openapi.qiyuesuo.cn";
    private $accessKey = "xUVCqGNsOC";
    private $accessSecret = "vIHYO10UWT9nBDWTzVyJr9dQvmVCyS";

    public function __construct($accessKey, $accessKeySecret, $endpoint="")
    {
        $accessKey = trim($accessKey);
        $accessKeySecret = trim($accessKeySecret);
        // $endpoint = trim(trim($endpoint), "/");

        if (empty($accessKey)) {
            throw new \Exception("access key id is empty");
        }
        if (empty($accessKeySecret)) {
            throw new \Exception("access key secret is empty");
        }
        // if (empty($endpoint)) {
        //     throw new \Exception("endpoint is empty");
        // }
        $this->url = ($endpoint=="dev")?"https://openapi.qiyuesuo.cn":"https://openapi.qiyuesuo.com";
        $this->accessKey = $accessKey;
        $this->accessSecret = $accessKeySecret;
    }

    public function getSDk() {
        $url = $this->url;
        $accessKey = $this->accessKey;
        $accessSecret = $this->accessSecret;
        $SDk = new SDKClient($accessKey, $accessSecret, $url);
        return $SDk;
    }
}