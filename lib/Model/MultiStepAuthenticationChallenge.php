<?php
/**
 * MultiStepAuthenticationChallenge
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
 * MultiStepAuthenticationChallenge Class Doc Comment
 *
 * @category Class
 * @description Container for multi-step authentication data, as returned by finAPI to the client
 * @package  OpenAPIAccess\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class MultiStepAuthenticationChallenge implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'MultiStepAuthenticationChallenge';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'hash' => 'string',
        'status' => 'MsaStatus',
        'challenge_message' => 'string',
        'answer_field_label' => 'string',
        'redirect_url' => 'string',
        'redirect_context' => 'string',
        'redirect_context_field' => 'string',
        'two_step_procedures' => '\OpenAPIAccess\Client\Model\TwoStepProcedure[]',
        'photo_tan_mime_type' => 'string',
        'photo_tan_data' => 'string',
        'optical_data' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'hash' => null,
        'status' => null,
        'challenge_message' => null,
        'answer_field_label' => null,
        'redirect_url' => null,
        'redirect_context' => null,
        'redirect_context_field' => null,
        'two_step_procedures' => null,
        'photo_tan_mime_type' => null,
        'photo_tan_data' => null,
        'optical_data' => null
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
        'hash' => 'hash',
        'status' => 'status',
        'challenge_message' => 'challengeMessage',
        'answer_field_label' => 'answerFieldLabel',
        'redirect_url' => 'redirectUrl',
        'redirect_context' => 'redirectContext',
        'redirect_context_field' => 'redirectContextField',
        'two_step_procedures' => 'twoStepProcedures',
        'photo_tan_mime_type' => 'photoTanMimeType',
        'photo_tan_data' => 'photoTanData',
        'optical_data' => 'opticalData'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'hash' => 'setHash',
        'status' => 'setStatus',
        'challenge_message' => 'setChallengeMessage',
        'answer_field_label' => 'setAnswerFieldLabel',
        'redirect_url' => 'setRedirectUrl',
        'redirect_context' => 'setRedirectContext',
        'redirect_context_field' => 'setRedirectContextField',
        'two_step_procedures' => 'setTwoStepProcedures',
        'photo_tan_mime_type' => 'setPhotoTanMimeType',
        'photo_tan_data' => 'setPhotoTanData',
        'optical_data' => 'setOpticalData'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'hash' => 'getHash',
        'status' => 'getStatus',
        'challenge_message' => 'getChallengeMessage',
        'answer_field_label' => 'getAnswerFieldLabel',
        'redirect_url' => 'getRedirectUrl',
        'redirect_context' => 'getRedirectContext',
        'redirect_context_field' => 'getRedirectContextField',
        'two_step_procedures' => 'getTwoStepProcedures',
        'photo_tan_mime_type' => 'getPhotoTanMimeType',
        'photo_tan_data' => 'getPhotoTanData',
        'optical_data' => 'getOpticalData'
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
        $this->container['hash'] = $data['hash'] ?? null;
        $this->container['status'] = $data['status'] ?? null;
        $this->container['challenge_message'] = $data['challenge_message'] ?? null;
        $this->container['answer_field_label'] = $data['answer_field_label'] ?? null;
        $this->container['redirect_url'] = $data['redirect_url'] ?? null;
        $this->container['redirect_context'] = $data['redirect_context'] ?? null;
        $this->container['redirect_context_field'] = $data['redirect_context_field'] ?? null;
        $this->container['two_step_procedures'] = $data['two_step_procedures'] ?? null;
        $this->container['photo_tan_mime_type'] = $data['photo_tan_mime_type'] ?? null;
        $this->container['photo_tan_data'] = $data['photo_tan_data'] ?? null;
        $this->container['optical_data'] = $data['optical_data'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['hash'] === null) {
            $invalidProperties[] = "'hash' can't be null";
        }
        if ($this->container['status'] === null) {
            $invalidProperties[] = "'status' can't be null";
        }
        if ($this->container['challenge_message'] === null) {
            $invalidProperties[] = "'challenge_message' can't be null";
        }
        if ($this->container['answer_field_label'] === null) {
            $invalidProperties[] = "'answer_field_label' can't be null";
        }
        if ($this->container['redirect_url'] === null) {
            $invalidProperties[] = "'redirect_url' can't be null";
        }
        if ($this->container['redirect_context'] === null) {
            $invalidProperties[] = "'redirect_context' can't be null";
        }
        if ($this->container['redirect_context_field'] === null) {
            $invalidProperties[] = "'redirect_context_field' can't be null";
        }
        if ($this->container['two_step_procedures'] === null) {
            $invalidProperties[] = "'two_step_procedures' can't be null";
        }
        if ($this->container['photo_tan_mime_type'] === null) {
            $invalidProperties[] = "'photo_tan_mime_type' can't be null";
        }
        if ($this->container['photo_tan_data'] === null) {
            $invalidProperties[] = "'photo_tan_data' can't be null";
        }
        if ($this->container['optical_data'] === null) {
            $invalidProperties[] = "'optical_data' can't be null";
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
     * Gets hash
     *
     * @return string
     */
    public function getHash()
    {
        return $this->container['hash'];
    }

    /**
     * Sets hash
     *
     * @param string $hash Hash for this multi-step authentication flow. Must be passed back to finAPI when continuing the flow.
     *
     * @return self
     */
    public function setHash($hash)
    {
        $this->container['hash'] = $hash;

        return $this;
    }

    /**
     * Gets status
     *
     * @return MsaStatus
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param MsaStatus $status <strong>Type:</strong> MsaStatus<br/> Indicates the current status of the multi-step authentication flow:<br/><br/>TWO_STEP_PROCEDURE_REQUIRED means that the bank has requested an SCA method selection for the user. In this case, the service should be recalled with a chosen TSP-ID set to the 'twoStepProcedureId' field.<br/>When the web form flow is used, the user is forwarded to finAPI's web form to prompt for his credentials (if they are not stored in finAPI) and to select the preferred SCA method.<br/><br/>CHALLENGE_RESPONSE_REQUIRED means that the bank has requested a challenge code for the previously given TSP (SCA). This status can be completed by setting the 'challengeResponse' field.<br/>When the web form flow is used, the user should submit the challenge response for the challenge message shown by the web form.<br/><br/>REDIRECT_REQUIRED means that the user must be redirected to the bank's website, where the authentication can be finished.<br/>When the web form flow is used, the user should visit the web form, get a redirect to the bank's website, complete the authentication and will then be redirected back to the web form.<br/><br/>DECOUPLED_AUTH_REQUIRED means that the bank has asked for the decoupled authentication. In this case, the 'decoupledCallback' field must be set to true to complete the authentication.<br/><br/>DECOUPLED_AUTH_IN_PROGRESS means that the bank is waiting for the completion of the decoupled authentication by the user. Until this is done, the service should be recalled at most every 5 seconds with the 'decoupledCallback' field set to 'true'. Once the decoupled authentication is completed by the user, the service returns a successful response.
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets challenge_message
     *
     * @return string
     */
    public function getChallengeMessage()
    {
        return $this->container['challenge_message'];
    }

    /**
     * Sets challenge_message
     *
     * @param string $challenge_message In case of status = CHALLENGE_RESPONSE_REQUIRED, this field contains a message from the bank containing instructions for the user on how to proceed with the authorization.
     *
     * @return self
     */
    public function setChallengeMessage($challenge_message)
    {
        $this->container['challenge_message'] = $challenge_message;

        return $this;
    }

    /**
     * Gets answer_field_label
     *
     * @return string
     */
    public function getAnswerFieldLabel()
    {
        return $this->container['answer_field_label'];
    }

    /**
     * Sets answer_field_label
     *
     * @param string $answer_field_label Suggestion from the bank on how you can label your input field where the user should enter his challenge response.
     *
     * @return self
     */
    public function setAnswerFieldLabel($answer_field_label)
    {
        $this->container['answer_field_label'] = $answer_field_label;

        return $this;
    }

    /**
     * Gets redirect_url
     *
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->container['redirect_url'];
    }

    /**
     * Sets redirect_url
     *
     * @param string $redirect_url In case of status = REDIRECT_REQUIRED, this field contains the URL to which you must direct the user. It already includes the redirect URL back to your client that you have passed when initiating the service call.
     *
     * @return self
     */
    public function setRedirectUrl($redirect_url)
    {
        $this->container['redirect_url'] = $redirect_url;

        return $this;
    }

    /**
     * Gets redirect_context
     *
     * @return string
     */
    public function getRedirectContext()
    {
        return $this->container['redirect_context'];
    }

    /**
     * Sets redirect_context
     *
     * @param string $redirect_context Set in case of status = REDIRECT_REQUIRED. When the bank redirects the user back to your client, the redirect URL will contain this string, which you must process to identify the user context for the callback on your side.
     *
     * @return self
     */
    public function setRedirectContext($redirect_context)
    {
        $this->container['redirect_context'] = $redirect_context;

        return $this;
    }

    /**
     * Gets redirect_context_field
     *
     * @return string
     */
    public function getRedirectContextField()
    {
        return $this->container['redirect_context_field'];
    }

    /**
     * Sets redirect_context_field
     *
     * @param string $redirect_context_field Set in case of status = REDIRECT_REQUIRED. This field is set to the name of the query parameter that contains the 'redirectContext' in the redirect URL from the bank back to your client.
     *
     * @return self
     */
    public function setRedirectContextField($redirect_context_field)
    {
        $this->container['redirect_context_field'] = $redirect_context_field;

        return $this;
    }

    /**
     * Gets two_step_procedures
     *
     * @return \OpenAPIAccess\Client\Model\TwoStepProcedure[]
     */
    public function getTwoStepProcedures()
    {
        return $this->container['two_step_procedures'];
    }

    /**
     * Sets two_step_procedures
     *
     * @param \OpenAPIAccess\Client\Model\TwoStepProcedure[] $two_step_procedures <strong>Type:</strong> TwoStepProcedure<br/> In case of status = TWO_STEP_PROCEDURE_REQUIRED, this field contains the available two-step procedures. Note that this set does not necessarily match the set that is stored in the respective bank connection interface. You should always use the set from this field for the multi-step authentication flow.
     *
     * @return self
     */
    public function setTwoStepProcedures($two_step_procedures)
    {


        $this->container['two_step_procedures'] = $two_step_procedures;

        return $this;
    }

    /**
     * Gets photo_tan_mime_type
     *
     * @return string
     */
    public function getPhotoTanMimeType()
    {
        return $this->container['photo_tan_mime_type'];
    }

    /**
     * Sets photo_tan_mime_type
     *
     * @param string $photo_tan_mime_type In case that the 'photoTanData' field is set (i.e. not null), this field contains the MIME type to use for interpreting the photo data (e.g.: 'image/png')
     *
     * @return self
     */
    public function setPhotoTanMimeType($photo_tan_mime_type)
    {
        $this->container['photo_tan_mime_type'] = $photo_tan_mime_type;

        return $this;
    }

    /**
     * Gets photo_tan_data
     *
     * @return string
     */
    public function getPhotoTanData()
    {
        return $this->container['photo_tan_data'];
    }

    /**
     * Sets photo_tan_data
     *
     * @param string $photo_tan_data In case that the bank server has instructed the user to scan a photo (or more generally speaking, any kind of QR-code-like data), then this field will contain the raw data of the photo as a BASE-64 string.
     *
     * @return self
     */
    public function setPhotoTanData($photo_tan_data)
    {
        $this->container['photo_tan_data'] = $photo_tan_data;

        return $this;
    }

    /**
     * Gets optical_data
     *
     * @return string
     */
    public function getOpticalData()
    {
        return $this->container['optical_data'];
    }

    /**
     * Sets optical_data
     *
     * @param string $optical_data In case that the bank server has instructed the user to scan a flicker code, then this field will contain the raw data for the flicker animation as a BASE-64 string.
     *
     * @return self
     */
    public function setOpticalData($optical_data)
    {
        $this->container['optical_data'] = $optical_data;

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


