## Table of Content
You will encounter the following errors when working with the MPESA-API

[[toc]]

## (STK_CB) DS Timeout
#### Description and Possible Causes
Applies to Lipa Na Mpesa API. 
It means that the STK Push Prompt never got to the user. 
Causes include:
- The user not having an updated SIM Card, thus needs an update
- The SIM card being too old (3+ years) to have received the STK Update to allow access to this service.
- Mobile phone is offline.

#### Solution
- Update SIM card via *234*1*6# or Upgrade SIM card
- Make sure target SIM card's mobile phone is online.

## SMSC ACK Timeout

#### Description and Possible Causes
Applies to Lipa Na Mpesa API. It means that the STK Push Prompt got to the customer but the response by the customer was not sent back on time. 
::: warning 
This is a backend API issue, not a user issue.
:::
#### Solution
Simply retry again after receiving the callback. 
::: tip
Make sure to notify the user that the request failed
:::

## (STK_CB) Request Cancelled By User

#### Description and Possible Causes
Applies to Lipa Na Mpesa API. Means that STK Push Prompt was cancelled from user end.
Causes are:	
- STK Prompt timed out waiting for user input (takes between 1-3 minutes depending on phone model).
- User literally cancelled the request on their phones.

#### Solution

Depending on scenario, either inform the user that they did not respond, or just cancel the transaction, then retry again.

## Unable To Lock Subscriber, A Transaction Is Already In Process For The Current Subscriber

#### Description and Possible Causes

Means the user already has another STK Prompt currently active on their mobile phones.

#### Solution
Inform the user, then retry after 2-3 minutes (time taken to automatically cancel an STK Prompt)

## The Initiator Information Is Invalid

#### Description and Possible Causes
This error and the rest of the "information is invalid" errors usually applies to Reversal, Transaction Status, Account Balance, B2B and B2C APIs. 

It means there is a mismatch in the data provided by the user in the request.
These include:
- Incorrect Initiator username for above API requests
- Incorrect Initiator password, or password not encrypted, or wrongly encrypted, for above API requests
- Incorrect values for Parties A and B, and Identifier Types where used


#### Solution

- Make sure the Initiator username is correct. 
This can be checked against what you have on your credentials page or the username that was assigned to you from the MPesa Portal
- *For API*'s with Initiator Identifier Types parameter, ensure the Initiator value matches the Initiator Type value e.g. for paybills, Initiator Identifier type is 11. 
For the Sender/Party A and Receiver/Party B Identifier types, Paybills have identifier type 4, Till Numbers have identifier type 2, and MSISDNs/Phone numbers have Identifier type 1.
- *For operators*, make sure the password is encrypted using the correct public key certificate, and that the encryption algorithm used actually produces the correct result. 
You can also just encrypt the password using the provided portal tools and use it as a static value in your API calls to make work easier.
Also make sure the initiator belongs to the shortcode being used, as the initiator has a direct relation to the shortcode used in the transaction. 
Also, make you do not copy paste additional spaces during password encryption.
 This causes alot of issues as the resulting password is completely different from the expected one.
- *In the API calls*, the Sender/PartyA represents the Debit party (party being debited the cash), and the Receiver/PartyB represents the credit party (party receiving the cash value).
 Make sure you use the correct value for each e.g. for B2C, the sender is the Shortcode, the receiver is the MSISDN/Phone number. In B2B requests, both the sender and receiver are shortcode numbers, but NOT the same shortcode.
  Also, please do not confuse B2B requests (movement of funds between different paybills) with intra-account transfers (movement of funds from Working to Utility accounts and vice versa within same paybill)
- *For reversal calls*, make sure the Initiator belongs to the shortcode reversing the transaction, and that the transaction being reversed was not debited from the initiator's paybill. 
You cannot reverse a transaction debited from your own account.|

## The Receiver Information Is Invalid
Similar to [above](#the-initiator-information-is-invalid)

## Credit Party Customer Type (Unregistered Or Registered Customer) Can't Be Supported By The Service

#### Description and Possible Causes

This applies to C2B, B2C and Lipa na MPesa API.
 It means the number in the request is not recorded with MPesa, whether as a registered or unregistered customer
 
#### Solution
 - Ensure the phone number being used in the transaction is registered with MPesa.
 
## Invalid Access Token Error

#### Description and Possible Causes

Applies to all APIs. Means the access token used in the API calls (usually preceded by the word Bearer) is expired or invalid.

#### Solution

- On Sandbox, the token usually lasts for 1 hour, so refresh the token again by sending a new Generate Token API call

## Invalid Amount

#### Description and Possible Causes

Means you have entered a weird value as the amount

#### Solution
::: tip MPESA AMOUNT LIMITS 
- C2B requests cannot have amounts greater than **Ksh. 70,000** in the request, 
- All APIs cannot have amounts below **Ksh. 0.**
- All APIs cannot have amounts going above **Ksh. 999,999,999** in value.
 I also don't think you got such an amount in your account :) :) :)
:::
- Make sure the amount makes sense :frowning_face: and is actually valid for the transaction. See the above limits

## Transaction Failed, Mpesa Cannot Complete Payment

#### Description and Possible Causes

MPesa was not able to complete the transaction in the back end.
This is usually due to an MPesa rule not being fulfilled in the back end, thus depends on the API being used.
#### Solution
For each API, you need to make sure all prerequisites are fulfilled before making the request. 
These include:
- For B2C requests, the client has to make sure the transaction does not cause their accounts to exceed the maximum allowed limit of 100K.
- For C2B, it means the paybill being used may have external validation enabled, and that it failed, thus confirm external validation is disabled, or that it went through and was accepted.
- Otherwise, means there was an error on the backend we are not aware of. So try again later.

## Paybill Verification Failed Due To The Following Reason: 

No Paybill Verification Data Found Service Request For Registration...

#### Description and Possible Causes
Occurs during the Go Live process. 
Means M-Pesa could not find the required data on the paybill to verify the person taking the shortcode to production.

#### Solution

Follow the instructions in the Go Live process above to update your KYC data on the MPesa Portal, then try again.

## Merchant Not Allowed To Carry Out Transaction Type CustomerPayBillOnline

#### Description and Possible Causes

Occurs in Lipa na Mpesa API, mostly production. 
Means the shortcode (paybill or till number) being used by the merchant is not allowed to perform Lipa na MPesa API calls using the **CustomerPayBillOnline** Command ID. 
Same goes for **CustomerBuyGoodsOnline** Command ID.
It could also mean you are using the wrong command ID for your shortcode.

#### Solution

You need to request to have the Command ID enabled on your shortcode.
Send the request to apifeedback@safaricom.co.ke requesting for your shortcode to have the shortcode enabled for Lipa na Mpesa API. 
You will then also receive a passkey to use in your requests. 
Also make sure you are using the correct command ID for your shortcode i.e. CustomerPayBillOnline for Paybill numbers, CustomerBuyGoodsOnline for Till numbers.

## Missing ICCID value in request

#### Description and Possible Causes

Occurs on Lipa na MPesa API. 
Means the number you have entered is not a Safaricom registered number, or it's blocked/inactive/dead.

#### Solution

Ensure the number you are using is actually a Safaricom number, it is registered, and is not blocked/inactive e.t.c.

## Internal Server Error In Crq Creation, Please Try Again

#### Description and Possible Causes

Happens on the Go Live process. 
This is an error on the back-end

#### Solution

Nothing you can do about this. Just keep retrying till it works.

## System Internal Error

#### Description and Possible Causes

Also an error on the back-end.

#### Solution

Also keep retrying till it works.
If it persists, escalate to the support team
