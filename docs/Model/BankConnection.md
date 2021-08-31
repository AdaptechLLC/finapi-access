# # BankConnection

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | Bank connection identifier |
**name** | **string** | Custom name for the bank connection. You can set this field with the &#39;Edit a bank connection&#39; service, as well as during the initial import of the bank connection. Maximum length is 64. |
**update_status** | **string** | Current status of data download (account balances and transactions/securities). The POST /bankConnections/import and POST /bankConnections/&lt;id&gt;/update services will set this flag to IN_PROGRESS before they return. Once the import or update has finished, the status will be changed to READY. |
**categorization_status** | [**CategorizationStatus**](CategorizationStatus.md) | &lt;strong&gt;Type:&lt;/strong&gt; CategorizationStatus&lt;br/&gt; Current status of transactions categorization. The asynchronous download process that is triggered by a call of the POST /bankConnections/import and POST /bankConnections/&lt;id&gt;/update services (and also by finAPI&#39;s auto update, if enabled) will set this flag to PENDING once the download has finished and a categorization is scheduled for the imported transactions. A separate categorization thread will then start to categorize the transactions (during this process, the status is IN_PROGRESS). When categorization has finished, the status will be (re-)set to READY. Note that the current categorization status should only be queried after the download has finished, i.e. once the download status has switched from IN_PROGRESS to READY. |
**interfaces** | [**\OpenAPIAccess\Client\Model\BankConnectionInterface[]**](BankConnectionInterface.md) | &lt;strong&gt;Type:&lt;/strong&gt; BankConnectionInterface&lt;br/&gt; Set of interfaces that are connected for this bank connection. |
**account_ids** | **int[]** | Identifiers of the accounts that belong to this bank connection |
**owners** | [**\OpenAPIAccess\Client\Model\BankConnectionOwner[]**](BankConnectionOwner.md) | &lt;strong&gt;Type:&lt;/strong&gt; BankConnectionOwner&lt;br/&gt; Information about the owner(s) of the bank connection |
**bank** | [**Bank**](Bank.md) | &lt;strong&gt;Type:&lt;/strong&gt; Bank&lt;br/&gt; Bank that this connection belongs to |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
