# Package with send Newsletters
### Installation
    Add the code bellow to your composer.json file:

        "repositories": [
            {
                "type": "vcs",
                "url": "git@bitbucket.org:abss-clients/newsletter.git"
            }
        ],

    Than run command:

    composer require abss/sending_subscribe_mail

    Added to your config/app.php file next string in providers array:
        \Abss\Sending_subscribe_mails\Providers\NewsletterProvider::class
    Then run command:
    php artisan vendor:publish --provider="Abss\Sending_subscribe_mails\Providers\NewsletterProvider" 

    After that setup config file subscribe_mail.php

### Usage
    1)Setup type provider in confing file(Mailchimp,Brevo,CampaignMonitor)
    2)Added api keys in config file( mailchimp,brevo OR campaignmonitor) , related
      what service you want to use
    3)In namespace write use Abss\Sending_subscribe_mails\Services\NewsLetterService

    The all response have 2 state : Success and Error. 
    Success:
    [
            'status' => 'Success',
            'body' => $data
    ];
    Error:
    [
            'status' => 'Error',
            'body' => $data
    ];

    (R)-required
    (S)-type of filed (S-string,B-boolean,etc)

# Mailchimp
    Methods:
### NewsLetterService::getCampaigns()

### NewsLetterService::createCampaign($attributes)
    $attributes=[
        (R)(S)'type'=>There are four types of campaigns you can create in Mailchimp. A/B Split campaigns have been deprecated 
                and variate campaigns should be used instead. Possible values: "regular", "plaintext", "absplit", "rss", 
                or "variate".,
        (O/A)'rss_opts'=>[
                (O)'shedule'=>The schedule for sending the RSS Campaign(hour/daily_send_weekly_send_day,monthly_send_date),
                (B)'constrain_rss_img'=>Whether to add CSS to images in the RSS feed to constrain their width in campaigns.,
                (S)'feed_url'=>The URL for the RSS feed,
                (S)'frequency'=>The frequency of the RSS Campaign. Possible values: "daily", "weekly", or "monthly".,
        ],
        (O/A)'recipients'=>[
            (O/A)'segment_opts'=>An object representing all segmentation options. This object should contain a 
                            saved_segment_id to use an existing segment, or you can create a new segment by including 
                            both match and conditions options(saved_segment_id,match,conditions)[
                        (I)'saved_segment_id'=>The id for an existing saved segment.,
                        (S)'match'=>Segment match type. Possible values: "any" or "all".,
                        (A)'conditions'=>Segment match conditions. There are multiple possible types
                ]
            (R)(S)'list_id'=>The unique list id.
        ]
        (O/A)'variate_settings'=> The settings specific to A/B test campaigns.[
            (I)'wait_time'=>The number of minutes to wait before choosing the winning campaign. The value of wait_time must 
                          be greater than 0 and in whole hours, specified in minutes.
            (I)'test_size=>The percentage of recipients to send the test combinations to, must be a value between 10 and 100.
            (S)'subject_lines'=>The possible subject lines to test. If no subject lines are provided, settings.subject_line will be used.
            (S)'send_times'=>The possible send times to test. The times provided should be in the format YYYY-MM-DD HH:MM:SS. 
                           If send_times are provided to test, the test_size will be set to 100% and winner_criteria will be ignored.
            (S)'from_names'=>The possible from names. The number of from_names provided must match the number of reply_to_addresses. 
                           If no from_names are provided, settings.from_name will be used.
            (S)'reply_to_addresses'=>The possible reply-to addresses. The number of reply_to_addresses provided must match 
                            the number of from_names. If no reply_to_addresses are provided, settings.reply_to will be used.
            (S)'winner_criteria'=>The combination that performs the best. This may be determined automatically by click rate, open rate,
                                or total revenue -- or you may choose manually based on the reporting data you find the most valuable. 
                                For Multivariate Campaigns testing send_time, winner_criteria is ignored. For Multivariate Campaigns 
                                with 'manual' as the winner_criteria, the winner must be chosen in the Mailchimp web application. 
                                Possible values: "opens", "clicks", "manual", or "total_revenue".
         ],
        (O/A)'settings'=>[
            (S)'subject_line'=>The subject line for the campaign.,
            (S)'preview_text'=>The preview text for the campaign.,
            (S)'title'=>The title of the campaign.,
            (S)'from_name'=>The 'from' name on the campaign (not an email address).,
            (S)'reply_to'=>The reply-to email address for the campaign. Note: while this field is not required for campaign creation, it is required for sending.
            (B)'use_conversation'=>Use Mailchimp Conversation feature to manage out-of-office replies.,
            (S)'to_name'=>The campaign's custom 'To' name. Typically the first name audience field.,
            (S)'folder_id'=>If the campaign is listed in a folder, the id for that folder.,
            (B)'authenticate'=>Whether Mailchimp authenticated the campaign. Defaults to true.,
            (B)'auto_footer'=>Automatically append Mailchimp's default footer to the campaign.,
            (B)'inline_css'=>Automatically inline the CSS included with the campaign content.,
            (B)'auto_tweet'=>Automatically tweet a link to the campaign archive page when the campaign is sent.,
            (S)'auto_fb_post'=>An array of Facebook page ids to auto-post to.,
            (B)'fb_comments'=>Allows Facebook comments on the campaign (also force-enables the Campaign Archive toolbar). Defaults to true.,
            (I)'template_id'=>The id of the template to use.
        ],
        (O/A)'tracking'=>[
            (B)'opens'=>Whether to track opens. Defaults to true. Cannot be set to false for variate campaigns.,
            (B)'html_clicks'=>Whether to track clicks in the HTML version of the campaign. Defaults to true. Cannot be set to false for variate campaigns.,
            (B)'text_clicks'=>Whether to track clicks in the plain-text version of the campaign. Defaults to true. Cannot be set to false for variate campaigns.,
            (B)'goal_tracking'=>Deprecated,
            (B)'ecomm360'=>Whether to enable e-commerce tracking.,
            (S)'google_analytics'=>The custom slug for Google Analytics tracking (max of 50 bytes).,
            (S)'clicktale'=>The custom slug for ClickTale tracking (max of 50 bytes).,
            (O/A)'salesforce'=>Deprecated[
                (B)'campaign'=>Create a campaign in a connected Salesforce account.,
                (B)'notes'=>Update contact notes for a campaign based on subscriber email addresses.
            ],
            (O/A)'capsule'=>Deprecated[
                (B)'notes'=>Update contact notes for a campaign based on subscriber email addresses.
            ]
        ],
        (O/A)'social_card'=>The preview for the campaign, rendered by social networks like Facebook and Twitter[
            (S)'image_url'=>The url for the header image for the card.,
            (S)'description'=>A short summary of the campaign to display.,
            (S)'title'=>The title for the card. Typically the subject line of the campaign.
        ],
        (S)'content_type'=>How the campaign's content is put together. The old drag and drop editor uses 'template' while 
                        the new editor uses 'multichannel'. Defaults to template. Possible values: "template" or "multichannel".
    ];

### NewsLetterService::updateCampaign($campaign_id, $attributes)
    $attributes=>same like create

### NewsLetterService::deleteCampaign($campaign_id)

### NewsLetterService::sendCampaign($campaign_id)

### NewsLetterService::getStatusForCampaign($campaign_id)

### NewsLetterService::setHTMLForCampaign($campaign_id,$attributes)
    (O/A)'archive'=>Available when uploading an archive to create campaign content. The archive should include all campaign content and images[
        (S)'archive_type'=>The type of encoded file. Defaults to zip. Possible values: "zip", "tar.gz", "tar.bz2", "tar", "tgz", or "tbz",
        (S)'archive_conten'=>The base64-encoded representation of the archive file
    ],
    (O/A)'template'=>Use this template to generate the HTML content of the campaign[
        (O/A)'sections'=>Content for the sections of the template. Each key should be the unique mc:edit area name from the template.
        (I)'id'=>The id of the template to use.
    ],
    (S)'plain_text'=>The plain-text portion of the campaign. If left unspecified, we'll generate this automatically.
    (S)'html'=>The raw HTML for the campaign.,
    (S)'url'=>When importing a campaign, the URL where the HTML lives.,
    (O/A)'variate_contents'=>Content options for Multivariate Campaigns. Each content option must provide HTML content and may 
                        optionally provide plain text. For campaigns not testing content, only one object should be provided.[
        (O/A)'archive'=>Available when uploading an archive to create campaign content. The archive should include all campaign content and images[
            (S)'archive_content'=>The base64-encoded representation of the archive file.,
            (S)'archive_type'=>The type of encoded file. Defaults to zip. Possible values: "zip", "tar.gz", "tar.bz2", "tar", "tgz", or "tbz.
        ],
        (O/A)'template'=>Use this template to generate the HTML content for the campaign[
            (I)'id'=>The id of the template to use.,
            (O/A)'sections'=>Content for the sections of the template. Each key should be the unique mc:edit area name from the template.
        ],
        (S)'content_label'=>The label used to identify the content option.,
        (S)'plain_text'=>The plain-text portion of the campaign. If left unspecified, we'll generate this automatically.
        (S)'html'=>The raw HTML for the campaign.,
        (S)'url'=>When importing a campaign, the URL for the HTML.
    ]

### NewsLetterService::setTextForCampaign($campaign_id,$attributes)
    $attributes= same like upper

### NewsLetterService::getLists()

### NewsLetterService::createLists($attributes)
    $attributes=[
        (R)(S)'name'=>The name of the list.,
        (R)(O/A)'contact'=>Contact information displayed in campaign footers to comply with international spam laws.[
            (S)'address2'=>The street address for the list contact.,
            (S)'state'=>The state for the list contact.,
            (S)'zip'=>The postal or zip code for the list contact.,
            (S)'phone'=>The phone number for the list contact.,
            (R)(S)'company'=>The company name for the list.,
            (R)(S)'address1'=>The street address for the list contact.,
            (R)(S)'city'=>The city for the list contact.,
            (R)(S)'country'=>A two-character ISO3166 country code. Defaults to US if invalid.
        ],
        (R)(S)'permission_reminder'=>The permission reminder for the list.,
        (R)(O/A)'campaign_defaults'=>Default values for campaigns created for this list.[
            (R)(S)'from_name'=>The default from name for campaigns sent to this list.,
            (R)(S)'from_email'=>The default from email for campaigns sent to this list.,
            (R)(S)'subject'=>The default subject line for campaigns sent to this list.,
            (R)(S)'language'=>The default language for this lists's forms.
        ],
        (R)(B)'email_type_option'=>Whether the list supports multiple formats for emails. When set to true, subscribers can 
                    choose whether they want to receive HTML or plain-text emails. When set to false, subscribers will 
                    receive HTML emails, with a plain-text alternative backup.,
        (B)'use_archive_bar'=>Whether campaigns for this list use the Archive Bar in archives by default.,
        (S)'notify_on_subscribe'=>The email address to send subscribe notifications to.,
        (S)'notify_on_unsubscribe'=>The email address to send unsubscribe notifications to.,
        (B)'double_optin'=>Whether or not to require the subscriber to confirm subscription via email.
        (B)'marketing_permissions'=>Whether or not the list has marketing permissions (eg. GDPR) enabled.
    ]

### NewsLetterService::getSegments($list_id)

### NewsLetterService::createSegment($list_id, $attributes)
    $attributes=[
        (R)(S)'name'=>The name of the segment.,
        (S)'static_segment'=>An array of emails to be used for a static segment. Any emails provided that are not present 
                        on the list will be ignored. Passing an empty array will create a static segment without any 
                        subscribers. This field cannot be provided with the options field.,
        (O/A)'options'=>The conditions of the segment. Static and fuzzy segments don't have conditions.[
            (S)'match'=>Match type. Possible values: "any" or "all".,
            (A)'conditions'=>Segment match conditions. There are multiple possible types, see the condition types documentation.
        ]
    ]

### NewsLetterService::getSubscribersForList($list_id)

### NewsLetterService::addSubscriberToList($list_id, $attributes)
    $attributes=[
        (R)(B)'email_address'=>Email address for a subscriber.,
        (R)(S)'status'=>Subscriber's current status. Possible values: "subscribed", "unsubscribed", "cleaned", "pending", or "transactional".
        (O/A)'email_type'=>Type of email this member asked to get ('html' or 'text').,
        (O/A)'merge_fields'=>A dictionary of merge fields where the keys are the merge tags,
        (O/A)'interests'=>The key of this object's properties is the ID of the interest in question.,
        (S)'language'=>If set/detected, the subscriber's language.,
        (B)'vip'=>VIP status for subscriber.,
        (O/A)'location'=>Subscriber location information.[
            (N)'latitude'=>The location latitude.,
            (N)'longitude'=>The location longitude.
        ],
        (O/A)'marketing_permissions'=>The marketing permissions for the subscriber.[
            (S)'marketing_permission_id'=>The id for the marketing permission on the list,
            (B)'enabled'=>If the subscriber has opted-in to the marketing permission.
        ],
        (S)'ip_signup'=>IP address the subscriber signed up from.б
        (S)'timestamp_signup'=>The date and time the subscriber signed up for the list in ISO 8601 format.,
        (S)'ip_opt'=>The IP address the subscriber used to confirm their opt-in status.,
        (S)'timestamp_opt'=>The date and time the subscriber confirmed their opt-in status in ISO 8601 format.,
        (S)'tags'=>The tags that are associated with a member.
    ]

### NewsLetterService::removeSubscriberFromList($list_id, $subscriber_hash)

### NewsLetterService::subscriberValidateEmailAddress($email)

### NewsLetterService::subscriberIsOnList($list_id)

### NewsLetterService::getSubscriberStatusForList($list_id, $subscriber_hash)

# Brevo
    Methods:

### NewsLetterService::getCampaigns()
### NewsLetterService::createCampaign($attributes)
    $attributes=[
        (S)'tag'=>Tag of the campaign,
        (R)(A/O)'sender'=>[
            (S)'name'=>Sender Name,
            (S)'email'=>Sender email,
            (I)'id'=>Select the sender for the campaign on the basis of sender id.In order to select a sender with specific
                    pool of IP’s, dedicated ip users shall pass id (instead of email).

            ],
        (R)(S)'name'=>Name of the campaign,
        (URL)'htmlContent'=>Mandatory if htmlContent and templateId are empty. Url to the message (HTML). For example:
                    https://html.domain.com,
        (I)'templateId'=>Mandatory if htmlContent and htmlUrl are empty. Id of the transactional
                        email template with status active. Used to copy only its content fetched
                        from htmlContent/htmlUrl to an email campaign for RSS feature.,
        (S)'scheduledAt'=>Sending UTC date-time (YYYY-MM-DDTHH:mm:ss.SSSZ). Prefer to pass your timezone in date-time format for accurate result.
                    If sendAtBestTime is set to true, your campaign will be sent according to the date passed (ignoring the time part). For example:
                    2017-06-01T12:30:00+02:00,
        (S)'subject'=>Subject of the campaign. Mandatory if abTesting is false.Ignored if abTesting is true.
        (S)'previewText'=>Preview text or preheader of the email campaign,
        (S)'replyTo'=>Email on which the campaign recipients will be able to reply to
        (S)'toField'=>To personalize the To Field. If you want to include the first name and last name of your recipient, add {FNAME} {LNAME}. These contact 
                attributes must already exist in your Brevo account. If input parameter params used please use {{contact.FNAME}} {{contact.LNAME}} for personalization
        (O/A)'recipients'=>Segment ids and List ids to include/exclude from campaign[
            (A)'exclusionListIds'=>List ids to exclude from the campaign,
            (A)'listIds'=>Mandatory if scheduledAt is not empty. List Ids to send the campaign to
            (A)'segmentIds'=>Mandatory if listIds are not used. Segment ids to send the campaign to.   
        (URL)'attachmentUrl'=>Absolute url of the attachment (no local file).Extension allowed:xlsx, xls, ods, docx, docm, doc, csv, pdf, txt, gif, jpg, jpeg, png, tif, tiff, rtf,
                        bmp, cgm, css, shtml, html, htm, zip, xml, ppt, pptx, tar, ez, ics, mobi, msg, pub and eps
            
        (B)'inlineImageActivation'=>Use true to embedded the images in your email. Final size ofthe email should be less than 4MB. Campaigns with embedded images can not be sent to more than 
                            5000 contacts,
        (B)'mirrorActive'=>Use true to enable the mirror link,
        (S)'footer'=>Footer of the email campaign,
        (S)'header'=>Header of the email campaign,
        (S)'utmCampaign'=>Customize the utm_campaign value. If this field is empty, the campaign name will be used. Only alphanumeric characters and spaces are allowed
        (O/A)'params'=>Pass the set of attributes to customize the type classic campaign. For example: {"FNAME":"Joe", "LNAME":"Doe"}. Only available if type is classic. It's considered only if 
                campaign is in New Template Language format. The New Template Language is dependent on the values of subject, htmlContent/htmlUrl, sender.name & toField
        (B)'sendAtBestTime'=>Set this to true if you want to send your campaign at best time.
        (B)'abTesting'=>Status of A/B Test. abTesting = false means it is disabled & abTesting = true means it is enabled. subjectA, subjectB, splitRule, winnerCriteria & winnerDelay will be 
                    considered when abTesting is set to true. subjectA & subjectB are mandatory together & subject if passed is ignored. Can be set to true only if sendAtBestTime is false.
                    You will be able to set up two subject lines for your campaign and send them to a random sample of your total recipients. Half of the test group will receive version A, 
                    and the other half will receive version B,
        (S)'subjectA'=>Subject A of the campaign. Mandatory if abTesting = true. subjectA & subjectB should have unique value,
        (S)'subjectB'=>Subject B of the campaign. Mandatory if abTesting = true.subjectA & subjectB should have unique value,
        (I)'splitRule'=>Add the size of your test groups. Mandatory if abTesting = true & 'recipients' is passed. We'll send version A and B to a random sample of recipients, and then the winning version to everyone else,
        (S)'winnerCriteria'=>Choose the metrics that will determinate the winning version. Mandatory if splitRule >= 1 and < 50. If splitRule = 50, winnerCriteria is ignored if passed
        (I)'winnerDelay'=>Choose the duration of the test in hours. Maximum is 7 days, pass 24*7 = 168 hours. The winning version will be sent at the end of the test. Mandatory if splitRule >= 1 and < 50. If splitRule = 50, 
                        winnerDelay is ignored if passed,
        (B)'ipWarmupEnable'=>Available for dedicated ip clients. Set this to true if you wish to warm up your ip.
        (I)'initialQuota'=>Mandatory if ipWarmupEnable is set to true. Set an initial quota greater than 1 for warming up your ip. We recommend you set a value of 3000.
        (I)'increaseRate'=>Mandatory if ipWarmupEnable is set to true. Set a percentage increase rate for warming up your ip. We recommend you set the increase rate to 30% per day. If you want to send the same number of emails 
                            every day, set the daily increase value to 0%.,
        (S)'unsubscriptionPageId'=>Enter an unsubscription page id. The page id is a 24 digit alphanumeric id that can be found in the URL when editing the page. If not entered, then the default unsubscription page will be used.
        (S)'updateFormId'=>Mandatory if templateId is used containing the {{ update_profile }} tag. Enter an update profile form id. The form id is a 24 digit alphanumeric id that can be found in the URL when editing the form. 
                            If not entered, then the default update profile form will be used.
        ],
    ];

### NewsLetterService::updateCampaign($campaign_id, $attributes)
        $attributes=>same like create

### NewsLetterService::deleteCampaign($campaign_id)
### NewsLetterService::sendCampaign($campaign_id)
### NewsLetterService::getStatusForCampaign($campaign_id)
### NewsLetterService::setHTMLForCampaign($campaign_id, $attributes)
    $attributes=[
        (S)'htmlContent'=>Body of the message (HTML version). If the campaign is designed using Drag & Drop editor via HTML content, then the design page will not have Drag & Drop editor access for that campaign. REQUIRED if htmlUrl 
                        is empty
    ]

### NewsLetterService::setTextForCampaign($campaign_id, $attributes)
    $attributes=[
        (S)'previewText'=>Preview text or preheader of the email campaign
    ]

### NewsLetterService::getLists()
### NewsLetterService::createLists($attributes)
    $attributes=[
        (R)(S)'name'=>Name of the list,
        (R)(I)'folderId'=>Id of the parent folder in which this list is to be created
    ]

### NewsLetterService::getSegments($list_id)
### NewsLetterService::getSubscribersForList($list_id)
### NewsLetterService::addSubscriberToList($list_id, $attributes)
    $attributes=[
        (R)(I)'listId'=>Id of the list
    ]

### NewsLetterService::removeSubscriberFromList($list_id)
### NewsLetterService::subscriberValidateEmailAddress($email)
### NewsLetterService::subscriberIsOnList($list_id)
### NewsLetterService::getListsForSubscriber($subscriber_id)

# Campaign Monitor
    Methods:

### NewsLetterService::getCampaigns()
### NewsLetterService::createCampaign($attributes)
    $attributes=[
        (S)"Name": "My Campaign Name",
        (S)"Subject": "My Subject",
        (S)"FromName": "My Name",
        (S)"FromEmail": "myemail@mydomain.com",
        (S)"ReplyTo": "myemail@mydomain.com",
        (S)"HtmlUrl": "http://example.com/campaigncontent/index.html",
        (O/A)"ListIDs": [
            "a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1",
            "a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1"
        ],
        (O/A)"SegmentIDs": [
            "a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1",
            "a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1"
        ]
    ]

### NewsLetterService::deleteCampaign($campaign_id)
### NewsLetterService::sendCampaign($campaign_id)
### NewsLetterService::setHTMLForCampaign($campaign_id, $attributes)
    $attributes=[
        (S)"Name": "Template Two",
        (S)"HtmlPageURL": "http://example.com/index.html",
        (S)"ZipFileURL": "http://example.com/files.zip"
    ]
### NewsLetterService::setTextForCampaign($campaign_id, $attributes)
        $attributes=[
        (S)"Name": "My Campaign Name",
        (S)"Subject": "My Subject",
        (S)"FromName": "My Name",
        (S)"FromEmail": "myemail@mydomain.com",
        (S)"ReplyTo": "myemail@mydomain.com",
        (S)"HtmlUrl": "http://example.com/campaigncontent/index.html",
        (O/A)"ListIDs": [
            "a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1",
            "a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1"
        ],
        (O/A)"SegmentIDs": [
            "a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1",
            "a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1a1"
        ]
    ]
    In this method we have only one option ->create new compaign with text ,we can't update only text

### NewsLetterService::getLists()
### NewsLetterService::createLists($attributes)
    $attributes=[
        (S)"Title": "Website Subscribers",
        (S)"UnsubscribePage": "http://www.example.com/unsubscribed.html",
        (S)"UnsubscribeSetting": "AllClientLists",
        (B)"ConfirmedOptIn": false,
        (S)"ConfirmationSuccessPage": "http://www.example.com/joined.html"
    ]

### NewsLetterService::getSegments($list_id)
### NewsLetterService::getSubscribersForList($list_id)
### NewsLetterService::addSubscriberToList($list_id, $attributes)
    $attributes=[
        (S)"EmailAddress": "subscriber@example.com",
        (S)"Name": "New Subscriber",
        (S)"MobileNumber": "+5012398752",
        (O/A)"CustomFields": [
            {
                (S)"Key": "website",
                (S)"Value": "http://example.com"
            },
            {
                (S)"Key": "interests",
                (S)"Value": "magic"
            },
            {
                (S)"Key": "interests",
                (S)"Value": "romantic walks"
            }
        ],
        (B)"Resubscribe": true,
        (B)"RestartSubscriptionBasedAutoresponders": true,
        (S)"ConsentToTrack":"Yes",
        (S)"ConsentToSendSms":"Yes"
    ]

### NewsLetterService::subscriberValidateEmailAddress($email)
### NewsLetterService::subscriberIsOnList($list_id)