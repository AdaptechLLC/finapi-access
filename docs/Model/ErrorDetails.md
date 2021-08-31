# # ErrorDetails

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**message** | **string** | Error message |
**code** | [**ErrorCode**](ErrorCode.md) | &lt;strong&gt;Type:&lt;/strong&gt; ErrorCode&lt;br/&gt; Error code. See the documentation of the individual services for details about what values may be returned. |
**type** | [**ErrorType**](ErrorType.md) | &lt;strong&gt;Type:&lt;/strong&gt; ErrorType&lt;br/&gt; Error type. BUSINESS errors depict error messages in the language of the bank (or the preferred language) for the user, e.g. from a bank server. TECHNICAL errors are meant to be read by developers and depict internal errors. |
**multi_step_authentication** | [**MultiStepAuthenticationChallenge**](MultiStepAuthenticationChallenge.md) | &lt;strong&gt;Type:&lt;/strong&gt; MultiStepAuthenticationChallenge&lt;br/&gt; This field is set when a multi-step authentication is required, i.e. when you need to repeat the original service call and provide additional data. The field contains information about what additional data is required. |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
