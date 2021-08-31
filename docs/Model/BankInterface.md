# # BankInterface

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**interface** | [**BankingInterface**](BankingInterface.md) | &lt;strong&gt;Type:&lt;/strong&gt; BankingInterface&lt;br/&gt; Bank interface. Possible values:&lt;br&gt;&lt;br&gt;&amp;bull; &lt;code&gt;WEB_SCRAPER&lt;/code&gt; - means that finAPI will parse data from the bank&#39;s online banking website.&lt;br&gt;&amp;bull; &lt;code&gt;FINTS_SERVER&lt;/code&gt; - means that finAPI will download data via the bank&#39;s FinTS server.&lt;br&gt;&amp;bull; &lt;code&gt;XS2A&lt;/code&gt; - means that finAPI will download data via the bank&#39;s XS2A interface.&lt;br&gt; |
**tpp_authentication_group** | [**TppAuthenticationGroup**](TppAuthenticationGroup.md) | &lt;strong&gt;Type:&lt;/strong&gt; TppAuthenticationGroup&lt;br/&gt; TPP Authentication Group which the bank interface is connected to |
**login_credentials** | [**\OpenAPIAccess\Client\Model\BankInterfaceLoginField[]**](BankInterfaceLoginField.md) | &lt;strong&gt;Type:&lt;/strong&gt; BankInterfaceLoginField&lt;br/&gt; Login fields for this interface (in the order that we suggest to show them to the user) |
**properties** | [**BankInterfaceProperty[]**](BankInterfaceProperty.md) |  |
**login_hint** | **string** | Login hint. Contains a German message for the user that explains what kind of credentials are expected.&lt;br/&gt;&lt;br/&gt;Please note that it is essential to always show the login hint to the user if there is one, as the credentials that finAPI requires for the bank might be different to the credentials that the user knows from his online banking.&lt;br/&gt;&lt;br/&gt;Also note that the contents of this field should always be interpreted as HTML, as the text might contain HTML tags for highlighted words, paragraphs, etc. |
**health** | **int** | The health status of this interface. This is a value between 0 and 100, depicting the percentage of successful communication attempts with the bank via this interface during the latest couple of bank connection imports or updates (across the entire finAPI system). Note that &#39;successful&#39; means that there was no technical error trying to establish a communication with the bank. Non-technical errors (like incorrect credentials) are regarded successful communication attempts. |
**last_communication_attempt** | **string** | Time of the last communication attempt with this interface during an import, update or connect interface (across the entire finAPI system). The value is returned in the format &#39;YYYY-MM-DD HH:MM:SS.SSS&#39; (german time). |
**last_successful_communication** | **string** | Time of the last successful communication with this interface during an import, update or connect interface (across the entire finAPI system). The value is returned in the format &#39;YYYY-MM-DD HH:MM:SS.SSS&#39; (german time). |
**is_money_transfer_supported** | **bool** | Whether this interface has the general capability to do money transfers. Note that it still depends on the specifics of an account whether you will actually be able to do money transfers for that account or not - see the field AccountInterface.capabilities for more. In general, you should prefer the field AccountInterface.capabilities to determine what kind of payments an account supports. This field here is meant to be used mainly for when you are planning to do standalone money transfers (finAPI Payment product, i.e. when you do not plan to import an account and thus will not have the data about the account&#39;s exact capabilities). |
**is_ais_supported** | **bool** | Whether this interface has the general capability to perform Account Information Services (AIS), i.e. if this interface can be used to download accounts, balances and transactions. |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)