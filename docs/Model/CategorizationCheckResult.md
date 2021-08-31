# # CategorizationCheckResult

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**transaction_id** | **string** | The transaction identifier. The transactionId of the transaction that was passed to the service as input. This is not an actual ID of a stored transaction in finAPI, as the checkCategorization service doesn&#39;t store any data. |
**category** | [**Category**](Category.md) | &lt;strong&gt;Type:&lt;/strong&gt; Category&lt;br/&gt; A category. The determined transaction category for the given transactionId. This can be null, if the categorization algorithm fails to find a matching rule. |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
