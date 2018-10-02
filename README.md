[![PHP version](https://badge.fury.io/ph/aspose%2Fcloud-sdk-php.svg)](http://badge.fury.io/ph/aspose%2Fcloud-sdk-php)

#Aspose Cloud SDK for PHP Repository

This repository holds Aspose Cloud SDK for PHP source code. This SDK allows you to work with Aspose REST API in your PHP applications quickly and easily.

Installation
----------------------------------

Add the following line to your composer.json file:

```json
// composer.json
{
    require: {
        "aspose/cloud-sdk-php": "~1.1"
    }
}
```

Install the new dependencies by running `composer update` from the directory where your composer.json file is located.
 


##What's included in this SDK repository?

<table>
<tr>
<th>Module</th>
<th>Description</th>
</tr>

<tr>
<td>Common</td>
<td>This module provides the features commonly used by other sections of the SDK.</td>
</tr>

<tr>
<td>Storage</td>
<td>This module provides the features to work with Aspose storage.</td>
</tr>

<tr>
<td>Pdf</td>
<td>This module provides the features to manipulate PDF file formats using Aspose.Pdf for Cloud.</td>
</tr>

<tr>
<td>Words</td>
<td>This module provides the features to manipulate word processing file formats using Aspose.Words for Cloud.</td>
</tr>

<tr>
<td>Cells</td>
<td>This module provides the features to manipulate spreadsheet file formats using Aspose.Cloud for Cloud.</td>
</tr>

<tr>
<td>Slides</td>
<td>This module provides the features to manipulate presentations file formats using Aspose.Slides for Cloud.</td>
</tr>

<tr>
<td>BarCode</td>
<td>This module provides the features to create and detect BarCodes images using Aspose.BarCode for Cloud.</td>
</tr>

<tr>
<td>Email</td>
<td>This module provides the features to manipulate email file formats using Aspose.Email for Cloud.</td>
</tr>

<tr>
<td>OCR</td>
<td>This module provides the features to detect text from images using Aspose.OCR for Cloud.</td>
</tr>

<tr>
<td>Imaging</td>
<td>This module provides the features to process image file formats using Aspose.Imaging for Cloud.</td>
</tr>

<tr>
<td>Tasks</td>
<td>This module provides the features to process Microsoft Project file formats using Aspose.Tasks for Cloud.</td>
</tr>

</table>



### Data

In order to manipulate any files, you first need to upload them to the Aspose Cloud storage using Storage module. 

### Output

The Aspose Cloud SDK for PHP allows you to save the output files at your specified location.

Make use of the EventDispatcher
-------------------------------

The SDK allows you to alter the calls made by [connecting `EventListeners`](http://symfony.com/doc/current/components/event_dispatcher/introduction.html#connecting-listeners). You can simply register a php callable in your code by using the following example:

```php
use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Event\ProcessCommandEvent;

$dispatcher = AsposeApp::getEventDispatcher();
$dispatcher->addListener(ProcessCommandEvent::PRE_CURL, function (ProcessCommandEvent $event) {
    // will be executed when the ProcessCommandEvent::PRE_CURL event is dispatched
    curl_setopt($event->getSession(), CURLOPT_TIMEOUT, 60); 
});
```

The SDK currenlty dispatches the following events. Please use the Event class constants in your code to register to the specific events.

<table>
<tr>
<th>Module</th>
<th>Event names</th>
<th>Description</th>
</tr>

<tr>
<td>Utils</td>
<td>ProcessCommandEvent::PRE_CURL</td>
<td>Allows you to alter the curl session before the call is executed.</td>
</tr>

<tr>
<td>Utils</td>
<td>ProcessCommandEvent::POST_CURL</td>
<td>Allows you to alter the curl session and response after the curl request is executed, but before the curl session is closed.</td>
</tr>

<tr>
<td>Utils</td>
<td>ValidateOutputEvent::VALIDATE_OUTPUT</td>
<td>Allows you to add extra validation on the result, by altering the invalid variable.</td>
</tr>

<tr>
<td>Pdf & Document</td>
<td>SplitPageEvent::PAGE_IS_SPLIT</td>
<td>Triggers after a SDK split call, for each page that was split. This allows you to use the `$outputFile` and `$pageNumber` directly after it was saved by `Utils::saveFile`.</td>
</tr>

</table>

Docs
----

For SDK API Ref Docs, please go through [API Docs](http://asposeforcloud.github.io/php-sdk-docs/).
For SDK Usage Examples, please go through [wiki](https://github.com/asposeforcloud/Aspose_Cloud_SDK_For_PHP/wiki).
For Aspose Cloud APIs related help, please go through [Aspose.Total for Cloud](http://www.aspose.com/cloud/total-api.aspx).

Start a Free Trial Today
------------------------

Start a free trial today – all you need is to [sign up](https://cloud.aspose.com/SignUp) with Aspose for Cloud service. Once you have signed up, you are ready to try powerful file processing features offered by Aspose for Cloud.
