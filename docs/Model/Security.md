# # Security

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | Identifier. Note: Whenever a security account is being updated, its security positions will be internally re-created, meaning that the identifier of a security position might change over time. |
**account_id** | **int** | Security account identifier |
**name** | **string** | Name |
**isin** | **string** | ISIN |
**wkn** | **string** | WKN |
**quote** | **float** | Quote |
**quote_currency** | **string** | Currency of quote |
**quote_type** | [**SecurityPositionQuoteType**](SecurityPositionQuoteType.md) | &lt;strong&gt;Type:&lt;/strong&gt; SecurityPositionQuoteType&lt;br/&gt; Type of quote. &#39;PERC&#39; if quote is a percentage value, &#39;ACTU&#39; if quote is the actual amount |
**quote_date** | **string** | Quote date in the format &#39;YYYY-MM-DD HH:MM:SS.SSS&#39; (german time). |
**quantity_nominal** | **float** | Value of quantity or nominal |
**quantity_nominal_type** | [**SecurityPositionQuantityNominalType**](SecurityPositionQuantityNominalType.md) | &lt;strong&gt;Type:&lt;/strong&gt; SecurityPositionQuantityNominalType&lt;br/&gt; Type of quantity or nominal value. &#39;UNIT&#39; if value is a quantity, &#39;FAMT&#39; if value is the nominal amount |
**market_value** | **float** | Market value |
**market_value_currency** | **string** | Currency of market value |
**entry_quote** | **float** | Entry quote |
**entry_quote_currency** | **string** | Currency of entry quote |
**profit_or_loss** | **float** | Current profit or loss |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
