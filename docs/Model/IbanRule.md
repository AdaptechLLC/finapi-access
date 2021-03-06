# # IbanRule

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | Rule identifier |
**category** | [**Category**](Category.md) | &lt;strong&gt;Type:&lt;/strong&gt; Category&lt;br/&gt; The category that this rule assigns to the transactions that it matches |
**direction** | [**TransactionDirection**](TransactionDirection.md) | &lt;strong&gt;Type:&lt;/strong&gt; TransactionDirection&lt;br/&gt; Direction for the rule. &#39;Income&#39; means that the rule applies to transactions with a positive amount only, &#39;Spending&#39; means it applies to transactions with a negative amount only. |
**creation_date** | **string** | Timestamp of when the rule was created, in the format &#39;YYYY-MM-DD HH:MM:SS.SSS&#39; (german time) |
**iban** | **string** | The IBAN for this rule |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
