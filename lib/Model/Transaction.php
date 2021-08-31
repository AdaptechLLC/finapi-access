<?php
/**
 * Transaction
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
 * <strong>RESTful API for Account Information Services (AIS) and Payment Initiation Services (PIS)</strong>  The following pages give you some general information on how to use our APIs.<br/> The actual API services documentation then follows further below. You can use the menu to jump between API sections. <br/> <br/> This page has a built-in HTTP(S) client, so you can test the services directly from within this page, by filling in the request parameters and/or body in the respective services, and then hitting the TRY button. Note that you need to be authorized to make a successful API call. To authorize, refer to the 'Authorization' section of the API, or just use the OAUTH button that can be found near the TRY button. <br/> <br/> You should also check out the <a href=\"https://finapi.zendesk.com/hc/en-us\" target=\"_blank\">Developer Portal</a> for more information. If you need any help with the API, contact support@finapi.io. <br/>  <h2>General information</h2>  <h3><strong>Error Responses</strong></h3> When an API call returns with an error, then in general it has the structure shown in the following example:  <pre> {   \"errors\": [     {       \"message\": \"Interface 'FINTS_SERVER' is not supported for this operation.\",       \"code\": \"BAD_REQUEST\",       \"type\": \"TECHNICAL\"     }   ],   \"date\": \"2020-11-19 16:54:06.854\",   \"requestId\": \"selfgen-312042e7-df55-47e4-bffd-956a68ef37b5\",   \"endpoint\": \"POST /api/v1/bankConnections/import\",   \"authContext\": \"1/21\",   \"bank\": \"DEMO0002 - finAPI Test Redirect Bank\" } </pre>  If an API call requires an additional authentication by the user, HTTP code 510 is returned and the error response contains the additional \"multiStepAuthentication\" object, see the following example:  <pre> {   \"errors\": [     {       \"message\": \"Es ist eine zusätzliche Authentifizierung erforderlich. Bitte geben Sie folgenden Code an: 123456\",       \"code\": \"ADDITIONAL_AUTHENTICATION_REQUIRED\",       \"type\": \"BUSINESS\",       \"multiStepAuthentication\": {         \"hash\": \"678b13f4be9ed7d981a840af8131223a\",         \"status\": \"CHALLENGE_RESPONSE_REQUIRED\",         \"challengeMessage\": \"Es ist eine zusätzliche Authentifizierung erforderlich. Bitte geben Sie folgenden Code an: 123456\",         \"answerFieldLabel\": \"TAN\",         \"redirectUrl\": null,         \"redirectContext\": null,         \"redirectContextField\": null,         \"twoStepProcedures\": null,         \"photoTanMimeType\": null,         \"photoTanData\": null,         \"opticalData\": null       }     }   ],   \"date\": \"2019-11-29 09:51:55.931\",   \"requestId\": \"selfgen-45059c99-1b14-4df7-9bd3-9d5f126df294\",   \"endpoint\": \"POST /api/v1/bankConnections/import\",   \"authContext\": \"1/18\",   \"bank\": \"DEMO0001 - finAPI Test Bank\" } </pre>  An exception to this error format are API authentication errors, where the following structure is returned:  <pre> {   \"error\": \"invalid_token\",   \"error_description\": \"Invalid access token: cccbce46-xxxx-xxxx-xxxx-xxxxxxxxxx\" } </pre>  <h3><strong>Paging</strong></h3> API services that may potentially return a lot of data implement paging. They return a limited number of entries within a \"page\". Further entries must be fetched with subsequent calls. <br/><br/> Any API service that implements paging provides the following input parameters:<br/> &bull; \"page\": the number of the page to be retrieved (starting with 1).<br/> &bull; \"perPage\": the number of entries within a page. The default and maximum value is stated in the documentation of the respective services.  A paged response contains an additional \"paging\" object with the following structure:  <pre> {   ...   ,   \"paging\": {     \"page\": 1,     \"perPage\": 20,     \"pageCount\": 234,     \"totalCount\": 4662   } } </pre>  <h3><strong>Internationalization</strong></h3> The finAPI services support internationalization which means you can define the language you prefer for API service responses. <br/><br/> The following languages are available: German, English, Czech, Slovak. <br/><br/> The preferred language can be defined by providing the official HTTP <strong>Accept-Language</strong> header. For web form request issued in a web browser, the Accept-Language header is automatically set by the browser based on the browser's or operation system's language settings. For direct API calls, the Accept-Language header must be set explicity. <br/><br/> finAPI reacts on the official iso language codes &quot;de&quot;, &quot;en&quot;, &quot;cs&quot; and &quot;sk&quot; for the named languages. Additional subtags supported by the Accept-Language header may be provided, e.g. &quot;en-US&quot;, but are ignored. <br/> If no Accept-Language header is given, German is used as the default language. <br/><br/> Exceptions:<br/> &bull; Bank login hints and login fields are only available in the language of the bank and not being translated.<br/> &bull; Direct messages from the bank systems typically returned as BUSINESS errors will not be translated.<br/> &bull; BUSINESS errors created by finAPI directly are available in German and English.<br/> &bull; TECHNICAL errors messages meant for developers are mostly in English, but also may be translated.  <h3><strong>Request IDs</strong></h3> With any API call, you can pass a request ID via a header with name \"X-Request-Id\". The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. <br/><br/> If you don't pass a request ID for a call, finAPI will generate a random ID internally. <br/><br/> The request ID is always returned back in the response of a service, as a header with name \"X-Request-Id\". <br/><br/> We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster.  <h3><strong>Overriding HTTP methods</strong></h3> Some HTTP clients do not support the HTTP methods PATCH or DELETE. If you are using such a client in your application, you can use a POST request instead with a special HTTP header indicating the originally intended HTTP method. <br/><br/> The header's name is <strong>X-HTTP-Method-Override</strong>. Set its value to either <strong>PATCH</strong> or <strong>DELETE</strong>. POST Requests having this header set will be treated either as PATCH or DELETE by the finAPI servers. <br/><br/> Example: <br/><br/> <strong>X-HTTP-Method-Override: PATCH</strong><br/> POST /api/v1/label/51<br/> {\"name\": \"changed label\"}<br/><br/> will be interpreted by finAPI as:<br/><br/> PATCH /api/v1/label/51<br/> {\"name\": \"changed label\"}<br/>  <h3><strong>User metadata</strong></h3> With the migration to PSD2 APIs, a new term called \"User metadata\" (also known as \"PSU metadata\") has been introduced to the API. This user metadata aims to inform the banking API if there was a real end-user behind an HTTP request or if the request was triggered by a system (e.g. by an automatic batch update). In the latter case, the bank may apply some restrictions such as limiting the number of HTTP requests for a single consent. Also, some operations may be forbidden entirely by the banking API. For example, some banks do not allow issuing a new consent without the end-user being involved. Therefore, the PSU metadata must always be provided for such operations. <br/><br/> As finAPI does not have direct interaction with the end-user, it is the client application's responsibility to provide all the necessary information about the end-user. This must be done by sending additional headers with every request triggered on behalf of the end-user. <br/><br/> At the moment, the following headers are supported by the API:<br/> &bull; \"PSU-IP-Address\" - the IP address of the user's device.<br/> &bull; \"PSU-Device-OS\" - the user's device and/or operating system identification.<br/> &bull; \"PSU-User-Agent\" - the user's web browser or other client device identification. <br/><br/> Web-form customers (or unlicensed customers) must send the PSU headers from their client application to finAPI. It will not take effect if web form is triggered for the workflow. <br/> In this case Values for the PSU-Device-OS and PSU-User-Agent headers are identified by the JS platform detection and the PSU-IP-Address is obtained from a public Cloudflare service: https://www.cloudflare.com/cdn-cgi/trace. <br/><br/> But it is certainly necessary and obligatory to have the true PSU header data for API calls which don't trigger a web form (like \"Update a bank connection\").  <h3><strong>FAQ</strong></h3> <strong>Is there a finAPI SDK?</strong> <br/> Currently we do not offer a native SDK, but there is the option to generate a SDK for almost any target language via OpenAPI. Use the 'Download SDK' button on this page for SDK generation. <br/> <br/> <strong>How can I enable finAPI's automatic batch update?</strong> <br/> Currently there is no way to set up the batch update via the API. Please contact support@finapi.io for this. <br/> <br/> <strong>Why do I need to keep authorizing when calling services on this page?</strong> <br/> This page is a \"one-page-app\". Reloading the page resets the OAuth authorization context. There is generally no need to reload the page, so just don't do it and your authorization will persist.
 *
 * The version of the OpenAPI document: 1.135.0
 * Contact: kontakt@finapi.io
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.2.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace OpenAPIAccess\Client\Model;

use \ArrayAccess;
use \OpenAPIAccess\Client\ObjectSerializer;

/**
 * Transaction Class Doc Comment
 *
 * @category Class
 * @description Container for a transaction&#39;s data
 * @package  OpenAPIAccess\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class Transaction implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Transaction';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'int',
        'parent_id' => 'int',
        'account_id' => 'int',
        'value_date' => 'string',
        'bank_booking_date' => 'string',
        'finapi_booking_date' => 'string',
        'amount' => 'float',
        'currency' => 'Currency',
        'purpose' => 'string',
        'counterpart_name' => 'string',
        'counterpart_account_number' => 'string',
        'counterpart_iban' => 'string',
        'counterpart_blz' => 'string',
        'counterpart_bic' => 'string',
        'counterpart_bank_name' => 'string',
        'counterpart_mandate_reference' => 'string',
        'counterpart_customer_reference' => 'string',
        'counterpart_creditor_id' => 'string',
        'counterpart_debitor_id' => 'string',
        'type' => 'string',
        'type_code_zka' => 'string',
        'type_code_swift' => 'string',
        'sepa_purpose_code' => 'string',
        'primanota' => 'string',
        'category' => 'Category',
        'labels' => '\OpenAPIAccess\Client\Model\Label[]',
        'is_potential_duplicate' => 'bool',
        'is_adjusting_entry' => 'bool',
        'is_new' => 'bool',
        'import_date' => 'string',
        'children' => 'int[]',
        'end_to_end_reference' => 'string',
        'compensation_amount' => 'float',
        'original_amount' => 'float',
        'original_currency' => 'Currency',
        'different_debitor' => 'string',
        'different_creditor' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'id' => 'int64',
        'parent_id' => 'int64',
        'account_id' => 'int64',
        'value_date' => null,
        'bank_booking_date' => null,
        'finapi_booking_date' => null,
        'amount' => null,
        'currency' => null,
        'purpose' => null,
        'counterpart_name' => null,
        'counterpart_account_number' => null,
        'counterpart_iban' => null,
        'counterpart_blz' => null,
        'counterpart_bic' => null,
        'counterpart_bank_name' => null,
        'counterpart_mandate_reference' => null,
        'counterpart_customer_reference' => null,
        'counterpart_creditor_id' => null,
        'counterpart_debitor_id' => null,
        'type' => null,
        'type_code_zka' => null,
        'type_code_swift' => null,
        'sepa_purpose_code' => null,
        'primanota' => null,
        'category' => null,
        'labels' => null,
        'is_potential_duplicate' => null,
        'is_adjusting_entry' => null,
        'is_new' => null,
        'import_date' => null,
        'children' => 'int64',
        'end_to_end_reference' => null,
        'compensation_amount' => null,
        'original_amount' => null,
        'original_currency' => null,
        'different_debitor' => null,
        'different_creditor' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'id' => 'id',
        'parent_id' => 'parentId',
        'account_id' => 'accountId',
        'value_date' => 'valueDate',
        'bank_booking_date' => 'bankBookingDate',
        'finapi_booking_date' => 'finapiBookingDate',
        'amount' => 'amount',
        'currency' => 'currency',
        'purpose' => 'purpose',
        'counterpart_name' => 'counterpartName',
        'counterpart_account_number' => 'counterpartAccountNumber',
        'counterpart_iban' => 'counterpartIban',
        'counterpart_blz' => 'counterpartBlz',
        'counterpart_bic' => 'counterpartBic',
        'counterpart_bank_name' => 'counterpartBankName',
        'counterpart_mandate_reference' => 'counterpartMandateReference',
        'counterpart_customer_reference' => 'counterpartCustomerReference',
        'counterpart_creditor_id' => 'counterpartCreditorId',
        'counterpart_debitor_id' => 'counterpartDebitorId',
        'type' => 'type',
        'type_code_zka' => 'typeCodeZka',
        'type_code_swift' => 'typeCodeSwift',
        'sepa_purpose_code' => 'sepaPurposeCode',
        'primanota' => 'primanota',
        'category' => 'category',
        'labels' => 'labels',
        'is_potential_duplicate' => 'isPotentialDuplicate',
        'is_adjusting_entry' => 'isAdjustingEntry',
        'is_new' => 'isNew',
        'import_date' => 'importDate',
        'children' => 'children',
        'end_to_end_reference' => 'endToEndReference',
        'compensation_amount' => 'compensationAmount',
        'original_amount' => 'originalAmount',
        'original_currency' => 'originalCurrency',
        'different_debitor' => 'differentDebitor',
        'different_creditor' => 'differentCreditor'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'parent_id' => 'setParentId',
        'account_id' => 'setAccountId',
        'value_date' => 'setValueDate',
        'bank_booking_date' => 'setBankBookingDate',
        'finapi_booking_date' => 'setFinapiBookingDate',
        'amount' => 'setAmount',
        'currency' => 'setCurrency',
        'purpose' => 'setPurpose',
        'counterpart_name' => 'setCounterpartName',
        'counterpart_account_number' => 'setCounterpartAccountNumber',
        'counterpart_iban' => 'setCounterpartIban',
        'counterpart_blz' => 'setCounterpartBlz',
        'counterpart_bic' => 'setCounterpartBic',
        'counterpart_bank_name' => 'setCounterpartBankName',
        'counterpart_mandate_reference' => 'setCounterpartMandateReference',
        'counterpart_customer_reference' => 'setCounterpartCustomerReference',
        'counterpart_creditor_id' => 'setCounterpartCreditorId',
        'counterpart_debitor_id' => 'setCounterpartDebitorId',
        'type' => 'setType',
        'type_code_zka' => 'setTypeCodeZka',
        'type_code_swift' => 'setTypeCodeSwift',
        'sepa_purpose_code' => 'setSepaPurposeCode',
        'primanota' => 'setPrimanota',
        'category' => 'setCategory',
        'labels' => 'setLabels',
        'is_potential_duplicate' => 'setIsPotentialDuplicate',
        'is_adjusting_entry' => 'setIsAdjustingEntry',
        'is_new' => 'setIsNew',
        'import_date' => 'setImportDate',
        'children' => 'setChildren',
        'end_to_end_reference' => 'setEndToEndReference',
        'compensation_amount' => 'setCompensationAmount',
        'original_amount' => 'setOriginalAmount',
        'original_currency' => 'setOriginalCurrency',
        'different_debitor' => 'setDifferentDebitor',
        'different_creditor' => 'setDifferentCreditor'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'parent_id' => 'getParentId',
        'account_id' => 'getAccountId',
        'value_date' => 'getValueDate',
        'bank_booking_date' => 'getBankBookingDate',
        'finapi_booking_date' => 'getFinapiBookingDate',
        'amount' => 'getAmount',
        'currency' => 'getCurrency',
        'purpose' => 'getPurpose',
        'counterpart_name' => 'getCounterpartName',
        'counterpart_account_number' => 'getCounterpartAccountNumber',
        'counterpart_iban' => 'getCounterpartIban',
        'counterpart_blz' => 'getCounterpartBlz',
        'counterpart_bic' => 'getCounterpartBic',
        'counterpart_bank_name' => 'getCounterpartBankName',
        'counterpart_mandate_reference' => 'getCounterpartMandateReference',
        'counterpart_customer_reference' => 'getCounterpartCustomerReference',
        'counterpart_creditor_id' => 'getCounterpartCreditorId',
        'counterpart_debitor_id' => 'getCounterpartDebitorId',
        'type' => 'getType',
        'type_code_zka' => 'getTypeCodeZka',
        'type_code_swift' => 'getTypeCodeSwift',
        'sepa_purpose_code' => 'getSepaPurposeCode',
        'primanota' => 'getPrimanota',
        'category' => 'getCategory',
        'labels' => 'getLabels',
        'is_potential_duplicate' => 'getIsPotentialDuplicate',
        'is_adjusting_entry' => 'getIsAdjustingEntry',
        'is_new' => 'getIsNew',
        'import_date' => 'getImportDate',
        'children' => 'getChildren',
        'end_to_end_reference' => 'getEndToEndReference',
        'compensation_amount' => 'getCompensationAmount',
        'original_amount' => 'getOriginalAmount',
        'original_currency' => 'getOriginalCurrency',
        'different_debitor' => 'getDifferentDebitor',
        'different_creditor' => 'getDifferentCreditor'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['id'] = $data['id'] ?? null;
        $this->container['parent_id'] = $data['parent_id'] ?? null;
        $this->container['account_id'] = $data['account_id'] ?? null;
        $this->container['value_date'] = $data['value_date'] ?? null;
        $this->container['bank_booking_date'] = $data['bank_booking_date'] ?? null;
        $this->container['finapi_booking_date'] = $data['finapi_booking_date'] ?? null;
        $this->container['amount'] = $data['amount'] ?? null;
        $this->container['currency'] = $data['currency'] ?? null;
        $this->container['purpose'] = $data['purpose'] ?? null;
        $this->container['counterpart_name'] = $data['counterpart_name'] ?? null;
        $this->container['counterpart_account_number'] = $data['counterpart_account_number'] ?? null;
        $this->container['counterpart_iban'] = $data['counterpart_iban'] ?? null;
        $this->container['counterpart_blz'] = $data['counterpart_blz'] ?? null;
        $this->container['counterpart_bic'] = $data['counterpart_bic'] ?? null;
        $this->container['counterpart_bank_name'] = $data['counterpart_bank_name'] ?? null;
        $this->container['counterpart_mandate_reference'] = $data['counterpart_mandate_reference'] ?? null;
        $this->container['counterpart_customer_reference'] = $data['counterpart_customer_reference'] ?? null;
        $this->container['counterpart_creditor_id'] = $data['counterpart_creditor_id'] ?? null;
        $this->container['counterpart_debitor_id'] = $data['counterpart_debitor_id'] ?? null;
        $this->container['type'] = $data['type'] ?? null;
        $this->container['type_code_zka'] = $data['type_code_zka'] ?? null;
        $this->container['type_code_swift'] = $data['type_code_swift'] ?? null;
        $this->container['sepa_purpose_code'] = $data['sepa_purpose_code'] ?? null;
        $this->container['primanota'] = $data['primanota'] ?? null;
        $this->container['category'] = $data['category'] ?? null;
        $this->container['labels'] = $data['labels'] ?? null;
        $this->container['is_potential_duplicate'] = $data['is_potential_duplicate'] ?? null;
        $this->container['is_adjusting_entry'] = $data['is_adjusting_entry'] ?? null;
        $this->container['is_new'] = $data['is_new'] ?? null;
        $this->container['import_date'] = $data['import_date'] ?? null;
        $this->container['children'] = $data['children'] ?? null;
        $this->container['end_to_end_reference'] = $data['end_to_end_reference'] ?? null;
        $this->container['compensation_amount'] = $data['compensation_amount'] ?? null;
        $this->container['original_amount'] = $data['original_amount'] ?? null;
        $this->container['original_currency'] = $data['original_currency'] ?? null;
        $this->container['different_debitor'] = $data['different_debitor'] ?? null;
        $this->container['different_creditor'] = $data['different_creditor'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['id'] === null) {
            $invalidProperties[] = "'id' can't be null";
        }
        if ($this->container['parent_id'] === null) {
            $invalidProperties[] = "'parent_id' can't be null";
        }
        if ($this->container['account_id'] === null) {
            $invalidProperties[] = "'account_id' can't be null";
        }
        if ($this->container['value_date'] === null) {
            $invalidProperties[] = "'value_date' can't be null";
        }
        if ($this->container['bank_booking_date'] === null) {
            $invalidProperties[] = "'bank_booking_date' can't be null";
        }
        if ($this->container['finapi_booking_date'] === null) {
            $invalidProperties[] = "'finapi_booking_date' can't be null";
        }
        if ($this->container['amount'] === null) {
            $invalidProperties[] = "'amount' can't be null";
        }
        if ($this->container['currency'] === null) {
            $invalidProperties[] = "'currency' can't be null";
        }
        if ($this->container['purpose'] === null) {
            $invalidProperties[] = "'purpose' can't be null";
        }
        if ($this->container['counterpart_name'] === null) {
            $invalidProperties[] = "'counterpart_name' can't be null";
        }
        if ($this->container['counterpart_account_number'] === null) {
            $invalidProperties[] = "'counterpart_account_number' can't be null";
        }
        if ($this->container['counterpart_iban'] === null) {
            $invalidProperties[] = "'counterpart_iban' can't be null";
        }
        if ($this->container['counterpart_blz'] === null) {
            $invalidProperties[] = "'counterpart_blz' can't be null";
        }
        if ($this->container['counterpart_bic'] === null) {
            $invalidProperties[] = "'counterpart_bic' can't be null";
        }
        if ($this->container['counterpart_bank_name'] === null) {
            $invalidProperties[] = "'counterpart_bank_name' can't be null";
        }
        if ($this->container['counterpart_mandate_reference'] === null) {
            $invalidProperties[] = "'counterpart_mandate_reference' can't be null";
        }
        if ($this->container['counterpart_customer_reference'] === null) {
            $invalidProperties[] = "'counterpart_customer_reference' can't be null";
        }
        if ($this->container['counterpart_creditor_id'] === null) {
            $invalidProperties[] = "'counterpart_creditor_id' can't be null";
        }
        if ($this->container['counterpart_debitor_id'] === null) {
            $invalidProperties[] = "'counterpart_debitor_id' can't be null";
        }
        if ($this->container['type'] === null) {
            $invalidProperties[] = "'type' can't be null";
        }
        if ($this->container['type_code_zka'] === null) {
            $invalidProperties[] = "'type_code_zka' can't be null";
        }
        if ($this->container['type_code_swift'] === null) {
            $invalidProperties[] = "'type_code_swift' can't be null";
        }
        if ($this->container['sepa_purpose_code'] === null) {
            $invalidProperties[] = "'sepa_purpose_code' can't be null";
        }
        if ($this->container['primanota'] === null) {
            $invalidProperties[] = "'primanota' can't be null";
        }
        if ($this->container['category'] === null) {
            $invalidProperties[] = "'category' can't be null";
        }
        if ($this->container['labels'] === null) {
            $invalidProperties[] = "'labels' can't be null";
        }
        if ($this->container['is_potential_duplicate'] === null) {
            $invalidProperties[] = "'is_potential_duplicate' can't be null";
        }
        if ($this->container['is_adjusting_entry'] === null) {
            $invalidProperties[] = "'is_adjusting_entry' can't be null";
        }
        if ($this->container['is_new'] === null) {
            $invalidProperties[] = "'is_new' can't be null";
        }
        if ($this->container['import_date'] === null) {
            $invalidProperties[] = "'import_date' can't be null";
        }
        if ($this->container['children'] === null) {
            $invalidProperties[] = "'children' can't be null";
        }
        if ($this->container['end_to_end_reference'] === null) {
            $invalidProperties[] = "'end_to_end_reference' can't be null";
        }
        if ($this->container['compensation_amount'] === null) {
            $invalidProperties[] = "'compensation_amount' can't be null";
        }
        if ($this->container['original_amount'] === null) {
            $invalidProperties[] = "'original_amount' can't be null";
        }
        if ($this->container['original_currency'] === null) {
            $invalidProperties[] = "'original_currency' can't be null";
        }
        if ($this->container['different_debitor'] === null) {
            $invalidProperties[] = "'different_debitor' can't be null";
        }
        if ($this->container['different_creditor'] === null) {
            $invalidProperties[] = "'different_creditor' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets id
     *
     * @return int
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param int $id Transaction identifier
     *
     * @return self
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets parent_id
     *
     * @return int
     */
    public function getParentId()
    {
        return $this->container['parent_id'];
    }

    /**
     * Sets parent_id
     *
     * @param int $parent_id Parent transaction identifier
     *
     * @return self
     */
    public function setParentId($parent_id)
    {
        $this->container['parent_id'] = $parent_id;

        return $this;
    }

    /**
     * Gets account_id
     *
     * @return int
     */
    public function getAccountId()
    {
        return $this->container['account_id'];
    }

    /**
     * Sets account_id
     *
     * @param int $account_id Account identifier
     *
     * @return self
     */
    public function setAccountId($account_id)
    {
        $this->container['account_id'] = $account_id;

        return $this;
    }

    /**
     * Gets value_date
     *
     * @return string
     */
    public function getValueDate()
    {
        return $this->container['value_date'];
    }

    /**
     * Sets value_date
     *
     * @param string $value_date Value date in the format 'YYYY-MM-DD HH:MM:SS.SSS' (german time).
     *
     * @return self
     */
    public function setValueDate($value_date)
    {
        $this->container['value_date'] = $value_date;

        return $this;
    }

    /**
     * Gets bank_booking_date
     *
     * @return string
     */
    public function getBankBookingDate()
    {
        return $this->container['bank_booking_date'];
    }

    /**
     * Sets bank_booking_date
     *
     * @param string $bank_booking_date Bank booking date in the format 'YYYY-MM-DD HH:MM:SS.SSS' (german time).
     *
     * @return self
     */
    public function setBankBookingDate($bank_booking_date)
    {
        $this->container['bank_booking_date'] = $bank_booking_date;

        return $this;
    }

    /**
     * Gets finapi_booking_date
     *
     * @return string
     */
    public function getFinapiBookingDate()
    {
        return $this->container['finapi_booking_date'];
    }

    /**
     * Sets finapi_booking_date
     *
     * @param string $finapi_booking_date finAPI Booking date in the format 'YYYY-MM-DD HH:MM:SS.SSS' (german time). NOTE: In some cases, banks may deliver transactions that are booked in future, but already included in the current account balance. To keep the account balance consistent with the set of transactions, such \"future transactions\" will be imported with their finapiBookingDate set to the current date (i.e.: date of import). The finapiBookingDate will automatically get adjusted towards the bankBookingDate each time the associated bank account is updated. Example: A transaction is imported on July, 3rd, with a bank reported booking date of July, 6th. The transaction will be imported with its finapiBookingDate set to July, 3rd. Then, on July 4th, the associated account is updated. During this update, the transaction's finapiBookingDate will be automatically adjusted to July 4th. This adjustment of the finapiBookingDate takes place on each update until the bank account is updated on July 6th or later, in which case the transaction's finapiBookingDate will be adjusted to its final value, July 6th.<br/> The finapiBookingDate is the date that is used by the finAPI PFM services. E.g. when you calculate the spendings of an account for the current month, and have a transaction with finapiBookingDate in the current month but bankBookingDate at the beginning of the next month, then this transaction is included in the calculations (as the bank has this transaction's amount included in the current account balance as well).
     *
     * @return self
     */
    public function setFinapiBookingDate($finapi_booking_date)
    {
        $this->container['finapi_booking_date'] = $finapi_booking_date;

        return $this;
    }

    /**
     * Gets amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->container['amount'];
    }

    /**
     * Sets amount
     *
     * @param float $amount Transaction amount
     *
     * @return self
     */
    public function setAmount($amount)
    {
        $this->container['amount'] = $amount;

        return $this;
    }

    /**
     * Gets currency
     *
     * @return Currency
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param Currency $currency <strong>Type:</strong> Currency<br/> Transaction currency in ISO 4217 format.This field can be null if not explicitly provided the bank. In this case it can be assumed as account’s currency.
     *
     * @return self
     */
    public function setCurrency($currency)
    {
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets purpose
     *
     * @return string
     */
    public function getPurpose()
    {
        return $this->container['purpose'];
    }

    /**
     * Sets purpose
     *
     * @param string $purpose Transaction purpose. Maximum length: 2000
     *
     * @return self
     */
    public function setPurpose($purpose)
    {
        $this->container['purpose'] = $purpose;

        return $this;
    }

    /**
     * Gets counterpart_name
     *
     * @return string
     */
    public function getCounterpartName()
    {
        return $this->container['counterpart_name'];
    }

    /**
     * Sets counterpart_name
     *
     * @param string $counterpart_name Counterpart name. Maximum length: 80
     *
     * @return self
     */
    public function setCounterpartName($counterpart_name)
    {
        $this->container['counterpart_name'] = $counterpart_name;

        return $this;
    }

    /**
     * Gets counterpart_account_number
     *
     * @return string
     */
    public function getCounterpartAccountNumber()
    {
        return $this->container['counterpart_account_number'];
    }

    /**
     * Sets counterpart_account_number
     *
     * @param string $counterpart_account_number Counterpart account number
     *
     * @return self
     */
    public function setCounterpartAccountNumber($counterpart_account_number)
    {
        $this->container['counterpart_account_number'] = $counterpart_account_number;

        return $this;
    }

    /**
     * Gets counterpart_iban
     *
     * @return string
     */
    public function getCounterpartIban()
    {
        return $this->container['counterpart_iban'];
    }

    /**
     * Sets counterpart_iban
     *
     * @param string $counterpart_iban Counterpart IBAN
     *
     * @return self
     */
    public function setCounterpartIban($counterpart_iban)
    {
        $this->container['counterpart_iban'] = $counterpart_iban;

        return $this;
    }

    /**
     * Gets counterpart_blz
     *
     * @return string
     */
    public function getCounterpartBlz()
    {
        return $this->container['counterpart_blz'];
    }

    /**
     * Sets counterpart_blz
     *
     * @param string $counterpart_blz Counterpart BLZ
     *
     * @return self
     */
    public function setCounterpartBlz($counterpart_blz)
    {
        $this->container['counterpart_blz'] = $counterpart_blz;

        return $this;
    }

    /**
     * Gets counterpart_bic
     *
     * @return string
     */
    public function getCounterpartBic()
    {
        return $this->container['counterpart_bic'];
    }

    /**
     * Sets counterpart_bic
     *
     * @param string $counterpart_bic Counterpart BIC
     *
     * @return self
     */
    public function setCounterpartBic($counterpart_bic)
    {
        $this->container['counterpart_bic'] = $counterpart_bic;

        return $this;
    }

    /**
     * Gets counterpart_bank_name
     *
     * @return string
     */
    public function getCounterpartBankName()
    {
        return $this->container['counterpart_bank_name'];
    }

    /**
     * Sets counterpart_bank_name
     *
     * @param string $counterpart_bank_name Counterpart Bank name
     *
     * @return self
     */
    public function setCounterpartBankName($counterpart_bank_name)
    {
        $this->container['counterpart_bank_name'] = $counterpart_bank_name;

        return $this;
    }

    /**
     * Gets counterpart_mandate_reference
     *
     * @return string
     */
    public function getCounterpartMandateReference()
    {
        return $this->container['counterpart_mandate_reference'];
    }

    /**
     * Sets counterpart_mandate_reference
     *
     * @param string $counterpart_mandate_reference The mandate reference of the counterpart
     *
     * @return self
     */
    public function setCounterpartMandateReference($counterpart_mandate_reference)
    {
        $this->container['counterpart_mandate_reference'] = $counterpart_mandate_reference;

        return $this;
    }

    /**
     * Gets counterpart_customer_reference
     *
     * @return string
     */
    public function getCounterpartCustomerReference()
    {
        return $this->container['counterpart_customer_reference'];
    }

    /**
     * Sets counterpart_customer_reference
     *
     * @param string $counterpart_customer_reference The customer reference of the counterpart
     *
     * @return self
     */
    public function setCounterpartCustomerReference($counterpart_customer_reference)
    {
        $this->container['counterpart_customer_reference'] = $counterpart_customer_reference;

        return $this;
    }

    /**
     * Gets counterpart_creditor_id
     *
     * @return string
     */
    public function getCounterpartCreditorId()
    {
        return $this->container['counterpart_creditor_id'];
    }

    /**
     * Sets counterpart_creditor_id
     *
     * @param string $counterpart_creditor_id The creditor ID of the counterpart. Exists only for SEPA direct debit transactions (\"Lastschrift\").
     *
     * @return self
     */
    public function setCounterpartCreditorId($counterpart_creditor_id)
    {
        $this->container['counterpart_creditor_id'] = $counterpart_creditor_id;

        return $this;
    }

    /**
     * Gets counterpart_debitor_id
     *
     * @return string
     */
    public function getCounterpartDebitorId()
    {
        return $this->container['counterpart_debitor_id'];
    }

    /**
     * Sets counterpart_debitor_id
     *
     * @param string $counterpart_debitor_id The originator's identification code. Exists only for SEPA money transfer transactions (\"Überweisung\").
     *
     * @return self
     */
    public function setCounterpartDebitorId($counterpart_debitor_id)
    {
        $this->container['counterpart_debitor_id'] = $counterpart_debitor_id;

        return $this;
    }

    /**
     * Gets type
     *
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string $type Transaction type, according to the bank. If set, this will contain a German term that you can display to the user. Some examples of common values are: \"Lastschrift\", \"Auslands&uuml;berweisung\", \"Geb&uuml;hren\", \"Zinsen\". The maximum possible length of this field is 255 characters.
     *
     * @return self
     */
    public function setType($type)
    {
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets type_code_zka
     *
     * @return string
     */
    public function getTypeCodeZka()
    {
        return $this->container['type_code_zka'];
    }

    /**
     * Sets type_code_zka
     *
     * @param string $type_code_zka ZKA business transaction code which relates to the transaction's type. Possible values range from 1 through 999. If no information about the ZKA type code is available, then this field will be null.
     *
     * @return self
     */
    public function setTypeCodeZka($type_code_zka)
    {
        $this->container['type_code_zka'] = $type_code_zka;

        return $this;
    }

    /**
     * Gets type_code_swift
     *
     * @return string
     */
    public function getTypeCodeSwift()
    {
        return $this->container['type_code_swift'];
    }

    /**
     * Sets type_code_swift
     *
     * @param string $type_code_swift SWIFT transaction type code. If no information about the SWIFT code is available, then this field will be null.
     *
     * @return self
     */
    public function setTypeCodeSwift($type_code_swift)
    {
        $this->container['type_code_swift'] = $type_code_swift;

        return $this;
    }

    /**
     * Gets sepa_purpose_code
     *
     * @return string
     */
    public function getSepaPurposeCode()
    {
        return $this->container['sepa_purpose_code'];
    }

    /**
     * Sets sepa_purpose_code
     *
     * @param string $sepa_purpose_code SEPA purpose code, according to ISO 20022
     *
     * @return self
     */
    public function setSepaPurposeCode($sepa_purpose_code)
    {
        $this->container['sepa_purpose_code'] = $sepa_purpose_code;

        return $this;
    }

    /**
     * Gets primanota
     *
     * @return string
     */
    public function getPrimanota()
    {
        return $this->container['primanota'];
    }

    /**
     * Sets primanota
     *
     * @param string $primanota Transaction primanota (bank side identification number)
     *
     * @return self
     */
    public function setPrimanota($primanota)
    {
        $this->container['primanota'] = $primanota;

        return $this;
    }

    /**
     * Gets category
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->container['category'];
    }

    /**
     * Sets category
     *
     * @param Category $category <strong>Type:</strong> Category<br/> Transaction category, if any is assigned. Note: Recently imported transactions that have currently no category assigned might still get categorized by the background categorization process. To check the status of the background categorization, see GET /bankConnections. Manual category assignments to a transaction will remove the transaction from the background categorization process (i.e. the background categorization process will never overwrite a manual category assignment).
     *
     * @return self
     */
    public function setCategory($category)
    {
        $this->container['category'] = $category;

        return $this;
    }

    /**
     * Gets labels
     *
     * @return \OpenAPIAccess\Client\Model\Label[]
     */
    public function getLabels()
    {
        return $this->container['labels'];
    }

    /**
     * Sets labels
     *
     * @param \OpenAPIAccess\Client\Model\Label[] $labels <strong>Type:</strong> Label<br/> Array of assigned labels
     *
     * @return self
     */
    public function setLabels($labels)
    {
        $this->container['labels'] = $labels;

        return $this;
    }

    /**
     * Gets is_potential_duplicate
     *
     * @return bool
     */
    public function getIsPotentialDuplicate()
    {
        return $this->container['is_potential_duplicate'];
    }

    /**
     * Sets is_potential_duplicate
     *
     * @param bool $is_potential_duplicate While finAPI uses a well-elaborated algorithm for uniquely identifying transactions, there is still the possibility that during an account update, a transaction that was imported previously may be imported a second time as a new transaction. For example, this can happen if some transaction data changes on the bank server side. However, finAPI also includes an algorithm of identifying such \"potential duplicate\" transactions. If this field is set to true, it means that finAPI detected a similar transaction that might actually be the same. It is recommended to communicate this information to the end user, and give him an option to delete the transaction in case he confirms that it really is a duplicate.
     *
     * @return self
     */
    public function setIsPotentialDuplicate($is_potential_duplicate)
    {
        $this->container['is_potential_duplicate'] = $is_potential_duplicate;

        return $this;
    }

    /**
     * Gets is_adjusting_entry
     *
     * @return bool
     */
    public function getIsAdjustingEntry()
    {
        return $this->container['is_adjusting_entry'];
    }

    /**
     * Sets is_adjusting_entry
     *
     * @param bool $is_adjusting_entry Indicating whether this transaction is an adjusting entry ('Zwischensaldo').<br/><br/>Adjusting entries do not originate from the bank, but are added by finAPI during an account update when the bank reported account balance does not add up to the set of transactions that finAPI receives for the account. In this case, the adjusting entry will fix the deviation between the balance and the received transactions so that both adds up again.<br/><br/>Possible causes for such deviations are:<br/>- Inconsistencies in how the bank calculates the balance, for instance when not yet booked transactions are already included in the balance, but not included in the set of transactions<br/>- Gaps in the transaction history that finAPI receives, for instance because the account has not been updated for a while and older transactions are no longer available
     *
     * @return self
     */
    public function setIsAdjustingEntry($is_adjusting_entry)
    {
        $this->container['is_adjusting_entry'] = $is_adjusting_entry;

        return $this;
    }

    /**
     * Gets is_new
     *
     * @return bool
     */
    public function getIsNew()
    {
        return $this->container['is_new'];
    }

    /**
     * Sets is_new
     *
     * @param bool $is_new Indicating whether this transaction is 'new' or not. Any newly imported transaction will have this flag initially set to true. How you use this field is up to your interpretation. For example, you might want to set it to false once a user has clicked on/seen the transaction. You can change this flag to 'false' with the PATCH method.
     *
     * @return self
     */
    public function setIsNew($is_new)
    {
        $this->container['is_new'] = $is_new;

        return $this;
    }

    /**
     * Gets import_date
     *
     * @return string
     */
    public function getImportDate()
    {
        return $this->container['import_date'];
    }

    /**
     * Sets import_date
     *
     * @param string $import_date Date of transaction import, in the format 'YYYY-MM-DD HH:MM:SS.SSS' (german time).
     *
     * @return self
     */
    public function setImportDate($import_date)
    {
        $this->container['import_date'] = $import_date;

        return $this;
    }

    /**
     * Gets children
     *
     * @return int[]
     */
    public function getChildren()
    {
        return $this->container['children'];
    }

    /**
     * Sets children
     *
     * @param int[] $children Sub-transactions identifiers (if this transaction is split)
     *
     * @return self
     */
    public function setChildren($children)
    {
        $this->container['children'] = $children;

        return $this;
    }

    /**
     * Gets end_to_end_reference
     *
     * @return string
     */
    public function getEndToEndReference()
    {
        return $this->container['end_to_end_reference'];
    }

    /**
     * Sets end_to_end_reference
     *
     * @param string $end_to_end_reference End-To-End reference
     *
     * @return self
     */
    public function setEndToEndReference($end_to_end_reference)
    {
        $this->container['end_to_end_reference'] = $end_to_end_reference;

        return $this;
    }

    /**
     * Gets compensation_amount
     *
     * @return float
     */
    public function getCompensationAmount()
    {
        return $this->container['compensation_amount'];
    }

    /**
     * Sets compensation_amount
     *
     * @param float $compensation_amount Compensation Amount. Sum of reimbursement of out-of-pocket expenses plus processing brokerage in case of a national return / refund debit as well as an optional interest equalisation. Exists predominantly for SEPA direct debit returns.
     *
     * @return self
     */
    public function setCompensationAmount($compensation_amount)
    {
        $this->container['compensation_amount'] = $compensation_amount;

        return $this;
    }

    /**
     * Gets original_amount
     *
     * @return float
     */
    public function getOriginalAmount()
    {
        return $this->container['original_amount'];
    }

    /**
     * Sets original_amount
     *
     * @param float $original_amount Original Amount of the original direct debit. Exists predominantly for SEPA direct debit returns.
     *
     * @return self
     */
    public function setOriginalAmount($original_amount)
    {
        $this->container['original_amount'] = $original_amount;

        return $this;
    }

    /**
     * Gets original_currency
     *
     * @return Currency
     */
    public function getOriginalCurrency()
    {
        return $this->container['original_currency'];
    }

    /**
     * Sets original_currency
     *
     * @param Currency $original_currency <strong>Type:</strong> Currency<br/> Currency of the original amount in ISO 4217 format. This field can be null if not explicitly provided the bank. In this case it can be assumed as account’s currency.
     *
     * @return self
     */
    public function setOriginalCurrency($original_currency)
    {
        $this->container['original_currency'] = $original_currency;

        return $this;
    }

    /**
     * Gets different_debitor
     *
     * @return string
     */
    public function getDifferentDebitor()
    {
        return $this->container['different_debitor'];
    }

    /**
     * Sets different_debitor
     *
     * @param string $different_debitor Payer's/debtor's reference party (in the case of a credit transfer) or payee's/creditor's reference party (in the case of a direct debit)
     *
     * @return self
     */
    public function setDifferentDebitor($different_debitor)
    {
        $this->container['different_debitor'] = $different_debitor;

        return $this;
    }

    /**
     * Gets different_creditor
     *
     * @return string
     */
    public function getDifferentCreditor()
    {
        return $this->container['different_creditor'];
    }

    /**
     * Sets different_creditor
     *
     * @param string $different_creditor Payee's/creditor's reference party (in the case of a credit transfer) or payer's/debtor's reference party (in the case of a direct debit)
     *
     * @return self
     */
    public function setDifferentCreditor($different_creditor)
    {
        $this->container['different_creditor'] = $different_creditor;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


