<?php
/**
 * UpdateBankConnectionParams
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
 * UpdateBankConnectionParams Class Doc Comment
 *
 * @category Class
 * @description Container for bank connection update parameters
 * @package  OpenAPIAccess\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class UpdateBankConnectionParams implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'UpdateBankConnectionParams';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'bank_connection_id' => 'int',
        'interface' => 'BankingInterface',
        'login_credentials' => '\OpenAPIAccess\Client\Model\LoginCredential[]',
        'store_secrets' => 'bool',
        'import_new_accounts' => 'bool',
        'skip_positions_download' => 'bool',
        'load_owner_data' => 'bool',
        'account_types' => 'AccountType[]',
        'account_references' => '\OpenAPIAccess\Client\Model\AccountReference[]',
        'redirect_url' => 'string',
        'force_web_form' => 'bool',
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
        'bank_connection_id' => 'int64',
        'interface' => null,
        'login_credentials' => null,
        'store_secrets' => null,
        'import_new_accounts' => null,
        'skip_positions_download' => null,
        'load_owner_data' => null,
        'account_types' => null,
        'account_references' => null,
        'redirect_url' => null,
        'force_web_form' => null,
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
        'bank_connection_id' => 'bankConnectionId',
        'interface' => 'interface',
        'login_credentials' => 'loginCredentials',
        'store_secrets' => 'storeSecrets',
        'import_new_accounts' => 'importNewAccounts',
        'skip_positions_download' => 'skipPositionsDownload',
        'load_owner_data' => 'loadOwnerData',
        'account_types' => 'accountTypes',
        'account_references' => 'accountReferences',
        'redirect_url' => 'redirectUrl',
        'force_web_form' => 'forceWebForm',
        'multi_step_authentication' => 'multiStepAuthentication'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'bank_connection_id' => 'setBankConnectionId',
        'interface' => 'setInterface',
        'login_credentials' => 'setLoginCredentials',
        'store_secrets' => 'setStoreSecrets',
        'import_new_accounts' => 'setImportNewAccounts',
        'skip_positions_download' => 'setSkipPositionsDownload',
        'load_owner_data' => 'setLoadOwnerData',
        'account_types' => 'setAccountTypes',
        'account_references' => 'setAccountReferences',
        'redirect_url' => 'setRedirectUrl',
        'force_web_form' => 'setForceWebForm',
        'multi_step_authentication' => 'setMultiStepAuthentication'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'bank_connection_id' => 'getBankConnectionId',
        'interface' => 'getInterface',
        'login_credentials' => 'getLoginCredentials',
        'store_secrets' => 'getStoreSecrets',
        'import_new_accounts' => 'getImportNewAccounts',
        'skip_positions_download' => 'getSkipPositionsDownload',
        'load_owner_data' => 'getLoadOwnerData',
        'account_types' => 'getAccountTypes',
        'account_references' => 'getAccountReferences',
        'redirect_url' => 'getRedirectUrl',
        'force_web_form' => 'getForceWebForm',
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
        $this->container['bank_connection_id'] = $data['bank_connection_id'] ?? null;
        $this->container['interface'] = $data['interface'] ?? null;
        $this->container['login_credentials'] = $data['login_credentials'] ?? null;
        $this->container['store_secrets'] = $data['store_secrets'] ?? false;
        $this->container['import_new_accounts'] = $data['import_new_accounts'] ?? false;
        $this->container['skip_positions_download'] = $data['skip_positions_download'] ?? false;
        $this->container['load_owner_data'] = $data['load_owner_data'] ?? false;
        $this->container['account_types'] = $data['account_types'] ?? null;
        $this->container['account_references'] = $data['account_references'] ?? null;
        $this->container['redirect_url'] = $data['redirect_url'] ?? null;
        $this->container['force_web_form'] = $data['force_web_form'] ?? false;
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

        if ($this->container['bank_connection_id'] === null) {
            $invalidProperties[] = "'bank_connection_id' can't be null";
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
     * @param int $bank_connection_id Bank connection identifier
     *
     * @return self
     */
    public function setBankConnectionId($bank_connection_id)
    {
        $this->container['bank_connection_id'] = $bank_connection_id;

        return $this;
    }

    /**
     * Gets interface
     *
     * @return BankingInterface|null
     */
    public function getInterface()
    {
        return $this->container['interface'];
    }

    /**
     * Sets interface
     *
     * @param BankingInterface|null $interface <strong>Type:</strong> BankingInterface<br/> The interface to use for connecting with the bank.
     *
     * @return self
     */
    public function setInterface($interface)
    {
        $this->container['interface'] = $interface;

        return $this;
    }

    /**
     * Gets login_credentials
     *
     * @return \OpenAPIAccess\Client\Model\LoginCredential[]|null
     */
    public function getLoginCredentials()
    {
        return $this->container['login_credentials'];
    }

    /**
     * Sets login_credentials
     *
     * @param \OpenAPIAccess\Client\Model\LoginCredential[]|null $login_credentials <strong>Type:</strong> LoginCredential<br/> Set of login credentials. Must be passed in combination with the 'interface' field, if the credentials have not been previously stored. The labels that you pass must match with the login credential labels that the respective interface defines. finAPI will combine the given credentials with any credentials that it has stored. You can leave this field unset in case finAPI has stored all required credentials. When you must use a web form, you can also leave this field unset and the web form will take care of getting the credentials from the user. However, if you do pass credentials in that case, the web form will show only those fields that you have given.
     *
     * @return self
     */
    public function setLoginCredentials($login_credentials)
    {
        $this->container['login_credentials'] = $login_credentials;

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
     * @param bool|null $store_secrets Whether to store the secret login fields. If the secret fields are stored, then updates can be triggered without the involvement of the users, as long as the credentials remain valid and the bank consent has not expired. Note that bank consent will be stored regardless of the field value. Default value is false.<br/><br/>NOTES:<br/> - this field is ignored in case when the user will need to use finAPI's web form. The user will be able to decide whether to store the secrets or not in the web form, depending on the 'storeSecretsAvailableInWebForm' setting (see Client Configuration).
     *
     * @return self
     */
    public function setStoreSecrets($store_secrets)
    {
        $this->container['store_secrets'] = $store_secrets;

        return $this;
    }

    /**
     * Gets import_new_accounts
     *
     * @return bool|null
     */
    public function getImportNewAccounts()
    {
        return $this->container['import_new_accounts'];
    }

    /**
     * Sets import_new_accounts
     *
     * @param bool|null $import_new_accounts Whether new accounts that have not yet been imported will be imported or not. Default is false. <br/><br/>NOTES:<br/>&bull; For best performance of the bank connection update, you should not enable this flag unless you really expect new accounts to be available in the connection. It is recommended to let your users tell you through your application when they want the service to look for new accounts.<br/>&bull; If you have imported an interface using a limited set of account types, you would import all other accounts (e.g. security accounts or credit cards) by setting <code>importNewAccounts</code> to <code>true</code>. To avoid importing account types that you are not interested in, make sure to keep this field unset (or set to false) for the update.
     *
     * @return self
     */
    public function setImportNewAccounts($import_new_accounts)
    {
        $this->container['import_new_accounts'] = $import_new_accounts;

        return $this;
    }

    /**
     * Gets skip_positions_download
     *
     * @return bool|null
     */
    public function getSkipPositionsDownload()
    {
        return $this->container['skip_positions_download'];
    }

    /**
     * Sets skip_positions_download
     *
     * @param bool|null $skip_positions_download Whether to skip the download of transactions and securities or not. If set to true, then finAPI will download just the accounts list with the accounts' information (like account name, number, holder, etc), as well as the accounts' balances (if possible), but skip the download of transactions and securities. Default is false.<br/><br/>NOTES:<br/>&bull; Setting this flag to true is only meant to be used if A) you generally never download positions, because you are only interested in the accounts list and/or balances, or B) you want to get just the list of accounts in a first step, and then delete unwanted accounts from the bank connection, before you trigger another update with transactions download. This approach allows you to download transactions only for the accounts that you want.<br/>&bull; If you skip the download of transactions and securities during an import or update, you can still download them on a later update (though you might not get all positions at a later point, because the date range in which the bank servers provide this data is usually limited).<br/>&bull; If an account already had any positions imported before an update, and you skip the positions download in the update, then the account's updated balance might not add up to the set of transactions / security positions. Be aware that certain services (like GET /accounts/dailyBalances) may give incorrect results for accounts in such a state.<br/>&bull; If this bank connection is updated via finAPI's automatic batch update, then transactions and security positions (of already imported accounts) <u>will</u> be downloaded in any case!<br/>&bull; For security accounts, skipping the downloading of the securities might result in the account's balance also not being downloaded.<br/>&bull; For Bausparen accounts, this field is ignored. finAPI will always download transactions for Bausparen accounts.<br/>
     *
     * @return self
     */
    public function setSkipPositionsDownload($skip_positions_download)
    {
        $this->container['skip_positions_download'] = $skip_positions_download;

        return $this;
    }

    /**
     * Gets load_owner_data
     *
     * @return bool|null
     */
    public function getLoadOwnerData()
    {
        return $this->container['load_owner_data'];
    }

    /**
     * Sets load_owner_data
     *
     * @param bool|null $load_owner_data Whether to load/refresh information about the bank connection owner(s) - see field 'owners'. Default value is 'false'. Note that owner data is NOT loaded/refreshed during finAPI's automatic bank connection update.
     *
     * @return self
     */
    public function setLoadOwnerData($load_owner_data)
    {
        $this->container['load_owner_data'] = $load_owner_data;

        return $this;
    }

    /**
     * Gets account_types
     *
     * @return AccountType[]|null
     */
    public function getAccountTypes()
    {
        return $this->container['account_types'];
    }

    /**
     * Sets account_types
     *
     * @param AccountType[]|null $account_types account_types
     *
     * @return self
     */
    public function setAccountTypes($account_types)
    {
        $this->container['account_types'] = $account_types;

        return $this;
    }

    /**
     * Gets account_references
     *
     * @return \OpenAPIAccess\Client\Model\AccountReference[]|null
     */
    public function getAccountReferences()
    {
        return $this->container['account_references'];
    }

    /**
     * Sets account_references
     *
     * @param \OpenAPIAccess\Client\Model\AccountReference[]|null $account_references <strong>Type:</strong> AccountReference<br/> List of accounts for which access is requested from the bank. It may only be passed if the bank interface has the DETAILED_CONSENT property set. if omitted, finAPI will use the list of existing accounts. Note that the parameter is still required if you want to import new accounts (i.e. call with importNewAccounts=true).
     *
     * @return self
     */
    public function setAccountReferences($account_references)
    {
        $this->container['account_references'] = $account_references;

        return $this;
    }

    /**
     * Gets redirect_url
     *
     * @return string|null
     */
    public function getRedirectUrl()
    {
        return $this->container['redirect_url'];
    }

    /**
     * Sets redirect_url
     *
     * @param string|null $redirect_url Must only be passed when the used interface has the property REDIRECT_APPROACH and no web form flow is used. The user will be redirected to the given URL from the bank's website after having entered his credentials.
     *
     * @return self
     */
    public function setRedirectUrl($redirect_url)
    {
        $this->container['redirect_url'] = $redirect_url;

        return $this;
    }

    /**
     * Gets force_web_form
     *
     * @return bool|null
     */
    public function getForceWebForm()
    {
        return $this->container['force_web_form'];
    }

    /**
     * Sets force_web_form
     *
     * @param bool|null $force_web_form If the user has stored credentials in finAPI for the selected bank connection, then the finAPI web form will only be shown when the user must be involved for a second authentication, or when the previous connection to the bank via the selected interface had failed. However if you want to provide the web form to the user in any case, you can set this field to true. It will force the web form flow for the user and allow him to make changes to the data that he has stored in finAPI. Default value is 'false'.
     *
     * @return self
     */
    public function setForceWebForm($force_web_form)
    {
        $this->container['force_web_form'] = $force_web_form;

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


