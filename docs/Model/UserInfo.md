# # UserInfo

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**user_id** | **string** | User&#39;s identifier |
**registration_date** | **string** | User&#39;s registration date, in the format &#39;YYYY-MM-DD&#39; |
**deletion_date** | **string** | User&#39;s deletion date, in the format &#39;YYYY-MM-DD&#39;. May be null if the user has not been deleted. |
**last_active_date** | **string** | User&#39;s last active date, in the format &#39;YYYY-MM-DD&#39;. May be null if the user has not yet logged in. |
**bank_connection_count** | **int** | Number of bank connections that currently exist for this user. |
**latest_bank_connection_import_date** | **string** | Latest date of when a bank connection was imported for this user, in the format &#39;YYYY-MM-DD&#39;. This field is null when there has never been a bank connection import. |
**latest_bank_connection_deletion_date** | **string** | Latest date of when a bank connection was deleted for this user, in the format &#39;YYYY-MM-DD&#39;. This field is null when there has never been a bank connection deletion. |
**monthly_stats** | [**\OpenAPIAccess\Client\Model\MonthlyUserStats[]**](MonthlyUserStats.md) | &lt;strong&gt;Type:&lt;/strong&gt; MonthlyUserStats&lt;br/&gt; Additional information about the user&#39;s data or activities, broken down in months. The list will by default contain an entry for each month starting with the month of when the user was registered, up to the current month. The date range may vary when you have limited it in the request. &lt;br/&gt;&lt;br/&gt;Please note:&lt;br/&gt;&amp;bull; this field is only set when &#39;includeMonthlyStats&#39; &#x3D; true, otherwise it will be null.&lt;br/&gt;&amp;bull; the list is always ordered from the latest month first, to the oldest month last.&lt;br/&gt;&amp;bull; the list will never contain an entry for a month that was prior to the month of when the user was registered, or after the month of when the user was deleted, even when you have explicitly set a respective date range. This means that the list may be empty if you are requesting a date range where the user didn&#39;t exist yet, or didn&#39;t exist any longer. |
**is_locked** | **bool** | Whether the user is currently locked (for further information, see the &#39;maxUserLoginAttempts&#39; setting in your client&#39;s configuration). Note that deleted users will always have this field set to &#39;false&#39;. |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
