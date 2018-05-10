## Preamble

MPESA released their new API (Application Programming Interface) to enable developers to access M-MobileMoney services; 

These include: 
* _C2B (Customer to Business)_ - Concerned with payments sent from the customer and received to your business. Channels includes  the normal paybill and and till number service, 
* _B2C (Business to Customer)_ - This enables business to send money directly to a customer's phone number from their bulk account. Can be used for *Salary Payments*, *Business Payment* or *Promotion Payment* 
* _B2B (Business to Business)_ - This enables business to pay other businesses. It's the same as B2C but instead of sending money to a personal phone number, you sent to a paybill or till number. 

## Getting Started

#### Step 1: Creating an account on MPESA G2 Portal
The MPESA G2 portal is an online platform where merchants access paybill or till number transactions. The purpose of this step is to create a user who will be sent a One Time Password (OTP) before going live. Although online, you need to install a certificate in your Windows Internet Explorer. Below is the procedure:

To request the weekly certificate password to setup the MPESA portal, kindly send a blank email to *M-pesaCertpassword@safaricom.co.ke*
Click on the link in the auto-responder email to request the certificate. 

::: warning Certificate Notification
Unfortunately, MPESA will not inform you when the certificate is generated and you'll need to go back to the link in the email to install the certificate in Windows Internet Explorer. But you can use Chrome after installing. 
:::

If you don't have an account setup, kindly contact MPESA Business Support on M-PESABusiness@safaricom.co.ke or 0722002222 and request them to setup for you an account on MPESA G2 portal
Login to the MPESA portal by going to [https://org.ke.m-pesa.com](https://org.ke.m-pesa.com/), go to  *Operator Management* and create a user and give the user `Business Manager` and all roles that have an `API` word in them
Ensure you set your phone number to get notification via SMS and not email. For security purposes, the phone number will be sent a one time password (OTP) just before going live. 

#### Step 2: Creating an app on MPESA Developer Portal 
MPESA Developer Portal enables a developer to create an app and use that app to access the MPESA API's.

The purpose of this step is to be able to create an app. There is the test app and live app. The test app is used for development and after going live, an live app will be automatically created. This involves the following steps: 

Go to MPESA Developer Portal (see link below) and create an account

::: tip
Create an app and get the consumer key and consumer secret
:::

#### Step 3: Sandbox and Development
This library will enable you to register endpoint urls and test the API's.
 During this step you'll use the Consumer Key's and Consumer Secret of the test app created in Step 2. 

::: danger Using Non Secure urls
The URL you register need to be SSL or https. You can get a certificate from MPESA and install it on your server or use Lets Encrpt 
:::

#### Step 4: Going live 
After making sure that your code is working correctly, you'll need to go live that is a four sub step processes that enables you to verify you are the actual owner of the API by sending a one time password to the phone number of the user you created in Step 1. 

1. Login to Mpesa Developer portal and click on "Go Live"
2. Verification
    - Verification Step 1: Upload test case. Fortunately or unfortunately, Mpesa does not validate the test cases so just download the excel, fill it and re-upload it :slightly_smiling_face: 
    - Verification step 2: The following is a guide on how to fill the fields in this form
     Verification Type: 
        - Short Code
        - Organization Name - Paybill or Till Company Registration Name
        - Organization Short Code 
        
    For Paybill your short code and for till number, use a head office number and not store number. For till number it's not clearly documented
    MMobileMoney User Name- Use the user name of the user you created in Step 1 above. Note that this is case sensitive.
    We've receive a one time password (OTP) to the number registered in Step 1. 
    - Verification step 3: Enter password received and click "Submit"
    - Verification step 4: Tick all the check and key in the OTP and click "Submit"

3. Switch to the live app and use the live app's Consumer Key's and Secret in the code written in step 3. 
