<?php
/**
 * RequestSepaDirectDebitParams
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
 * RequestSepaDirectDebitParams Class Doc Comment
 *
 * @category Class
 * @description Parameters for a single or collective SEPA direct debit order request
 * @package  OpenAPIAccess\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class RequestSepaDirectDebitParams implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'RequestSepaDirectDebitParams';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'account_id' => 'int',
        'store_secrets' => 'bool',
        'two_step_procedure_id' => 'string',
        'direct_debit_type' => 'DirectDebitType',
        'sequence_type' => 'DirectDebitSequenceType',
        'execution_date' => 'string',
        'single_booking' => 'bool',
        'direct_debits' => '\OpenAPIAccess\Client\Model\SingleDirectDebitData[]',
        'hide_transaction_details_in_web_form' => 'bool',
        'multi_step_authentication' => 'MultiStepAuthenticationCallback'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'account_id' => 'int64',
        'store_secrets' => null,
        'two_step_procedure_id' => null,
        'direct_debit_type' => null,
        'sequence_type' => null,
        'execution_date' => null,
        'single_booking' => null,
        'direct_debits' => null,
        'hide_transaction_details_in_web_form' => null,
        'multi_step_authentication' => null
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
        'account_id' => 'accountId',
        'store_secrets' => 'storeSecrets',
        'two_step_procedure_id' => 'twoStepProcedureId',
        'direct_debit_type' => 'directDebitType',
        'sequence_type' => 'sequenceType',
        'execution_date' => 'executionDate',
        'single_booking' => 'singleBooking',
        'direct_debits' => 'directDebits',
        'hide_transaction_details_in_web_form' => 'hideTransactionDetailsInWebForm',
        'multi_step_authentication' => 'multiStepAuthentication'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'account_id' => 'setAccountId',
        'store_secrets' => 'setStoreSecrets',
        'two_step_procedure_id' => 'setTwoStepProcedureId',
        'direct_debit_type' => 'setDirectDebitType',
        'sequence_type' => 'setSequenceType',
        'execution_date' => 'setExecutionDate',
        'single_booking' => 'setSingleBooking',
        'direct_debits' => 'setDirectDebits',
        'hide_transaction_details_in_web_form' => 'setHideTransactionDetailsInWebForm',
        'multi_step_authentication' => 'setMultiStepAuthentication'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'account_id' => 'getAccountId',
        'store_secrets' => 'getStoreSecrets',
        'two_step_procedure_id' => 'getTwoStepProcedureId',
        'direct_debit_type' => 'getDirectDebitType',
        'sequence_type' => 'getSequenceType',
        'execution_date' => 'getExecutionDate',
        'single_booking' => 'getSingleBooking',
        'direct_debits' => 'getDirectDebits',
        'hide_transaction_details_in_web_form' => 'getHideTransactionDetailsInWebForm',
        'multi_step_authentication' => 'getMultiStepAuthentication'
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
        $this->container['account_id'] = $data['account_id'] ?? null;
        $this->container['store_secrets'] = $data['store_secrets'] ?? false;
        $this->container['two_step_procedure_id'] = $data['two_step_procedure_id'] ?? null;
        $this->container['direct_debit_type'] = $data['direct_debit_type'] ?? null;
        $this->container['sequence_type'] = $data['sequence_type'] ?? null;
        $this->container['execution_date'] = $data['execution_date'] ?? null;
        $this->container['single_booking'] = $data['single_booking'] ?? false;
        $this->container['direct_debits'] = $data['direct_debits'] ?? null;
        $this->container['hide_transaction_details_in_web_form'] = $data['hide_transaction_details_in_web_form'] ?? false;
        $this->container['multi_step_authentication'] = $data['multi_step_authentication'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['account_id'] === null) {
            $invalidProperties[] = "'account_id' can't be null";
        }
        if ($this->container['direct_debit_type'] === null) {
            $invalidProperties[] = "'direct_debit_type' can't be null";
        }
        if ($this->container['sequence_type'] === null) {
            $invalidProperties[] = "'sequence_type' can't be null";
        }
        if ($this->container['execution_date'] === null) {
            $invalidProperties[] = "'execution_date' can't be null";
        }
        if ($this->container['direct_debits'] === null) {
            $invalidProperties[] = "'direct_debits' can't be null";
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
     * @param int $account_id Identifier of the bank account to which you want to transfer the money.
     *
     * @return self
     */
    public function setAccountId($account_id)
    {
        $this->container['account_id'] = $account_id;

        return $this;
    }

    /**
     * Gets store_secrets
     *
     * @return bool|null
     */
    public function getStoreSecrets()
    {
        return $this->container['store_secrets'];
    }

    /**
     * Sets store_secrets
     *
     * @param bool|null $store_secrets Whether to store the PIN. If the PIN is stored, it is not required to pass the PIN again when executing SEPA orders. Default value is 'false'. <br/><br/>NOTES:<br/> - before you set this field to true, please regard the 'pinsAreVolatile' flag of the bank connection that the account belongs to. Please note that volatile credentials will not be stored, even if provided, to enforce user involvement in the next communication with the bank;<br/> - this field is ignored in case when the user will need to use finAPI's Web Form. The user will be able to decide whether to store the PIN or not in the Web Form, depending on the 'storeSecretsAvailableInWebForm' setting (see Client Configuration).
     *
     * @return self
     */
    public function setStoreSecrets($store_secrets)
    {
        $this->container['store_secrets'] = $store_secrets;

        return $this;
    }

    /**
     * Gets two_step_procedure_id
     *
     * @return string|null
     */
    public function getTwoStepProcedureId()
    {
        return $this->container['two_step_procedure_id'];
    }

    /**
     * Sets two_step_procedure_id
     *
     * @param string|null $two_step_procedure_id The bank-given ID of the two-step-procedure that should be used for the order. For a list of available two-step-procedures, see the corresponding bank connection (GET /bankConnections). If this field is not set, then the bank connection's default two-step-procedure will be used. Note that in this case, when the bank connection has no default two-step-procedure set, then the response of the service depends on whether you need to use finAPI's Web Form or not. If you need to use the Web Form, the user will be prompted to select the two-step-procedure within the Web Form. If you don't need to use the Web Form, then the service will return an error (passing a value for this field is required in this case).
     *
     * @return self
     */
    public function setTwoStepProcedureId($two_step_procedure_id)
    {
        $this->container['two_step_procedure_id'] = $two_step_procedure_id;

        return $this;
    }

    /**
     * Gets direct_debit_type
     *
     * @return DirectDebitType
     */
    public function getDirectDebitType()
    {
        return $this->container['direct_debit_type'];
    }

    /**
     * Sets direct_debit_type
     *
     * @param DirectDebitType $direct_debit_type <strong>Type:</strong> DirectDebitType<br/> Type of the direct debit; either <code>BASIC</code> or <code>B2B</code> (Business-To-Business). Please note that an account which supports the basic type must not necessarily support B2B (or vice versa). Check the source account's 'supportedOrders' field to find out which types of direct debit it supports.<br/><br/>
     *
     * @return self
     */
    public function setDirectDebitType($direct_debit_type)
    {
        $this->container['direct_debit_type'] = $direct_debit_type;

        return $this;
    }

    /**
     * Gets sequence_type
     *
     * @return DirectDebitSequenceType
     */
    public function getSequenceType()
    {
        return $this->container['sequence_type'];
    }

    /**
     * Sets sequence_type
     *
     * @param DirectDebitSequenceType $sequence_type <strong>Type:</strong> DirectDebitSequenceType<br/> Sequence type of the direct debit. Possible values:<br/><br/>&bull; <code>OOFF</code> - means that this is a one-time direct debit order<br/>&bull; <code>FRST</code> - means that this is the first in a row of multiple direct debit orders<br/>&bull; <code>RCUR</code> - means that this is one (but not the first or final) within a row of multiple direct debit orders<br/>&bull; <code>FNAL</code> - means that this is the final in a row of multiple direct debit orders<br/><br/>
     *
     * @return self
     */
    public function setSequenceType($sequence_type)
    {
        $this->container['sequence_type'] = $sequence_type;

        return $this;
    }

    /**
     * Gets execution_date
     *
     * @return string
     */
    public function getExecutionDate()
    {
        return $this->container['execution_date'];
    }

    /**
     * Sets execution_date
     *
     * @param string $execution_date Execution date for the direct debit(s), in the format 'YYYY-MM-DD'.
     *
     * @return self
     */
    public function setExecutionDate($execution_date)
    {
        $this->container['execution_date'] = $execution_date;

        return $this;
    }

    /**
     * Gets single_booking
     *
     * @return bool|null
     */
    public function getSingleBooking()
    {
        return $this->container['single_booking'];
    }

    /**
     * Sets single_booking
     *
     * @param bool|null $single_booking This field is only regarded when you pass multiple orders. It determines whether the orders should be processed by the bank as one collective booking (in case of 'false'), or as single bookings (in case of 'true'). Default value is 'false'.
     *
     * @return self
     */
    public function setSingleBooking($single_booking)
    {
        $this->container['single_booking'] = $single_booking;

        return $this;
    }

    /**
     * Gets direct_debits
     *
     * @return \OpenAPIAccess\Client\Model\SingleDirectDebitData[]
     */
    public function getDirectDebits()
    {
        return $this->container['direct_debits'];
    }

    /**
     * Sets direct_debits
     *
     * @param \OpenAPIAccess\Client\Model\SingleDirectDebitData[] $direct_debits <strong>Type:</strong> SingleDirectDebitData<br/> List of the direct debits that you want to execute (may contain at most 15000 items). Please check the account's 'supportedOrders' field to find out whether you can pass multiple direct debits or just one.
     *
     * @return self
     */
    public function setDirectDebits($direct_debits)
    {
        $this->container['direct_debits'] = $direct_debits;

        return $this;
    }

    /**
     * Gets hide_transaction_details_in_web_form
     *
     * @return bool|null
     */
    public function getHideTransactionDetailsInWebForm()
    {
        return $this->container['hide_transaction_details_in_web_form'];
    }

    /**
     * Sets hide_transaction_details_in_web_form
     *
     * @param bool|null $hide_transaction_details_in_web_form Whether the finAPI Web Form should hide transaction details when prompting the caller for the second factor. Default value is false.
     *
     * @return self
     */
    public function setHideTransactionDetailsInWebForm($hide_transaction_details_in_web_form)
    {
        $this->container['hide_transaction_details_in_web_form'] = $hide_transaction_details_in_web_form;

        return $this;
    }

    /**
     * Gets multi_step_authentication
     *
     * @return MultiStepAuthenticationCallback|null
     */
    public function getMultiStepAuthentication()
    {
        return $this->container['multi_step_authentication'];
    }

    /**
     * Sets multi_step_authentication
     *
     * @param MultiStepAuthenticationCallback|null $multi_step_authentication <strong>Type:</strong> MultiStepAuthenticationCallback<br/> Container for multi-step authentication data. Required when a previous service call initiated a multi-step authentication.
     *
     * @return self
     */
    public function setMultiStepAuthentication($multi_step_authentication)
    {
        $this->container['multi_step_authentication'] = $multi_step_authentication;

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


