# Welcome to MiniSend

A transactional email app where a client could send an email through a Laravel API and also would have the ability to see how many emails have been sent, and track more interesting data about them through a VueJS frontend.
  
## Setting up the Environment

For ease, use Docker with Laravel Sail.

1. Clone down this repo.

1. **sail up**

1. **sail composer install**

1. **sail artisan migrate**

1. **sail npm install**

1. Laravel horizon is needed to run the jobs. **sail artisan horizon**

1. You may access the mail client on http://minisend.test:8025 or according to your configuration

<br />

## Requesting a User Token

To start, you'll need to create a user. You can do this by making a post request to **/api/user-token**, name and email are required.

<br />

**Request:**

```json
{
    "name": "John Doe",
    "email": "john.doe@example.com"
}
```

The response of this request will be your API token. Use this token as your Authorization's Bearer token to access other API endpoints. The same API token will be used to access the front-end dashboard.

<br />

## Sending an email via API

To send an email, make a post request to **/api/email**

You may also attachment multiple files, make sure the key name is **attachments**

The file size limit is 10MB and the supported file types is similar to MailerSend.
https://developers.mailersend.com/api/v1/email.html#send-an-email

<br />

**Request:**
```json
{
  "from": {
    "email": "hello@mailersend.com",
    "name": "MailerSend"
  },
  "to": {
      "email": "john@mailersend.com",
      "name": "John Mailer"
    },
  "subject": "Hello from MailerSend!",
  "text": "This is just a friendly hello from your friends at MailerSend.",
  "html": "<b>This is just a friendly hello from your friends at MailerSend.</b>",
}

```

The response will have a X-Email-ID header, this will contain the email message ID of your request.
If you wish to delete the email you can make a DELETE request to **/api/email/{email_id}**.
Note that you can only delete the message if it has not been sent yet.

<br />

## Viewing the dashboard

To access the dashboard just visit the app on your browser. Your credentials will be the email you provided and the API token you received.
