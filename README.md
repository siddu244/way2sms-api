way2sms-api
===========

simple api for way2sms.com

1. First register to way2sms.com website by going to http://site21.way2sms.com/content/index.html
2. use the username and password obtained here to send message

To integrate it to your website :
    1. Give full write permissions to your working folder
        like-   sudo chmod 777 '/var/www/sms'
    2. clone this repository to your directory
    3. add require "way2sms-api.php"; to your page
    4. start using sendmsg($username,$password,$to_mobilenumber,$message) function with parameters specified accrodingly.
        
        enjoy...
