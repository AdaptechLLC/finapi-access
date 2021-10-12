<?php
/**
 * NewTransaction
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
 * The version of the OpenAPI document: 1.138.1
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
 * NewTransaction Class Doc Comment
 *
 * @category Class
 * @description Mock transaction data
 * @package  OpenAPIAccess\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class NewTransaction implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'NewTransaction';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'amount' => 'float',
        'currency' => 'Currency',
        'original_amount' => 'float',
        'original_currency' => 'Currency',
        'purpose' => 'string',
        'counterpart' => 'string',
        'counterpart_iban' => 'string',
        'counterpart_blz' => 'string',
        'counterpart_bic' => 'string',
        'counterpart_account_number' => 'string',
        'booking_date' => 'string',
        'value_date' => 'string',
        'type_id' => 'int',
        'counterpart_mandate_reference' => 'string',
        'counterpart_creditor_id' => 'string',
        'counterpart_customer_reference' => 'string',
        'counterpart_debitor_id' => 'string',
        'type' => 'string',
        'type_code_swift' => 'string',
        'sepa_purpose_code' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'amount' => null,
        'currency' => null,
        'original_amount' => null,
        'original_currency' => null,
        'purpose' => null,
        'counterpart' => null,
        'counterpart_iban' => null,
        'counterpart_blz' => null,
        'counterpart_bic' => null,
        'counterpart_account_number' => null,
        'booking_date' => null,
        'value_date' => null,
        'type_id' => 'int32',
        'counterpart_mandate_reference' => null,
        'counterpart_creditor_id' => null,
        'counterpart_customer_reference' => null,
        'counterpart_debitor_id' => null,
        'type' => null,
        'type_code_swift' => null,
        'sepa_purpose_code' => null
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
        'amount' => 'amount',
        'currency' => 'currency',
        'original_amount' => 'originalAmount',
        'original_currency' => 'originalCurrency',
        'purpose' => 'purpose',
        'counterpart' => 'counterpart',
        'counterpart_iban' => 'counterpartIban',
        'counterpart_blz' => 'counterpartBlz',
        'counterpart_bic' => 'counterpartBic',
        'counterpart_account_number' => 'counterpartAccountNumber',
        'booking_date' => 'bookingDate',
        'value_date' => 'valueDate',
        'type_id' => 'typeId',
        'counterpart_mandate_reference' => 'counterpartMandateReference',
        'counterpart_creditor_id' => 'counterpartCreditorId',
        'counterpart_customer_reference' => 'counterpartCustomerReference',
        'counterpart_debitor_id' => 'counterpartDebitorId',
        'type' => 'type',
        'type_code_swift' => 'typeCodeSwift',
        'sepa_purpose_code' => 'sepaPurposeCode'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'amount' => 'setAmount',
        'currency' => 'setCurrency',
        'original_amount' => 'setOriginalAmount',
        'original_currency' => 'setOriginalCurrency',
        'purpose' => 'setPurpose',
        'counterpart' => 'setCounterpart',
        'counterpart_iban' => 'setCounterpartIban',
        'counterpart_blz' => 'setCounterpartBlz',
        'counterpart_bic' => 'setCounterpartBic',
        'counterpart_account_number' => 'setCounterpartAccountNumber',
        'booking_date' => 'setBookingDate',
        'value_date' => 'setValueDate',
        'type_id' => 'setTypeId',
        'counterpart_mandate_reference' => 'setCounterpartMandateReference',
        'counterpart_creditor_id' => 'setCounterpartCreditorId',
        'counterpart_customer_reference' => 'setCounterpartCustomerReference',
        'counterpart_debitor_id' => 'setCounterpartDebitorId',
        'type' => 'setType',
        'type_code_swift' => 'setTypeCodeSwift',
        'sepa_purpose_code' => 'setSepaPurposeCode'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'amount' => 'getAmount',
        'currency' => 'getCurrency',
        'original_amount' => 'getOriginalAmount',
        'original_currency' => 'getOriginalCurrency',
        'purpose' => 'getPurpose',
        'counterpart' => 'getCounterpart',
        'counterpart_iban' => 'getCounterpartIban',
        'counterpart_blz' => 'getCounterpartBlz',
        'counterpart_bic' => 'getCounterpartBic',
        'counterpart_account_number' => 'getCounterpartAccountNumber',
        'booking_date' => 'getBookingDate',
        'value_date' => 'getValueDate',
        'type_id' => 'getTypeId',
        'counterpart_mandate_reference' => 'getCounterpartMandateReference',
        'counterpart_creditor_id' => 'getCounterpartCreditorId',
        'counterpart_customer_reference' => 'getCounterpartCustomerReference',
        'counterpart_debitor_id' => 'getCounterpartDebitorId',
        'type' => 'getType',
        'type_code_swift' => 'getTypeCodeSwift',
        'sepa_purpose_code' => 'getSepaPurposeCode'
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
        $this->container['amount'] = $data['amount'] ?? null;
        $this->container['currency'] = $data['currency'] ?? null;
        $this->container['original_amount'] = $data['original_amount'] ?? null;
        $this->container['original_currency'] = $data['original_currency'] ?? null;
        $this->container['purpose'] = $data['purpose'] ?? null;
        $this->container['counterpart'] = $data['counterpart'] ?? null;
        $this->container['counterpart_iban'] = $data['counterpart_iban'] ?? null;
        $this->container['counterpart_blz'] = $data['counterpart_blz'] ?? null;
        $this->container['counterpart_bic'] = $data['counterpart_bic'] ?? null;
        $this->container['counterpart_account_number'] = $data['counterpart_account_number'] ?? null;
        $this->container['booking_date'] = $data['booking_date'] ?? null;
        $this->container['value_date'] = $data['value_date'] ?? null;
        $this->container['type_id'] = $data['type_id'] ?? null;
        $this->container['counterpart_mandate_reference'] = $data['counterpart_mandate_reference'] ?? null;
        $this->container['counterpart_creditor_id'] = $data['counterpart_creditor_id'] ?? null;
        $this->container['counterpart_customer_reference'] = $data['counterpart_customer_reference'] ?? null;
        $this->container['counterpart_debitor_id'] = $data['counterpart_debitor_id'] ?? null;
        $this->container['type'] = $data['type'] ?? null;
        $this->container['type_code_swift'] = $data['type_code_swift'] ?? null;
        $this->container['sepa_purpose_code'] = $data['sepa_purpose_code'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['amount'] === null) {
            $invalidProperties[] = "'amount' can't be null";
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
     * @param float $amount Amount. Required.
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
     * @return Currency|null
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency
     *
     * @param Currency|null $currency <strong>Type:</strong> Currency<br/> Transaction currency.
     *
     * @return self
     */
    public function setCurrency($currency)
    {
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets original_amount
     *
     * @return float|null
     */
    public function getOriginalAmount()
    {
        return $this->container['original_amount'];
    }

    /**
     * Sets original_amount
     *
     * @param float|null $original_amount Original amount
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
     * @return Currency|null
     */
    public function getOriginalCurrency()
    {
        return $this->container['original_currency'];
    }

    /**
     * Sets original_currency
     *
     * @param Currency|null $original_currency <strong>Type:</strong> Currency<br/> Currency of the original amount.
     *
     * @return self
     */
    public function setOriginalCurrency($original_currency)
    {
        $this->container['original_currency'] = $original_currency;

        return $this;
    }

    /**
     * Gets purpose
     *
     * @return string|null
     */
    public function getPurpose()
    {
        return $this->container['purpose'];
    }

    /**
     * Sets purpose
     *
     * @param string|null $purpose Purpose. Any symbols are allowed. Maximum length is 2000. Optional. Default value: null.
     *
     * @return self
     */
    public function setPurpose($purpose)
    {
        $this->container['purpose'] = $purpose;

        return $this;
    }

    /**
     * Gets counterpart
     *
     * @return string|null
     */
    public function getCounterpart()
    {
        return $this->container['counterpart'];
    }

    /**
     * Sets counterpart
     *
     * @param string|null $counterpart Counterpart. Any symbols are allowed. Maximum length is 80. Optional. Default value: null.
     *
     * @return self
     */
    public function setCounterpart($counterpart)
    {
        $this->container['counterpart'] = $counterpart;

        return $this;
    }

    /**
     * Gets counterpart_iban
     *
     * @return string|null
     */
    public function getCounterpartIban()
    {
        return $this->container['counterpart_iban'];
    }

    /**
     * Sets counterpart_iban
     *
     * @param string|null $counterpart_iban Counterpart IBAN. Optional. Default value: null.
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
     * @return string|null
     */
    public function getCounterpartBlz()
    {
        return $this->container['counterpart_blz'];
    }

    /**
     * Sets counterpart_blz
     *
     * @param string|null $counterpart_blz Counterpart BLZ. Optional. Default value: null.
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
     * @return string|null
     */
    public function getCounterpartBic()
    {
        return $this->container['counterpart_bic'];
    }

    /**
     * Sets counterpart_bic
     *
     * @param string|null $counterpart_bic Counterpart BIC. Optional. Default value: null.
     *
     * @return self
     */
    public function setCounterpartBic($counterpart_bic)
    {
        $this->container['counterpart_bic'] = $counterpart_bic;

        return $this;
    }

    /**
     * Gets counterpart_account_number
     *
     * @return string|null
     */
    public function getCounterpartAccountNumber()
    {
        return $this->container['counterpart_account_number'];
    }

    /**
     * Sets counterpart_account_number
     *
     * @param string|null $counterpart_account_number Counterpart account number. Maximum length is 34. Optional. Default value: null.
     *
     * @return self
     */
    public function setCounterpartAccountNumber($counterpart_account_number)
    {
        $this->container['counterpart_account_number'] = $counterpart_account_number;

        return $this;
    }

    /**
     * Gets booking_date
     *
     * @return string|null
     */
    public function getBookingDate()
    {
        return $this->container['booking_date'];
    }

    /**
     * Sets booking_date
     *
     * @param string|null $booking_date Booking date in the format 'YYYY-MM-DD'.<br/><br/>If the date lies back more than 10 days from the booking date of the latest transaction that currently exists in the account, then this transaction will be ignored and not imported. If the date depicts a date in the future, then finAPI will deal with it the same way as it does with real transactions during a real update (see fields 'bankBookingDate' and 'finapiBookingDate' in the Transaction Resource for explanation).<br/><br/>This field is optional, default value is the current date.
     *
     * @return self
     */
    public function setBookingDate($booking_date)
    {
        $this->container['booking_date'] = $booking_date;

        return $this;
    }

    /**
     * Gets value_date
     *
     * @return string|null
     */
    public function getValueDate()
    {
        return $this->container['value_date'];
    }

    /**
     * Sets value_date
     *
     * @param string|null $value_date Value date in the format 'YYYY-MM-DD'. Optional. Default value: Same as the booking date.
     *
     * @return self
     */
    public function setValueDate($value_date)
    {
        $this->container['value_date'] = $value_date;

        return $this;
    }

    /**
     * Gets type_id
     *
     * @return int|null
     */
    public function getTypeId()
    {
        return $this->container['type_id'];
    }

    /**
     * Sets type_id
     *
     * @param int|null $type_id The transaction type id. It's usually a number between 1 and 999. You can look up valid transaction in the following document on page 198: <a href='https://www.hbci-zka.de/dokumente/spezifikation_deutsch/fintsv4/FinTS_4.1_Messages_Finanzdatenformate_2014-01-20-FV.pdf' target='_blank'>FinTS Financial Transaction Services</a>.<br/> For numbers not listed here, the service call might fail.
     *
     * @return self
     */
    public function setTypeId($type_id)
    {
        $this->container['type_id'] = $type_id;

        return $this;
    }

    /**
     * Gets counterpart_mandate_reference
     *
     * @return string|null
     */
    public function getCounterpartMandateReference()
    {
        return $this->container['counterpart_mandate_reference'];
    }

    /**
     * Sets counterpart_mandate_reference
     *
     * @param string|null $counterpart_mandate_reference The mandate reference of the counterpart. The maximum possible length of this field is 270 characters.
     *
     * @return self
     */
    public function setCounterpartMandateReference($counterpart_mandate_reference)
    {
        $this->container['counterpart_mandate_reference'] = $counterpart_mandate_reference;

        return $this;
    }

    /**
     * Gets counterpart_creditor_id
     *
     * @return string|null
     */
    public function getCounterpartCreditorId()
    {
        return $this->container['counterpart_creditor_id'];
    }

    /**
     * Sets counterpart_creditor_id
     *
     * @param string|null $counterpart_creditor_id The creditor ID of the counterpart. Exists only for SEPA direct debit transactions (\"Lastschrift\"). The maximum possible length of this field is 270 characters.
     *
     * @return self
     */
    public function setCounterpartCreditorId($counterpart_creditor_id)
    {
        $this->container['counterpart_creditor_id'] = $counterpart_creditor_id;

        return $this;
    }

    /**
     * Gets counterpart_customer_reference
     *
     * @return string|null
     */
    public function getCounterpartCustomerReference()
    {
        return $this->container['counterpart_customer_reference'];
    }

    /**
     * Sets counterpart_customer_reference
     *
     * @param string|null $counterpart_customer_reference The customer reference of the counterpart. The maximum possible length of this field is 270 characters.
     *
     * @return self
     */
    public function setCounterpartCustomerReference($counterpart_customer_reference)
    {
        $this->container['counterpart_customer_reference'] = $counterpart_customer_reference;

        return $this;
    }

    /**
     * Gets counterpart_debitor_id
     *
     * @return string|null
     */
    public function getCounterpartDebitorId()
    {
        return $this->container['counterpart_debitor_id'];
    }

    /**
     * Sets counterpart_debitor_id
     *
     * @param string|null $counterpart_debitor_id The originator's identification code. Exists only for SEPA money transfer transactions (\"Überweisung\"). The maximum possible length of this field is 100 characters.
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
     * @return string|null
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string|null $type Transaction type, according to the bank. If set, this will contain a German term that you can display to the user. Some examples of common values are: \"Lastschrift\", \"Auslands&uuml;berweisung\", \"Geb&uuml;hren\", \"Zinsen\". The maximum possible length of this field is 270 characters.
     *
     * @return self
     */
    public function setType($type)
    {
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets type_code_swift
     *
     * @return string|null
     */
    public function getTypeCodeSwift()
    {
        return $this->container['type_code_swift'];
    }

    /**
     * Sets type_code_swift
     *
     * @param string|null $type_code_swift SWIFT transaction type code.
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
     * @return string|null
     */
    public function getSepaPurposeCode()
    {
        return $this->container['sepa_purpose_code'];
    }

    /**
     * Sets sepa_purpose_code
     *
     * @param string|null $sepa_purpose_code SEPA purpose code.
     *
     * @return self
     */
    public function setSepaPurposeCode($sepa_purpose_code)
    {
        $this->container['sepa_purpose_code'] = $sepa_purpose_code;

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


