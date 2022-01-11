<?php
/**
 * ISO3166Alpha2Codes
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
 * ISO3166Alpha2Codes Class Doc Comment
 *
 * @category Class
 * @package  OpenAPIAccess\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ISO3166Alpha2Codes
{
    /**
     * Possible values of this enum
     */
    const AD = 'AD';

    const AE = 'AE';

    const AF = 'AF';

    const AG = 'AG';

    const AI = 'AI';

    const AL = 'AL';

    const AM = 'AM';

    const AO = 'AO';

    const AQ = 'AQ';

    const AR = 'AR';

    const _AS = 'AS';

    const AT = 'AT';

    const AU = 'AU';

    const AW = 'AW';

    const AX = 'AX';

    const AZ = 'AZ';

    const BA = 'BA';

    const BB = 'BB';

    const BD = 'BD';

    const BE = 'BE';

    const BF = 'BF';

    const BG = 'BG';

    const BH = 'BH';

    const BI = 'BI';

    const BJ = 'BJ';

    const BL = 'BL';

    const BM = 'BM';

    const BN = 'BN';

    const BO = 'BO';

    const BQ = 'BQ';

    const BR = 'BR';

    const BS = 'BS';

    const BT = 'BT';

    const BV = 'BV';

    const BW = 'BW';

    const BY = 'BY';

    const BZ = 'BZ';

    const CA = 'CA';

    const CC = 'CC';

    const CD = 'CD';

    const CF = 'CF';

    const CG = 'CG';

    const CH = 'CH';

    const CI = 'CI';

    const CK = 'CK';

    const CL = 'CL';

    const CM = 'CM';

    const CN = 'CN';

    const CO = 'CO';

    const CR = 'CR';

    const CU = 'CU';

    const CV = 'CV';

    const CW = 'CW';

    const CX = 'CX';

    const CY = 'CY';

    const CZ = 'CZ';

    const DE = 'DE';

    const DJ = 'DJ';

    const DK = 'DK';

    const DM = 'DM';

    const _DO = 'DO';

    const DZ = 'DZ';

    const EC = 'EC';

    const EE = 'EE';

    const EG = 'EG';

    const EH = 'EH';

    const ER = 'ER';

    const ES = 'ES';

    const ET = 'ET';

    const FI = 'FI';

    const FJ = 'FJ';

    const FK = 'FK';

    const FM = 'FM';

    const FO = 'FO';

    const FR = 'FR';

    const GA = 'GA';

    const GB = 'GB';

    const GD = 'GD';

    const GE = 'GE';

    const GF = 'GF';

    const GG = 'GG';

    const GH = 'GH';

    const GI = 'GI';

    const GL = 'GL';

    const GM = 'GM';

    const GN = 'GN';

    const GP = 'GP';

    const GQ = 'GQ';

    const GR = 'GR';

    const GS = 'GS';

    const GT = 'GT';

    const GU = 'GU';

    const GW = 'GW';

    const GY = 'GY';

    const HK = 'HK';

    const HM = 'HM';

    const HN = 'HN';

    const HR = 'HR';

    const HT = 'HT';

    const HU = 'HU';

    const ID = 'ID';

    const IE = 'IE';

    const IL = 'IL';

    const IM = 'IM';

    const IN = 'IN';

    const IO = 'IO';

    const IQ = 'IQ';

    const IR = 'IR';

    const IS = 'IS';

    const IT = 'IT';

    const JE = 'JE';

    const JM = 'JM';

    const JO = 'JO';

    const JP = 'JP';

    const KE = 'KE';

    const KG = 'KG';

    const KH = 'KH';

    const KI = 'KI';

    const KM = 'KM';

    const KN = 'KN';

    const KP = 'KP';

    const KR = 'KR';

    const KW = 'KW';

    const KY = 'KY';

    const KZ = 'KZ';

    const LA = 'LA';

    const LB = 'LB';

    const LC = 'LC';

    const LI = 'LI';

    const LK = 'LK';

    const LR = 'LR';

    const LS = 'LS';

    const LT = 'LT';

    const LU = 'LU';

    const LV = 'LV';

    const LY = 'LY';

    const MA = 'MA';

    const MC = 'MC';

    const MD = 'MD';

    const ME = 'ME';

    const MF = 'MF';

    const MG = 'MG';

    const MH = 'MH';

    const MK = 'MK';

    const ML = 'ML';

    const MM = 'MM';

    const MN = 'MN';

    const MO = 'MO';

    const MP = 'MP';

    const MQ = 'MQ';

    const MR = 'MR';

    const MS = 'MS';

    const MT = 'MT';

    const MU = 'MU';

    const MV = 'MV';

    const MW = 'MW';

    const MX = 'MX';

    const MY = 'MY';

    const MZ = 'MZ';

    const NA = 'NA';

    const NC = 'NC';

    const NE = 'NE';

    const NF = 'NF';

    const NG = 'NG';

    const NI = 'NI';

    const NL = 'NL';

    const NO = 'NO';

    const NP = 'NP';

    const NR = 'NR';

    const NU = 'NU';

    const NZ = 'NZ';

    const OM = 'OM';

    const PA = 'PA';

    const PE = 'PE';

    const PF = 'PF';

    const PG = 'PG';

    const PH = 'PH';

    const PK = 'PK';

    const PL = 'PL';

    const PM = 'PM';

    const PN = 'PN';

    const PR = 'PR';

    const PS = 'PS';

    const PT = 'PT';

    const PW = 'PW';

    const PY = 'PY';

    const QA = 'QA';

    const RE = 'RE';

    const RO = 'RO';

    const RS = 'RS';

    const RU = 'RU';

    const RW = 'RW';

    const SA = 'SA';

    const SB = 'SB';

    const SC = 'SC';

    const SD = 'SD';

    const SE = 'SE';

    const SG = 'SG';

    const SH = 'SH';

    const SI = 'SI';

    const SJ = 'SJ';

    const SK = 'SK';

    const SL = 'SL';

    const SM = 'SM';

    const SN = 'SN';

    const SO = 'SO';

    const SR = 'SR';

    const SS = 'SS';

    const ST = 'ST';

    const SV = 'SV';

    const SX = 'SX';

    const SY = 'SY';

    const SZ = 'SZ';

    const TC = 'TC';

    const TD = 'TD';

    const TF = 'TF';

    const TG = 'TG';

    const TH = 'TH';

    const TJ = 'TJ';

    const TK = 'TK';

    const TL = 'TL';

    const TM = 'TM';

    const TN = 'TN';

    const TO = 'TO';

    const TR = 'TR';

    const TT = 'TT';

    const TV = 'TV';

    const TW = 'TW';

    const TZ = 'TZ';

    const UA = 'UA';

    const UG = 'UG';

    const UM = 'UM';

    const US = 'US';

    const UY = 'UY';

    const UZ = 'UZ';

    const VA = 'VA';

    const VC = 'VC';

    const VE = 'VE';

    const VG = 'VG';

    const VI = 'VI';

    const VN = 'VN';

    const VU = 'VU';

    const WF = 'WF';

    const WS = 'WS';

    const XK = 'XK';

    const YE = 'YE';

    const YT = 'YT';

    const ZA = 'ZA';

    const ZM = 'ZM';

    const ZW = 'ZW';

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::AD,
            self::AE,
            self::AF,
            self::AG,
            self::AI,
            self::AL,
            self::AM,
            self::AO,
            self::AQ,
            self::AR,
            self::_AS,
            self::AT,
            self::AU,
            self::AW,
            self::AX,
            self::AZ,
            self::BA,
            self::BB,
            self::BD,
            self::BE,
            self::BF,
            self::BG,
            self::BH,
            self::BI,
            self::BJ,
            self::BL,
            self::BM,
            self::BN,
            self::BO,
            self::BQ,
            self::BR,
            self::BS,
            self::BT,
            self::BV,
            self::BW,
            self::BY,
            self::BZ,
            self::CA,
            self::CC,
            self::CD,
            self::CF,
            self::CG,
            self::CH,
            self::CI,
            self::CK,
            self::CL,
            self::CM,
            self::CN,
            self::CO,
            self::CR,
            self::CU,
            self::CV,
            self::CW,
            self::CX,
            self::CY,
            self::CZ,
            self::DE,
            self::DJ,
            self::DK,
            self::DM,
            self::_DO,
            self::DZ,
            self::EC,
            self::EE,
            self::EG,
            self::EH,
            self::ER,
            self::ES,
            self::ET,
            self::FI,
            self::FJ,
            self::FK,
            self::FM,
            self::FO,
            self::FR,
            self::GA,
            self::GB,
            self::GD,
            self::GE,
            self::GF,
            self::GG,
            self::GH,
            self::GI,
            self::GL,
            self::GM,
            self::GN,
            self::GP,
            self::GQ,
            self::GR,
            self::GS,
            self::GT,
            self::GU,
            self::GW,
            self::GY,
            self::HK,
            self::HM,
            self::HN,
            self::HR,
            self::HT,
            self::HU,
            self::ID,
            self::IE,
            self::IL,
            self::IM,
            self::IN,
            self::IO,
            self::IQ,
            self::IR,
            self::IS,
            self::IT,
            self::JE,
            self::JM,
            self::JO,
            self::JP,
            self::KE,
            self::KG,
            self::KH,
            self::KI,
            self::KM,
            self::KN,
            self::KP,
            self::KR,
            self::KW,
            self::KY,
            self::KZ,
            self::LA,
            self::LB,
            self::LC,
            self::LI,
            self::LK,
            self::LR,
            self::LS,
            self::LT,
            self::LU,
            self::LV,
            self::LY,
            self::MA,
            self::MC,
            self::MD,
            self::ME,
            self::MF,
            self::MG,
            self::MH,
            self::MK,
            self::ML,
            self::MM,
            self::MN,
            self::MO,
            self::MP,
            self::MQ,
            self::MR,
            self::MS,
            self::MT,
            self::MU,
            self::MV,
            self::MW,
            self::MX,
            self::MY,
            self::MZ,
            self::NA,
            self::NC,
            self::NE,
            self::NF,
            self::NG,
            self::NI,
            self::NL,
            self::NO,
            self::NP,
            self::NR,
            self::NU,
            self::NZ,
            self::OM,
            self::PA,
            self::PE,
            self::PF,
            self::PG,
            self::PH,
            self::PK,
            self::PL,
            self::PM,
            self::PN,
            self::PR,
            self::PS,
            self::PT,
            self::PW,
            self::PY,
            self::QA,
            self::RE,
            self::RO,
            self::RS,
            self::RU,
            self::RW,
            self::SA,
            self::SB,
            self::SC,
            self::SD,
            self::SE,
            self::SG,
            self::SH,
            self::SI,
            self::SJ,
            self::SK,
            self::SL,
            self::SM,
            self::SN,
            self::SO,
            self::SR,
            self::SS,
            self::ST,
            self::SV,
            self::SX,
            self::SY,
            self::SZ,
            self::TC,
            self::TD,
            self::TF,
            self::TG,
            self::TH,
            self::TJ,
            self::TK,
            self::TL,
            self::TM,
            self::TN,
            self::TO,
            self::TR,
            self::TT,
            self::TV,
            self::TW,
            self::TZ,
            self::UA,
            self::UG,
            self::UM,
            self::US,
            self::UY,
            self::UZ,
            self::VA,
            self::VC,
            self::VE,
            self::VG,
            self::VI,
            self::VN,
            self::VU,
            self::WF,
            self::WS,
            self::XK,
            self::YE,
            self::YT,
            self::ZA,
            self::ZM,
            self::ZW
        ];
    }
}


