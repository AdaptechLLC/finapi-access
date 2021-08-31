# # Payment

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | Payment identifier |
**account_id** | **int** | Identifier of the account to which this payment relates. This field is only set if it was specified upon creation of the payment. |
**iban** | **string** | IBAN of the account to which this payment relates. This field is only set if it was specified upon creation of the payment. |
**type** | [**PaymentType**](PaymentType.md) | &lt;strong&gt;Type:&lt;/strong&gt; PaymentType&lt;br/&gt; Payment type |
**amount** | **float** | Total money amount of the payment order(s), as absolute value |
**order_count** | **int** | Total count of orders included in this payment |
**status** | [**PaymentStatus**](PaymentStatus.md) | &lt;strong&gt;Type:&lt;/strong&gt; PaymentStatus&lt;br/&gt; Current payment status:&lt;br/&gt; &amp;bull; OPEN: means that this payment has been created in finAPI, but not yet submitted to the bank.&lt;br/&gt; &amp;bull; PENDING: means that this payment has been requested at the bank,  but has not been confirmed yet.&lt;br/&gt; &amp;bull; SUCCESSFUL: means that this payment has been successfully initiated.&lt;br/&gt; &amp;bull; NOT_SUCCESSFUL: means that this payment could not be executed successfully.&lt;br/&gt; &amp;bull; DISCARDED: means that this payment was discarded, either because another payment was requested for the same account before this payment was executed and the bank does not support this, or because the bank has rejected the payment even before the execution. |
**bank_message** | **string** | Contains the bank&#39;s response to the execution of this payment. This field is not set until the payment gets executed. Note that even after the execution of the payment, the field might still not be set, if the bank did not send any response message. |
**request_date** | **string** | Time of when this payment was requested, in the format &#39;YYYY-MM-DD HH:MM:SS.SSS&#39; (german time) |
**execution_date** | **string** | Time of when this payment was executed by finAPI, in the format &#39;YYYY-MM-DD HH:MM:SS.SSS&#39; (german time)&lt;br/&gt;Note: this is not necessarily identical to the date when the bank will book the payment, e.g. if a future date was given in the &#39;executionDate&#39; field of the payment. |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
