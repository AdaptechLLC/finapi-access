# # CreateMoneyTransferParams

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**single_booking** | **bool** | This field is only relevant when you pass multiple orders. It determines whether the orders should be processed by the bank as one collective booking (in case of &#39;false&#39;), or as single bookings (in case of &#39;true&#39;). Note that it is subject to the bank whether it will regard the field. Default value is &#39;false&#39;. | [optional] [default to false]
**account_id** | **int** | Identifier of the account that should be used for the money transfer. If you want to do a standalone money transfer (finAPI Payment product, i.e. for an account that is not imported in finAPI) leave this field unset and instead use the field &#39;iban&#39;. | [optional]
**iban** | **string** | IBAN of the account that should be used for the money transfer. Use this field only if you want to do a standalone money transfer (finAPI Payment product, i.e. for an account that is not imported in finAPI) otherwise, use the &#39;accountId&#39; field and leave this field unset. | [optional]
**execution_date** | **string** | Execution date for the money transfer(s), in the format &#39;YYYY-MM-DD&#39;. May not be in the past. For instant payments, it must be the current date.If not specified, then the current date will be used. | [optional]
**money_transfers** | [**\OpenAPIAccess\Client\Model\MoneyTransferOrderParams[]**](MoneyTransferOrderParams.md) | &lt;strong&gt;Type:&lt;/strong&gt; MoneyTransferOrderParams&lt;br/&gt; List of money transfer orders (may contain at most 15000 items). Please note that collective money transfer may not always be supported. |
**instant_payment** | **bool** | Whether the order should be submitted to the bank as an instant SEPA order. Default value is &#39;false&#39;.&lt;br/&gt;&lt;br/&gt;NOTE:&lt;br/&gt;&amp;bull; Instant payments can only be submitted if you use the Web Form 2.0, or no web form at all - the previous API-integrated version of the web form does not support submitting instant payments.&lt;br/&gt;&amp;bull; Submitting an instant payment will work only with interfaces that support it, see BankInterface.paymentCapabilities.sepaInstantMoneyTransfer&lt;br/&gt;&amp;bull; Instant payments work only for a single order, not for collective orders.&lt;br/&gt;&amp;bull; The bank may charge a fee for instant payments, depending on the agreement between the user and the bank.&lt;br/&gt;&amp;bull; The payment might get rejected if the source and/or target account doesn&#39;t support instant payments. | [optional] [default to false]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
