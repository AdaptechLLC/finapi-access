<?php
/**
 * BankInterface
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

use \ArrayAccess;
use \OpenAPIAccess\Client\ObjectSerializer;

/**
 * BankInterface Class Doc Comment
 *
 * @category Class
 * @description Interface used to connect to a bank
 * @package  OpenAPIAccess\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class BankInterface implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'BankInterface';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'interface' => 'BankingInterface',
        'tpp_authentication_group' => 'TppAuthenticationGroup',
        'login_credentials' => '\OpenAPIAccess\Client\Model\BankInterfaceLoginField[]',
        'properties' => 'BankInterfaceProperty[]',
        'login_hint' => 'string',
        'health' => 'int',
        'last_communication_attempt' => 'string',
        'last_successful_communication' => 'string',
        'is_ais_supported' => 'bool',
        'payment_capabilities' => 'BankInterfacePaymentCapabilities'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'interface' => null,
        'tpp_authentication_group' => null,
        'login_credentials' => null,
        'properties' => null,
        'login_hint' => null,
        'health' => 'int32',
        'last_communication_attempt' => null,
        'last_successful_communication' => null,
        'is_ais_supported' => null,
        'payment_capabilities' => null
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
        'interface' => 'interface',
        'tpp_authentication_group' => 'tppAuthenticationGroup',
        'login_credentials' => 'loginCredentials',
        'properties' => 'properties',
        'login_hint' => 'loginHint',
        'health' => 'health',
        'last_communication_attempt' => 'lastCommunicationAttempt',
        'last_successful_communication' => 'lastSuccessfulCommunication',
        'is_ais_supported' => 'isAisSupported',
        'payment_capabilities' => 'paymentCapabilities'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'interface' => 'setInterface',
        'tpp_authentication_group' => 'setTppAuthenticationGroup',
        'login_credentials' => 'setLoginCredentials',
        'properties' => 'setProperties',
        'login_hint' => 'setLoginHint',
        'health' => 'setHealth',
        'last_communication_attempt' => 'setLastCommunicationAttempt',
        'last_successful_communication' => 'setLastSuccessfulCommunication',
        'is_ais_supported' => 'setIsAisSupported',
        'payment_capabilities' => 'setPaymentCapabilities'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'interface' => 'getInterface',
        'tpp_authentication_group' => 'getTppAuthenticationGroup',
        'login_credentials' => 'getLoginCredentials',
        'properties' => 'getProperties',
        'login_hint' => 'getLoginHint',
        'health' => 'getHealth',
        'last_communication_attempt' => 'getLastCommunicationAttempt',
        'last_successful_communication' => 'getLastSuccessfulCommunication',
        'is_ais_supported' => 'getIsAisSupported',
        'payment_capabilities' => 'getPaymentCapabilities'
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
        $this->container['interface'] = $data['interface'] ?? null;
        $this->container['tpp_authentication_group'] = $data['tpp_authentication_group'] ?? null;
        $this->container['login_credentials'] = $data['login_credentials'] ?? null;
        $this->container['properties'] = $data['properties'] ?? null;
        $this->container['login_hint'] = $data['login_hint'] ?? null;
        $this->container['health'] = $data['health'] ?? null;
        $this->container['last_communication_attempt'] = $data['last_communication_attempt'] ?? null;
        $this->container['last_successful_communication'] = $data['last_successful_communication'] ?? null;
        $this->container['is_ais_supported'] = $data['is_ais_supported'] ?? null;
        $this->container['payment_capabilities'] = $data['payment_capabilities'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['interface'] === null) {
            $invalidProperties[] = "'interface' can't be null";
        }
        if ($this->container['tpp_authentication_group'] === null) {
            $invalidProperties[] = "'tpp_authentication_group' can't be null";
        }
        if ($this->container['login_credentials'] === null) {
            $invalidProperties[] = "'login_credentials' can't be null";
        }
        if ($this->container['properties'] === null) {
            $invalidProperties[] = "'properties' can't be null";
        }
        if ($this->container['login_hint'] === null) {
            $invalidProperties[] = "'login_hint' can't be null";
        }
        if ($this->container['health'] === null) {
            $invalidProperties[] = "'health' can't be null";
        }
        if (($this->container['health'] > 100)) {
            $invalidProperties[] = "invalid value for 'health', must be smaller than or equal to 100.";
        }

        if (($this->container['health'] < 0)) {
            $invalidProperties[] = "invalid value for 'health', must be bigger than or equal to 0.";
        }

        if ($this->container['last_communication_attempt'] === null) {
            $invalidProperties[] = "'last_communication_attempt' can't be null";
        }
        if ($this->container['last_successful_communication'] === null) {
            $invalidProperties[] = "'last_successful_communication' can't be null";
        }
        if ($this->container['is_ais_supported'] === null) {
            $invalidProperties[] = "'is_ais_supported' can't be null";
        }
        if ($this->container['payment_capabilities'] === null) {
            $invalidProperties[] = "'payment_capabilities' can't be null";
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
     * Gets interface
     *
     * @return BankingInterface
     */
    public function getInterface()
    {
        return $this->container['interface'];
    }

    /**
     * Sets interface
     *
     * @param BankingInterface $interface <strong>Type:</strong> BankingInterface<br/> Bank interface. Possible values:<br><br>&bull; <code>WEB_SCRAPER</code> - means that finAPI will parse data from the bank's online banking website.<br>&bull; <code>FINTS_SERVER</code> - means that finAPI will download data via the bank's FinTS server.<br>&bull; <code>XS2A</code> - means that finAPI will download data via the bank's XS2A interface.<br>
     *
     * @return self
     */
    public function setInterface($interface)
    {
        $this->container['interface'] = $interface;

        return $this;
    }

    /**
     * Gets tpp_authentication_group
     *
     * @return TppAuthenticationGroup
     */
    public function getTppAuthenticationGroup()
    {
        return $this->container['tpp_authentication_group'];
    }

    /**
     * Sets tpp_authentication_group
     *
     * @param TppAuthenticationGroup $tpp_authentication_group <strong>Type:</strong> TppAuthenticationGroup<br/> TPP Authentication Group which the bank interface is connected to
     *
     * @return self
     */
    public function setTppAuthenticationGroup($tpp_authentication_group)
    {
        $this->container['tpp_authentication_group'] = $tpp_authentication_group;

        return $this;
    }

    /**
     * Gets login_credentials
     *
     * @return \OpenAPIAccess\Client\Model\BankInterfaceLoginField[]
     */
    public function getLoginCredentials()
    {
        return $this->container['login_credentials'];
    }

    /**
     * Sets login_credentials
     *
     * @param \OpenAPIAccess\Client\Model\BankInterfaceLoginField[] $login_credentials <strong>Type:</strong> BankInterfaceLoginField<br/> Login fields for this interface (in the order that we suggest to show them to the user)
     *
     * @return self
     */
    public function setLoginCredentials($login_credentials)
    {
        $this->container['login_credentials'] = $login_credentials;

        return $this;
    }

    /**
     * Gets properties
     *
     * @return BankInterfaceProperty[]
     */
    public function getProperties()
    {
        return $this->container['properties'];
    }

    /**
     * Sets properties
     *
     * @param BankInterfaceProperty[] $properties properties
     *
     * @return self
     */
    public function setProperties($properties)
    {


        $this->container['properties'] = $properties;

        return $this;
    }

    /**
     * Gets login_hint
     *
     * @return string
     */
    public function getLoginHint()
    {
        return $this->container['login_hint'];
    }

    /**
     * Sets login_hint
     *
     * @param string $login_hint Login hint. Contains a German message for the user that explains what kind of credentials are expected.<br/><br/>Please note that it is essential to always show the login hint to the user if there is one, as the credentials that finAPI requires for the bank might be different to the credentials that the user knows from his online banking.<br/><br/>Also note that the contents of this field should always be interpreted as HTML, as the text might contain HTML tags for highlighted words, paragraphs, etc.
     *
     * @return self
     */
    public function setLoginHint($login_hint)
    {
        $this->container['login_hint'] = $login_hint;

        return $this;
    }

    /**
     * Gets health
     *
     * @return int
     */
    public function getHealth()
    {
        return $this->container['health'];
    }

    /**
     * Sets health
     *
     * @param int $health The health status of this interface. This is a value between 0 and 100, depicting the percentage of successful communication attempts with the bank via this interface during the latest couple of bank connection imports or updates (across the entire finAPI system). Note that 'successful' means that there was no technical error trying to establish a communication with the bank. Non-technical errors (like incorrect credentials) are regarded successful communication attempts.
     *
     * @return self
     */
    public function setHealth($health)
    {

        if (($health > 100)) {
            throw new \InvalidArgumentException('invalid value for $health when calling BankInterface., must be smaller than or equal to 100.');
        }
        if (($health < 0)) {
            throw new \InvalidArgumentException('invalid value for $health when calling BankInterface., must be bigger than or equal to 0.');
        }

        $this->container['health'] = $health;

        return $this;
    }

    /**
     * Gets last_communication_attempt
     *
     * @return string
     */
    public function getLastCommunicationAttempt()
    {
        return $this->container['last_communication_attempt'];
    }

    /**
     * Sets last_communication_attempt
     *
     * @param string $last_communication_attempt Time of the last communication attempt with this interface during an import, update or connect interface (across the entire finAPI system). The value is returned in the format 'YYYY-MM-DD HH:MM:SS.SSS' (german time).
     *
     * @return self
     */
    public function setLastCommunicationAttempt($last_communication_attempt)
    {
        $this->container['last_communication_attempt'] = $last_communication_attempt;

        return $this;
    }

    /**
     * Gets last_successful_communication
     *
     * @return string
     */
    public function getLastSuccessfulCommunication()
    {
        return $this->container['last_successful_communication'];
    }

    /**
     * Sets last_successful_communication
     *
     * @param string $last_successful_communication Time of the last successful communication with this interface during an import, update or connect interface (across the entire finAPI system). The value is returned in the format 'YYYY-MM-DD HH:MM:SS.SSS' (german time).
     *
     * @return self
     */
    public function setLastSuccessfulCommunication($last_successful_communication)
    {
        $this->container['last_successful_communication'] = $last_successful_communication;

        return $this;
    }

    /**
     * Gets is_ais_supported
     *
     * @return bool
     */
    public function getIsAisSupported()
    {
        return $this->container['is_ais_supported'];
    }

    /**
     * Sets is_ais_supported
     *
     * @param bool $is_ais_supported Whether this interface has the general capability to perform Account Information Services (AIS), i.e. if this interface can be used to download accounts, balances and transactions.
     *
     * @return self
     */
    public function setIsAisSupported($is_ais_supported)
    {
        $this->container['is_ais_supported'] = $is_ais_supported;

        return $this;
    }

    /**
     * Gets payment_capabilities
     *
     * @return BankInterfacePaymentCapabilities
     */
    public function getPaymentCapabilities()
    {
        return $this->container['payment_capabilities'];
    }

    /**
     * Sets payment_capabilities
     *
     * @param BankInterfacePaymentCapabilities $payment_capabilities <strong>Type:</strong> BankInterfacePaymentCapabilities<br/> The general payment capabilities of this interface. If a capability is 'true', it means that the option is supported, as long as the involved account also supports it (see AccountInterface.capabilities and AccountInterface.paymentCapabilities). If a capability is 'false', the option is not supported for any account.
     *
     * @return self
     */
    public function setPaymentCapabilities($payment_capabilities)
    {
        $this->container['payment_capabilities'] = $payment_capabilities;

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


