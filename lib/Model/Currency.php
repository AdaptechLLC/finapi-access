<?php
/**
 * Currency
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  OpenAPIAccess\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * finAPI Access
 *
 * <strong>RESTful API for Account Information Services (AIS) and Payment Initiation Services (PIS)</strong>  The following pages give you some general information on how to use our APIs.<br/> The actual API services documentation then follows further below. You can use the menu to jump between API sections. <br/> <br/> This page has a built-in HTTP(S) client, so you can test the services directly from within this page, by filling in the request parameters and/or body in the respective services, and then hitting the TRY button. Note that you need to be authorized to make a successful API call. To authorize, refer to the 'Authorization' section of the API, or just use the OAUTH button that can be found near the TRY button. <br/>  <h2 id=\"general-information\">General information</h2>  <h3 id=\"general-error-responses\"><strong>Error Responses</strong></h3> When an API call returns with an error, then in general it has the structure shown in the following example:  <pre> {   \"errors\": [     {       \"message\": \"Interface 'FINTS_SERVER' is not supported for this operation.\",       \"code\": \"BAD_REQUEST\",       \"type\": \"TECHNICAL\"     }   ],   \"date\": \"2020-11-19 16:54:06.854\",   \"requestId\": \"selfgen-312042e7-df55-47e4-bffd-956a68ef37b5\",   \"endpoint\": \"POST /api/v1/bankConnections/import\",   \"authContext\": \"1/21\",   \"bank\": \"DEMO0002 - finAPI Test Redirect Bank\" } </pre>  If an API call requires an additional authentication by the user, HTTP code 510 is returned and the error response contains the additional \"multiStepAuthentication\" object, see the following example:  <pre> {   \"errors\": [     {       \"message\": \"Es ist eine zusätzliche Authentifizierung erforderlich. Bitte geben Sie folgenden Code an: 123456\",       \"code\": \"ADDITIONAL_AUTHENTICATION_REQUIRED\",       \"type\": \"BUSINESS\",       \"multiStepAuthentication\": {         \"hash\": \"678b13f4be9ed7d981a840af8131223a\",         \"status\": \"CHALLENGE_RESPONSE_REQUIRED\",         \"challengeMessage\": \"Es ist eine zusätzliche Authentifizierung erforderlich. Bitte geben Sie folgenden Code an: 123456\",         \"answerFieldLabel\": \"TAN\",         \"redirectUrl\": null,         \"redirectContext\": null,         \"redirectContextField\": null,         \"twoStepProcedures\": null,         \"photoTanMimeType\": null,         \"photoTanData\": null,         \"opticalData\": null       }     }   ],   \"date\": \"2019-11-29 09:51:55.931\",   \"requestId\": \"selfgen-45059c99-1b14-4df7-9bd3-9d5f126df294\",   \"endpoint\": \"POST /api/v1/bankConnections/import\",   \"authContext\": \"1/18\",   \"bank\": \"DEMO0001 - finAPI Test Bank\" } </pre>  An exception to this error format are API authentication errors, where the following structure is returned:  <pre> {   \"error\": \"invalid_token\",   \"error_description\": \"Invalid access token: cccbce46-xxxx-xxxx-xxxx-xxxxxxxxxx\" } </pre>  <h3 id=\"general-paging\"><strong>Paging</strong></h3> API services that may potentially return a lot of data implement paging. They return a limited number of entries within a \"page\". Further entries must be fetched with subsequent calls. <br/><br/> Any API service that implements paging provides the following input parameters:<br/> &bull; \"page\": the number of the page to be retrieved (starting with 1).<br/> &bull; \"perPage\": the number of entries within a page. The default and maximum value is stated in the documentation of the respective services.  A paged response contains an additional \"paging\" object with the following structure:  <pre> {   ...   ,   \"paging\": {     \"page\": 1,     \"perPage\": 20,     \"pageCount\": 234,     \"totalCount\": 4662   } } </pre>  <h3 id=\"general-internationalization\"><strong>Internationalization</strong></h3> The finAPI services support internationalization which means you can define the language you prefer for API service responses. <br/><br/> The following languages are available: German, English, Czech, Slovak. <br/><br/> The preferred language can be defined by providing the official HTTP <strong>Accept-Language</strong> header. <br/><br/> finAPI reacts on the official iso language codes &quot;de&quot;, &quot;en&quot;, &quot;cs&quot; and &quot;sk&quot; for the named languages. Additional subtags supported by the Accept-Language header may be provided, e.g. &quot;en-US&quot;, but are ignored. <br/> If no Accept-Language header is given, German is used as the default language. <br/><br/> Exceptions:<br/> &bull; Bank login hints and login fields are only available in the language of the bank and not being translated.<br/> &bull; Direct messages from the bank systems typically returned as BUSINESS errors will not be translated.<br/> &bull; BUSINESS errors created by finAPI directly are available in German and English.<br/> &bull; TECHNICAL errors messages meant for developers are mostly in English, but also may be translated.  <h3 id=\"general-request-ids\"><strong>Request IDs</strong></h3> With any API call, you can pass a request ID via a header with name \"X-Request-Id\". The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. <br/><br/> If you don't pass a request ID for a call, finAPI will generate a random ID internally. <br/><br/> The request ID is always returned back in the response of a service, as a header with name \"X-Request-Id\". <br/><br/> We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster.  <h3 id=\"general-overriding-http-methods\"><strong>Overriding HTTP methods</strong></h3> Some HTTP clients do not support the HTTP methods PATCH or DELETE. If you are using such a client in your application, you can use a POST request instead with a special HTTP header indicating the originally intended HTTP method. <br/><br/> The header's name is <strong>X-HTTP-Method-Override</strong>. Set its value to either <strong>PATCH</strong> or <strong>DELETE</strong>. POST Requests having this header set will be treated either as PATCH or DELETE by the finAPI servers. <br/><br/> Example: <br/><br/> <strong>X-HTTP-Method-Override: PATCH</strong><br/> POST /api/v1/label/51<br/> {\"name\": \"changed label\"}<br/><br/> will be interpreted by finAPI as:<br/><br/> PATCH /api/v1/label/51<br/> {\"name\": \"changed label\"}<br/>  <h3 id=\"general-user-metadata\"><strong>User metadata</strong></h3> With the migration to PSD2 APIs, a new term called \"User metadata\" (also known as \"PSU metadata\") has been introduced to the API. This user metadata aims to inform the banking API if there was a real end-user behind an HTTP request or if the request was triggered by a system (e.g. by an automatic batch update). In the latter case, the bank may apply some restrictions such as limiting the number of HTTP requests for a single consent. Also, some operations may be forbidden entirely by the banking API. For example, some banks do not allow issuing a new consent without the end-user being involved. Therefore, it is certainly necessary and obligatory for the customer to provide the PSU metadata for such operations. <br/><br/> As finAPI does not have direct interaction with the end-user, it is the client application's responsibility to provide all the necessary information about the end-user. This must be done by sending additional headers with every request triggered on behalf of the end-user. <br/><br/> At the moment, the following headers are supported by the API:<br/> &bull; \"PSU-IP-Address\" - the IP address of the user's device.<br/> &bull; \"PSU-Device-OS\" - the user's device and/or operating system identification.<br/> &bull; \"PSU-User-Agent\" - the user's web browser or other client device identification.  <h3 id=\"general-faq\"><strong>FAQ</strong></h3> <strong>Is there a finAPI SDK?</strong> <br/> Currently we do not offer a native SDK, but there is the option to generate a SDK for almost any target language via OpenAPI. Use the 'Download SDK' button on this page for SDK generation. <br/> <br/> <strong>How can I enable finAPI's automatic batch update?</strong> <br/> Currently there is no way to set up the batch update via the API. Please contact support@finapi.io for this. <br/> <br/> <strong>Why do I need to keep authorizing when calling services on this page?</strong> <br/> This page is a \"one-page-app\". Reloading the page resets the OAuth authorization context. There is generally no need to reload the page, so just don't do it and your authorization will persist.
 *
 * The version of the OpenAPI document: 1.143.1
 * Contact: kontakt@finapi.io
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.3.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace OpenAPIAccess\Client\Model;
use \OpenAPIAccess\Client\ObjectSerializer;

/**
 * Currency Class Doc Comment
 *
 * @category Class
 * @package  OpenAPIAccess\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class Currency
{
    /**
     * Possible values of this enum
     */
    const AED = 'AED';

    const AFN = 'AFN';

    const ALL = 'ALL';

    const AMD = 'AMD';

    const ANG = 'ANG';

    const AOA = 'AOA';

    const ARS = 'ARS';

    const AUD = 'AUD';

    const AWG = 'AWG';

    const AZN = 'AZN';

    const BAM = 'BAM';

    const BBD = 'BBD';

    const BDT = 'BDT';

    const BGN = 'BGN';

    const BHD = 'BHD';

    const BIF = 'BIF';

    const BMD = 'BMD';

    const BND = 'BND';

    const BOB = 'BOB';

    const BOV = 'BOV';

    const BRL = 'BRL';

    const BSD = 'BSD';

    const BTN = 'BTN';

    const BWP = 'BWP';

    const BYN = 'BYN';

    const BZD = 'BZD';

    const CAD = 'CAD';

    const CDF = 'CDF';

    const CHE = 'CHE';

    const CHF = 'CHF';

    const CHN = 'CHN';

    const CHW = 'CHW';

    const CLF = 'CLF';

    const CLP = 'CLP';

    const CNY = 'CNY';

    const COP = 'COP';

    const COU = 'COU';

    const CRC = 'CRC';

    const CUC = 'CUC';

    const CUP = 'CUP';

    const CVE = 'CVE';

    const CZK = 'CZK';

    const DJF = 'DJF';

    const DKK = 'DKK';

    const DOP = 'DOP';

    const DZD = 'DZD';

    const EGP = 'EGP';

    const ERN = 'ERN';

    const ETB = 'ETB';

    const EUR = 'EUR';

    const FJD = 'FJD';

    const FKP = 'FKP';

    const GBP = 'GBP';

    const GEL = 'GEL';

    const GGP = 'GGP';

    const GHS = 'GHS';

    const GIP = 'GIP';

    const GMD = 'GMD';

    const GNF = 'GNF';

    const GTQ = 'GTQ';

    const GYD = 'GYD';

    const HKD = 'HKD';

    const HNL = 'HNL';

    const HRK = 'HRK';

    const HTG = 'HTG';

    const HUF = 'HUF';

    const IDR = 'IDR';

    const ILS = 'ILS';

    const IMP = 'IMP';

    const INR = 'INR';

    const IQD = 'IQD';

    const IRR = 'IRR';

    const ISK = 'ISK';

    const JEP = 'JEP';

    const JMD = 'JMD';

    const JOD = 'JOD';

    const JPY = 'JPY';

    const KES = 'KES';

    const KGS = 'KGS';

    const KHR = 'KHR';

    const KID = 'KID';

    const KMF = 'KMF';

    const KPW = 'KPW';

    const KRW = 'KRW';

    const KWD = 'KWD';

    const KYD = 'KYD';

    const KZT = 'KZT';

    const LAK = 'LAK';

    const LBP = 'LBP';

    const LKR = 'LKR';

    const LRD = 'LRD';

    const LSL = 'LSL';

    const LYD = 'LYD';

    const MAD = 'MAD';

    const MDL = 'MDL';

    const MGA = 'MGA';

    const MKD = 'MKD';

    const MMK = 'MMK';

    const MNT = 'MNT';

    const MOP = 'MOP';

    const MRU = 'MRU';

    const MUR = 'MUR';

    const MVR = 'MVR';

    const MWK = 'MWK';

    const MXN = 'MXN';

    const MXV = 'MXV';

    const MYR = 'MYR';

    const MZN = 'MZN';

    const NAD = 'NAD';

    const NGN = 'NGN';

    const NIO = 'NIO';

    const NIS = 'NIS';

    const NOK = 'NOK';

    const NPR = 'NPR';

    const NTD = 'NTD';

    const NZD = 'NZD';

    const OMR = 'OMR';

    const PAB = 'PAB';

    const PEN = 'PEN';

    const PGK = 'PGK';

    const PHP = 'PHP';

    const PKR = 'PKR';

    const PLN = 'PLN';

    const PRB = 'PRB';

    const PYG = 'PYG';

    const QAR = 'QAR';

    const RMB = 'RMB';

    const RON = 'RON';

    const RSD = 'RSD';

    const RUB = 'RUB';

    const RWF = 'RWF';

    const SAR = 'SAR';

    const SBD = 'SBD';

    const SCR = 'SCR';

    const SDG = 'SDG';

    const SEK = 'SEK';

    const SGD = 'SGD';

    const SHP = 'SHP';

    const SLL = 'SLL';

    const SLS = 'SLS';

    const SOS = 'SOS';

    const SRD = 'SRD';

    const SSP = 'SSP';

    const STN = 'STN';

    const SVC = 'SVC';

    const SYP = 'SYP';

    const SZL = 'SZL';

    const THB = 'THB';

    const TJS = 'TJS';

    const TMT = 'TMT';

    const TND = 'TND';

    const TOP = 'TOP';

    const _TRY = 'TRY';

    const TTD = 'TTD';

    const TVD = 'TVD';

    const TWD = 'TWD';

    const TZS = 'TZS';

    const UAH = 'UAH';

    const UGX = 'UGX';

    const USD = 'USD';

    const USN = 'USN';

    const UYI = 'UYI';

    const UYU = 'UYU';

    const UYW = 'UYW';

    const UZS = 'UZS';

    const VEF = 'VEF';

    const VES = 'VES';

    const VND = 'VND';

    const VUV = 'VUV';

    const WST = 'WST';

    const XAF = 'XAF';

    const XAG = 'XAG';

    const XAU = 'XAU';

    const XBA = 'XBA';

    const XBB = 'XBB';

    const XBC = 'XBC';

    const XBD = 'XBD';

    const XCD = 'XCD';

    const XDR = 'XDR';

    const XOF = 'XOF';

    const XPD = 'XPD';

    const XPF = 'XPF';

    const XPT = 'XPT';

    const XSU = 'XSU';

    const XTS = 'XTS';

    const XUA = 'XUA';

    const XXX = 'XXX';

    const YER = 'YER';

    const ZAR = 'ZAR';

    const ZMW = 'ZMW';

    const ZWB = 'ZWB';

    const ZWL = 'ZWL';

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::AED,
            self::AFN,
            self::ALL,
            self::AMD,
            self::ANG,
            self::AOA,
            self::ARS,
            self::AUD,
            self::AWG,
            self::AZN,
            self::BAM,
            self::BBD,
            self::BDT,
            self::BGN,
            self::BHD,
            self::BIF,
            self::BMD,
            self::BND,
            self::BOB,
            self::BOV,
            self::BRL,
            self::BSD,
            self::BTN,
            self::BWP,
            self::BYN,
            self::BZD,
            self::CAD,
            self::CDF,
            self::CHE,
            self::CHF,
            self::CHN,
            self::CHW,
            self::CLF,
            self::CLP,
            self::CNY,
            self::COP,
            self::COU,
            self::CRC,
            self::CUC,
            self::CUP,
            self::CVE,
            self::CZK,
            self::DJF,
            self::DKK,
            self::DOP,
            self::DZD,
            self::EGP,
            self::ERN,
            self::ETB,
            self::EUR,
            self::FJD,
            self::FKP,
            self::GBP,
            self::GEL,
            self::GGP,
            self::GHS,
            self::GIP,
            self::GMD,
            self::GNF,
            self::GTQ,
            self::GYD,
            self::HKD,
            self::HNL,
            self::HRK,
            self::HTG,
            self::HUF,
            self::IDR,
            self::ILS,
            self::IMP,
            self::INR,
            self::IQD,
            self::IRR,
            self::ISK,
            self::JEP,
            self::JMD,
            self::JOD,
            self::JPY,
            self::KES,
            self::KGS,
            self::KHR,
            self::KID,
            self::KMF,
            self::KPW,
            self::KRW,
            self::KWD,
            self::KYD,
            self::KZT,
            self::LAK,
            self::LBP,
            self::LKR,
            self::LRD,
            self::LSL,
            self::LYD,
            self::MAD,
            self::MDL,
            self::MGA,
            self::MKD,
            self::MMK,
            self::MNT,
            self::MOP,
            self::MRU,
            self::MUR,
            self::MVR,
            self::MWK,
            self::MXN,
            self::MXV,
            self::MYR,
            self::MZN,
            self::NAD,
            self::NGN,
            self::NIO,
            self::NIS,
            self::NOK,
            self::NPR,
            self::NTD,
            self::NZD,
            self::OMR,
            self::PAB,
            self::PEN,
            self::PGK,
            self::PHP,
            self::PKR,
            self::PLN,
            self::PRB,
            self::PYG,
            self::QAR,
            self::RMB,
            self::RON,
            self::RSD,
            self::RUB,
            self::RWF,
            self::SAR,
            self::SBD,
            self::SCR,
            self::SDG,
            self::SEK,
            self::SGD,
            self::SHP,
            self::SLL,
            self::SLS,
            self::SOS,
            self::SRD,
            self::SSP,
            self::STN,
            self::SVC,
            self::SYP,
            self::SZL,
            self::THB,
            self::TJS,
            self::TMT,
            self::TND,
            self::TOP,
            self::_TRY,
            self::TTD,
            self::TVD,
            self::TWD,
            self::TZS,
            self::UAH,
            self::UGX,
            self::USD,
            self::USN,
            self::UYI,
            self::UYU,
            self::UYW,
            self::UZS,
            self::VEF,
            self::VES,
            self::VND,
            self::VUV,
            self::WST,
            self::XAF,
            self::XAG,
            self::XAU,
            self::XBA,
            self::XBB,
            self::XBC,
            self::XBD,
            self::XCD,
            self::XDR,
            self::XOF,
            self::XPD,
            self::XPF,
            self::XPT,
            self::XSU,
            self::XTS,
            self::XUA,
            self::XXX,
            self::YER,
            self::ZAR,
            self::ZMW,
            self::ZWB,
            self::ZWL
        ];
    }
}


