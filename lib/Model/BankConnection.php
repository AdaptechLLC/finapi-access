<?php
/**
 * BankConnection
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
 * BankConnection Class Doc Comment
 *
 * @category Class
 * @description Container for a bank connection&#39;s data
 * @package  OpenAPIAccess\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class BankConnection implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'BankConnection';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'int',
        'name' => 'string',
        'update_status' => 'string',
        'categorization_status' => 'CategorizationStatus',
        'interfaces' => '\OpenAPIAccess\Client\Model\BankConnectionInterface[]',
        'account_ids' => 'int[]',
        'owners' => '\OpenAPIAccess\Client\Model\BankConnectionOwner[]',
        'bank' => 'Bank'
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
        'name' => null,
        'update_status' => null,
        'categorization_status' => null,
        'interfaces' => null,
        'account_ids' => 'int64',
        'owners' => null,
        'bank' => null
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
        'name' => 'name',
        'update_status' => 'updateStatus',
        'categorization_status' => 'categorizationStatus',
        'interfaces' => 'interfaces',
        'account_ids' => 'accountIds',
        'owners' => 'owners',
        'bank' => 'bank'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'name' => 'setName',
        'update_status' => 'setUpdateStatus',
        'categorization_status' => 'setCategorizationStatus',
        'interfaces' => 'setInterfaces',
        'account_ids' => 'setAccountIds',
        'owners' => 'setOwners',
        'bank' => 'setBank'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'name' => 'getName',
        'update_status' => 'getUpdateStatus',
        'categorization_status' => 'getCategorizationStatus',
        'interfaces' => 'getInterfaces',
        'account_ids' => 'getAccountIds',
        'owners' => 'getOwners',
        'bank' => 'getBank'
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

    const UPDATE_STATUS_IN_PROGRESS = 'IN_PROGRESS';
    const UPDATE_STATUS_READY = 'READY';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getUpdateStatusAllowableValues()
    {
        return [
            self::UPDATE_STATUS_IN_PROGRESS,
            self::UPDATE_STATUS_READY,
        ];
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
        $this->container['name'] = $data['name'] ?? null;
        $this->container['update_status'] = $data['update_status'] ?? null;
        $this->container['categorization_status'] = $data['categorization_status'] ?? null;
        $this->container['interfaces'] = $data['interfaces'] ?? null;
        $this->container['account_ids'] = $data['account_ids'] ?? null;
        $this->container['owners'] = $data['owners'] ?? null;
        $this->container['bank'] = $data['bank'] ?? null;
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
        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['update_status'] === null) {
            $invalidProperties[] = "'update_status' can't be null";
        }
        $allowedValues = $this->getUpdateStatusAllowableValues();
        if (!is_null($this->container['update_status']) && !in_array($this->container['update_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'update_status', must be one of '%s'",
                $this->container['update_status'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['categorization_status'] === null) {
            $invalidProperties[] = "'categorization_status' can't be null";
        }
        if ($this->container['interfaces'] === null) {
            $invalidProperties[] = "'interfaces' can't be null";
        }
        if ($this->container['account_ids'] === null) {
            $invalidProperties[] = "'account_ids' can't be null";
        }
        if ($this->container['owners'] === null) {
            $invalidProperties[] = "'owners' can't be null";
        }
        if ($this->container['bank'] === null) {
            $invalidProperties[] = "'bank' can't be null";
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
     * @param int $id Bank connection identifier
     *
     * @return self
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name Custom name for the bank connection. You can set this field with the 'Edit a bank connection' service, as well as during the initial import of the bank connection. Maximum length is 64.
     *
     * @return self
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets update_status
     *
     * @return string
     */
    public function getUpdateStatus()
    {
        return $this->container['update_status'];
    }

    /**
     * Sets update_status
     *
     * @param string $update_status Current status of data download (account balances and transactions/securities). The POST /bankConnections/import and POST /bankConnections/<id>/update services will set this flag to IN_PROGRESS before they return. Once the import or update has finished, the status will be changed to READY.
     *
     * @return self
     */
    public function setUpdateStatus($update_status)
    {
        $allowedValues = $this->getUpdateStatusAllowableValues();
        if (!in_array($update_status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'update_status', must be one of '%s'",
                    $update_status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['update_status'] = $update_status;

        return $this;
    }

    /**
     * Gets categorization_status
     *
     * @return CategorizationStatus
     */
    public function getCategorizationStatus()
    {
        return $this->container['categorization_status'];
    }

    /**
     * Sets categorization_status
     *
     * @param CategorizationStatus $categorization_status <strong>Type:</strong> CategorizationStatus<br/> Current status of transactions categorization. The asynchronous download process that is triggered by a call of the POST /bankConnections/import and POST /bankConnections/<id>/update services (and also by finAPI's auto update, if enabled) will set this flag to PENDING once the download has finished and a categorization is scheduled for the imported transactions. A separate categorization thread will then start to categorize the transactions (during this process, the status is IN_PROGRESS). When categorization has finished, the status will be (re-)set to READY. Note that the current categorization status should only be queried after the download has finished, i.e. once the download status has switched from IN_PROGRESS to READY.
     *
     * @return self
     */
    public function setCategorizationStatus($categorization_status)
    {
        $this->container['categorization_status'] = $categorization_status;

        return $this;
    }

    /**
     * Gets interfaces
     *
     * @return \OpenAPIAccess\Client\Model\BankConnectionInterface[]
     */
    public function getInterfaces()
    {
        return $this->container['interfaces'];
    }

    /**
     * Sets interfaces
     *
     * @param \OpenAPIAccess\Client\Model\BankConnectionInterface[] $interfaces <strong>Type:</strong> BankConnectionInterface<br/> Set of interfaces that are connected for this bank connection.
     *
     * @return self
     */
    public function setInterfaces($interfaces)
    {
        $this->container['interfaces'] = $interfaces;

        return $this;
    }

    /**
     * Gets account_ids
     *
     * @return int[]
     */
    public function getAccountIds()
    {
        return $this->container['account_ids'];
    }

    /**
     * Sets account_ids
     *
     * @param int[] $account_ids Identifiers of the accounts that belong to this bank connection
     *
     * @return self
     */
    public function setAccountIds($account_ids)
    {
        $this->container['account_ids'] = $account_ids;

        return $this;
    }

    /**
     * Gets owners
     *
     * @return \OpenAPIAccess\Client\Model\BankConnectionOwner[]
     */
    public function getOwners()
    {
        return $this->container['owners'];
    }

    /**
     * Sets owners
     *
     * @param \OpenAPIAccess\Client\Model\BankConnectionOwner[] $owners <strong>Type:</strong> BankConnectionOwner<br/> Information about the owner(s) of the bank connection
     *
     * @return self
     */
    public function setOwners($owners)
    {
        $this->container['owners'] = $owners;

        return $this;
    }

    /**
     * Gets bank
     *
     * @return Bank
     */
    public function getBank()
    {
        return $this->container['bank'];
    }

    /**
     * Sets bank
     *
     * @param Bank $bank <strong>Type:</strong> Bank<br/> Bank that this connection belongs to
     *
     * @return self
     */
    public function setBank($bank)
    {
        $this->container['bank'] = $bank;

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


