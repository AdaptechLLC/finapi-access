# OpenAPIAccess\Client\MocksAndTestsApi

All URIs are relative to https://sandbox.finapi.io.

Method | HTTP request | Description
------------- | ------------- | -------------
[**checkCategorization()**](MocksAndTestsApi.md#checkCategorization) | **POST** /api/v1/tests/checkCategorization | Check categorization
[**mockBatchUpdate()**](MocksAndTestsApi.md#mockBatchUpdate) | **POST** /api/v1/tests/mockBatchUpdate | Mock batch update


## `checkCategorization()`

```php
checkCategorization($check_categorization_data, $x_request_id): \OpenAPIAccess\Client\Model\CategorizationCheckResults
```

Check categorization

This service can be used to check the categorization for a given set of transactions, without the need of having the transactions imported in finAPI. You must pass the user's access_token.<br/><br/>Note that the result of the categorization is generally the same as if the transactions were actually imported (the service regards the user-specific categorization rules), but there is one exception: If you pass a ‘mcCode’, this will also be regarded during categorization - which is not the case when transactions get categorized during import (because most banks do not deliver this field).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPIAccess\Client\Api\MocksAndTestsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$check_categorization_data = new \OpenAPIAccess\Client\Model\CheckCategorizationData(); // \OpenAPIAccess\Client\Model\CheckCategorizationData | Transactions data
$x_request_id = 'x_request_id_example'; // string | With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don't pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name 'X-Request-Id'. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster.

try {
    $result = $apiInstance->checkCategorization($check_categorization_data, $x_request_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MocksAndTestsApi->checkCategorization: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **check_categorization_data** | [**\OpenAPIAccess\Client\Model\CheckCategorizationData**](../Model/CheckCategorizationData.md)| Transactions data |
 **x_request_id** | **string**| With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don&#39;t pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name &#39;X-Request-Id&#39;. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster. | [optional]

### Return type

[**\OpenAPIAccess\Client\Model\CategorizationCheckResults**](../Model/CategorizationCheckResults.md)

### Authorization

[finapi_auth](../../README.md#finapi_auth), [finapi_auth](../../README.md#finapi_auth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `mockBatchUpdate()`

```php
mockBatchUpdate($mock_batch_update_params, $x_request_id)
```

Mock batch update

This service can be used to mock an update of one or several bank connections by letting you simulate finAPI's communication with a bank server. More specifically, you can provide custom balances and transactions for existing accounts and finAPI will import that data into the accounts as if the data had been delivered by a real bank server during a real update. The idea of this service is to allow you to create accounts with specific data in them so that you can test your application in different scenarios.<br/><br/>You can also test your application's reception and processing of push notifications with this service, by enabling the 'triggerNotifications' flag in your request. When this flag is enabled, finAPI will send notifications to your application based on the notification rules that are set up for the user and on the data you provided in the request, the same way as it works with finAPI's real automatic batch update process.<br/><br/>Note that this service behaves mostly like calling the bank connection update service, meaning that it returns immediately after having asynchronously started the update process, and also meaning that you have to check the status of the updated bank connections and accounts to find out when the update has finished and what the result is. As you can update several bank connections at once, this service is closer to how finAPI's automatic batch updates work as it is to the manual update service though. Because of this, the result of the mocked bank connection updates will be stored in the 'lastAutoUpdate' field of the bank connection interface and not in the 'lastManualUpdate' field. Also, just like with the real batch update, any bank connection that you use with this service must have a PIN stored (even though it is not actually forwarded to any bank server).<br/><br/>Also note that this service may be called only when the user's automatic bank connection updates are disabled, to make sure that the mock updates cannot intervene with a real update (please see the User field 'isAutoUpdateEnabled'). Also, it is currently not possible to mock data for security accounts with this service, as you can only pass transactions, but not security positions.<br/><br/>Please be aware that you will 'mess up' the accounts when using this service, meaning that when you perform a real update of accounts that you have previously updated with this service, finAPI might detect inconsistencies in the data that exists in its database and the data that is reported by the bank server, and try to fix this with the insertion of an adjusting entry ('Zwischensaldo' transaction). Also, new real transactions might not get imported as finAPI could match them to mocked transactions. Also note that transactions older than 89 days from the current date will be skipped. <b>THIS SERVICE IS MEANT FOR TESTING PURPOSES DURING DEVELOPMENT OF YOUR APPLICATION ONLY!</b> This is why it will work only on the sandbox or alpha environments. Calling it on the live environment will result in <b>403 Forbidden</b>.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');

// Configure OAuth2 access token for authorization: finapi_auth
$config = OpenAPIAccess\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPIAccess\Client\Api\MocksAndTestsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$mock_batch_update_params = new \OpenAPIAccess\Client\Model\MockBatchUpdateParams(); // \OpenAPIAccess\Client\Model\MockBatchUpdateParams | Data for mock bank connection updates
$x_request_id = 'x_request_id_example'; // string | With any API call, you can pass a request ID. The request ID can be an arbitrary string with up to 255 characters. Passing a longer string will result in an error. If you don't pass a request ID for a call, finAPI will generate a random ID internally. The request ID is always returned back in the response of a service, as a header with name 'X-Request-Id'. We highly recommend to always pass a (preferably unique) request ID, and include it into your client application logs whenever you make a request or receive a response (especially in the case of an error response). finAPI is also logging request IDs on its end. Having a request ID can help the finAPI support team to work more efficiently and solve tickets faster.

try {
    $apiInstance->mockBatchUpdate($mock_batch_update_params, $x_request_id);
} catch (Exception $e) {
    echo 'Exception when calling MocksAndTestsApi->mockBatchUpdate: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **mock_batch_update_params** | [**\OpenAPIAccess\Client\Model\MockBatchUpdateParams**](../Model/MockBatchUpdateParams.md)| Data for mock bank connection updates |
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
