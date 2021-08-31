# # MultiStepAuthenticationCallback

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**hash** | **string** | Hash that was returned in the previous multi-step authentication error. |
**challenge_response** | **string** | Challenge response. Must be set when the previous multi-step authentication error had status &#39;CHALLENGE_RESPONSE_REQUIRED. | [optional]
**two_step_procedure_id** | **string** | The bank-given ID of the two-step-procedure that should be used for authentication. Must be set when the previous multi-step authentication error had status &#39;TWO_STEP_PROCEDURE_REQUIRED. | [optional]
**redirect_callback** | **string** | Must be passed when the previous multi-step authentication error had status &#39;REDIRECT_REQUIRED&#39;. The value must consist of the complete query parameter list that was contained in the received redirect from the bank. | [optional]
**decoupled_callback** | **bool** | Must be passed when the previous multi-step authentication error had status &#39;DECOUPLED_AUTH_REQUIRED&#39; or &#39;DECOUPLED_AUTH_IN_PROGRESS&#39;. The field represents the state of the decoupled authentication meaning that when it&#39;s set to &#39;true&#39;, the end-user has completed the authentication process on bank&#39;s side.&lt;br/&gt;&lt;br/&gt;Please note: Don&#39;t repeat the service call too frequently. Some banks limit the amount of requests per minute. Our suggestion is to repeat the service call for the decoupled approach every 5 seconds. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
