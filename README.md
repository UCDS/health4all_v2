health4all_v2
=============
**********************************************************************************************************
CONTENTS
**********************************************************************************************************
1. Demo
2. Installation Instruction

***********************************************************************************************************
#1. DEMO

Visit http://code4community/health4all_test
Username : admin
Password : password


***********************************************************************************************************
#2. INSTALLATION INSTRUCTIONS

Setup the application
-----------------------------------
Once you downloaded the applcation, moved it into the www folder, you will need to modify a few files before
starting to use the application.

File : application/config/config.php
------------------------------------
$config['base_url'] = 'Path to your application folder here';

date_default_timezone_set("Timezone of your preference here");

File : .htaccess
------------------------------------
You don't need to make any changes here if you've placed the folder directly in your www folder and the folder name
is 'health4all', if you make any changes to the name or path you need to modify this path and change the file path wherever mentioned.

File : application/config/database.php
------------------------------------
In this file you will modify the database configurations, 
the database host, username, password and database name are to be changed.


Run the application
-------------------------------------
Once you've made these changes, you will be able to run the application from your browser.

To use the features in this application after installation, you will require to login with the following credentials,
Default Username : admin
Default Password : password

