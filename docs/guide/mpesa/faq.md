- How long does it take for my app to be approved?
>The approval will be done within 24hours.

- I am getting the error ‘OTP not created’ when I initiate the GO-LIVE process.
>This could be either because you have not activated your business manager and/or business operator roles within your paybill organization on the M-PESA Portal, or because there you have not activated the SMS notification as the preferred channel for notification the roles above within the paybill organization.
Kindly log into the M-PESA portal, then activate the roles and ensure you have enable the MSISDNs for those roles for to receive SMS notifications.

- I am getting the error “Initiator information” is invalid. What does this mean?
Kindly check for spaces before and after pasting the security credential. Select the security credential, Make sure when you put them on the field 'initiator security password' there is no space before or after, then click generate credentials and copy the long code i.e. your security credential.

- When I get the error ‘App Not Created’, what does this mean?
>This error is because the Organization name you specified during the verification process is too long or contains more than 2 spaces.

- How do I edit the username and KYC on M-PESA portal?
>Note the following that needs to be done on M-PESA portal:
    - If you are not a Business Administrator or Business manager role you will need to create a business manager role and log in in order to activate it and thus edit the KYC.
If the status for the user is still “pending active” it means you have not logged in with your user credentials. You will need to log in with the user credentials you created in order to activate the user account.
Click on search then organization,
On organization enter your organization Short Code and click search,
Under operators select your preferred operator and click on the details tab on the right of the name,
On the KYC tab you will see the details tab on the far right,
Click and edit the preferred contact phone number under personal details in format 254XXXXXXXXX,
Go down under contact details and change preferred notification channel from email to SMS,
Click on submit and it will save, now try generate OTP again.

- What is a ‘Shortcode’?
>A shortcode is the unique number that is allocated to a paybill or buy goods organization through they will be able to receive customer payment. It could be a Paybill, Buy Goods or Till Number.

- What Shortcode do you use?
>When testing in the sandbox environment all APIs Shortcode 1 = all APIs except B2B i.e. ‘Party B’ where you use Short Code 2.
Lipa na M-MobileMoney online Short code = 174379 (FOR LIPA NA MPESA ONLINE ONLY.)

The test credentials are provided in Sandbox

- ERRORS

SPID correlator error.

It means, there was a previous register URL done. This URL needs to be deleted for new ones to be registered.

Kindly send an official mail to apifeedback@safaricom.co.ke and request for new URLs to be registered.

 

How do I re-register URL’s

Kindly send mail to apifeedback@safaricom.co.ke indicating the paybill number and the both old and the new URLs you want to register

 

No paybill verification data found

This means that you are either using the wrong paybill details, paybill is not active or you are using a child paybill.

 

Under verification, the help toolkit shows "7 Digit Short Code” and the paybill no. is only 6 –Digits

7 digits is the maximum number, 6 should be able to work as well

 

Can you integrate using child paybill number?

No, it is not possible.

 

Bad Request - Invalid InitiatorName

Client using the wrong initiator name provided.  Should copy and paste the one provided on the test credentials.

 

The verification fails for some reason:

I have a till number and I was never given an online portal because I transact using my phone. How can I request for approval to production on this?

Send mail to m-pesabusiness@safaricom.co.ke and request for access.

 

 

How do I generate a token on sandbox?

Kindly go to the API menu

Under the list of API click on the OAuth API
On the right, click on the GENERATE TOKEN
Scroll down to the Query parameters and click on the HTTP BASIC
On the pop up, enter your Consumer key and Consumer Secret (This are found under my app, view app details tab, Keys)
Save to set authentications
Click on send this request button
Your requests will be generated and access token available below on tab “Response”
 

Getting error in callback response - Invalid Input parameter 'Prompt message prefix', length should be less than 94 characters

You need to shorten Account reference and transaction description to around 10

 

'APP not created' in production

Organization name is either too long or has a space in between

 

How long do I wait for you do activate my validation?

24hours

 

How do I get SSL certificate –From any trusted CA
