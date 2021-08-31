# # AccessToken

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**scope** | **string** | Requested scopes (it&#39;s always &#39;all&#39;) |
**access_token** | **string** | Access token. Token has a length of up to 128 characters. |
**refresh_token** | **string** | Refresh token. Only set in case of grant_type&#x3D;&#39;password&#39;. Token has a length of up to 128 characters. | [optional]
**token_type** | **string** | Token type (it&#39;s always &#39;bearer&#39;) |
**expires_in** | **int** | Expiration time in seconds. A value of 0 means that the token never expires (unless it is explicitly invalidated, e.g. by revocation, or when a user gets locked). |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
