<?php
/**
 * Account
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
 * Account Class Doc Comment
 *
 * @category Class
 * @description Container for a bank account&#39;s data
 * @package  OpenAPIAccess\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class Account implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Account';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'int',
        'bank_connection_id' => 'int',
        'account_name' => 'string',
        'iban' => 'string',
        'account_number' => 'string',
        'sub_account_number' => 'string',
        'account_holder_name' => 'string',
        'account_holder_id' => 'string',
        'account_currency' => 'string',
        'account_type' => 'AccountType',
        'balance' => 'float',
        'overdraft' => 'float',
        'overdraft_limit' => 'float',
        'available_funds' => 'float',
        'is_new' => 'bool',
        'interfaces' => '\OpenAPIAccess\Client\Model\AccountInterface[]',
        'is_seized' => 'bool'
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
        'bank_connection_id' => 'int64',
        'account_name' => null,
        'iban' => null,
        'account_number' => null,
        'sub_account_number' => null,
        'account_holder_name' => null,
        'account_holder_id' => null,
        'account_currency' => null,
        'account_type' => null,
        'balance' => null,
        'overdraft' => null,
        'overdraft_limit' => null,
        'available_funds' => null,
        'is_new' => null,
        'interfaces' => null,
        'is_seized' => null
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
        'bank_connection_id' => 'bankConnectionId',
        'account_name' => 'accountName',
        'iban' => 'iban',
        'account_number' => 'accountNumber',
        'sub_account_number' => 'subAccountNumber',
        'account_holder_name' => 'accountHolderName',
        'account_holder_id' => 'accountHolderId',
        'account_currency' => 'accountCurrency',
        'account_type' => 'accountType',
        'balance' => 'balance',
        'overdraft' => 'overdraft',
        'overdraft_limit' => 'overdraftLimit',
        'available_funds' => 'availableFunds',
        'is_new' => 'isNew',
        'interfaces' => 'interfaces',
        'is_seized' => 'isSeized'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'bank_connection_id' => 'setBankConnectionId',
        'account_name' => 'setAccountName',
        'iban' => 'setIban',
        'account_number' => 'setAccountNumber',
        'sub_account_number' => 'setSubAccountNumber',
        'account_holder_name' => 'setAccountHolderName',
        'account_holder_id' => 'setAccountHolderId',
        'account_currency' => 'setAccountCurrency',
        'account_type' => 'setAccountType',
        'balance' => 'setBalance',
        'overdraft' => 'setOverdraft',
        'overdraft_limit' => 'setOverdraftLimit',
        'available_funds' => 'setAvailableFunds',
        'is_new' => 'setIsNew',
        'interfaces' => 'setInterfaces',
        'is_seized' => 'setIsSeized'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'bank_connection_id' => 'getBankConnectionId',
        'account_name' => 'getAccountName',
        'iban' => 'getIban',
        'account_number' => 'getAccountNumber',
        'sub_account_number' => 'getSubAccountNumber',
        'account_holder_name' => 'getAccountHolderName',
        'account_holder_id' => 'getAccountHolderId',
        'account_currency' => 'getAccountCurrency',
        'account_type' => 'getAccountType',
        'balance' => 'getBalance',
        'overdraft' => 'getOverdraft',
        'overdraft_limit' => 'getOverdraftLimit',
        'available_funds' => 'getAvailableFunds',
        'is_new' => 'getIsNew',
        'interfaces' => 'getInterfaces',
        'is_seized' => 'getIsSeized'
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
        $this->container['bank_connection_id'] = $data['bank_connection_id'] ?? null;
        $this->container['account_name'] = $data['account_name'] ?? null;
        $this->container['iban'] = $data['iban'] ?? null;
        $this->container['account_number'] = $data['account_number'] ?? null;
        $this->container['sub_account_number'] = $data['sub_account_number'] ?? null;
        $this->container['account_holder_name'] = $data['account_holder_name'] ?? null;
        $this->container['account_holder_id'] = $data['account_holder_id'] ?? null;
        $this->container['account_currency'] = $data['account_currency'] ?? null;
        $this->container['account_type'] = $data['account_type'] ?? null;
        $this->container['balance'] = $data['balance'] ?? null;
        $this->container['overdraft'] = $data['overdraft'] ?? null;
        $this->container['overdraft_limit'] = $data['overdraft_limit'] ?? null;
        $this->container['available_funds'] = $data['available_funds'] ?? null;
        $this->container['is_new'] = $data['is_new'] ?? null;
        $this->container['interfaces'] = $data['interfaces'] ?? null;
        $this->container['is_seized'] = $data['is_seized'] ?? null;
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
        if ($this->container['bank_connection_id'] === null) {
            $invalidProperties[] = "'bank_connection_id' can't be null";
        }
        if ($this->container['account_name'] === null) {
            $invalidProperties[] = "'account_name' can't be null";
        }
        if ($this->container['iban'] === null) {
            $invalidProperties[] = "'iban' can't be null";
        }
        if ($this->container['account_number'] === null) {
            $invalidProperties[] = "'account_number' can't be null";
        }
        if ($this->container['sub_account_number'] === null) {
            $invalidProperties[] = "'sub_account_number' can't be null";
        }
        if ($this->container['account_holder_name'] === null) {
            $invalidProperties[] = "'account_holder_name' can't be null";
        }
        if ($this->container['account_holder_id'] === null) {
            $invalidProperties[] = "'account_holder_id' can't be null";
        }
        if ($this->container['account_currency'] === null) {
            $invalidProperties[] = "'account_currency' can't be null";
        }
        if ($this->container['account_type'] === null) {
            $invalidProperties[] = "'account_type' can't be null";
        }
        if ($this->container['balance'] === null) {
            $invalidProperties[] = "'balance' can't be null";
        }
        if ($this->container['overdraft'] === null) {
            $invalidProperties[] = "'overdraft' can't be null";
        }
        if ($this->container['overdraft_limit'] === null) {
            $invalidProperties[] = "'overdraft_limit' can't be null";
        }
        if ($this->container['available_funds'] === null) {
            $invalidProperties[] = "'available_funds' can't be null";
        }
        if ($this->container['is_new'] === null) {
            $invalidProperties[] = "'is_new' can't be null";
        }
        if ($this->container['interfaces'] === null) {
            $invalidProperties[] = "'interfaces' can't be null";
        }
        if ($this->container['is_seized'] === null) {
            $invalidProperties[] = "'is_seized' can't be null";
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
     * @param int $id Account identifier
     *
     * @return self
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets bank_connection_id
     *
     * @return int
     */
    public function getBankConnectionId()
    {
        return $this->container['bank_connection_id'];
    }

    /**
     * Sets bank_connection_id
     *
     * @param int $bank_connection_id Identifier of the bank connection that this account belongs to
     *
     * @return self
     */
    public function setBankConnectionId($bank_connection_id)
    {
        $this->container['bank_connection_id'] = $bank_connection_id;

        return $this;
    }

    /**
     * Gets account_name
     *
     * @return string
     */
    public function getAccountName()
    {
        return $this->container['account_name'];
    }

    /**
     * Sets account_name
     *
     * @param string $account_name Account name
     *
     * @return self
     */
    public function setAccountName($account_name)
    {
        $this->container['account_name'] = $account_name;

        return $this;
    }

    /**
     * Gets iban
     *
     * @return string
     */
    public function getIban()
    {
        return $this->container['iban'];
    }

    /**
     * Sets iban
     *
     * @param string $iban Account's IBAN. Note that this field can change from 'null' to a value - or vice versa - any time when the account is being updated. This is subject to changes within the bank's internal account management.
     *
     * @return self
     */
    public function setIban($iban)
    {
        $this->container['iban'] = $iban;

        return $this;
    }

    /**
     * Gets account_number
     *
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->container['account_number'];
    }

    /**
     * Sets account_number
     *
     * @param string $account_number (National) account number. Note that this value might change whenever the account is updated (for example, leading zeros might be added or removed).
     *
     * @return self
     */
    public function setAccountNumber($account_number)
    {
        $this->container['account_number'] = $account_number;

        return $this;
    }

    /**
     * Gets sub_account_number
     *
     * @return string
     */
    public function getSubAccountNumber()
    {
        return $this->container['sub_account_number'];
    }

    /**
     * Sets sub_account_number
     *
     * @param string $sub_account_number Account's sub-account-number. Note that this field can change from 'null' to a value - or vice versa - any time when the account is being updated. This is subject to changes within the bank's internal account management.
     *
     * @return self
     */
    public function setSubAccountNumber($sub_account_number)
    {
        $this->container['sub_account_number'] = $sub_account_number;

        return $this;
    }

    /**
     * Gets account_holder_name
     *
     * @return string
     */
    public function getAccountHolderName()
    {
        return $this->container['account_holder_name'];
    }

    /**
     * Sets account_holder_name
     *
     * @param string $account_holder_name Name of the account holder
     *
     * @return self
     */
    public function setAccountHolderName($account_holder_name)
    {
        $this->container['account_holder_name'] = $account_holder_name;

        return $this;
    }

    /**
     * Gets account_holder_id
     *
     * @return string
     */
    public function getAccountHolderId()
    {
        return $this->container['account_holder_id'];
    }

    /**
     * Sets account_holder_id
     *
     * @param string $account_holder_id Bank's internal identification of the account holder. Note that if your client has no license for processing this field, it will always be 'XXXXX'
     *
     * @return self
     */
    public function setAccountHolderId($account_holder_id)
    {
        $this->container['account_holder_id'] = $account_holder_id;

        return $this;
    }

    /**
     * Gets account_currency
     *
     * @return string
     */
    public function getAccountCurrency()
    {
        return $this->container['account_currency'];
    }

    /**
     * Sets account_currency
     *
     * @param string $account_currency Account's currency
     *
     * @return self
     */
    public function setAccountCurrency($account_currency)
    {
        $this->container['account_currency'] = $account_currency;

        return $this;
    }

    /**
     * Gets account_type
     *
     * @return AccountType
     */
    public function getAccountType()
    {
        return $this->container['account_type'];
    }

    /**
     * Sets account_type
     *
     * @param AccountType $account_type <strong>Type:</strong> AccountType<br/> An account type.<br/><br/>Checking,<br/>Savings,<br/>CreditCard,<br/>Security,<br/>Loan,<br/>Pocket (DEPRECATED; will not be returned for any account unless this type has explicitly been set via PATCH),<br/>Membership,<br/>Bausparen<br/><br/>
     *
     * @return self
     */
    public function setAccountType($account_type)
    {
        $this->container['account_type'] = $account_type;

        return $this;
    }

    /**
     * Gets balance
     *
     * @return float
     */
    public function getBalance()
    {
        return $this->container['balance'];
    }

    /**
     * Sets balance
     *
     * @param float $balance Current account balance
     *
     * @return self
     */
    public function setBalance($balance)
    {
        $this->container['balance'] = $balance;

        return $this;
    }

    /**
     * Gets overdraft
     *
     * @return float
     */
    public function getOverdraft()
    {
        return $this->container['overdraft'];
    }

    /**
     * Sets overdraft
     *
     * @param float $overdraft Current overdraft
     *
     * @return self
     */
    public function setOverdraft($overdraft)
    {
        $this->container['overdraft'] = $overdraft;

        return $this;
    }

    /**
     * Gets overdraft_limit
     *
     * @return float
     */
    public function getOverdraftLimit()
    {
        return $this->container['overdraft_limit'];
    }

    /**
     * Sets overdraft_limit
     *
     * @param float $overdraft_limit Overdraft limit
     *
     * @return self
     */
    public function setOverdraftLimit($overdraft_limit)
    {
        $this->container['overdraft_limit'] = $overdraft_limit;

        return $this;
    }

    /**
     * Gets available_funds
     *
     * @return float
     */
    public function getAvailableFunds()
    {
        return $this->container['available_funds'];
    }

    /**
     * Sets available_funds
     *
     * @param float $available_funds Current available funds. Note that this field is only set if finAPI can make a definite statement about the current available funds. This might not always be the case, for example if there is not enough information available about the overdraft limit and current overdraft.
     *
     * @return self
     */
    public function setAvailableFunds($available_funds)
    {
        $this->container['available_funds'] = $available_funds;

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
     * @param bool $is_new Indicating whether this account is 'new' or not. Any newly imported account will have this flag initially set to true, and remain so until you set it to false (see PATCH /accounts/<id>). How you use this field is up to your interpretation, however it is recommended to set the flag to false for all accounts right after the initial import of the bank connection. This way, you will be able recognize accounts that get newly imported during a later update of the bank connection, by checking for any accounts with the flag set to true right after an update.
     *
     * @return self
     */
    public function setIsNew($is_new)
    {
        $this->container['is_new'] = $is_new;

        return $this;
    }

    /**
     * Gets interfaces
     *
     * @return \OpenAPIAccess\Client\Model\AccountInterface[]
     */
    public function getInterfaces()
    {
        return $this->container['interfaces'];
    }

    /**
     * Sets interfaces
     *
     * @param \OpenAPIAccess\Client\Model\AccountInterface[] $interfaces <strong>Type:</strong> AccountInterface<br/> Set of interfaces to which this account is connected
     *
     * @return self
     */
    public function setInterfaces($interfaces)
    {
        $this->container['interfaces'] = $interfaces;

        return $this;
    }

    /**
     * Gets is_seized
     *
     * @return bool
     */
    public function getIsSeized()
    {
        return $this->container['is_seized'];
    }

    /**
     * Sets is_seized
     *
     * @param bool $is_seized Whether this account is seized. Note that this information is not received from the bank, but determined by finAPI based on the available account information.
     *
     * @return self
     */
    public function setIsSeized($is_seized)
    {
        $this->container['is_seized'] = $is_seized;

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


