# # TppCertificateParams

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**type** | [**TppCertificateType**](TppCertificateType.md) | &lt;strong&gt;Type:&lt;/strong&gt; TppCertificateType&lt;br/&gt; The type of the submitted certificate |
**public_key** | **string** | A certificate (public key) |
**private_key** | **string** | A private key in PKCS #8 or PKCS #1 format. PKCS #1/#8 private keys are typically exchanged in the PEM base64-encoded format (https://support.quovadisglobal.com/kb/a37/what-is-pem-format.aspx)&lt;br/&gt;&lt;br/&gt;NOTE: The certificate should have one of the following headers:&lt;br/&gt;- &#39;-----BEGIN RSA PRIVATE KEY-----&#39;&lt;br/&gt;- &#39;-----BEGIN PRIVATE KEY-----&#39;&lt;br/&gt;- &#39;-----BEGIN ENCRYPTED PRIVATE KEY-----&#39;&lt;br/&gt;Any other header denotes that the private key is neither in PKCS #8 nor in PKCS #1 formats!&lt;br/&gt;&lt;br/&gt;Also, bear in mind that if the private key is in PKCS #1 encrypted format, the encryption information must be provided with explicitly separated lines (the JSON must contain \&quot;\\n\&quot; at the end of each line), such as in the example below:&lt;br/&gt;-----BEGIN RSA PRIVATE KEY-----&lt;br/&gt;Proc-Type: 4,ENCRYPTED&lt;br/&gt;DEK-Info: AES-256-CBC,BFA11F426E7D634BC621C77A72B804DB&lt;br/&gt;...&lt;br/&gt;-----END RSA PRIVATE KEY----- |
**passphrase** | **string** | Optional passphrase for the private key | [optional]
**ca_public_key** | **string** | A certificate (public key) of the certificate authority (CA) that signed the certificate. Required in certain cases to build the PKI path between Access and the bank&#39;s API when banks do not possess intermediate TLS certificates while placing the trust chain. | [optional]
**label** | **string** | A label for the certificate |
**valid_from_date** | **string** | Start day of the certificate&#39;s validity, in the format &#39;YYYY-MM-DD&#39;. Default is the passed certificate validFrom date | [optional]
**valid_until_date** | **string** | Expiration day of the certificate&#39;s validity, in the format &#39;YYYY-MM-DD&#39;. Default is the passed certificate validUntil date | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
