<?php
/**
 * MandatorAdministrationApi
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

namespace OpenAPIAccess\Client\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use OpenAPIAccess\Client\ApiException;
use OpenAPIAccess\Client\Configuration;
use OpenAPIAccess\Client\HeaderSelector;
use OpenAPIAccess\Client\ObjectSerializer;

/**
 * MandatorAdministrationApi Class Doc Comment
 *
 * @category Class
 * @package  OpenAPIAccess\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class MandatorAdministrationApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation changeClientCredentials
     *
     * Change client credentials
     *
     * @param  \OpenAPIAccess\Client\Model\ChangeClientCredentialsParams $change_client_credentials_params Parameters for changing client credentials (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \OpenAPIAccess\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function changeClientCredentials($change_client_credentials_params, $x_request_id = null)
    {
        $this->changeClientCredentialsWithHttpInfo($change_client_credentials_params, $x_request_id);
    }

    /**
     * Operation changeClientCredentialsWithHttpInfo
     *
     * Change client credentials
     *
     * @param  \OpenAPIAccess\Client\Model\ChangeClientCredentialsParams $change_client_credentials_params Parameters for changing client credentials (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \OpenAPIAccess\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function changeClientCredentialsWithHttpInfo($change_client_credentials_params, $x_request_id = null)
    {
        $request = $this->changeClientCredentialsRequest($change_client_credentials_params, $x_request_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return [null, $statusCode, $response->getHeaders()];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\BadCredentialsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 422:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation changeClientCredentialsAsync
     *
     * Change client credentials
     *
     * @param  \OpenAPIAccess\Client\Model\ChangeClientCredentialsParams $change_client_credentials_params Parameters for changing client credentials (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function changeClientCredentialsAsync($change_client_credentials_params, $x_request_id = null)
    {
        return $this->changeClientCredentialsAsyncWithHttpInfo($change_client_credentials_params, $x_request_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation changeClientCredentialsAsyncWithHttpInfo
     *
     * Change client credentials
     *
     * @param  \OpenAPIAccess\Client\Model\ChangeClientCredentialsParams $change_client_credentials_params Parameters for changing client credentials (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function changeClientCredentialsAsyncWithHttpInfo($change_client_credentials_params, $x_request_id = null)
    {
        $returnType = '';
        $request = $this->changeClientCredentialsRequest($change_client_credentials_params, $x_request_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'changeClientCredentials'
     *
     * @param  \OpenAPIAccess\Client\Model\ChangeClientCredentialsParams $change_client_credentials_params Parameters for changing client credentials (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function changeClientCredentialsRequest($change_client_credentials_params, $x_request_id = null)
    {
        // verify the required parameter 'change_client_credentials_params' is set
        if ($change_client_credentials_params === null || (is_array($change_client_credentials_params) && count($change_client_credentials_params) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $change_client_credentials_params when calling changeClientCredentials'
            );
        }

        $resourcePath = '/api/v1/mandatorAdmin/changeClientCredentials';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($x_request_id !== null) {
            $headerParams['X-Request-Id'] = ObjectSerializer::toHeaderValue($x_request_id);
        }



        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($change_client_credentials_params)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($change_client_credentials_params));
            } else {
                $httpBody = $change_client_credentials_params;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation createIbanRules
     *
     * Create IBAN rules
     *
     * @param  \OpenAPIAccess\Client\Model\IbanRulesParams $iban_rules_params IBAN rule definitions (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \OpenAPIAccess\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPIAccess\Client\Model\IbanRuleList|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\BadCredentialsError|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage
     */
    public function createIbanRules($iban_rules_params, $x_request_id = null)
    {
        list($response) = $this->createIbanRulesWithHttpInfo($iban_rules_params, $x_request_id);
        return $response;
    }

    /**
     * Operation createIbanRulesWithHttpInfo
     *
     * Create IBAN rules
     *
     * @param  \OpenAPIAccess\Client\Model\IbanRulesParams $iban_rules_params IBAN rule definitions (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \OpenAPIAccess\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPIAccess\Client\Model\IbanRuleList|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\BadCredentialsError|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage, HTTP status code, HTTP response headers (array of strings)
     */
    public function createIbanRulesWithHttpInfo($iban_rules_params, $x_request_id = null)
    {
        $request = $this->createIbanRulesRequest($iban_rules_params, $x_request_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 201:
                    if ('\OpenAPIAccess\Client\Model\IbanRuleList' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\IbanRuleList', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\OpenAPIAccess\Client\Model\BadCredentialsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\BadCredentialsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 403:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 404:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 422:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 500:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPIAccess\Client\Model\IbanRuleList';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\IbanRuleList',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\BadCredentialsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 422:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createIbanRulesAsync
     *
     * Create IBAN rules
     *
     * @param  \OpenAPIAccess\Client\Model\IbanRulesParams $iban_rules_params IBAN rule definitions (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createIbanRulesAsync($iban_rules_params, $x_request_id = null)
    {
        return $this->createIbanRulesAsyncWithHttpInfo($iban_rules_params, $x_request_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createIbanRulesAsyncWithHttpInfo
     *
     * Create IBAN rules
     *
     * @param  \OpenAPIAccess\Client\Model\IbanRulesParams $iban_rules_params IBAN rule definitions (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createIbanRulesAsyncWithHttpInfo($iban_rules_params, $x_request_id = null)
    {
        $returnType = '\OpenAPIAccess\Client\Model\IbanRuleList';
        $request = $this->createIbanRulesRequest($iban_rules_params, $x_request_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'createIbanRules'
     *
     * @param  \OpenAPIAccess\Client\Model\IbanRulesParams $iban_rules_params IBAN rule definitions (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createIbanRulesRequest($iban_rules_params, $x_request_id = null)
    {
        // verify the required parameter 'iban_rules_params' is set
        if ($iban_rules_params === null || (is_array($iban_rules_params) && count($iban_rules_params) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $iban_rules_params when calling createIbanRules'
            );
        }

        $resourcePath = '/api/v1/mandatorAdmin/ibanRules';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($x_request_id !== null) {
            $headerParams['X-Request-Id'] = ObjectSerializer::toHeaderValue($x_request_id);
        }



        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($iban_rules_params)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($iban_rules_params));
            } else {
                $httpBody = $iban_rules_params;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation createKeywordRules
     *
     * Create keyword rules
     *
     * @param  \OpenAPIAccess\Client\Model\KeywordRulesParams $keyword_rules_params Keyword rule definitions (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \OpenAPIAccess\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPIAccess\Client\Model\KeywordRuleList|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\BadCredentialsError|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage
     */
    public function createKeywordRules($keyword_rules_params, $x_request_id = null)
    {
        list($response) = $this->createKeywordRulesWithHttpInfo($keyword_rules_params, $x_request_id);
        return $response;
    }

    /**
     * Operation createKeywordRulesWithHttpInfo
     *
     * Create keyword rules
     *
     * @param  \OpenAPIAccess\Client\Model\KeywordRulesParams $keyword_rules_params Keyword rule definitions (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \OpenAPIAccess\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPIAccess\Client\Model\KeywordRuleList|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\BadCredentialsError|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage, HTTP status code, HTTP response headers (array of strings)
     */
    public function createKeywordRulesWithHttpInfo($keyword_rules_params, $x_request_id = null)
    {
        $request = $this->createKeywordRulesRequest($keyword_rules_params, $x_request_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 201:
                    if ('\OpenAPIAccess\Client\Model\KeywordRuleList' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\KeywordRuleList', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\OpenAPIAccess\Client\Model\BadCredentialsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\BadCredentialsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 403:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 404:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 422:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 500:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPIAccess\Client\Model\KeywordRuleList';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\KeywordRuleList',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\BadCredentialsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 422:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation createKeywordRulesAsync
     *
     * Create keyword rules
     *
     * @param  \OpenAPIAccess\Client\Model\KeywordRulesParams $keyword_rules_params Keyword rule definitions (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createKeywordRulesAsync($keyword_rules_params, $x_request_id = null)
    {
        return $this->createKeywordRulesAsyncWithHttpInfo($keyword_rules_params, $x_request_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createKeywordRulesAsyncWithHttpInfo
     *
     * Create keyword rules
     *
     * @param  \OpenAPIAccess\Client\Model\KeywordRulesParams $keyword_rules_params Keyword rule definitions (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createKeywordRulesAsyncWithHttpInfo($keyword_rules_params, $x_request_id = null)
    {
        $returnType = '\OpenAPIAccess\Client\Model\KeywordRuleList';
        $request = $this->createKeywordRulesRequest($keyword_rules_params, $x_request_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'createKeywordRules'
     *
     * @param  \OpenAPIAccess\Client\Model\KeywordRulesParams $keyword_rules_params Keyword rule definitions (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createKeywordRulesRequest($keyword_rules_params, $x_request_id = null)
    {
        // verify the required parameter 'keyword_rules_params' is set
        if ($keyword_rules_params === null || (is_array($keyword_rules_params) && count($keyword_rules_params) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $keyword_rules_params when calling createKeywordRules'
            );
        }

        $resourcePath = '/api/v1/mandatorAdmin/keywordRules';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($x_request_id !== null) {
            $headerParams['X-Request-Id'] = ObjectSerializer::toHeaderValue($x_request_id);
        }



        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($keyword_rules_params)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($keyword_rules_params));
            } else {
                $httpBody = $keyword_rules_params;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteIbanRules
     *
     * Delete IBAN rules
     *
     * @param  \OpenAPIAccess\Client\Model\IbanRuleIdentifiersParams $iban_rule_identifiers_params List of IBAN rules identifiers.The maximum number of identifiers is 100. (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \OpenAPIAccess\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPIAccess\Client\Model\IdentifierList|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\BadCredentialsError|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage
     */
    public function deleteIbanRules($iban_rule_identifiers_params, $x_request_id = null)
    {
        list($response) = $this->deleteIbanRulesWithHttpInfo($iban_rule_identifiers_params, $x_request_id);
        return $response;
    }

    /**
     * Operation deleteIbanRulesWithHttpInfo
     *
     * Delete IBAN rules
     *
     * @param  \OpenAPIAccess\Client\Model\IbanRuleIdentifiersParams $iban_rule_identifiers_params List of IBAN rules identifiers.The maximum number of identifiers is 100. (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \OpenAPIAccess\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPIAccess\Client\Model\IdentifierList|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\BadCredentialsError|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteIbanRulesWithHttpInfo($iban_rule_identifiers_params, $x_request_id = null)
    {
        $request = $this->deleteIbanRulesRequest($iban_rule_identifiers_params, $x_request_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\OpenAPIAccess\Client\Model\IdentifierList' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\IdentifierList', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\OpenAPIAccess\Client\Model\BadCredentialsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\BadCredentialsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 403:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 404:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 500:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPIAccess\Client\Model\IdentifierList';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\IdentifierList',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\BadCredentialsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation deleteIbanRulesAsync
     *
     * Delete IBAN rules
     *
     * @param  \OpenAPIAccess\Client\Model\IbanRuleIdentifiersParams $iban_rule_identifiers_params List of IBAN rules identifiers.The maximum number of identifiers is 100. (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteIbanRulesAsync($iban_rule_identifiers_params, $x_request_id = null)
    {
        return $this->deleteIbanRulesAsyncWithHttpInfo($iban_rule_identifiers_params, $x_request_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteIbanRulesAsyncWithHttpInfo
     *
     * Delete IBAN rules
     *
     * @param  \OpenAPIAccess\Client\Model\IbanRuleIdentifiersParams $iban_rule_identifiers_params List of IBAN rules identifiers.The maximum number of identifiers is 100. (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteIbanRulesAsyncWithHttpInfo($iban_rule_identifiers_params, $x_request_id = null)
    {
        $returnType = '\OpenAPIAccess\Client\Model\IdentifierList';
        $request = $this->deleteIbanRulesRequest($iban_rule_identifiers_params, $x_request_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'deleteIbanRules'
     *
     * @param  \OpenAPIAccess\Client\Model\IbanRuleIdentifiersParams $iban_rule_identifiers_params List of IBAN rules identifiers.The maximum number of identifiers is 100. (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteIbanRulesRequest($iban_rule_identifiers_params, $x_request_id = null)
    {
        // verify the required parameter 'iban_rule_identifiers_params' is set
        if ($iban_rule_identifiers_params === null || (is_array($iban_rule_identifiers_params) && count($iban_rule_identifiers_params) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $iban_rule_identifiers_params when calling deleteIbanRules'
            );
        }

        $resourcePath = '/api/v1/mandatorAdmin/ibanRules/delete';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($x_request_id !== null) {
            $headerParams['X-Request-Id'] = ObjectSerializer::toHeaderValue($x_request_id);
        }



        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($iban_rule_identifiers_params)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($iban_rule_identifiers_params));
            } else {
                $httpBody = $iban_rule_identifiers_params;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteKeywordRules
     *
     * Delete keyword rules
     *
     * @param  \OpenAPIAccess\Client\Model\KeywordRuleIdentifiersParams $keyword_rule_identifiers_params List of keyword rule identifiers.The maximum number of identifiers is 100. (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \OpenAPIAccess\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPIAccess\Client\Model\IdentifierList|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\BadCredentialsError|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage
     */
    public function deleteKeywordRules($keyword_rule_identifiers_params, $x_request_id = null)
    {
        list($response) = $this->deleteKeywordRulesWithHttpInfo($keyword_rule_identifiers_params, $x_request_id);
        return $response;
    }

    /**
     * Operation deleteKeywordRulesWithHttpInfo
     *
     * Delete keyword rules
     *
     * @param  \OpenAPIAccess\Client\Model\KeywordRuleIdentifiersParams $keyword_rule_identifiers_params List of keyword rule identifiers.The maximum number of identifiers is 100. (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \OpenAPIAccess\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPIAccess\Client\Model\IdentifierList|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\BadCredentialsError|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteKeywordRulesWithHttpInfo($keyword_rule_identifiers_params, $x_request_id = null)
    {
        $request = $this->deleteKeywordRulesRequest($keyword_rule_identifiers_params, $x_request_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\OpenAPIAccess\Client\Model\IdentifierList' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\IdentifierList', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\OpenAPIAccess\Client\Model\BadCredentialsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\BadCredentialsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 403:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 404:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 500:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPIAccess\Client\Model\IdentifierList';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\IdentifierList',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\BadCredentialsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation deleteKeywordRulesAsync
     *
     * Delete keyword rules
     *
     * @param  \OpenAPIAccess\Client\Model\KeywordRuleIdentifiersParams $keyword_rule_identifiers_params List of keyword rule identifiers.The maximum number of identifiers is 100. (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteKeywordRulesAsync($keyword_rule_identifiers_params, $x_request_id = null)
    {
        return $this->deleteKeywordRulesAsyncWithHttpInfo($keyword_rule_identifiers_params, $x_request_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteKeywordRulesAsyncWithHttpInfo
     *
     * Delete keyword rules
     *
     * @param  \OpenAPIAccess\Client\Model\KeywordRuleIdentifiersParams $keyword_rule_identifiers_params List of keyword rule identifiers.The maximum number of identifiers is 100. (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteKeywordRulesAsyncWithHttpInfo($keyword_rule_identifiers_params, $x_request_id = null)
    {
        $returnType = '\OpenAPIAccess\Client\Model\IdentifierList';
        $request = $this->deleteKeywordRulesRequest($keyword_rule_identifiers_params, $x_request_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'deleteKeywordRules'
     *
     * @param  \OpenAPIAccess\Client\Model\KeywordRuleIdentifiersParams $keyword_rule_identifiers_params List of keyword rule identifiers.The maximum number of identifiers is 100. (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteKeywordRulesRequest($keyword_rule_identifiers_params, $x_request_id = null)
    {
        // verify the required parameter 'keyword_rule_identifiers_params' is set
        if ($keyword_rule_identifiers_params === null || (is_array($keyword_rule_identifiers_params) && count($keyword_rule_identifiers_params) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $keyword_rule_identifiers_params when calling deleteKeywordRules'
            );
        }

        $resourcePath = '/api/v1/mandatorAdmin/keywordRules/delete';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($x_request_id !== null) {
            $headerParams['X-Request-Id'] = ObjectSerializer::toHeaderValue($x_request_id);
        }



        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($keyword_rule_identifiers_params)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($keyword_rule_identifiers_params));
            } else {
                $httpBody = $keyword_rule_identifiers_params;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteUsers
     *
     * Delete users
     *
     * @param  \OpenAPIAccess\Client\Model\UserIdentifiersParams $user_identifiers_params List of user identifiers (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \OpenAPIAccess\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPIAccess\Client\Model\UserIdentifiersList|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\BadCredentialsError|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage
     */
    public function deleteUsers($user_identifiers_params, $x_request_id = null)
    {
        list($response) = $this->deleteUsersWithHttpInfo($user_identifiers_params, $x_request_id);
        return $response;
    }

    /**
     * Operation deleteUsersWithHttpInfo
     *
     * Delete users
     *
     * @param  \OpenAPIAccess\Client\Model\UserIdentifiersParams $user_identifiers_params List of user identifiers (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \OpenAPIAccess\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPIAccess\Client\Model\UserIdentifiersList|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\BadCredentialsError|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteUsersWithHttpInfo($user_identifiers_params, $x_request_id = null)
    {
        $request = $this->deleteUsersRequest($user_identifiers_params, $x_request_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\OpenAPIAccess\Client\Model\UserIdentifiersList' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\UserIdentifiersList', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\OpenAPIAccess\Client\Model\BadCredentialsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\BadCredentialsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 403:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 500:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPIAccess\Client\Model\UserIdentifiersList';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\UserIdentifiersList',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\BadCredentialsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation deleteUsersAsync
     *
     * Delete users
     *
     * @param  \OpenAPIAccess\Client\Model\UserIdentifiersParams $user_identifiers_params List of user identifiers (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteUsersAsync($user_identifiers_params, $x_request_id = null)
    {
        return $this->deleteUsersAsyncWithHttpInfo($user_identifiers_params, $x_request_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteUsersAsyncWithHttpInfo
     *
     * Delete users
     *
     * @param  \OpenAPIAccess\Client\Model\UserIdentifiersParams $user_identifiers_params List of user identifiers (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteUsersAsyncWithHttpInfo($user_identifiers_params, $x_request_id = null)
    {
        $returnType = '\OpenAPIAccess\Client\Model\UserIdentifiersList';
        $request = $this->deleteUsersRequest($user_identifiers_params, $x_request_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'deleteUsers'
     *
     * @param  \OpenAPIAccess\Client\Model\UserIdentifiersParams $user_identifiers_params List of user identifiers (required)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteUsersRequest($user_identifiers_params, $x_request_id = null)
    {
        // verify the required parameter 'user_identifiers_params' is set
        if ($user_identifiers_params === null || (is_array($user_identifiers_params) && count($user_identifiers_params) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_identifiers_params when calling deleteUsers'
            );
        }

        $resourcePath = '/api/v1/mandatorAdmin/deleteUsers';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // header params
        if ($x_request_id !== null) {
            $headerParams['X-Request-Id'] = ObjectSerializer::toHeaderValue($x_request_id);
        }



        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($user_identifiers_params)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($user_identifiers_params));
            } else {
                $httpBody = $user_identifiers_params;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getIbanRuleList
     *
     * Get IBAN rules
     *
     * @param  int $page Result page that you want to retrieve (optional, default to 1)
     * @param  int $per_page Maximum number of records per page. By default it&#39;s 20. Can be at most 500. (optional, default to 20)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \OpenAPIAccess\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPIAccess\Client\Model\PageableIbanRuleList|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\BadCredentialsError|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage
     */
    public function getIbanRuleList($page = 1, $per_page = 20, $x_request_id = null)
    {
        list($response) = $this->getIbanRuleListWithHttpInfo($page, $per_page, $x_request_id);
        return $response;
    }

    /**
     * Operation getIbanRuleListWithHttpInfo
     *
     * Get IBAN rules
     *
     * @param  int $page Result page that you want to retrieve (optional, default to 1)
     * @param  int $per_page Maximum number of records per page. By default it&#39;s 20. Can be at most 500. (optional, default to 20)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \OpenAPIAccess\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPIAccess\Client\Model\PageableIbanRuleList|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\BadCredentialsError|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage, HTTP status code, HTTP response headers (array of strings)
     */
    public function getIbanRuleListWithHttpInfo($page = 1, $per_page = 20, $x_request_id = null)
    {
        $request = $this->getIbanRuleListRequest($page, $per_page, $x_request_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\OpenAPIAccess\Client\Model\PageableIbanRuleList' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\PageableIbanRuleList', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\OpenAPIAccess\Client\Model\BadCredentialsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\BadCredentialsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 403:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 500:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPIAccess\Client\Model\PageableIbanRuleList';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\PageableIbanRuleList',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\BadCredentialsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getIbanRuleListAsync
     *
     * Get IBAN rules
     *
     * @param  int $page Result page that you want to retrieve (optional, default to 1)
     * @param  int $per_page Maximum number of records per page. By default it&#39;s 20. Can be at most 500. (optional, default to 20)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getIbanRuleListAsync($page = 1, $per_page = 20, $x_request_id = null)
    {
        return $this->getIbanRuleListAsyncWithHttpInfo($page, $per_page, $x_request_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getIbanRuleListAsyncWithHttpInfo
     *
     * Get IBAN rules
     *
     * @param  int $page Result page that you want to retrieve (optional, default to 1)
     * @param  int $per_page Maximum number of records per page. By default it&#39;s 20. Can be at most 500. (optional, default to 20)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getIbanRuleListAsyncWithHttpInfo($page = 1, $per_page = 20, $x_request_id = null)
    {
        $returnType = '\OpenAPIAccess\Client\Model\PageableIbanRuleList';
        $request = $this->getIbanRuleListRequest($page, $per_page, $x_request_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getIbanRuleList'
     *
     * @param  int $page Result page that you want to retrieve (optional, default to 1)
     * @param  int $per_page Maximum number of records per page. By default it&#39;s 20. Can be at most 500. (optional, default to 20)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getIbanRuleListRequest($page = 1, $per_page = 20, $x_request_id = null)
    {
        if ($page !== null && $page < 1) {
            throw new \InvalidArgumentException('invalid value for "$page" when calling MandatorAdministrationApi.getIbanRuleList, must be bigger than or equal to 1.');
        }

        if ($per_page !== null && $per_page > 500) {
            throw new \InvalidArgumentException('invalid value for "$per_page" when calling MandatorAdministrationApi.getIbanRuleList, must be smaller than or equal to 500.');
        }
        if ($per_page !== null && $per_page < 1) {
            throw new \InvalidArgumentException('invalid value for "$per_page" when calling MandatorAdministrationApi.getIbanRuleList, must be bigger than or equal to 1.');
        }


        $resourcePath = '/api/v1/mandatorAdmin/ibanRules';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($page !== null) {
            if('form' === 'form' && is_array($page)) {
                foreach($page as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['page'] = $page;
            }
        }
        // query params
        if ($per_page !== null) {
            if('form' === 'form' && is_array($per_page)) {
                foreach($per_page as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['perPage'] = $per_page;
            }
        }

        // header params
        if ($x_request_id !== null) {
            $headerParams['X-Request-Id'] = ObjectSerializer::toHeaderValue($x_request_id);
        }



        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getKeywordRuleList
     *
     * Get keyword rules
     *
     * @param  int $page Result page that you want to retrieve (optional, default to 1)
     * @param  int $per_page Maximum number of records per page. By default it&#39;s 20. Can be at most 500. (optional, default to 20)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \OpenAPIAccess\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPIAccess\Client\Model\PageableKeywordRuleList|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\BadCredentialsError|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage
     */
    public function getKeywordRuleList($page = 1, $per_page = 20, $x_request_id = null)
    {
        list($response) = $this->getKeywordRuleListWithHttpInfo($page, $per_page, $x_request_id);
        return $response;
    }

    /**
     * Operation getKeywordRuleListWithHttpInfo
     *
     * Get keyword rules
     *
     * @param  int $page Result page that you want to retrieve (optional, default to 1)
     * @param  int $per_page Maximum number of records per page. By default it&#39;s 20. Can be at most 500. (optional, default to 20)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \OpenAPIAccess\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPIAccess\Client\Model\PageableKeywordRuleList|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\BadCredentialsError|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage, HTTP status code, HTTP response headers (array of strings)
     */
    public function getKeywordRuleListWithHttpInfo($page = 1, $per_page = 20, $x_request_id = null)
    {
        $request = $this->getKeywordRuleListRequest($page, $per_page, $x_request_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\OpenAPIAccess\Client\Model\PageableKeywordRuleList' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\PageableKeywordRuleList', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\OpenAPIAccess\Client\Model\BadCredentialsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\BadCredentialsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 403:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 500:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPIAccess\Client\Model\PageableKeywordRuleList';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\PageableKeywordRuleList',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\BadCredentialsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getKeywordRuleListAsync
     *
     * Get keyword rules
     *
     * @param  int $page Result page that you want to retrieve (optional, default to 1)
     * @param  int $per_page Maximum number of records per page. By default it&#39;s 20. Can be at most 500. (optional, default to 20)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getKeywordRuleListAsync($page = 1, $per_page = 20, $x_request_id = null)
    {
        return $this->getKeywordRuleListAsyncWithHttpInfo($page, $per_page, $x_request_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getKeywordRuleListAsyncWithHttpInfo
     *
     * Get keyword rules
     *
     * @param  int $page Result page that you want to retrieve (optional, default to 1)
     * @param  int $per_page Maximum number of records per page. By default it&#39;s 20. Can be at most 500. (optional, default to 20)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getKeywordRuleListAsyncWithHttpInfo($page = 1, $per_page = 20, $x_request_id = null)
    {
        $returnType = '\OpenAPIAccess\Client\Model\PageableKeywordRuleList';
        $request = $this->getKeywordRuleListRequest($page, $per_page, $x_request_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getKeywordRuleList'
     *
     * @param  int $page Result page that you want to retrieve (optional, default to 1)
     * @param  int $per_page Maximum number of records per page. By default it&#39;s 20. Can be at most 500. (optional, default to 20)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getKeywordRuleListRequest($page = 1, $per_page = 20, $x_request_id = null)
    {
        if ($page !== null && $page < 1) {
            throw new \InvalidArgumentException('invalid value for "$page" when calling MandatorAdministrationApi.getKeywordRuleList, must be bigger than or equal to 1.');
        }

        if ($per_page !== null && $per_page > 500) {
            throw new \InvalidArgumentException('invalid value for "$per_page" when calling MandatorAdministrationApi.getKeywordRuleList, must be smaller than or equal to 500.');
        }
        if ($per_page !== null && $per_page < 1) {
            throw new \InvalidArgumentException('invalid value for "$per_page" when calling MandatorAdministrationApi.getKeywordRuleList, must be bigger than or equal to 1.');
        }


        $resourcePath = '/api/v1/mandatorAdmin/keywordRules';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($page !== null) {
            if('form' === 'form' && is_array($page)) {
                foreach($page as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['page'] = $page;
            }
        }
        // query params
        if ($per_page !== null) {
            if('form' === 'form' && is_array($per_page)) {
                foreach($per_page as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['perPage'] = $per_page;
            }
        }

        // header params
        if ($x_request_id !== null) {
            $headerParams['X-Request-Id'] = ObjectSerializer::toHeaderValue($x_request_id);
        }



        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getUserList
     *
     * Get user list
     *
     * @param  string $min_registration_date Lower bound for a user&#39;s registration date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;registrationDate&#39; is equal to or later than the given date will be regarded. (optional)
     * @param  string $max_registration_date Upper bound for a user&#39;s registration date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;registrationDate&#39; is equal to or earlier than the given date will be regarded. (optional)
     * @param  string $min_deletion_date Lower bound for a user&#39;s deletion date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;deletionDate&#39; is not null, and is equal to or later than the given date will be regarded. (optional)
     * @param  string $max_deletion_date Upper bound for a user&#39;s deletion date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;deletionDate&#39; is null, or is equal to or earlier than the given date will be regarded. (optional)
     * @param  string $min_last_active_date Lower bound for a user&#39;s last active date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;lastActiveDate&#39; is not null, and is equal to or later than the given date will be regarded. (optional)
     * @param  string $max_last_active_date Upper bound for a user&#39;s last active date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;lastActiveDate&#39; is null, or is equal to or earlier than the given date will be regarded. (optional)
     * @param  bool $include_monthly_stats Whether to include the &#39;monthlyStats&#39; for the returned users. If not specified, then the field defaults to &#39;false&#39;. (optional, default to false)
     * @param  string $monthly_stats_start_date Minimum bound for the monthly stats (&#x3D;oldest month that should be included). Must be passed in the format &#39;YYYY-MM&#39;. If not specified, then the monthly stats will go back up to the first month in which the user existed (date of the user&#39;s registration). Note that this field is only regarded if &#39;includeMonthlyStats&#39; &#x3D; true. (optional)
     * @param  string $monthly_stats_end_date Maximum bound for the monthly stats (&#x3D;latest month that should be included). Must be passed in the format &#39;YYYY-MM&#39;. If not specified, then the monthly stats will go up to either the current month (for active users), or up to the month of deletion (for deleted users). Note that this field is only regarded if  &#39;includeMonthlyStats&#39; &#x3D; true. (optional)
     * @param  int $min_bank_connection_count_in_monthly_stats A value of X means that the service will return only those users which had at least X bank connections imported at any time within the returned monthly stats set. This field is only regarded when &#39;includeMonthlyStats&#39; is set to &#39;true&#39;. The default value for this field is 0. (optional, default to 0)
     * @param  string $user_id The identifier of a user to search for. If specified, then only the user with the given id will be regarded. If no user can be found for the passed userId (because the user was deleted or his username was misspelled), then the result list will be empty. (optional)
     * @param  bool $is_deleted If NOT specified, then the service will regard both active and deleted users in the search. If set to &#39;true&#39;, then ONLY deleted users will be regarded. If set to &#39;false&#39;, then ONLY active users will be regarded. (optional)
     * @param  bool $is_locked If NOT specified, then the service will regard both locked and not locked users in the search. If set to &#39;true&#39;, then ONLY locked users will be regarded. If set to &#39;false&#39;, then ONLY not locked users will be regarded. (optional)
     * @param  int $page Result page that you want to retrieve (optional, default to 1)
     * @param  int $per_page Maximum number of records per page. By default it&#39;s 20. Can be at most 500. (optional, default to 20)
     * @param  string[] $order Determines the order of the results. You can order the results by &#39;userId&#39;. The default order for this service is &#39;userId,asc&#39;. The general format is: &#39;property[,asc|desc]&#39;, with &#39;asc&#39; being the default value. (optional)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \OpenAPIAccess\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \OpenAPIAccess\Client\Model\PageableUserInfoList|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\BadCredentialsError|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage
     */
    public function getUserList($min_registration_date = null, $max_registration_date = null, $min_deletion_date = null, $max_deletion_date = null, $min_last_active_date = null, $max_last_active_date = null, $include_monthly_stats = false, $monthly_stats_start_date = null, $monthly_stats_end_date = null, $min_bank_connection_count_in_monthly_stats = 0, $user_id = null, $is_deleted = null, $is_locked = null, $page = 1, $per_page = 20, $order = null, $x_request_id = null)
    {
        list($response) = $this->getUserListWithHttpInfo($min_registration_date, $max_registration_date, $min_deletion_date, $max_deletion_date, $min_last_active_date, $max_last_active_date, $include_monthly_stats, $monthly_stats_start_date, $monthly_stats_end_date, $min_bank_connection_count_in_monthly_stats, $user_id, $is_deleted, $is_locked, $page, $per_page, $order, $x_request_id);
        return $response;
    }

    /**
     * Operation getUserListWithHttpInfo
     *
     * Get user list
     *
     * @param  string $min_registration_date Lower bound for a user&#39;s registration date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;registrationDate&#39; is equal to or later than the given date will be regarded. (optional)
     * @param  string $max_registration_date Upper bound for a user&#39;s registration date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;registrationDate&#39; is equal to or earlier than the given date will be regarded. (optional)
     * @param  string $min_deletion_date Lower bound for a user&#39;s deletion date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;deletionDate&#39; is not null, and is equal to or later than the given date will be regarded. (optional)
     * @param  string $max_deletion_date Upper bound for a user&#39;s deletion date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;deletionDate&#39; is null, or is equal to or earlier than the given date will be regarded. (optional)
     * @param  string $min_last_active_date Lower bound for a user&#39;s last active date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;lastActiveDate&#39; is not null, and is equal to or later than the given date will be regarded. (optional)
     * @param  string $max_last_active_date Upper bound for a user&#39;s last active date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;lastActiveDate&#39; is null, or is equal to or earlier than the given date will be regarded. (optional)
     * @param  bool $include_monthly_stats Whether to include the &#39;monthlyStats&#39; for the returned users. If not specified, then the field defaults to &#39;false&#39;. (optional, default to false)
     * @param  string $monthly_stats_start_date Minimum bound for the monthly stats (&#x3D;oldest month that should be included). Must be passed in the format &#39;YYYY-MM&#39;. If not specified, then the monthly stats will go back up to the first month in which the user existed (date of the user&#39;s registration). Note that this field is only regarded if &#39;includeMonthlyStats&#39; &#x3D; true. (optional)
     * @param  string $monthly_stats_end_date Maximum bound for the monthly stats (&#x3D;latest month that should be included). Must be passed in the format &#39;YYYY-MM&#39;. If not specified, then the monthly stats will go up to either the current month (for active users), or up to the month of deletion (for deleted users). Note that this field is only regarded if  &#39;includeMonthlyStats&#39; &#x3D; true. (optional)
     * @param  int $min_bank_connection_count_in_monthly_stats A value of X means that the service will return only those users which had at least X bank connections imported at any time within the returned monthly stats set. This field is only regarded when &#39;includeMonthlyStats&#39; is set to &#39;true&#39;. The default value for this field is 0. (optional, default to 0)
     * @param  string $user_id The identifier of a user to search for. If specified, then only the user with the given id will be regarded. If no user can be found for the passed userId (because the user was deleted or his username was misspelled), then the result list will be empty. (optional)
     * @param  bool $is_deleted If NOT specified, then the service will regard both active and deleted users in the search. If set to &#39;true&#39;, then ONLY deleted users will be regarded. If set to &#39;false&#39;, then ONLY active users will be regarded. (optional)
     * @param  bool $is_locked If NOT specified, then the service will regard both locked and not locked users in the search. If set to &#39;true&#39;, then ONLY locked users will be regarded. If set to &#39;false&#39;, then ONLY not locked users will be regarded. (optional)
     * @param  int $page Result page that you want to retrieve (optional, default to 1)
     * @param  int $per_page Maximum number of records per page. By default it&#39;s 20. Can be at most 500. (optional, default to 20)
     * @param  string[] $order Determines the order of the results. You can order the results by &#39;userId&#39;. The default order for this service is &#39;userId,asc&#39;. The general format is: &#39;property[,asc|desc]&#39;, with &#39;asc&#39; being the default value. (optional)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \OpenAPIAccess\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \OpenAPIAccess\Client\Model\PageableUserInfoList|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\BadCredentialsError|\OpenAPIAccess\Client\Model\ErrorMessage|\OpenAPIAccess\Client\Model\ErrorMessage, HTTP status code, HTTP response headers (array of strings)
     */
    public function getUserListWithHttpInfo($min_registration_date = null, $max_registration_date = null, $min_deletion_date = null, $max_deletion_date = null, $min_last_active_date = null, $max_last_active_date = null, $include_monthly_stats = false, $monthly_stats_start_date = null, $monthly_stats_end_date = null, $min_bank_connection_count_in_monthly_stats = 0, $user_id = null, $is_deleted = null, $is_locked = null, $page = 1, $per_page = 20, $order = null, $x_request_id = null)
    {
        $request = $this->getUserListRequest($min_registration_date, $max_registration_date, $min_deletion_date, $max_deletion_date, $min_last_active_date, $max_last_active_date, $include_monthly_stats, $monthly_stats_start_date, $monthly_stats_end_date, $min_bank_connection_count_in_monthly_stats, $user_id, $is_deleted, $is_locked, $page, $per_page, $order, $x_request_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\OpenAPIAccess\Client\Model\PageableUserInfoList' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\PageableUserInfoList', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\OpenAPIAccess\Client\Model\BadCredentialsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\BadCredentialsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 403:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 500:
                    if ('\OpenAPIAccess\Client\Model\ErrorMessage' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPIAccess\Client\Model\ErrorMessage', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\OpenAPIAccess\Client\Model\PageableUserInfoList';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\PageableUserInfoList',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\BadCredentialsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPIAccess\Client\Model\ErrorMessage',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getUserListAsync
     *
     * Get user list
     *
     * @param  string $min_registration_date Lower bound for a user&#39;s registration date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;registrationDate&#39; is equal to or later than the given date will be regarded. (optional)
     * @param  string $max_registration_date Upper bound for a user&#39;s registration date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;registrationDate&#39; is equal to or earlier than the given date will be regarded. (optional)
     * @param  string $min_deletion_date Lower bound for a user&#39;s deletion date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;deletionDate&#39; is not null, and is equal to or later than the given date will be regarded. (optional)
     * @param  string $max_deletion_date Upper bound for a user&#39;s deletion date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;deletionDate&#39; is null, or is equal to or earlier than the given date will be regarded. (optional)
     * @param  string $min_last_active_date Lower bound for a user&#39;s last active date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;lastActiveDate&#39; is not null, and is equal to or later than the given date will be regarded. (optional)
     * @param  string $max_last_active_date Upper bound for a user&#39;s last active date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;lastActiveDate&#39; is null, or is equal to or earlier than the given date will be regarded. (optional)
     * @param  bool $include_monthly_stats Whether to include the &#39;monthlyStats&#39; for the returned users. If not specified, then the field defaults to &#39;false&#39;. (optional, default to false)
     * @param  string $monthly_stats_start_date Minimum bound for the monthly stats (&#x3D;oldest month that should be included). Must be passed in the format &#39;YYYY-MM&#39;. If not specified, then the monthly stats will go back up to the first month in which the user existed (date of the user&#39;s registration). Note that this field is only regarded if &#39;includeMonthlyStats&#39; &#x3D; true. (optional)
     * @param  string $monthly_stats_end_date Maximum bound for the monthly stats (&#x3D;latest month that should be included). Must be passed in the format &#39;YYYY-MM&#39;. If not specified, then the monthly stats will go up to either the current month (for active users), or up to the month of deletion (for deleted users). Note that this field is only regarded if  &#39;includeMonthlyStats&#39; &#x3D; true. (optional)
     * @param  int $min_bank_connection_count_in_monthly_stats A value of X means that the service will return only those users which had at least X bank connections imported at any time within the returned monthly stats set. This field is only regarded when &#39;includeMonthlyStats&#39; is set to &#39;true&#39;. The default value for this field is 0. (optional, default to 0)
     * @param  string $user_id The identifier of a user to search for. If specified, then only the user with the given id will be regarded. If no user can be found for the passed userId (because the user was deleted or his username was misspelled), then the result list will be empty. (optional)
     * @param  bool $is_deleted If NOT specified, then the service will regard both active and deleted users in the search. If set to &#39;true&#39;, then ONLY deleted users will be regarded. If set to &#39;false&#39;, then ONLY active users will be regarded. (optional)
     * @param  bool $is_locked If NOT specified, then the service will regard both locked and not locked users in the search. If set to &#39;true&#39;, then ONLY locked users will be regarded. If set to &#39;false&#39;, then ONLY not locked users will be regarded. (optional)
     * @param  int $page Result page that you want to retrieve (optional, default to 1)
     * @param  int $per_page Maximum number of records per page. By default it&#39;s 20. Can be at most 500. (optional, default to 20)
     * @param  string[] $order Determines the order of the results. You can order the results by &#39;userId&#39;. The default order for this service is &#39;userId,asc&#39;. The general format is: &#39;property[,asc|desc]&#39;, with &#39;asc&#39; being the default value. (optional)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getUserListAsync($min_registration_date = null, $max_registration_date = null, $min_deletion_date = null, $max_deletion_date = null, $min_last_active_date = null, $max_last_active_date = null, $include_monthly_stats = false, $monthly_stats_start_date = null, $monthly_stats_end_date = null, $min_bank_connection_count_in_monthly_stats = 0, $user_id = null, $is_deleted = null, $is_locked = null, $page = 1, $per_page = 20, $order = null, $x_request_id = null)
    {
        return $this->getUserListAsyncWithHttpInfo($min_registration_date, $max_registration_date, $min_deletion_date, $max_deletion_date, $min_last_active_date, $max_last_active_date, $include_monthly_stats, $monthly_stats_start_date, $monthly_stats_end_date, $min_bank_connection_count_in_monthly_stats, $user_id, $is_deleted, $is_locked, $page, $per_page, $order, $x_request_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getUserListAsyncWithHttpInfo
     *
     * Get user list
     *
     * @param  string $min_registration_date Lower bound for a user&#39;s registration date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;registrationDate&#39; is equal to or later than the given date will be regarded. (optional)
     * @param  string $max_registration_date Upper bound for a user&#39;s registration date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;registrationDate&#39; is equal to or earlier than the given date will be regarded. (optional)
     * @param  string $min_deletion_date Lower bound for a user&#39;s deletion date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;deletionDate&#39; is not null, and is equal to or later than the given date will be regarded. (optional)
     * @param  string $max_deletion_date Upper bound for a user&#39;s deletion date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;deletionDate&#39; is null, or is equal to or earlier than the given date will be regarded. (optional)
     * @param  string $min_last_active_date Lower bound for a user&#39;s last active date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;lastActiveDate&#39; is not null, and is equal to or later than the given date will be regarded. (optional)
     * @param  string $max_last_active_date Upper bound for a user&#39;s last active date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;lastActiveDate&#39; is null, or is equal to or earlier than the given date will be regarded. (optional)
     * @param  bool $include_monthly_stats Whether to include the &#39;monthlyStats&#39; for the returned users. If not specified, then the field defaults to &#39;false&#39;. (optional, default to false)
     * @param  string $monthly_stats_start_date Minimum bound for the monthly stats (&#x3D;oldest month that should be included). Must be passed in the format &#39;YYYY-MM&#39;. If not specified, then the monthly stats will go back up to the first month in which the user existed (date of the user&#39;s registration). Note that this field is only regarded if &#39;includeMonthlyStats&#39; &#x3D; true. (optional)
     * @param  string $monthly_stats_end_date Maximum bound for the monthly stats (&#x3D;latest month that should be included). Must be passed in the format &#39;YYYY-MM&#39;. If not specified, then the monthly stats will go up to either the current month (for active users), or up to the month of deletion (for deleted users). Note that this field is only regarded if  &#39;includeMonthlyStats&#39; &#x3D; true. (optional)
     * @param  int $min_bank_connection_count_in_monthly_stats A value of X means that the service will return only those users which had at least X bank connections imported at any time within the returned monthly stats set. This field is only regarded when &#39;includeMonthlyStats&#39; is set to &#39;true&#39;. The default value for this field is 0. (optional, default to 0)
     * @param  string $user_id The identifier of a user to search for. If specified, then only the user with the given id will be regarded. If no user can be found for the passed userId (because the user was deleted or his username was misspelled), then the result list will be empty. (optional)
     * @param  bool $is_deleted If NOT specified, then the service will regard both active and deleted users in the search. If set to &#39;true&#39;, then ONLY deleted users will be regarded. If set to &#39;false&#39;, then ONLY active users will be regarded. (optional)
     * @param  bool $is_locked If NOT specified, then the service will regard both locked and not locked users in the search. If set to &#39;true&#39;, then ONLY locked users will be regarded. If set to &#39;false&#39;, then ONLY not locked users will be regarded. (optional)
     * @param  int $page Result page that you want to retrieve (optional, default to 1)
     * @param  int $per_page Maximum number of records per page. By default it&#39;s 20. Can be at most 500. (optional, default to 20)
     * @param  string[] $order Determines the order of the results. You can order the results by &#39;userId&#39;. The default order for this service is &#39;userId,asc&#39;. The general format is: &#39;property[,asc|desc]&#39;, with &#39;asc&#39; being the default value. (optional)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getUserListAsyncWithHttpInfo($min_registration_date = null, $max_registration_date = null, $min_deletion_date = null, $max_deletion_date = null, $min_last_active_date = null, $max_last_active_date = null, $include_monthly_stats = false, $monthly_stats_start_date = null, $monthly_stats_end_date = null, $min_bank_connection_count_in_monthly_stats = 0, $user_id = null, $is_deleted = null, $is_locked = null, $page = 1, $per_page = 20, $order = null, $x_request_id = null)
    {
        $returnType = '\OpenAPIAccess\Client\Model\PageableUserInfoList';
        $request = $this->getUserListRequest($min_registration_date, $max_registration_date, $min_deletion_date, $max_deletion_date, $min_last_active_date, $max_last_active_date, $include_monthly_stats, $monthly_stats_start_date, $monthly_stats_end_date, $min_bank_connection_count_in_monthly_stats, $user_id, $is_deleted, $is_locked, $page, $per_page, $order, $x_request_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getUserList'
     *
     * @param  string $min_registration_date Lower bound for a user&#39;s registration date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;registrationDate&#39; is equal to or later than the given date will be regarded. (optional)
     * @param  string $max_registration_date Upper bound for a user&#39;s registration date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;registrationDate&#39; is equal to or earlier than the given date will be regarded. (optional)
     * @param  string $min_deletion_date Lower bound for a user&#39;s deletion date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;deletionDate&#39; is not null, and is equal to or later than the given date will be regarded. (optional)
     * @param  string $max_deletion_date Upper bound for a user&#39;s deletion date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;deletionDate&#39; is null, or is equal to or earlier than the given date will be regarded. (optional)
     * @param  string $min_last_active_date Lower bound for a user&#39;s last active date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;lastActiveDate&#39; is not null, and is equal to or later than the given date will be regarded. (optional)
     * @param  string $max_last_active_date Upper bound for a user&#39;s last active date, in the format &#39;YYYY-MM-DD&#39; (e.g. &#39;2016-01-01&#39;). If specified, then only users whose &#39;lastActiveDate&#39; is null, or is equal to or earlier than the given date will be regarded. (optional)
     * @param  bool $include_monthly_stats Whether to include the &#39;monthlyStats&#39; for the returned users. If not specified, then the field defaults to &#39;false&#39;. (optional, default to false)
     * @param  string $monthly_stats_start_date Minimum bound for the monthly stats (&#x3D;oldest month that should be included). Must be passed in the format &#39;YYYY-MM&#39;. If not specified, then the monthly stats will go back up to the first month in which the user existed (date of the user&#39;s registration). Note that this field is only regarded if &#39;includeMonthlyStats&#39; &#x3D; true. (optional)
     * @param  string $monthly_stats_end_date Maximum bound for the monthly stats (&#x3D;latest month that should be included). Must be passed in the format &#39;YYYY-MM&#39;. If not specified, then the monthly stats will go up to either the current month (for active users), or up to the month of deletion (for deleted users). Note that this field is only regarded if  &#39;includeMonthlyStats&#39; &#x3D; true. (optional)
     * @param  int $min_bank_connection_count_in_monthly_stats A value of X means that the service will return only those users which had at least X bank connections imported at any time within the returned monthly stats set. This field is only regarded when &#39;includeMonthlyStats&#39; is set to &#39;true&#39;. The default value for this field is 0. (optional, default to 0)
     * @param  string $user_id The identifier of a user to search for. If specified, then only the user with the given id will be regarded. If no user can be found for the passed userId (because the user was deleted or his username was misspelled), then the result list will be empty. (optional)
     * @param  bool $is_deleted If NOT specified, then the service will regard both active and deleted users in the search. If set to &#39;true&#39;, then ONLY deleted users will be regarded. If set to &#39;false&#39;, then ONLY active users will be regarded. (optional)
     * @param  bool $is_locked If NOT specified, then the service will regard both locked and not locked users in the search. If set to &#39;true&#39;, then ONLY locked users will be regarded. If set to &#39;false&#39;, then ONLY not locked users will be regarded. (optional)
     * @param  int $page Result page that you want to retrieve (optional, default to 1)
     * @param  int $per_page Maximum number of records per page. By default it&#39;s 20. Can be at most 500. (optional, default to 20)
     * @param  string[] $order Determines the order of the results. You can order the results by &#39;userId&#39;. The default order for this service is &#39;userId,asc&#39;. The general format is: &#39;property[,asc|desc]&#39;, with &#39;asc&#39; being the default value. (optional)
     * @param  string $x_request_id With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getUserListRequest($min_registration_date = null, $max_registration_date = null, $min_deletion_date = null, $max_deletion_date = null, $min_last_active_date = null, $max_last_active_date = null, $include_monthly_stats = false, $monthly_stats_start_date = null, $monthly_stats_end_date = null, $min_bank_connection_count_in_monthly_stats = 0, $user_id = null, $is_deleted = null, $is_locked = null, $page = 1, $per_page = 20, $order = null, $x_request_id = null)
    {
        if ($page !== null && $page < 1) {
            throw new \InvalidArgumentException('invalid value for "$page" when calling MandatorAdministrationApi.getUserList, must be bigger than or equal to 1.');
        }

        if ($per_page !== null && $per_page > 500) {
            throw new \InvalidArgumentException('invalid value for "$per_page" when calling MandatorAdministrationApi.getUserList, must be smaller than or equal to 500.');
        }
        if ($per_page !== null && $per_page < 1) {
            throw new \InvalidArgumentException('invalid value for "$per_page" when calling MandatorAdministrationApi.getUserList, must be bigger than or equal to 1.');
        }


        $resourcePath = '/api/v1/mandatorAdmin/getUserList';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($min_registration_date !== null) {
            if('form' === 'form' && is_array($min_registration_date)) {
                foreach($min_registration_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['minRegistrationDate'] = $min_registration_date;
            }
        }
        // query params
        if ($max_registration_date !== null) {
            if('form' === 'form' && is_array($max_registration_date)) {
                foreach($max_registration_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['maxRegistrationDate'] = $max_registration_date;
            }
        }
        // query params
        if ($min_deletion_date !== null) {
            if('form' === 'form' && is_array($min_deletion_date)) {
                foreach($min_deletion_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['minDeletionDate'] = $min_deletion_date;
            }
        }
        // query params
        if ($max_deletion_date !== null) {
            if('form' === 'form' && is_array($max_deletion_date)) {
                foreach($max_deletion_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['maxDeletionDate'] = $max_deletion_date;
            }
        }
        // query params
        if ($min_last_active_date !== null) {
            if('form' === 'form' && is_array($min_last_active_date)) {
                foreach($min_last_active_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['minLastActiveDate'] = $min_last_active_date;
            }
        }
        // query params
        if ($max_last_active_date !== null) {
            if('form' === 'form' && is_array($max_last_active_date)) {
                foreach($max_last_active_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['maxLastActiveDate'] = $max_last_active_date;
            }
        }
        // query params
        if ($include_monthly_stats !== null) {
            if('form' === 'form' && is_array($include_monthly_stats)) {
                foreach($include_monthly_stats as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['includeMonthlyStats'] = $include_monthly_stats;
            }
        }
        // query params
        if ($monthly_stats_start_date !== null) {
            if('form' === 'form' && is_array($monthly_stats_start_date)) {
                foreach($monthly_stats_start_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['monthlyStatsStartDate'] = $monthly_stats_start_date;
            }
        }
        // query params
        if ($monthly_stats_end_date !== null) {
            if('form' === 'form' && is_array($monthly_stats_end_date)) {
                foreach($monthly_stats_end_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['monthlyStatsEndDate'] = $monthly_stats_end_date;
            }
        }
        // query params
        if ($min_bank_connection_count_in_monthly_stats !== null) {
            if('form' === 'form' && is_array($min_bank_connection_count_in_monthly_stats)) {
                foreach($min_bank_connection_count_in_monthly_stats as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['minBankConnectionCountInMonthlyStats'] = $min_bank_connection_count_in_monthly_stats;
            }
        }
        // query params
        if ($user_id !== null) {
            if('form' === 'form' && is_array($user_id)) {
                foreach($user_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['userId'] = $user_id;
            }
        }
        // query params
        if ($is_deleted !== null) {
            if('form' === 'form' && is_array($is_deleted)) {
                foreach($is_deleted as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['isDeleted'] = $is_deleted;
            }
        }
        // query params
        if ($is_locked !== null) {
            if('form' === 'form' && is_array($is_locked)) {
                foreach($is_locked as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['isLocked'] = $is_locked;
            }
        }
        // query params
        if ($page !== null) {
            if('form' === 'form' && is_array($page)) {
                foreach($page as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['page'] = $page;
            }
        }
        // query params
        if ($per_page !== null) {
            if('form' === 'form' && is_array($per_page)) {
                foreach($per_page as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['perPage'] = $per_page;
            }
        }
        // query params
        if ($order !== null) {
            if('form' === 'form' && is_array($order)) {
                foreach($order as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['order'] = $order;
            }
        }

        // header params
        if ($x_request_id !== null) {
            $headerParams['X-Request-Id'] = ObjectSerializer::toHeaderValue($x_request_id);
        }



        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
