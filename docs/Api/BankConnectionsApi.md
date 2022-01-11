# OpenAPIAccess\Client\BankConnectionsApi

All URIs are relative to https://sandbox.finapi.io.

Method | HTTP request | Description
------------- | ------------- | -------------
[**connectInterface()**](BankConnectionsApi.md#connectInterface) | **POST** /api/v1/bankConnections/connectInterface | Connect a new interface
[**deleteAccessData()**](BankConnectionsApi.md#deleteAccessData) | **DELETE** /api/v1/bankConnections/{id}/aisConsent | Delete a consent
[**deleteAllBankConnections()**](BankConnectionsApi.md#deleteAllBankConnections) | **DELETE** /api/v1/bankConnections | Delete all bank connections
[**deleteBankConnection()**](BankConnectionsApi.md#deleteBankConnection) | **DELETE** /api/v1/bankConnections/{id} | Delete a bank connection
[**editBankConnection()**](BankConnectionsApi.md#editBankConnection) | **PATCH** /api/v1/bankConnections/{id} | Edit a bank connection
[**getAllBankConnections()**](BankConnectionsApi.md#getAllBankConnections) | **GET** /api/v1/bankConnections | Get all bank connections
[**getBankConnection()**](BankConnectionsApi.md#getBankConnection) | **GET** /api/v1/bankConnections/{id} | Get a bank connection
[**importBankConnection()**](BankConnectionsApi.md#importBankConnection) | **POST** /api/v1/bankConnections/import | Import a new bank connection
[**removeInterface()**](BankConnectionsApi.md#removeInterface) | **POST** /api/v1/bankConnections/removeInterface | Remove an interface
[**updateBankConnection()**](BankConnectionsApi.md#updateBankConnection) | **POST** /api/v1/bankConnections/update | Update a bank connection


## `connectInterface()`

```php
connectInterface($connect_interface_params, $psu_ip_address, $psu_device_os, $psu_user_agent, $x_request_id): \OpenAPIAccess\Client\Model\BankConnection
```

Connect a new interface

If you are unlicensed, or licensed but using finAPI’s Web Form, this endpoint is not relevant to you. Instead, please refer to the endpoint <a href='https://docs.finapi.io?product=web_form_2.0#post-/api/tasks/backgroundUpdate' target='_blank'>here</a>.<br/><br/>Connects a new interface to an existing bank connection for a specific user. Must pass the connection credentials and the user's access_token. All bank accounts will be downloaded and imported with their current balances, transactions and supported two-step-procedures (note that the amount of available transactions may vary between banks, e.g. some banks deliver all transactions from the past year, others only deliver the transactions from the past three months). The balance and transactions download process runs asynchronously, so this service may return before all balances and transactions have been imported. Also, all downloaded transactions will be categorized by a separate background process that runs asynchronously too. To check the status of the balance and transactions download process as well as the background categorization process, see the status flags that are returned by the GET /bankConnections/&lt;id&gt; service.<br/><br/>NOTE (THIS LOGIC IS DEPRECATED AND WILL BE REMOVED):<br/>Depending on your license, this service may respond with HTTP code 451, containing an error message with an identifier of Web Form in it. In addition to that the response will also have included a 'Location' header, which contains the URL to the Web Form. In this case, you must forward your user to finAPI's Web Form.<br/><br/><b>ATTENTION:</b><ul><li>For XS2A interface additional headers must be included in the request if the end user is involved. Please refer to the <a href='#general-user-metadata'>User metadata</a> section under 'General Information' of the API documentation.</li><li>Due to bank-side changes we have been forced to limit the transactions download range to 89 days, to reduce the risk of strong customer authentication (SCA) requests.<br/>If you have implemented the SCA flow, please contact us, so that we can remove this limitation from your client.</li></ul>

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPIAccess\Client\Api\BankConnectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$connect_interface_params = new \OpenAPIAccess\Client\Model\ConnectInterfaceParams(); // \OpenAPIAccess\Client\Model\ConnectInterfaceParams | Connect interface parameters
$psu_ip_address = 'psu_ip_address_example'; // string | The IP address of the user's device. This header will be forwarded to the bank if the 'XS2A' interface is used.
$psu_device_os = 'psu_device_os_example'; // string | The user's device and/or operating system identification. This header will be forwarded to the bank if the 'XS2A' interface is used.
$psu_user_agent = 'psu_user_agent_example'; // string | The user's web browser or other client device identification. This header will be forwarded to the bank if the 'XS2A' interface is used.
$x_request_id = 'x_request_id_example'; // string | With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don't pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name 'X-Request-Id'. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster.

try {
    $result = $apiInstance->connectInterface($connect_interface_params, $psu_ip_address, $psu_device_os, $psu_user_agent, $x_request_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BankConnectionsApi->connectInterface: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **connect_interface_params** | [**\OpenAPIAccess\Client\Model\ConnectInterfaceParams**](../Model/ConnectInterfaceParams.md)| Connect interface parameters |
 **psu_ip_address** | **string**| The IP address of the user&#39;s device. This header will be forwarded to the bank if the &#39;XS2A&#39; interface is used. | [optional]
 **psu_device_os** | **string**| The user&#39;s device and/or operating system identification. This header will be forwarded to the bank if the &#39;XS2A&#39; interface is used. | [optional]
 **psu_user_agent** | **string**| The user&#39;s web browser or other client device identification. This header will be forwarded to the bank if the &#39;XS2A&#39; interface is used. | [optional]
 **x_request_id** | **string**| With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. | [optional]

### Return type

[**\OpenAPIAccess\Client\Model\BankConnection**](../Model/BankConnection.md)

### Authorization

[finapi_auth](../../README.md#finapi_auth), [finapi_auth](../../README.md#finapi_auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteAccessData()`

```php
deleteAccessData($id, $interface, $psu_ip_address, $psu_device_os, $psu_user_agent, $x_http_method_override, $x_request_id): \OpenAPIAccess\Client\Model\DeleteConsent
```

Delete a consent

Deletes a consent for an interface of a bank connection (on finAPI and on the bank's side).<br/><br/><b>ATTENTION:</b> For XS2A interface additional headers must be included in the request if the end user is involved. Please refer to the <a href='#general-user-metadata'>User metadata</a> section under 'General Information' of the API documentation.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPIAccess\Client\Api\BankConnectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Identifier of a bank connection
$interface = 'interface_example'; // string | Banking interface
$psu_ip_address = 'psu_ip_address_example'; // string | The IP address of the user's device. This header will be forwarded to the bank if the 'XS2A' interface is used.
$psu_device_os = 'psu_device_os_example'; // string | The user's device and/or operating system identification. This header will be forwarded to the bank if the 'XS2A' interface is used.
$psu_user_agent = 'psu_user_agent_example'; // string | The user's web browser or other client device identification. This header will be forwarded to the bank if the 'XS2A' interface is used.
$x_http_method_override = 'x_http_method_override_example'; // string | Some HTTP clients do not support the HTTP methods PATCH or DELETE. If you are using such a client in your application, you can use a POST request instead with this header indicating the originally intended HTTP method. POST Requests having this  header set will be treated either as PATCH or DELETE by the finAPI servers.
$x_request_id = 'x_request_id_example'; // string | With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don't pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name 'X-Request-Id'. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster.

try {
    $result = $apiInstance->deleteAccessData($id, $interface, $psu_ip_address, $psu_device_os, $psu_user_agent, $x_http_method_override, $x_request_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BankConnectionsApi->deleteAccessData: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Identifier of a bank connection |
 **interface** | **string**| Banking interface |
 **psu_ip_address** | **string**| The IP address of the user&#39;s device. This header will be forwarded to the bank if the &#39;XS2A&#39; interface is used. | [optional]
 **psu_device_os** | **string**| The user&#39;s device and/or operating system identification. This header will be forwarded to the bank if the &#39;XS2A&#39; interface is used. | [optional]
 **psu_user_agent** | **string**| The user&#39;s web browser or other client device identification. This header will be forwarded to the bank if the &#39;XS2A&#39; interface is used. | [optional]
 **x_http_method_override** | **string**| Some HTTP clients do not support the HTTP methods PATCH or DELETE. If you are using such a client in your application, you can use a POST request instead with this header indicating the originally intended HTTP method. POST Requests having this  header set will be treated either as PATCH or DELETE by the finAPI servers. | [optional]
 **x_request_id** | **string**| With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. | [optional]

### Return type

[**\OpenAPIAccess\Client\Model\DeleteConsent**](../Model/DeleteConsent.md)

### Authorization

[finapi_auth](../../README.md#finapi_auth), [finapi_auth](../../README.md#finapi_auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteAllBankConnections()`

```php
deleteAllBankConnections($x_http_method_override, $x_request_id): \OpenAPIAccess\Client\Model\IdentifierList
```

Delete all bank connections

Delete all bank connections of the user that is authorized by the access_token. Must pass the user's access_token.<br/><br/>Notes: <br/>- All notification rules that are connected to any specific bank connection will get deleted as well. <br/>- If at least one bank connection is busy (currently in the process of import, update, or transaction categorization), then this service will perform no action at all.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPIAccess\Client\Api\BankConnectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$x_http_method_override = 'x_http_method_override_example'; // string | Some HTTP clients do not support the HTTP methods PATCH or DELETE. If you are using such a client in your application, you can use a POST request instead with this header indicating the originally intended HTTP method. POST Requests having this  header set will be treated either as PATCH or DELETE by the finAPI servers.
$x_request_id = 'x_request_id_example'; // string | With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don't pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name 'X-Request-Id'. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster.

try {
    $result = $apiInstance->deleteAllBankConnections($x_http_method_override, $x_request_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BankConnectionsApi->deleteAllBankConnections: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **x_http_method_override** | **string**| Some HTTP clients do not support the HTTP methods PATCH or DELETE. If you are using such a client in your application, you can use a POST request instead with this header indicating the originally intended HTTP method. POST Requests having this  header set will be treated either as PATCH or DELETE by the finAPI servers. | [optional]
 **x_request_id** | **string**| With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. | [optional]

### Return type

[**\OpenAPIAccess\Client\Model\IdentifierList**](../Model/IdentifierList.md)

### Authorization

[finapi_auth](../../README.md#finapi_auth), [finapi_auth](../../README.md#finapi_auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteBankConnection()`

```php
deleteBankConnection($id, $x_http_method_override, $x_request_id)
```

Delete a bank connection

Delete a single bank connection of the user that is authorized by the access_token, including all of its accounts and their transactions and balance data. Must pass the connection's identifier and the user's access_token.<br/><br/>Notes: <br/>- All notification rules that are connected to the bank connection will get adjusted so that they no longer have this connection listed. Notification rules that are connected to just this bank connection (and no other connection) will get deleted altogether. <br/>- A bank connection cannot get deleted while it is in the process of import, update, or transaction categorization.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPIAccess\Client\Api\BankConnectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Identifier of the bank connection to delete
$x_http_method_override = 'x_http_method_override_example'; // string | Some HTTP clients do not support the HTTP methods PATCH or DELETE. If you are using such a client in your application, you can use a POST request instead with this header indicating the originally intended HTTP method. POST Requests having this  header set will be treated either as PATCH or DELETE by the finAPI servers.
$x_request_id = 'x_request_id_example'; // string | With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don't pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name 'X-Request-Id'. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster.

try {
    $apiInstance->deleteBankConnection($id, $x_http_method_override, $x_request_id);
} catch (Exception $e) {
    echo 'Exception when calling BankConnectionsApi->deleteBankConnection: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Identifier of the bank connection to delete |
 **x_http_method_override** | **string**| Some HTTP clients do not support the HTTP methods PATCH or DELETE. If you are using such a client in your application, you can use a POST request instead with this header indicating the originally intended HTTP method. POST Requests having this  header set will be treated either as PATCH or DELETE by the finAPI servers. | [optional]
 **x_request_id** | **string**| With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. | [optional]

### Return type

void (empty response body)

### Authorization

[finapi_auth](../../README.md#finapi_auth), [finapi_auth](../../README.md#finapi_auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `editBankConnection()`

```php
editBankConnection($id, $edit_bank_connection_params, $x_http_method_override, $x_request_id): \OpenAPIAccess\Client\Model\BankConnection
```

Edit a bank connection

If you are unlicensed, or licensed but using finAPI’s Web Form, this endpoint is relevant to you ONLY if you want to update the name of the bank connection. Please check <a href='https://docs.finapi.io?product=web_form_2.0#post-/api/tasks/backgroundUpdate' target='_blank'>this</a> endpoint for all other functionalities instead.<br/><br/>Edit bank connection data. Must pass the connection's identifier and the user's access_token.<br/><br/>Note that a bank connection's credentials cannot be changed while it is in the process of being imported, updated, or connecting a new interface.<br/><br/>NOTE (THIS LOGIC IS DEPRECATED AND WILL BE REMOVED):<br/>Depending on your license, this service may respond with HTTP code 451, containing an error message with an identifier of Web Form in it. In addition to that the response will also have included a 'Location' header, which contains the URL to the Web Form. In this case, you must forward your user to finAPI's Web Form.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPIAccess\Client\Api\BankConnectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Identifier of the bank connection to change the parameters for
$edit_bank_connection_params = new \OpenAPIAccess\Client\Model\EditBankConnectionParams(); // \OpenAPIAccess\Client\Model\EditBankConnectionParams | New bank connection parameters
$x_http_method_override = 'x_http_method_override_example'; // string | Some HTTP clients do not support the HTTP methods PATCH or DELETE. If you are using such a client in your application, you can use a POST request instead with this header indicating the originally intended HTTP method. POST Requests having this  header set will be treated either as PATCH or DELETE by the finAPI servers.
$x_request_id = 'x_request_id_example'; // string | With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don't pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name 'X-Request-Id'. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster.

try {
    $result = $apiInstance->editBankConnection($id, $edit_bank_connection_params, $x_http_method_override, $x_request_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BankConnectionsApi->editBankConnection: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Identifier of the bank connection to change the parameters for |
 **edit_bank_connection_params** | [**\OpenAPIAccess\Client\Model\EditBankConnectionParams**](../Model/EditBankConnectionParams.md)| New bank connection parameters |
 **x_http_method_override** | **string**| Some HTTP clients do not support the HTTP methods PATCH or DELETE. If you are using such a client in your application, you can use a POST request instead with this header indicating the originally intended HTTP method. POST Requests having this  header set will be treated either as PATCH or DELETE by the finAPI servers. | [optional]
 **x_request_id** | **string**| With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. | [optional]

### Return type

[**\OpenAPIAccess\Client\Model\BankConnection**](../Model/BankConnection.md)

### Authorization

[finapi_auth](../../README.md#finapi_auth), [finapi_auth](../../README.md#finapi_auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getAllBankConnections()`

```php
getAllBankConnections($ids, $x_request_id): \OpenAPIAccess\Client\Model\BankConnectionList
```

Get all bank connections

Get bank connections of the user that is authorized by the access_token. Must pass the user's access_token. You can set optional search criteria to get only those bank connections that you are interested in. If you do not specify any search criteria, then this service functions as a 'get all' service.<br/>Web Form 2.0 customers should also use this endpoint to learn about the status of the bank connection (The bank connection ID can be found in the payload of the API response from the relevant Web Form 2.0 API endpoint).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPIAccess\Client\Api\BankConnectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ids = array(56); // int[] | A comma-separated list of bank connection identifiers. If specified, then only bank connections whose identifier match any of the given identifiers will be regarded. The maximum number of identifiers is 1000.
$x_request_id = 'x_request_id_example'; // string | With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don't pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name 'X-Request-Id'. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster.

try {
    $result = $apiInstance->getAllBankConnections($ids, $x_request_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BankConnectionsApi->getAllBankConnections: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **ids** | [**int[]**](../Model/int.md)| A comma-separated list of bank connection identifiers. If specified, then only bank connections whose identifier match any of the given identifiers will be regarded. The maximum number of identifiers is 1000. | [optional]
 **x_request_id** | **string**| With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. | [optional]

### Return type

[**\OpenAPIAccess\Client\Model\BankConnectionList**](../Model/BankConnectionList.md)

### Authorization

[finapi_auth](../../README.md#finapi_auth), [finapi_auth](../../README.md#finapi_auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getBankConnection()`

```php
getBankConnection($id, $x_request_id): \OpenAPIAccess\Client\Model\BankConnection
```

Get a bank connection

Get a single bank connection of the user that is authorized by the access_token. Must pass the connection's identifier and the user's access_token.<br/>Web Form 2.0 customers should also use this endpoint to learn about the status of the bank connection (The bank connection ID can be found in the payload of the API response from the relevant Web Form 2.0 API endpoint).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPIAccess\Client\Api\BankConnectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Identifier of requested bank connection
$x_request_id = 'x_request_id_example'; // string | With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don't pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name 'X-Request-Id'. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster.

try {
    $result = $apiInstance->getBankConnection($id, $x_request_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BankConnectionsApi->getBankConnection: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Identifier of requested bank connection |
 **x_request_id** | **string**| With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. | [optional]

### Return type

[**\OpenAPIAccess\Client\Model\BankConnection**](../Model/BankConnection.md)

### Authorization

[finapi_auth](../../README.md#finapi_auth), [finapi_auth](../../README.md#finapi_auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `importBankConnection()`

```php
importBankConnection($import_bank_connection_params, $psu_ip_address, $psu_device_os, $psu_user_agent, $x_request_id): \OpenAPIAccess\Client\Model\BankConnection
```

Import a new bank connection

If you are unlicensed, or licensed but using finAPI’s Web Form, this endpoint is not relevant to you. Instead, please refer to the endpoint <a href='https://docs.finapi.io?product=web_form_2.0#post-/api/webForms/bankConnectionImport' target='_blank'>here</a>.<br/><br/>Imports a new bank connection for a specific user. Must pass the connection credentials and the user's access_token. All bank accounts will be downloaded and imported with their current balances, transactions and supported two-step-procedures (note that the amount of available transactions may vary between banks, e.g. some banks deliver all transactions from the past year, others only deliver the transactions from the past three months). The balance and transactions download process runs asynchronously, so this service may return before all balances and transactions have been imported. Also, all downloaded transactions will be categorized by a separate background process that runs asynchronously too. To check the status of the balance and transactions download process as well as the background categorization process, see the status flags that are returned by the GET /bankConnections/&lt;id&gt; service.<br/><br/>To test the API, you can import a \"demo connection\". To import the demo connection, you need to pass the identifier of the \"finAPI Test Bank\". For more details, please see the associated <a href='https://documentation.finapi.io/access/finAPI-Test-Banks.2556264541.html' target='_blank'>documentation</a>.<br/><br/>For a more in-depth understanding of the import process, please also read this page on our Access Public Documentation: <a href='https://documentation.finapi.io/access/Post-Processing-of-Bank-Account-Import%2FUpdate.2766405656.html' target='_blank'>Post Processing of Bank Account Import/Update</a><br/><br/><b>ATTENTION:</b><ul><li>For XS2A interface additional headers must be included in the request if the end user is involved. Please refer to the <a href='#general-user-metadata'>User metadata</a> section under 'General Information' of the API documentation.</li><li>Due to bank-side changes we have been forced to limit the transactions download range to 89 days, to reduce the risk of strong customer authentication (SCA) requests.<br/>If you have implemented the SCA flow, please contact us, so that we can remove this limitation from your client.</li></ul>

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPIAccess\Client\Api\BankConnectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$import_bank_connection_params = new \OpenAPIAccess\Client\Model\ImportBankConnectionParams(); // \OpenAPIAccess\Client\Model\ImportBankConnectionParams | Import bank connection parameters
$psu_ip_address = 'psu_ip_address_example'; // string | The IP address of the user's device. This header will be forwarded to the bank if the 'XS2A' interface is used.
$psu_device_os = 'psu_device_os_example'; // string | The user's device and/or operating system identification. This header will be forwarded to the bank if the 'XS2A' interface is used.
$psu_user_agent = 'psu_user_agent_example'; // string | The user's web browser or other client device identification. This header will be forwarded to the bank if the 'XS2A' interface is used.
$x_request_id = 'x_request_id_example'; // string | With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don't pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name 'X-Request-Id'. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster.

try {
    $result = $apiInstance->importBankConnection($import_bank_connection_params, $psu_ip_address, $psu_device_os, $psu_user_agent, $x_request_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BankConnectionsApi->importBankConnection: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **import_bank_connection_params** | [**\OpenAPIAccess\Client\Model\ImportBankConnectionParams**](../Model/ImportBankConnectionParams.md)| Import bank connection parameters |
 **psu_ip_address** | **string**| The IP address of the user&#39;s device. This header will be forwarded to the bank if the &#39;XS2A&#39; interface is used. | [optional]
 **psu_device_os** | **string**| The user&#39;s device and/or operating system identification. This header will be forwarded to the bank if the &#39;XS2A&#39; interface is used. | [optional]
 **psu_user_agent** | **string**| The user&#39;s web browser or other client device identification. This header will be forwarded to the bank if the &#39;XS2A&#39; interface is used. | [optional]
 **x_request_id** | **string**| With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. | [optional]

### Return type

[**\OpenAPIAccess\Client\Model\BankConnection**](../Model/BankConnection.md)

### Authorization

[finapi_auth](../../README.md#finapi_auth), [finapi_auth](../../README.md#finapi_auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `removeInterface()`

```php
removeInterface($remove_interface_params, $x_request_id)
```

Remove an interface

Remove an interface from bank connection and from all associated accounts in the bank connection. Notes: <br/>- An interface cannot get deleted while it is in the process of import or update.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPIAccess\Client\Api\BankConnectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$remove_interface_params = new \OpenAPIAccess\Client\Model\RemoveInterfaceParams(); // \OpenAPIAccess\Client\Model\RemoveInterfaceParams | Remove interface parameters
$x_request_id = 'x_request_id_example'; // string | With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don't pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name 'X-Request-Id'. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster.

try {
    $apiInstance->removeInterface($remove_interface_params, $x_request_id);
} catch (Exception $e) {
    echo 'Exception when calling BankConnectionsApi->removeInterface: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **remove_interface_params** | [**\OpenAPIAccess\Client\Model\RemoveInterfaceParams**](../Model/RemoveInterfaceParams.md)| Remove interface parameters |
 **x_request_id** | **string**| With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. | [optional]

### Return type

void (empty response body)

### Authorization

[finapi_auth](../../README.md#finapi_auth), [finapi_auth](../../README.md#finapi_auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateBankConnection()`

```php
updateBankConnection($update_bank_connection_params, $psu_ip_address, $psu_device_os, $psu_user_agent, $x_request_id): \OpenAPIAccess\Client\Model\BankConnection
```

Update a bank connection

If you are unlicensed, or licensed but using finAPI’s Web Form, this endpoint is not relevant to you. Instead, please refer to the endpoint <a href='https://docs.finapi.io?product=web_form_2.0#post-/api/tasks/backgroundUpdate' target='_blank'>here</a>.<br/><br/>Update an existing bank connection of the user that is authorized by the access_token. Downloads and imports the current account balances and new transactions. Note that if the bank connection has several interfaces and some of its accounts was previously imported or updated via an interface which have higher priority than the interface used in the current update, then balances and transactions will not be downloaded for such accounts (The XS2A interface has the highest priority, followed by FINTS_SERVER and finally WEB_SCRAPER). Must pass the connection's identifier and the user's access_token. For more information about the processes of authentication, data download and transaction categorization, see POST /bankConnections/import. Note that supported two-step-procedures are updated as well. It may unset the current default two-step-procedure of the given bank connection (but only if this procedure is not supported anymore by the bank). You can also update the \"demo connection\" (in this case, secret login credentials and the fields 'importNewAccounts' and 'skipPositionsDownload' will be ignored).<br/><br/>Note that you cannot trigger an update of a bank connection as long as there is still a previously triggered update running.<br/><br/>For a more in-depth understanding of the update process, please also read this page on our Access Public Documentation: <a href='https://documentation.finapi.io/access/Post-Processing-of-Bank-Account-Import%2FUpdate.2766405656.html' target='_blank'>Post Processing of Bank Account Import/Update</a><br/><br/>NOTE (THIS LOGIC IS DEPRECATED AND WILL BE REMOVED):<br/>Depending on your license, this service may respond with HTTP code 451, containing an error message with an identifier of Web Form in it. In addition to that the response will also have included a 'Location' header, which contains the URL to the Web Form. In this case, you must forward your user to finAPI's Web Form.<br/><br/><b>ATTENTION:</b><ul><li>For XS2A interface additional headers must be included in the request if the end user is involved. Please refer to the <a href='#general-user-metadata'>User metadata</a> section under 'General Information' of the API documentation.</li><li>Due to bank-side changes we have been forced to limit the transactions download range to 89 days, to reduce the risk of strong customer authentication (SCA) requests.<br/>Now any update of a bank connection will fetch at most the last three months of transactions per account. If the last successful update was more than 3 months ago, an adjusting entry ('Zwischensaldo' transaction) might be created.</li></ul>

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPIAccess\Client\Api\BankConnectionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$update_bank_connection_params = new \OpenAPIAccess\Client\Model\UpdateBankConnectionParams(); // \OpenAPIAccess\Client\Model\UpdateBankConnectionParams | Update bank connection parameters
$psu_ip_address = 'psu_ip_address_example'; // string | The IP address of the user's device. This header will be forwarded to the bank if the 'XS2A' interface is used.
$psu_device_os = 'psu_device_os_example'; // string | The user's device and/or operating system identification. This header will be forwarded to the bank if the 'XS2A' interface is used.
$psu_user_agent = 'psu_user_agent_example'; // string | The user's web browser or other client device identification. This header will be forwarded to the bank if the 'XS2A' interface is used.
$x_request_id = 'x_request_id_example'; // string | With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don't pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name 'X-Request-Id'. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster.

try {
    $result = $apiInstance->updateBankConnection($update_bank_connection_params, $psu_ip_address, $psu_device_os, $psu_user_agent, $x_request_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BankConnectionsApi->updateBankConnection: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **update_bank_connection_params** | [**\OpenAPIAccess\Client\Model\UpdateBankConnectionParams**](../Model/UpdateBankConnectionParams.md)| Update bank connection parameters |
 **psu_ip_address** | **string**| The IP address of the user&#39;s device. This header will be forwarded to the bank if the &#39;XS2A&#39; interface is used. | [optional]
 **psu_device_os** | **string**| The user&#39;s device and/or operating system identification. This header will be forwarded to the bank if the &#39;XS2A&#39; interface is used. | [optional]
 **psu_user_agent** | **string**| The user&#39;s web browser or other client device identification. This header will be forwarded to the bank if the &#39;XS2A&#39; interface is used. | [optional]
 **x_request_id** | **string**| With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. | [optional]

### Return type

[**\OpenAPIAccess\Client\Model\BankConnection**](../Model/BankConnection.md)

### Authorization

[finapi_auth](../../README.md#finapi_auth), [finapi_auth](../../README.md#finapi_auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
