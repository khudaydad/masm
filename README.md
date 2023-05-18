# Mobile Application Subscription Management API
There are three main operation that the project can handle:

# 1. Registeration
Mobile devices must be registered before making purchases. The same device can have multiple subscription with the different uid or appId.

# 2. Purchase
After the devices are registered, they can make the purchase with a unique token and receipt.

# 3. End Expired Subcriptions
To end all expired subcriptions you can add the command to your crontab:
php .\public\index.php end-expired-subscriptions


# Database
In order to run the project you have to first create the database named "db_masm". Then you run database migration and seed operations.