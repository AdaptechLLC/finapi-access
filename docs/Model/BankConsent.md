# # BankConsent

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**status** | [**BankConsentStatus**](BankConsentStatus.md) | &lt;strong&gt;Type:&lt;/strong&gt; BankConsentStatus&lt;br/&gt; Status of the consent. If &lt;code&gt;PRESENT&lt;/code&gt;, it means that finAPI has a consent stored and can use it to connect to the bank. If &lt;code&gt;NOT_PRESENT&lt;/code&gt;, finAPI will need to acquire a consent when connecting to the bank, which may require login credentials (either passed by the client, or stored in finAPI), and/or user involvement. Note that even when a consent is &lt;code&gt;PRESENT&lt;/code&gt;, it may no longer be valid and finAPI will still have to acquire a new consent. |
**expires_at** | **string** | Expiration time of the consent in the format &#39;YYYY-MM-DD HH:MM:SS.SSS&#39; (german time). |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
