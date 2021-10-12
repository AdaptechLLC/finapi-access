<?php
/**
 * ClientConfiguration
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
 * ClientConfiguration Class Doc Comment
 *
 * @category Class
 * @description Client configuration parameters
 * @package  OpenAPIAccess\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class ClientConfiguration implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'ClientConfiguration';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'pfm_services_enabled' => 'bool',
        'is_automatic_batch_update_enabled' => 'bool',
        'is_development_mode_enabled' => 'bool',
        'is_non_euro_accounts_supported' => 'bool',
        'is_auto_categorization_enabled' => 'bool',
        'mandator_license' => 'MandatorLicense',
        'preferred_consent_type' => 'PreferredConsentType',
        'user_notification_callback_url' => 'string',
        'user_synchronization_callback_url' => 'string',
        'refresh_tokens_validity_period' => 'int',
        'user_access_tokens_validity_period' => 'int',
        'client_access_tokens_validity_period' => 'int',
        'max_user_login_attempts' => 'int',
        'transaction_import_limitation' => 'int',
        'is_user_auto_verification_enabled' => 'bool',
        'is_mandator_admin' => 'bool',
        'is_web_scraping_enabled' => 'bool',
        'payments_enabled' => 'bool',
        'is_standalone_payments_enabled' => 'bool',
        'available_bank_groups' => 'string[]',
        'products' => 'Product[]',
        'application_name' => 'string',
        'fin_ts_product_registration_number' => 'string',
        'store_secrets_available_in_web_form' => 'bool',
        'support_subject_default' => 'string',
        'support_email' => 'string',
        'ais_web_form_mode' => 'WebFormMode',
        'pis_web_form_mode' => 'WebFormMode',
        'pis_standalone_web_form_mode' => 'WebFormMode',
        'beta_banks_enabled' => 'bool',
        'category_restrictions' => '\OpenAPIAccess\Client\Model\Category[]',
        'auto_dismount_web_form' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'pfm_services_enabled' => null,
        'is_automatic_batch_update_enabled' => null,
        'is_development_mode_enabled' => null,
        'is_non_euro_accounts_supported' => null,
        'is_auto_categorization_enabled' => null,
        'mandator_license' => null,
        'preferred_consent_type' => null,
        'user_notification_callback_url' => null,
        'user_synchronization_callback_url' => null,
        'refresh_tokens_validity_period' => 'int32',
        'user_access_tokens_validity_period' => 'int32',
        'client_access_tokens_validity_period' => 'int32',
        'max_user_login_attempts' => 'int32',
        'transaction_import_limitation' => 'int32',
        'is_user_auto_verification_enabled' => null,
        'is_mandator_admin' => null,
        'is_web_scraping_enabled' => null,
        'payments_enabled' => null,
        'is_standalone_payments_enabled' => null,
        'available_bank_groups' => null,
        'products' => null,
        'application_name' => null,
        'fin_ts_product_registration_number' => null,
        'store_secrets_available_in_web_form' => null,
        'support_subject_default' => null,
        'support_email' => null,
        'ais_web_form_mode' => null,
        'pis_web_form_mode' => null,
        'pis_standalone_web_form_mode' => null,
        'beta_banks_enabled' => null,
        'category_restrictions' => null,
        'auto_dismount_web_form' => null
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
        'pfm_services_enabled' => 'pfmServicesEnabled',
        'is_automatic_batch_update_enabled' => 'isAutomaticBatchUpdateEnabled',
        'is_development_mode_enabled' => 'isDevelopmentModeEnabled',
        'is_non_euro_accounts_supported' => 'isNonEuroAccountsSupported',
        'is_auto_categorization_enabled' => 'isAutoCategorizationEnabled',
        'mandator_license' => 'mandatorLicense',
        'preferred_consent_type' => 'preferredConsentType',
        'user_notification_callback_url' => 'userNotificationCallbackUrl',
        'user_synchronization_callback_url' => 'userSynchronizationCallbackUrl',
        'refresh_tokens_validity_period' => 'refreshTokensValidityPeriod',
        'user_access_tokens_validity_period' => 'userAccessTokensValidityPeriod',
        'client_access_tokens_validity_period' => 'clientAccessTokensValidityPeriod',
        'max_user_login_attempts' => 'maxUserLoginAttempts',
        'transaction_import_limitation' => 'transactionImportLimitation',
        'is_user_auto_verification_enabled' => 'isUserAutoVerificationEnabled',
        'is_mandator_admin' => 'isMandatorAdmin',
        'is_web_scraping_enabled' => 'isWebScrapingEnabled',
        'payments_enabled' => 'paymentsEnabled',
        'is_standalone_payments_enabled' => 'isStandalonePaymentsEnabled',
        'available_bank_groups' => 'availableBankGroups',
        'products' => 'products',
        'application_name' => 'applicationName',
        'fin_ts_product_registration_number' => 'finTSProductRegistrationNumber',
        'store_secrets_available_in_web_form' => 'storeSecretsAvailableInWebForm',
        'support_subject_default' => 'supportSubjectDefault',
        'support_email' => 'supportEmail',
        'ais_web_form_mode' => 'aisWebFormMode',
        'pis_web_form_mode' => 'pisWebFormMode',
        'pis_standalone_web_form_mode' => 'pisStandaloneWebFormMode',
        'beta_banks_enabled' => 'betaBanksEnabled',
        'category_restrictions' => 'categoryRestrictions',
        'auto_dismount_web_form' => 'autoDismountWebForm'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'pfm_services_enabled' => 'setPfmServicesEnabled',
        'is_automatic_batch_update_enabled' => 'setIsAutomaticBatchUpdateEnabled',
        'is_development_mode_enabled' => 'setIsDevelopmentModeEnabled',
        'is_non_euro_accounts_supported' => 'setIsNonEuroAccountsSupported',
        'is_auto_categorization_enabled' => 'setIsAutoCategorizationEnabled',
        'mandator_license' => 'setMandatorLicense',
        'preferred_consent_type' => 'setPreferredConsentType',
        'user_notification_callback_url' => 'setUserNotificationCallbackUrl',
        'user_synchronization_callback_url' => 'setUserSynchronizationCallbackUrl',
        'refresh_tokens_validity_period' => 'setRefreshTokensValidityPeriod',
        'user_access_tokens_validity_period' => 'setUserAccessTokensValidityPeriod',
        'client_access_tokens_validity_period' => 'setClientAccessTokensValidityPeriod',
        'max_user_login_attempts' => 'setMaxUserLoginAttempts',
        'transaction_import_limitation' => 'setTransactionImportLimitation',
        'is_user_auto_verification_enabled' => 'setIsUserAutoVerificationEnabled',
        'is_mandator_admin' => 'setIsMandatorAdmin',
        'is_web_scraping_enabled' => 'setIsWebScrapingEnabled',
        'payments_enabled' => 'setPaymentsEnabled',
        'is_standalone_payments_enabled' => 'setIsStandalonePaymentsEnabled',
        'available_bank_groups' => 'setAvailableBankGroups',
        'products' => 'setProducts',
        'application_name' => 'setApplicationName',
        'fin_ts_product_registration_number' => 'setFinTsProductRegistrationNumber',
        'store_secrets_available_in_web_form' => 'setStoreSecretsAvailableInWebForm',
        'support_subject_default' => 'setSupportSubjectDefault',
        'support_email' => 'setSupportEmail',
        'ais_web_form_mode' => 'setAisWebFormMode',
        'pis_web_form_mode' => 'setPisWebFormMode',
        'pis_standalone_web_form_mode' => 'setPisStandaloneWebFormMode',
        'beta_banks_enabled' => 'setBetaBanksEnabled',
        'category_restrictions' => 'setCategoryRestrictions',
        'auto_dismount_web_form' => 'setAutoDismountWebForm'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'pfm_services_enabled' => 'getPfmServicesEnabled',
        'is_automatic_batch_update_enabled' => 'getIsAutomaticBatchUpdateEnabled',
        'is_development_mode_enabled' => 'getIsDevelopmentModeEnabled',
        'is_non_euro_accounts_supported' => 'getIsNonEuroAccountsSupported',
        'is_auto_categorization_enabled' => 'getIsAutoCategorizationEnabled',
        'mandator_license' => 'getMandatorLicense',
        'preferred_consent_type' => 'getPreferredConsentType',
        'user_notification_callback_url' => 'getUserNotificationCallbackUrl',
        'user_synchronization_callback_url' => 'getUserSynchronizationCallbackUrl',
        'refresh_tokens_validity_period' => 'getRefreshTokensValidityPeriod',
        'user_access_tokens_validity_period' => 'getUserAccessTokensValidityPeriod',
        'client_access_tokens_validity_period' => 'getClientAccessTokensValidityPeriod',
        'max_user_login_attempts' => 'getMaxUserLoginAttempts',
        'transaction_import_limitation' => 'getTransactionImportLimitation',
        'is_user_auto_verification_enabled' => 'getIsUserAutoVerificationEnabled',
        'is_mandator_admin' => 'getIsMandatorAdmin',
        'is_web_scraping_enabled' => 'getIsWebScrapingEnabled',
        'payments_enabled' => 'getPaymentsEnabled',
        'is_standalone_payments_enabled' => 'getIsStandalonePaymentsEnabled',
        'available_bank_groups' => 'getAvailableBankGroups',
        'products' => 'getProducts',
        'application_name' => 'getApplicationName',
        'fin_ts_product_registration_number' => 'getFinTsProductRegistrationNumber',
        'store_secrets_available_in_web_form' => 'getStoreSecretsAvailableInWebForm',
        'support_subject_default' => 'getSupportSubjectDefault',
        'support_email' => 'getSupportEmail',
        'ais_web_form_mode' => 'getAisWebFormMode',
        'pis_web_form_mode' => 'getPisWebFormMode',
        'pis_standalone_web_form_mode' => 'getPisStandaloneWebFormMode',
        'beta_banks_enabled' => 'getBetaBanksEnabled',
        'category_restrictions' => 'getCategoryRestrictions',
        'auto_dismount_web_form' => 'getAutoDismountWebForm'
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
        $this->container['pfm_services_enabled'] = $data['pfm_services_enabled'] ?? null;
        $this->container['is_automatic_batch_update_enabled'] = $data['is_automatic_batch_update_enabled'] ?? null;
        $this->container['is_development_mode_enabled'] = $data['is_development_mode_enabled'] ?? null;
        $this->container['is_non_euro_accounts_supported'] = $data['is_non_euro_accounts_supported'] ?? null;
        $this->container['is_auto_categorization_enabled'] = $data['is_auto_categorization_enabled'] ?? null;
        $this->container['mandator_license'] = $data['mandator_license'] ?? null;
        $this->container['preferred_consent_type'] = $data['preferred_consent_type'] ?? null;
        $this->container['user_notification_callback_url'] = $data['user_notification_callback_url'] ?? null;
        $this->container['user_synchronization_callback_url'] = $data['user_synchronization_callback_url'] ?? null;
        $this->container['refresh_tokens_validity_period'] = $data['refresh_tokens_validity_period'] ?? null;
        $this->container['user_access_tokens_validity_period'] = $data['user_access_tokens_validity_period'] ?? null;
        $this->container['client_access_tokens_validity_period'] = $data['client_access_tokens_validity_period'] ?? null;
        $this->container['max_user_login_attempts'] = $data['max_user_login_attempts'] ?? null;
        $this->container['transaction_import_limitation'] = $data['transaction_import_limitation'] ?? null;
        $this->container['is_user_auto_verification_enabled'] = $data['is_user_auto_verification_enabled'] ?? null;
        $this->container['is_mandator_admin'] = $data['is_mandator_admin'] ?? null;
        $this->container['is_web_scraping_enabled'] = $data['is_web_scraping_enabled'] ?? null;
        $this->container['payments_enabled'] = $data['payments_enabled'] ?? null;
        $this->container['is_standalone_payments_enabled'] = $data['is_standalone_payments_enabled'] ?? null;
        $this->container['available_bank_groups'] = $data['available_bank_groups'] ?? null;
        $this->container['products'] = $data['products'] ?? null;
        $this->container['application_name'] = $data['application_name'] ?? null;
        $this->container['fin_ts_product_registration_number'] = $data['fin_ts_product_registration_number'] ?? null;
        $this->container['store_secrets_available_in_web_form'] = $data['store_secrets_available_in_web_form'] ?? null;
        $this->container['support_subject_default'] = $data['support_subject_default'] ?? null;
        $this->container['support_email'] = $data['support_email'] ?? null;
        $this->container['ais_web_form_mode'] = $data['ais_web_form_mode'] ?? null;
        $this->container['pis_web_form_mode'] = $data['pis_web_form_mode'] ?? null;
        $this->container['pis_standalone_web_form_mode'] = $data['pis_standalone_web_form_mode'] ?? null;
        $this->container['beta_banks_enabled'] = $data['beta_banks_enabled'] ?? null;
        $this->container['category_restrictions'] = $data['category_restrictions'] ?? null;
        $this->container['auto_dismount_web_form'] = $data['auto_dismount_web_form'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['pfm_services_enabled'] === null) {
            $invalidProperties[] = "'pfm_services_enabled' can't be null";
        }
        if ($this->container['is_automatic_batch_update_enabled'] === null) {
            $invalidProperties[] = "'is_automatic_batch_update_enabled' can't be null";
        }
        if ($this->container['is_development_mode_enabled'] === null) {
            $invalidProperties[] = "'is_development_mode_enabled' can't be null";
        }
        if ($this->container['is_non_euro_accounts_supported'] === null) {
            $invalidProperties[] = "'is_non_euro_accounts_supported' can't be null";
        }
        if ($this->container['is_auto_categorization_enabled'] === null) {
            $invalidProperties[] = "'is_auto_categorization_enabled' can't be null";
        }
        if ($this->container['mandator_license'] === null) {
            $invalidProperties[] = "'mandator_license' can't be null";
        }
        if ($this->container['preferred_consent_type'] === null) {
            $invalidProperties[] = "'preferred_consent_type' can't be null";
        }
        if ($this->container['user_notification_callback_url'] === null) {
            $invalidProperties[] = "'user_notification_callback_url' can't be null";
        }
        if ($this->container['user_synchronization_callback_url'] === null) {
            $invalidProperties[] = "'user_synchronization_callback_url' can't be null";
        }
        if ($this->container['refresh_tokens_validity_period'] === null) {
            $invalidProperties[] = "'refresh_tokens_validity_period' can't be null";
        }
        if ($this->container['user_access_tokens_validity_period'] === null) {
            $invalidProperties[] = "'user_access_tokens_validity_period' can't be null";
        }
        if ($this->container['client_access_tokens_validity_period'] === null) {
            $invalidProperties[] = "'client_access_tokens_validity_period' can't be null";
        }
        if ($this->container['max_user_login_attempts'] === null) {
            $invalidProperties[] = "'max_user_login_attempts' can't be null";
        }
        if ($this->container['transaction_import_limitation'] === null) {
            $invalidProperties[] = "'transaction_import_limitation' can't be null";
        }
        if ($this->container['is_user_auto_verification_enabled'] === null) {
            $invalidProperties[] = "'is_user_auto_verification_enabled' can't be null";
        }
        if ($this->container['is_mandator_admin'] === null) {
            $invalidProperties[] = "'is_mandator_admin' can't be null";
        }
        if ($this->container['is_web_scraping_enabled'] === null) {
            $invalidProperties[] = "'is_web_scraping_enabled' can't be null";
        }
        if ($this->container['payments_enabled'] === null) {
            $invalidProperties[] = "'payments_enabled' can't be null";
        }
        if ($this->container['is_standalone_payments_enabled'] === null) {
            $invalidProperties[] = "'is_standalone_payments_enabled' can't be null";
        }
        if ($this->container['available_bank_groups'] === null) {
            $invalidProperties[] = "'available_bank_groups' can't be null";
        }
        if ($this->container['products'] === null) {
            $invalidProperties[] = "'products' can't be null";
        }
        if ($this->container['application_name'] === null) {
            $invalidProperties[] = "'application_name' can't be null";
        }
        if ($this->container['fin_ts_product_registration_number'] === null) {
            $invalidProperties[] = "'fin_ts_product_registration_number' can't be null";
        }
        if ($this->container['store_secrets_available_in_web_form'] === null) {
            $invalidProperties[] = "'store_secrets_available_in_web_form' can't be null";
        }
        if ($this->container['support_subject_default'] === null) {
            $invalidProperties[] = "'support_subject_default' can't be null";
        }
        if ($this->container['support_email'] === null) {
            $invalidProperties[] = "'support_email' can't be null";
        }
        if ($this->container['ais_web_form_mode'] === null) {
            $invalidProperties[] = "'ais_web_form_mode' can't be null";
        }
        if ($this->container['pis_web_form_mode'] === null) {
            $invalidProperties[] = "'pis_web_form_mode' can't be null";
        }
        if ($this->container['pis_standalone_web_form_mode'] === null) {
            $invalidProperties[] = "'pis_standalone_web_form_mode' can't be null";
        }
        if ($this->container['beta_banks_enabled'] === null) {
            $invalidProperties[] = "'beta_banks_enabled' can't be null";
        }
        if ($this->container['category_restrictions'] === null) {
            $invalidProperties[] = "'category_restrictions' can't be null";
        }
        if ($this->container['auto_dismount_web_form'] === null) {
            $invalidProperties[] = "'auto_dismount_web_form' can't be null";
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
     * Gets pfm_services_enabled
     *
     * @return bool
     */
    public function getPfmServicesEnabled()
    {
        return $this->container['pfm_services_enabled'];
    }

    /**
     * Sets pfm_services_enabled
     *
     * @param bool $pfm_services_enabled Whether your client is allowed to call PFM services (Personal Finance Management). The set of PFM services is the following:<br/><br/>&bull; all /mandatorAdmin/ibanRules/_* and /mandatorAdmin/keywordRules/_* services<br/>&bull; GET /accounts/dailyBalances<br/>&bull; all /transactions/_* services, except for GET /transactions/[id(s)] and DELETE /transactions/[id]<br/>&bull; all /categories/_* services, except for GET /categories/[id(s)]<br/>&bull; all /labels/_* services<br/>&bull; all /notificationRules/_* services<br/>&bull; all /tests/_* services
     *
     * @return self
     */
    public function setPfmServicesEnabled($pfm_services_enabled)
    {
        $this->container['pfm_services_enabled'] = $pfm_services_enabled;

        return $this;
    }

    /**
     * Gets is_automatic_batch_update_enabled
     *
     * @return bool
     */
    public function getIsAutomaticBatchUpdateEnabled()
    {
        return $this->container['is_automatic_batch_update_enabled'];
    }

    /**
     * Sets is_automatic_batch_update_enabled
     *
     * @param bool $is_automatic_batch_update_enabled Whether finAPI performs a regular automatic update of your users' bank connections. To find out how the automatic batch update is configured for your client, i.e. which bank connections get updated, and at which time and interval, please contact your Sys-Admin. Note that even if the automatic batch update is enabled for your client, individual users can still disable the feature for their own bank connections.
     *
     * @return self
     */
    public function setIsAutomaticBatchUpdateEnabled($is_automatic_batch_update_enabled)
    {
        $this->container['is_automatic_batch_update_enabled'] = $is_automatic_batch_update_enabled;

        return $this;
    }

    /**
     * Gets is_development_mode_enabled
     *
     * @return bool
     */
    public function getIsDevelopmentModeEnabled()
    {
        return $this->container['is_development_mode_enabled'];
    }

    /**
     * Sets is_development_mode_enabled
     *
     * @param bool $is_development_mode_enabled Whether development mode is enabled. This setting is enabled on mandator level and allows any user to access the ‘Mock batch update’ service. <br/><br/>NOTE: This flag is meant for testing purposes during development of your application. <br/>This is why this will never be enabled on a production environment.
     *
     * @return self
     */
    public function setIsDevelopmentModeEnabled($is_development_mode_enabled)
    {
        $this->container['is_development_mode_enabled'] = $is_development_mode_enabled;

        return $this;
    }

    /**
     * Gets is_non_euro_accounts_supported
     *
     * @return bool
     */
    public function getIsNonEuroAccountsSupported()
    {
        return $this->container['is_non_euro_accounts_supported'];
    }

    /**
     * Sets is_non_euro_accounts_supported
     *
     * @param bool $is_non_euro_accounts_supported Whether finAPI will download data (balance and transactions) for bank accounts with a currency other than EUR (affects all users). If this flag is false, then non-EUR accounts will still be returned in the account list, but they will have no balance and no transactions. Note that this currently applies to Checking accounts only.
     *
     * @return self
     */
    public function setIsNonEuroAccountsSupported($is_non_euro_accounts_supported)
    {
        $this->container['is_non_euro_accounts_supported'] = $is_non_euro_accounts_supported;

        return $this;
    }

    /**
     * Gets is_auto_categorization_enabled
     *
     * @return bool
     */
    public function getIsAutoCategorizationEnabled()
    {
        return $this->container['is_auto_categorization_enabled'];
    }

    /**
     * Sets is_auto_categorization_enabled
     *
     * @param bool $is_auto_categorization_enabled Whether transactions will be categorized as soon as they are downloaded. <br/>In case this flag is false, the user needs to manually trigger categorization using the ‘Trigger categorization’ service.
     *
     * @return self
     */
    public function setIsAutoCategorizationEnabled($is_auto_categorization_enabled)
    {
        $this->container['is_auto_categorization_enabled'] = $is_auto_categorization_enabled;

        return $this;
    }

    /**
     * Gets mandator_license
     *
     * @return MandatorLicense
     */
    public function getMandatorLicense()
    {
        return $this->container['mandator_license'];
    }

    /**
     * Sets mandator_license
     *
     * @param MandatorLicense $mandator_license <strong>Type:</strong> MandatorLicense<br/> The license associated with your client. <br/>The licensing model affects the TPP registration data used to connect to the bank (e.g. <b>finTSProductRegistrationNumber</b> for FINTS_SERVER interface). Licenses are administered by finAPI. Please contact the support to change the license that was set up for you.<br/>Possible values are:<br/>UNLICENSED: finAPI will use its own TPP registration to connect to the bank for both account information services (AIS) and payment initiation services (PIS).<br/>AISP: finAPI will use its own TPP registration to connect to the bank for PIS, and your registration for AIS.<br/>PISP: finAPI will use its own TPP registration to connect to the bank for AIS, and your registration for PIS.<br/>FULLY_LICENSED: finAPI will use your TPP registration to connect to the bank for both AIS and PIS.
     *
     * @return self
     */
    public function setMandatorLicense($mandator_license)
    {
        $this->container['mandator_license'] = $mandator_license;

        return $this;
    }

    /**
     * Gets preferred_consent_type
     *
     * @return PreferredConsentType
     */
    public function getPreferredConsentType()
    {
        return $this->container['preferred_consent_type'];
    }

    /**
     * Sets preferred_consent_type
     *
     * @param PreferredConsentType $preferred_consent_type <strong>Type:</strong> PreferredConsentType<br/> The preferred consent type that will be used for the XS2A interface.<br/><br/><b>ONETIME</b> - The consent can only be used once to download data associated with the account. The consent won’t be saved by finAPI.<br/><b>RECURRING</b> - The consent is valid for up to 90 days and can be used by finAPI to access and download account data for up to 4 times per day.<br/><br/>NOTE: If the bank does not support the preferred consent type, then finAPI will default to the other type.
     *
     * @return self
     */
    public function setPreferredConsentType($preferred_consent_type)
    {
        $this->container['preferred_consent_type'] = $preferred_consent_type;

        return $this;
    }

    /**
     * Gets user_notification_callback_url
     *
     * @return string
     */
    public function getUserNotificationCallbackUrl()
    {
        return $this->container['user_notification_callback_url'];
    }

    /**
     * Sets user_notification_callback_url
     *
     * @param string $user_notification_callback_url Callback URL to which finAPI sends the notification messages that are triggered from the automatic batch update of the users' bank connections. This field is only relevant if the automatic batch update is enabled for your client. For details about what the notification messages look like, please see the documentation in the 'Notification Rules' section. finAPI will call this URL with HTTP method POST. Note that the response of the call is not processed by finAPI. Also note that while the callback URL may be a non-secured (http) URL on the finAPI sandbox or alpha environment, it MUST be a SSL-secured (https) URL on the finAPI live system.
     *
     * @return self
     */
    public function setUserNotificationCallbackUrl($user_notification_callback_url)
    {
        $this->container['user_notification_callback_url'] = $user_notification_callback_url;

        return $this;
    }

    /**
     * Gets user_synchronization_callback_url
     *
     * @return string
     */
    public function getUserSynchronizationCallbackUrl()
    {
        return $this->container['user_synchronization_callback_url'];
    }

    /**
     * Sets user_synchronization_callback_url
     *
     * @param string $user_synchronization_callback_url Callback URL for user synchronization. This field should be set if you - as a finAPI customer - have multiple clients using finAPI. In such case, all of your clients will share the same user base, making it possible for a user to be created in one client, but then deleted in another. To keep the client-side user data consistent in all clients, you should set a callback URL for each client. finAPI will send a notification to the callback URL of each client whenever a user of your user base gets deleted. Note that finAPI will send a deletion notification to ALL clients, including the one that made the user deletion request to finAPI. So when deleting a user in finAPI, a client should rely on the callback to delete the user on its own side. <p>The notification that finAPI sends to the clients' callback URLs will be a POST request, with this body: <pre>{    \"userId\" : string // contains the identifier of the deleted user    \"event\" : string // this will always be \"DELETED\" }</pre><br/>Note that finAPI does not process the response of this call. Also note that while the callback URL may be a non-secured (http) URL on the finAPI sandbox or alpha environment, it MUST be a SSL-secured (https) URL on the finAPI live system.</p>As long as you have just one client, you can ignore this field and let it be null. However keep in mind that in this case your client will not receive any callback when a user gets deleted - so the deletion of the user on the client-side must not be forgotten. Of course you may still use the callback URL even for just one client, if you want to implement the deletion of the user on the client-side via the callback from finAPI.
     *
     * @return self
     */
    public function setUserSynchronizationCallbackUrl($user_synchronization_callback_url)
    {
        $this->container['user_synchronization_callback_url'] = $user_synchronization_callback_url;

        return $this;
    }

    /**
     * Gets refresh_tokens_validity_period
     *
     * @return int
     */
    public function getRefreshTokensValidityPeriod()
    {
        return $this->container['refresh_tokens_validity_period'];
    }

    /**
     * Sets refresh_tokens_validity_period
     *
     * @param int $refresh_tokens_validity_period The validity period that newly requested refresh tokens initially have (in seconds). A value of 0 means that the tokens never expire (Unless explicitly invalidated, e.g. by revocation, or when a user gets locked, or when the password is reset for a user).
     *
     * @return self
     */
    public function setRefreshTokensValidityPeriod($refresh_tokens_validity_period)
    {
        $this->container['refresh_tokens_validity_period'] = $refresh_tokens_validity_period;

        return $this;
    }

    /**
     * Gets user_access_tokens_validity_period
     *
     * @return int
     */
    public function getUserAccessTokensValidityPeriod()
    {
        return $this->container['user_access_tokens_validity_period'];
    }

    /**
     * Sets user_access_tokens_validity_period
     *
     * @param int $user_access_tokens_validity_period The validity period that newly requested access tokens for users initially have (in seconds). A value of 0 means that the tokens never expire (Unless explicitly invalidated, e.g. by revocation, or when a user gets locked, or when the password is reset for a user).
     *
     * @return self
     */
    public function setUserAccessTokensValidityPeriod($user_access_tokens_validity_period)
    {
        $this->container['user_access_tokens_validity_period'] = $user_access_tokens_validity_period;

        return $this;
    }

    /**
     * Gets client_access_tokens_validity_period
     *
     * @return int
     */
    public function getClientAccessTokensValidityPeriod()
    {
        return $this->container['client_access_tokens_validity_period'];
    }

    /**
     * Sets client_access_tokens_validity_period
     *
     * @param int $client_access_tokens_validity_period The validity period that newly requested access tokens for clients initially have (in seconds). A value of 0 means that the tokens never expire (Unless explicitly invalidated, e.g. by revocation).
     *
     * @return self
     */
    public function setClientAccessTokensValidityPeriod($client_access_tokens_validity_period)
    {
        $this->container['client_access_tokens_validity_period'] = $client_access_tokens_validity_period;

        return $this;
    }

    /**
     * Gets max_user_login_attempts
     *
     * @return int
     */
    public function getMaxUserLoginAttempts()
    {
        return $this->container['max_user_login_attempts'];
    }

    /**
     * Sets max_user_login_attempts
     *
     * @param int $max_user_login_attempts Number of consecutive failed login attempts of a user into his finAPI account that is allowed before finAPI locks the user's account. When a user's account is locked, finAPI will invalidate all user's tokens and it will deny any service call in the context of this user (i.e. any call to a service using one of the user's authorization tokens, as well as the service for requesting a new token for this user). To unlock a user's account, a new password must be set for the account by the client (see the services /users/requestPasswordChange and /users/executePasswordChange). Once a new password has been set, all services will be available again for this user and the user's failed login attempts counter is reset to 0. The user's failed login attempts counter is also reset whenever a new authorization token has been successfully retrieved, or whenever the user himself changes his password.<br/><br/>Note that when this field has a value of 0, it means that there is no limit for user login attempts, i.e. finAPI will never lock user accounts.
     *
     * @return self
     */
    public function setMaxUserLoginAttempts($max_user_login_attempts)
    {
        $this->container['max_user_login_attempts'] = $max_user_login_attempts;

        return $this;
    }

    /**
     * Gets transaction_import_limitation
     *
     * @return int
     */
    public function getTransactionImportLimitation()
    {
        return $this->container['transaction_import_limitation'];
    }

    /**
     * Sets transaction_import_limitation
     *
     * @param int $transaction_import_limitation This setting defines the upper limit of how much of an account's transactions history may be downloaded whenever a new account is imported, across all of your users. More technically, it depicts the maximum number of days for which transactions might get downloaded, starting from - and including - the date of the account import. '0' means that there is no limitation.
     *
     * @return self
     */
    public function setTransactionImportLimitation($transaction_import_limitation)
    {
        $this->container['transaction_import_limitation'] = $transaction_import_limitation;

        return $this;
    }

    /**
     * Gets is_user_auto_verification_enabled
     *
     * @return bool
     */
    public function getIsUserAutoVerificationEnabled()
    {
        return $this->container['is_user_auto_verification_enabled'];
    }

    /**
     * Sets is_user_auto_verification_enabled
     *
     * @param bool $is_user_auto_verification_enabled Whether users that are created with this client are automatically verified on creation. If this field is set to 'false', then any user that is created with this client must first be verified with the \"Verify a user\" service before he can be authorized. If the field is 'true', then no verification is required by the client and the user can be authorized immediately after creation.
     *
     * @return self
     */
    public function setIsUserAutoVerificationEnabled($is_user_auto_verification_enabled)
    {
        $this->container['is_user_auto_verification_enabled'] = $is_user_auto_verification_enabled;

        return $this;
    }

    /**
     * Gets is_mandator_admin
     *
     * @return bool
     */
    public function getIsMandatorAdmin()
    {
        return $this->container['is_mandator_admin'];
    }

    /**
     * Sets is_mandator_admin
     *
     * @param bool $is_mandator_admin Whether this client is a 'Mandator Admin'. Mandator Admins are special clients that can access the 'Mandator Administration' section of finAPI. If you do not yet have credentials for a Mandator Admin, please contact us at support@finapi.io. For further information, please refer to <a href='https://finapi.zendesk.com/hc/en-us/articles/115003661827-Difference-between-app-clients-and-mandator-admin-client' target='_blank'>this article</a> on our Dev Portal.
     *
     * @return self
     */
    public function setIsMandatorAdmin($is_mandator_admin)
    {
        $this->container['is_mandator_admin'] = $is_mandator_admin;

        return $this;
    }

    /**
     * Gets is_web_scraping_enabled
     *
     * @return bool
     */
    public function getIsWebScrapingEnabled()
    {
        return $this->container['is_web_scraping_enabled'];
    }

    /**
     * Sets is_web_scraping_enabled
     *
     * @param bool $is_web_scraping_enabled Whether finAPI is allowed to use the WEB_SCRAPER interface for data download or payments. <br/><br/>If this field is set to 'true', then finAPI might download data from the online banking websites of banks (either in addition to other interfaces, or as the sole data source for the download). Also, it will be possible to do payments via the WEB_SCRAPER interface.<br/><br/>If this field is set to 'false', then finAPI will not use any web scrapers. Payments via the WEB_SCRAPER interface will not be possible, and finAPI will not allow any data download for banks where no other interface except WEB_SCRAPER is available. <br/><br/>Please contact your Sys-Admin if you want to change this setting.
     *
     * @return self
     */
    public function setIsWebScrapingEnabled($is_web_scraping_enabled)
    {
        $this->container['is_web_scraping_enabled'] = $is_web_scraping_enabled;

        return $this;
    }

    /**
     * Gets payments_enabled
     *
     * @return bool
     */
    public function getPaymentsEnabled()
    {
        return $this->container['payments_enabled'];
    }

    /**
     * Sets payments_enabled
     *
     * @param bool $payments_enabled Whether this client is allowed to do payments.<br/><br/>Note that on the Sandbox environment, it is always possible to execute payments (regardless of what this field says), as long as you are using a test bank (see Bank.isTestBank)
     *
     * @return self
     */
    public function setPaymentsEnabled($payments_enabled)
    {
        $this->container['payments_enabled'] = $payments_enabled;

        return $this;
    }

    /**
     * Gets is_standalone_payments_enabled
     *
     * @return bool
     */
    public function getIsStandalonePaymentsEnabled()
    {
        return $this->container['is_standalone_payments_enabled'];
    }

    /**
     * Sets is_standalone_payments_enabled
     *
     * @param bool $is_standalone_payments_enabled Whether the finAPI Payment product is enabled for this client (doing money transfers for accounts that are not imported in finAPI).<br/><br/>Note that on the Sandbox environment, it is always possible to execute payments (regardless of what this field says), as long as you are using a test bank (see Bank.isTestBank)
     *
     * @return self
     */
    public function setIsStandalonePaymentsEnabled($is_standalone_payments_enabled)
    {
        $this->container['is_standalone_payments_enabled'] = $is_standalone_payments_enabled;

        return $this;
    }

    /**
     * Gets available_bank_groups
     *
     * @return string[]
     */
    public function getAvailableBankGroups()
    {
        return $this->container['available_bank_groups'];
    }

    /**
     * Sets available_bank_groups
     *
     * @param string[] $available_bank_groups available_bank_groups
     *
     * @return self
     */
    public function setAvailableBankGroups($available_bank_groups)
    {
        $this->container['available_bank_groups'] = $available_bank_groups;

        return $this;
    }

    /**
     * Gets products
     *
     * @return Product[]
     */
    public function getProducts()
    {
        return $this->container['products'];
    }

    /**
     * Sets products
     *
     * @param Product[] $products products
     *
     * @return self
     */
    public function setProducts($products)
    {


        $this->container['products'] = $products;

        return $this;
    }

    /**
     * Gets application_name
     *
     * @return string
     */
    public function getApplicationName()
    {
        return $this->container['application_name'];
    }

    /**
     * Sets application_name
     *
     * @param string $application_name Application name. When an application name is set (e.g. \"My App\"), then <a href='https://finapi.zendesk.com/hc/en-us/articles/360002596391' target='_blank'>finAPI's web form</a> will display a text to the user \"Weiterleitung auf finAPI von ...\" (e.g. \"Weiterleitung auf finAPI von MyApp\").
     *
     * @return self
     */
    public function setApplicationName($application_name)
    {
        $this->container['application_name'] = $application_name;

        return $this;
    }

    /**
     * Gets fin_ts_product_registration_number
     *
     * @return string
     */
    public function getFinTsProductRegistrationNumber()
    {
        return $this->container['fin_ts_product_registration_number'];
    }

    /**
     * Sets fin_ts_product_registration_number
     *
     * @param string $fin_ts_product_registration_number The FinTS product registration number. If a value is stored, this will always be 'XXXXX'.
     *
     * @return self
     */
    public function setFinTsProductRegistrationNumber($fin_ts_product_registration_number)
    {
        $this->container['fin_ts_product_registration_number'] = $fin_ts_product_registration_number;

        return $this;
    }

    /**
     * Gets store_secrets_available_in_web_form
     *
     * @return bool
     */
    public function getStoreSecretsAvailableInWebForm()
    {
        return $this->container['store_secrets_available_in_web_form'];
    }

    /**
     * Sets store_secrets_available_in_web_form
     *
     * @param bool $store_secrets_available_in_web_form Whether <a href='https://finapi.zendesk.com/hc/en-us/articles/360002596391' target='_blank'>finAPI's web form</a> will allow the user to choose whether to store login secrets (like a PIN) in finAPI. If this field is set to false, the option will not be available and the secrets not stored.
     *
     * @return self
     */
    public function setStoreSecretsAvailableInWebForm($store_secrets_available_in_web_form)
    {
        $this->container['store_secrets_available_in_web_form'] = $store_secrets_available_in_web_form;

        return $this;
    }

    /**
     * Gets support_subject_default
     *
     * @return string
     */
    public function getSupportSubjectDefault()
    {
        return $this->container['support_subject_default'];
    }

    /**
     * Sets support_subject_default
     *
     * @param string $support_subject_default Default value for the subject element of support emails.
     *
     * @return self
     */
    public function setSupportSubjectDefault($support_subject_default)
    {
        $this->container['support_subject_default'] = $support_subject_default;

        return $this;
    }

    /**
     * Gets support_email
     *
     * @return string
     */
    public function getSupportEmail()
    {
        return $this->container['support_email'];
    }

    /**
     * Sets support_email
     *
     * @param string $support_email Email address to sent support requests to from the web form.
     *
     * @return self
     */
    public function setSupportEmail($support_email)
    {
        $this->container['support_email'] = $support_email;

        return $this;
    }

    /**
     * Gets ais_web_form_mode
     *
     * @return WebFormMode
     */
    public function getAisWebFormMode()
    {
        return $this->container['ais_web_form_mode'];
    }

    /**
     * Sets ais_web_form_mode
     *
     * @param WebFormMode $ais_web_form_mode <strong>Type:</strong> WebFormMode<br/> Indicates whether the client is using the finAPI webform for Account Initiation Services.<br/><br/>Possible values: <br/>&bull; <code>DISABLED</code> - No web form is triggered<br/>&bull; <code>INTERNAL</code> - End users will be directed to the <a href='https://finapi.zendesk.com/hc/en-us/articles/360002596391-finAPI-PSD2-Web-Form' target='_blank'>classical web form</a> implementation.<br/>&bull; <code>EXTERNAL</code> - End users will be directed to the <a href='https://finapi.jira.com/wiki/spaces/FWFPD/overview'  target='_blank'>new web form</a> implementation.
     *
     * @return self
     */
    public function setAisWebFormMode($ais_web_form_mode)
    {
        $this->container['ais_web_form_mode'] = $ais_web_form_mode;

        return $this;
    }

    /**
     * Gets pis_web_form_mode
     *
     * @return WebFormMode
     */
    public function getPisWebFormMode()
    {
        return $this->container['pis_web_form_mode'];
    }

    /**
     * Sets pis_web_form_mode
     *
     * @param WebFormMode $pis_web_form_mode <strong>Type:</strong> WebFormMode<br/> Indicates whether the client is using the finAPI webform for Standard Payment Initiation Services (Payments for accounts that have been imported in finAPI).<br/><br/>Possible values: <br/>&bull; <code>DISABLED</code> - No web form is triggered<br/>&bull; <code>INTERNAL</code> - End users will be directed to the <a href='https://finapi.zendesk.com/hc/en-us/articles/360002596391-finAPI-PSD2-Web-Form' target='_blank'>classical web form</a> implementation.<br/>&bull; <code>EXTERNAL</code> - End users will be directed to the <a href='https://finapi.jira.com/wiki/spaces/FWFPD/overview'  target='_blank'>new web form</a> implementation.
     *
     * @return self
     */
    public function setPisWebFormMode($pis_web_form_mode)
    {
        $this->container['pis_web_form_mode'] = $pis_web_form_mode;

        return $this;
    }

    /**
     * Gets pis_standalone_web_form_mode
     *
     * @return WebFormMode
     */
    public function getPisStandaloneWebFormMode()
    {
        return $this->container['pis_standalone_web_form_mode'];
    }

    /**
     * Sets pis_standalone_web_form_mode
     *
     * @param WebFormMode $pis_standalone_web_form_mode <strong>Type:</strong> WebFormMode<br/> Indicates whether the client is using the finAPI webform for Standalone Payment Initiation Services (Payments without account import).<br/><br/>Possible values: <br/>&bull; <code>DISABLED</code> - No web form is triggered<br/>&bull; <code>INTERNAL</code> - End users will be directed to the <a href='https://finapi.zendesk.com/hc/en-us/articles/360002596391-finAPI-PSD2-Web-Form' target='_blank'>classical web form</a> implementation.<br/>&bull; <code>EXTERNAL</code> - End users will be directed to the <a href='https://finapi.jira.com/wiki/spaces/FWFPD/overview'  target='_blank'>new web form</a> implementation.
     *
     * @return self
     */
    public function setPisStandaloneWebFormMode($pis_standalone_web_form_mode)
    {
        $this->container['pis_standalone_web_form_mode'] = $pis_standalone_web_form_mode;

        return $this;
    }

    /**
     * Gets beta_banks_enabled
     *
     * @return bool
     */
    public function getBetaBanksEnabled()
    {
        return $this->container['beta_banks_enabled'];
    }

    /**
     * Sets beta_banks_enabled
     *
     * @param bool $beta_banks_enabled Whether the set of banks that are available to your client contains “Beta banks”. Beta banks provide pre-release interfaces that are still in a beta phase. Communication to the bank via such interfaces might be unstable, and the correctness and/or quality of data delivery or payment execution cannot be guaranteed.<br/>As the word “BETA” already indicates, Beta banks are subject to changes. Their properties, as well as their behaviour can change based on continuous tests and customer feedback. Also, to keep our bank list clean, we might remove Beta banks at any point in time, including all related user data (bank connections, accounts, transactions etc). We still recommend you to enable beta banks in your application, because it enables us to release a stable interface faster. However, you should point it out to your users when using a beta bank (also see field Bank.isBeta).<br/><br/>If this field is true, then the GET /banks services will include beta banks in their results, and you can use beta banks in any service where you can pass a bank identifier. If the field is false, then beta banks will not exist for your client.
     *
     * @return self
     */
    public function setBetaBanksEnabled($beta_banks_enabled)
    {
        $this->container['beta_banks_enabled'] = $beta_banks_enabled;

        return $this;
    }

    /**
     * Gets category_restrictions
     *
     * @return \OpenAPIAccess\Client\Model\Category[]
     */
    public function getCategoryRestrictions()
    {
        return $this->container['category_restrictions'];
    }

    /**
     * Sets category_restrictions
     *
     * @param \OpenAPIAccess\Client\Model\Category[] $category_restrictions <strong>Type:</strong> Category<br/> Defines the set of transaction categories to which your client is restricted. When retrieving transactions (via the GET /transactions services), you may request only those transactions whose 'category' is one of the listed categories. If this field is null, then there are no restrictions for your client, and you may retrieve the full set of imported transactions.
     *
     * @return self
     */
    public function setCategoryRestrictions($category_restrictions)
    {
        $this->container['category_restrictions'] = $category_restrictions;

        return $this;
    }

    /**
     * Gets auto_dismount_web_form
     *
     * @return bool
     */
    public function getAutoDismountWebForm()
    {
        return $this->container['auto_dismount_web_form'];
    }

    /**
     * Sets auto_dismount_web_form
     *
     * @param bool $auto_dismount_web_form This flag indicates whether the webform should get removed from the parent page automatically once it’s finished. It applies ONLY to the classical embedded web form. That means it’s only applied if aisWebFormMode, pisWebFormMode or pisStandaloneWebFormMode are defined as INTERNAL. In case you are using our standalone web form by redirecting the user to our web form link, this feature has no effect.
     *
     * @return self
     */
    public function setAutoDismountWebForm($auto_dismount_web_form)
    {
        $this->container['auto_dismount_web_form'] = $auto_dismount_web_form;

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


