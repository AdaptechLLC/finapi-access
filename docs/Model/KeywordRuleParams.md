# # KeywordRuleParams

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**category_id** | **int** | ID of the category that this rule should assign to the matching transactions |
**direction** | [**CategorizationRuleDirection**](CategorizationRuleDirection.md) | &lt;strong&gt;Type:&lt;/strong&gt; CategorizationRuleDirection&lt;br/&gt; Direction for the rule. &#39;Income&#39; means that the rule applies to transactions with a positive amount only, &#39;Spending&#39; means it applies to transactions with a negative amount only. &#39;Both&#39; means that it applies to both kind of transactions. Note that in case of &#39;Both&#39;, finAPI will create two individual rules (one with direction &#39;Income&#39; and one with direction &#39;Spending&#39;). |
**keywords** | **string[]** |  |
**all_keywords_must_match** | **bool** | This field is only relevant if you pass multiple keywords. If set to &#39;true&#39;, it means that all keywords have to be found in a transaction to apply the given category. If set to &#39;false&#39;, then even a single matching keyword in a transaction can trigger this rule. Default value is &#39;false&#39;. | [optional] [default to false]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
