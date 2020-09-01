# Send Laravel email template stored in the database

Send Laravel email template stored in the database.

## Quick example
```php
use Codoffer\EmailTemplates\BuildTemplate;

$replacement_values = [
    'FIRST_NAME' => 'Raju',
    'LAST_NAME' => 'Singh',
];

$email_template = new BuildTemplate('WELCOME_USER', $replacement_values);

Mail::to('codoffer@gmail.com')->send($email_template);
```