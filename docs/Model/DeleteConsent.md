# # DeleteConsent

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**local** | [**DeleteConsentResult**](DeleteConsentResult.md) | &lt;strong&gt;Type:&lt;/strong&gt; DeleteConsentResult&lt;br/&gt; Result of deleting a consent stored in the finAPI database (local):&lt;br/&gt;&lt;br/&gt;&amp;bull; &lt;code&gt;DELETED&lt;/code&gt; - when there was a stored consent and it was deleted.&lt;br/&gt;&amp;bull; &lt;code&gt;NOT_EXIST&lt;/code&gt; - if there is no stored consent.&lt;br/&gt; |
**remote** | [**DeleteConsentResult**](DeleteConsentResult.md) | &lt;strong&gt;Type:&lt;/strong&gt; DeleteConsentResult&lt;br/&gt; Result of deleting a consent stored on the bank&#39;s side (remote):&lt;br/&gt;&lt;br/&gt;&amp;bull; &lt;code&gt;DELETED&lt;/code&gt; - if the consent was successfully deleted on the bank side.&lt;br/&gt;&amp;bull; &lt;code&gt;NOT_SUPPORTED&lt;/code&gt; - if the bank doesn&#39;t support the feature of deleting consents.&lt;br/&gt;&amp;bull; &lt;code&gt;NOT_EXIST&lt;/code&gt; - if either there is no remote consent, or there is no local consent (and that makes impossible to identify any remote data).&lt;br/&gt; |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
