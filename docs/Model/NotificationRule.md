# # NotificationRule

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | Notification rule identifier |
**trigger_event** | **string** | Trigger event type |
**params** | **array<string,string>** | Additional parameters that are specific to the trigger event type. Please refer to the documentation for details. |
**callback_handle** | **string** | The string that finAPI includes into the notifications that it sends based on this rule. |
**include_details** | **bool** | Whether the notification messages that will be sent based on this rule contain encrypted detailed data or not. |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
