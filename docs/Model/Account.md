# # Account

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | Account identifier |
**bank_connection_id** | **int** | Identifier of the bank connection that this account belongs to |
**account_name** | **string** | Account name |
**iban** | **string** | Account&#39;s IBAN. Note that this field can change from &#39;null&#39; to a value - or vice versa - any time when the account is being updated. This is subject to changes within the bank&#39;s internal account management. |
**account_number** | **string** | (National) account number. Note that this value might change whenever the account is updated (for example, leading zeros might be added or removed). |
**sub_account_number** | **string** | Account&#39;s sub-account-number. Note that this field can change from &#39;null&#39; to a value - or vice versa - any time when the account is being updated. This is subject to changes within the bank&#39;s internal account management. |
**account_holder_name** | **string** | Name of the account holder |
**account_holder_id** | **string** | Bank&#39;s internal identification of the account holder. Note that if your client has no license for processing this field, it will always be &#39;XXXXX&#39; |
**account_currency** | **string** | Account&#39;s currency |
**account_type** | [**AccountType**](AccountType.md) | &lt;strong&gt;Type:&lt;/strong&gt; AccountType&lt;br/&gt; An account type.&lt;br/&gt;&lt;br/&gt;Checking,&lt;br/&gt;Savings,&lt;br/&gt;CreditCard,&lt;br/&gt;Security,&lt;br/&gt;Loan,&lt;br/&gt;Pocket (DEPRECATED; will not be returned for any account unless this type has explicitly been set via PATCH),&lt;br/&gt;Membership,&lt;br/&gt;Bausparen&lt;br/&gt;&lt;br/&gt; |
**balance** | **float** | Current account balance |
**overdraft** | **float** | Current overdraft |
**overdraft_limit** | **float** | Overdraft limit |
**available_funds** | **float** | Current available funds. Note that this field is only set if finAPI can make a definite statement about the current available funds. This might not always be the case, for example if there is not enough information available about the overdraft limit and current overdraft. |
**is_new** | **bool** | Indicating whether this account is &#39;new&#39; or not. Any newly imported account will have this flag initially set to true, and remain so until you set it to false (see PATCH /accounts/&lt;id&gt;). How you use this field is up to your interpretation, however it is recommended to set the flag to false for all accounts right after the initial import of the bank connection. This way, you will be able recognize accounts that get newly imported during a later update of the bank connection, by checking for any accounts with the flag set to true right after an update. |
**interfaces** | [**\OpenAPIAccess\Client\Model\AccountInterface[]**](AccountInterface.md) | &lt;strong&gt;Type:&lt;/strong&gt; AccountInterface&lt;br/&gt; Set of interfaces to which this account is connected |
**is_seized** | **bool** | Whether this account is seized. Note that this information is not received from the bank, but determined by finAPI based on the available account information. |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
