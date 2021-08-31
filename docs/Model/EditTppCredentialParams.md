# # EditTppCredentialParams

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**tpp_authentication_group_id** | **int** | The TPP Authentication Group Id for which the credentials can be used | [optional]
**label** | **string** | Label for credentials | [optional]
**tpp_client_id** | **string** | ID of the TPP accessing the ASPSP API, as provided by the ASPSP as the result of registration | [optional]
**tpp_client_secret** | **string** | Secret of the TPP accessing the ASPSP API, as provided by the ASPSP as the result of registration | [optional]
**tpp_api_key** | **string** | API Key provided by ASPSP  as the result of registration | [optional]
**tpp_name** | **string** | TPP name | [optional]
**valid_from_date** | **string** | Credentials \&quot;valid from\&quot; date in the format &#39;YYYY-MM-DD&#39;. Default is today&#39;s date | [optional]
**valid_until_date** | **string** | Credentials \&quot;valid until\&quot; date in the format &#39;YYYY-MM-DD&#39;. Default is null which means \&quot;indefinite\&quot; (no limit) | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
