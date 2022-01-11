# OpenAPIAccess\Client\TPPCredentialsApi

All URIs are relative to https://sandbox.finapi.io.

Method | HTTP request | Description
------------- | ------------- | -------------
[**createTppCredential()**](TPPCredentialsApi.md#createTppCredential) | **POST** /api/v1/tppCredentials | Upload TPP credentials
[**deleteTppCredential()**](TPPCredentialsApi.md#deleteTppCredential) | **DELETE** /api/v1/tppCredentials/{id} | Delete a set of TPP credentials
[**editTppCredential()**](TPPCredentialsApi.md#editTppCredential) | **PATCH** /api/v1/tppCredentials/{id} | Edit a set of TPP credentials
[**getAllTppCredentials()**](TPPCredentialsApi.md#getAllTppCredentials) | **GET** /api/v1/tppCredentials | Get all TPP credentials
[**getAndSearchTppAuthenticationGroups()**](TPPCredentialsApi.md#getAndSearchTppAuthenticationGroups) | **GET** /api/v1/tppCredentials/tppAuthenticationGroups | Get all TPP Authentication Groups
[**getTppCredential()**](TPPCredentialsApi.md#getTppCredential) | **GET** /api/v1/tppCredentials/{id} | Get a set of TPP credentials


## `createTppCredential()`

```php
createTppCredential($tpp_credentials_params, $x_request_id): \OpenAPIAccess\Client\Model\TppCredentials
```

Upload TPP credentials

Upload TPP credentials for a TPP Authentication Group. Must pass the <a href='https://documentation.finapi.io/access/Application-management.2763423767.html' target='_blank'>mandator admin client</a>'s access_token.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPIAccess\Client\Api\TPPCredentialsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$tpp_credentials_params = new \OpenAPIAccess\Client\Model\TppCredentialsParams(); // \OpenAPIAccess\Client\Model\TppCredentialsParams | Parameters of a new set of TPP credentials
$x_request_id = 'x_request_id_example'; // string | With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don't pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name 'X-Request-Id'. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster.

try {
    $result = $apiInstance->createTppCredential($tpp_credentials_params, $x_request_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TPPCredentialsApi->createTppCredential: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **tpp_credentials_params** | [**\OpenAPIAccess\Client\Model\TppCredentialsParams**](../Model/TppCredentialsParams.md)| Parameters of a new set of TPP credentials |
 **x_request_id** | **string**| With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. | [optional]

### Return type

[**\OpenAPIAccess\Client\Model\TppCredentials**](../Model/TppCredentials.md)

### Authorization

[finapi_auth](../../README.md#finapi_auth), [finapi_auth](../../README.md#finapi_auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteTppCredential()`

```php
deleteTppCredential($id, $x_http_method_override, $x_request_id)
```

Delete a set of TPP credentials

Delete a single set of TPP credentials by its id. Must pass the <a href='https://documentation.finapi.io/access/Application-management.2763423767.html' target='_blank'>mandator admin client</a>'s access_token.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPIAccess\Client\Api\TPPCredentialsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Id of the TPP credentials to delete
$x_http_method_override = 'x_http_method_override_example'; // string | Some HTTP clients do not support the HTTP methods PATCH or DELETE. If you are using such a client in your application, you can use a POST request instead with this header indicating the originally intended HTTP method. POST Requests having this  header set will be treated either as PATCH or DELETE by the finAPI servers.
$x_request_id = 'x_request_id_example'; // string | With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don't pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name 'X-Request-Id'. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster.

try {
    $apiInstance->deleteTppCredential($id, $x_http_method_override, $x_request_id);
} catch (Exception $e) {
    echo 'Exception when calling TPPCredentialsApi->deleteTppCredential: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Id of the TPP credentials to delete |
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

## `editTppCredential()`

```php
editTppCredential($id, $edit_tpp_credential_params, $x_http_method_override, $x_request_id): \OpenAPIAccess\Client\Model\TppCredentials
```

Edit a set of TPP credentials

Edit TPP credentials data. Must pass the <a href='https://documentation.finapi.io/access/Application-management.2763423767.html' target='_blank'>mandator admin client</a>'s access_token.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPIAccess\Client\Api\TPPCredentialsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Id of the TPP credentials to edit
$edit_tpp_credential_params = new \OpenAPIAccess\Client\Model\EditTppCredentialParams(); // \OpenAPIAccess\Client\Model\EditTppCredentialParams | New TPP credentials parameters
$x_http_method_override = 'x_http_method_override_example'; // string | Some HTTP clients do not support the HTTP methods PATCH or DELETE. If you are using such a client in your application, you can use a POST request instead with this header indicating the originally intended HTTP method. POST Requests having this  header set will be treated either as PATCH or DELETE by the finAPI servers.
$x_request_id = 'x_request_id_example'; // string | With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don't pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name 'X-Request-Id'. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster.

try {
    $result = $apiInstance->editTppCredential($id, $edit_tpp_credential_params, $x_http_method_override, $x_request_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TPPCredentialsApi->editTppCredential: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Id of the TPP credentials to edit |
 **edit_tpp_credential_params** | [**\OpenAPIAccess\Client\Model\EditTppCredentialParams**](../Model/EditTppCredentialParams.md)| New TPP credentials parameters |
 **x_http_method_override** | **string**| Some HTTP clients do not support the HTTP methods PATCH or DELETE. If you are using such a client in your application, you can use a POST request instead with this header indicating the originally intended HTTP method. POST Requests having this  header set will be treated either as PATCH or DELETE by the finAPI servers. | [optional]
 **x_request_id** | **string**| With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. | [optional]

### Return type

[**\OpenAPIAccess\Client\Model\TppCredentials**](../Model/TppCredentials.md)

### Authorization

[finapi_auth](../../README.md#finapi_auth), [finapi_auth](../../README.md#finapi_auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getAllTppCredentials()`

```php
getAllTppCredentials($search, $page, $per_page, $order, $x_request_id): \OpenAPIAccess\Client\Model\PageableTppCredentialResources
```

Get all TPP credentials

Get and search all TPP credentials. Must pass the <a href='https://documentation.finapi.io/access/Application-management.2763423767.html' target='_blank'>mandator admin client</a>'s access_token. You can set optional search criteria to get only those TPP credentials that you are interested in. If you do not specify any search criteria, then this service functions as a 'get all' service.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPIAccess\Client\Api\TPPCredentialsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$search = 'search_example'; // string | Returns only the TPP credentials belonging to those banks whose 'name', 'blz', or 'bic' contains the given search string (the matching works case-insensitive). Note: If the given search string consists of several terms (separated by whitespace), then ALL of these terms must apply to a bank for it to get included into the result.
$page = 1; // int | Result page that you want to retrieve
$per_page = 20; // int | Maximum number of records per page. By default it's 20. Can be at most 500.
$order = array('order_example'); // string[] | Determines the order of the results. You can order the results by 'label'. The default order for this service is 'label,asc'. The general format is: 'property[,asc|desc]', with 'asc' being the default value.
$x_request_id = 'x_request_id_example'; // string | With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don't pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name 'X-Request-Id'. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster.

try {
    $result = $apiInstance->getAllTppCredentials($search, $page, $per_page, $order, $x_request_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TPPCredentialsApi->getAllTppCredentials: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **search** | **string**| Returns only the TPP credentials belonging to those banks whose &#39;name&#39;, &#39;blz&#39;, or &#39;bic&#39; contains the given search string (the matching works case-insensitive). Note: If the given search string consists of several terms (separated by whitespace), then ALL of these terms must apply to a bank for it to get included into the result. | [optional]
 **page** | **int**| Result page that you want to retrieve | [optional] [default to 1]
 **per_page** | **int**| Maximum number of records per page. By default it&#39;s 20. Can be at most 500. | [optional] [default to 20]
 **order** | [**string[]**](../Model/string.md)| Determines the order of the results. You can order the results by &#39;label&#39;. The default order for this service is &#39;label,asc&#39;. The general format is: &#39;property[,asc|desc]&#39;, with &#39;asc&#39; being the default value. | [optional]
 **x_request_id** | **string**| With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. | [optional]

### Return type

[**\OpenAPIAccess\Client\Model\PageableTppCredentialResources**](../Model/PageableTppCredentialResources.md)

### Authorization

[finapi_auth](../../README.md#finapi_auth), [finapi_auth](../../README.md#finapi_auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getAndSearchTppAuthenticationGroups()`

```php
getAndSearchTppAuthenticationGroups($ids, $name, $bank_blz, $bank_name, $page, $per_page, $order, $x_request_id): \OpenAPIAccess\Client\Model\PageableTppAuthenticationGroupResources
```

Get all TPP Authentication Groups

Get and search across all available TPP authentication groups. Must pass the <a href='https://documentation.finapi.io/access/Application-management.2763423767.html' target='_blank'>mandator admin client</a>'s access_token. You can set optional search criteria to get only those TPP authentication groups that you are interested in. If you do not specify any search criteria, then this service functions as a 'get all' service.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPIAccess\Client\Api\TPPCredentialsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ids = array(56); // int[] | A comma-separated list of TPP authentication group identifiers. If specified, then only TPP authentication groups whose identifier match any of the given identifiers will be regarded. The maximum number of identifiers is 1000.
$name = 'name_example'; // string | Only the tpp authentication groups with name matching the given one should appear in the result list
$bank_blz = 'bank_blz_example'; // string | Search by connected banks: only the banks with BLZ matching the given one should appear in the result list
$bank_name = 'bank_name_example'; // string | Search by connected banks: only the banks with name matching the given one should appear in the result list
$page = 1; // int | Result page that you want to retrieve
$per_page = 20; // int | Maximum number of records per page. By default it's 20. Can be at most 500.
$order = array('order_example'); // string[] | Determines the order of the results. You can order the results by 'id' and 'name'. The default order for this service is 'id,asc'. The general format is: 'property[,asc|desc]', with 'asc' being the default value.
$x_request_id = 'x_request_id_example'; // string | With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don't pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name 'X-Request-Id'. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster.

try {
    $result = $apiInstance->getAndSearchTppAuthenticationGroups($ids, $name, $bank_blz, $bank_name, $page, $per_page, $order, $x_request_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TPPCredentialsApi->getAndSearchTppAuthenticationGroups: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **ids** | [**int[]**](../Model/int.md)| A comma-separated list of TPP authentication group identifiers. If specified, then only TPP authentication groups whose identifier match any of the given identifiers will be regarded. The maximum number of identifiers is 1000. | [optional]
 **name** | **string**| Only the tpp authentication groups with name matching the given one should appear in the result list | [optional]
 **bank_blz** | **string**| Search by connected banks: only the banks with BLZ matching the given one should appear in the result list | [optional]
 **bank_name** | **string**| Search by connected banks: only the banks with name matching the given one should appear in the result list | [optional]
 **page** | **int**| Result page that you want to retrieve | [optional] [default to 1]
 **per_page** | **int**| Maximum number of records per page. By default it&#39;s 20. Can be at most 500. | [optional] [default to 20]
 **order** | [**string[]**](../Model/string.md)| Determines the order of the results. You can order the results by &#39;id&#39; and &#39;name&#39;. The default order for this service is &#39;id,asc&#39;. The general format is: &#39;property[,asc|desc]&#39;, with &#39;asc&#39; being the default value. | [optional]
 **x_request_id** | **string**| With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. | [optional]

### Return type

[**\OpenAPIAccess\Client\Model\PageableTppAuthenticationGroupResources**](../Model/PageableTppAuthenticationGroupResources.md)

### Authorization

[finapi_auth](../../README.md#finapi_auth), [finapi_auth](../../README.md#finapi_auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getTppCredential()`

```php
getTppCredential($id, $x_request_id): \OpenAPIAccess\Client\Model\TppCredentials
```

Get a set of TPP credentials

Get a single set of TPP credentials by its id. Must pass the <a href='https://documentation.finapi.io/access/Application-management.2763423767.html' target='_blank'>mandator admin client</a>'s access_token.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPIAccess\Client\Api\TPPCredentialsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | Id of the requested TPP credentials
$x_request_id = 'x_request_id_example'; // string | With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don't pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name 'X-Request-Id'. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster.

try {
    $result = $apiInstance->getTppCredential($id, $x_request_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TPPCredentialsApi->getTppCredential: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| Id of the requested TPP credentials |
 **x_request_id** | **string**| With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. | [optional]

### Return type

[**\OpenAPIAccess\Client\Model\TppCredentials**](../Model/TppCredentials.md)

### Authorization

[finapi_auth](../../README.md#finapi_auth), [finapi_auth](../../README.md#finapi_auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
