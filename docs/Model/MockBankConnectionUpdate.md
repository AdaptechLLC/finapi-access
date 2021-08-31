# # MockBankConnectionUpdate

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**bank_connection_id** | **int** | Bank connection identifier |
**interface** | [**BankingInterface**](BankingInterface.md) | &lt;strong&gt;Type:&lt;/strong&gt; BankingInterface&lt;br/&gt; Banking interface to update. If not specified, then first available interface in bank connection will be used. | [optional]
**simulate_bank_login_error** | **bool** | Whether to simulate the case that the update fails due to incorrect banking credentials. Note that there is no real communication to any bank server involved, so you won&#39;t lock your accounts when enabling this flag. Default value is &#39;false&#39;. | [optional] [default to false]
**mock_accounts_data** | [**\OpenAPIAccess\Client\Model\MockAccountData[]**](MockAccountData.md) | &lt;strong&gt;Type:&lt;/strong&gt; MockAccountData&lt;br/&gt; Mock accounts data. Note that for accounts that exist in a bank connection but that you do not specify in this list, the service will act like those accounts are not received by the bank servers. This means that any accounts that you do not specify here will be marked as deprecated. If you do not specify this list at all, all accounts in the bank connection will be marked as deprecated. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
