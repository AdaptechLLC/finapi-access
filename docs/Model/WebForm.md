# # WebForm

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | Web Form identifier, as returned in the 451 response of the REST service call that initiated the Web Form flow. |
**token** | **string** | Token for the finAPI Web Form page, as contained in the 451 response of the REST service call that initiated the Web Form flow (in the &#39;Location&#39; header). |
**status** | [**WebFormStatus**](WebFormStatus.md) | &lt;strong&gt;Type:&lt;/strong&gt; WebFormStatus&lt;br/&gt; Status of a Web Form. Possible values are:&lt;br/&gt;&amp;bull; NOT_YET_OPENED - the Web Form URL was not yet called;&lt;br/&gt;&amp;bull; IN_PROGRESS - the Web Form has been opened but not yet submitted by the user;&lt;br/&gt;&amp;bull; COMPLETED - the user has opened and submitted the Web Form;&lt;br/&gt;&amp;bull; ABORTED - the user has opened but then aborted the Web Form, or the Web Form was aborted by the finAPI system because it has expired (this is the case when a Web Form is opened and then not submitted within 10 minutes) |
**service_response_code** | **int** | HTTP response code of the REST service call that initiated the Web Form flow. This field can be queried as soon as the status becomes COMPLETED or ABORTED. Note that it is still not guaranteed in this case that the field has a value, i.e. it might be null. |
**service_response_body** | **string** | HTTP response body of the REST service call that initiated the Web Form flow. This field can be queried as soon as the status becomes COMPLETED or ABORTED. Note that it is still not guaranteed in this case that the field has a value, i.e. it might be null. |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
