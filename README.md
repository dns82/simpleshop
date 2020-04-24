!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!



SimpleShop Project
=====================

Components
----------

###Server software:

* PHP >7.1
* Mysql

Project structure
-----------------


Development
-----------
- compass compile - run only on local machine, not in box
- after local merge from [dev, master] run in box:

        grunt bump
        grunt string-replace
        
- composer require - not worked
- composer dump-autoload - use very carefully, check autoload classes after running.
- QA / PROD deployment:

        ~/deploy.sh

Links
-----
###Git:
[ssh://git clone git@bitbucket.org:rebus_soft/forevermissed.git](ssh://git clone git@bitbucket.org:rebus_soft/forevermissed.git)


Grunt Tasks and Usage
-----
###Usage
https://gruntjs.com/using-the-cli#installing-the-cli

    grunt --option[task, no-color, etc]
    grunt js:[option] - enable options for custom task (ie: grunt js:prod)

###Backend tasks
    composer-update: Updating composer -> dumpautoload -> new version in conf
    composer-full-clean: Cleaning composer test folders -> dumpautoload
    classes: dumpautoload
    bower-update: updating bower to the latest version
    jshint: generate js error report [all, main, memorial, common, core]
    apigen: generate php classmap documentation
###Deployment tasks
    js: clean -> concat -> uglify
    css: compile css[dev, prod, dev_clean, prod_clean]
    repack: create new build
    
###Local ssl sertificate
https://justmarkup.com/articles/2018-05-31-https-valid-certificate-local-domain/

    openssl req -x509 -days 3650 -new -keyout root.key -out root.cer -config root.cnf
    openssl req -nodes -days 3650 -new -keyout server.key -out server.csr -config server.cnf
    openssl x509 -days 3650 -req -in server.csr -CA root.cer -CAkey root.key -set_serial 123 -out server.cer -extfile server.cnf -extensions x509_ext

also you need add root sertificate to the trusted athorities

###Sharing your local box to the public network
 1. Install vagrant plugin
 
        plugin install vagrant-share
    
 2. Install ngrok on windows , add variables in to PATH
 
    https://ngrok.com/
 
 3. Run in console
 
        ngrok http -host-header=rewrite www.fm-local.com:443
        
 4. Now you can use ngrok web address to access your local machine
 
 ###If info and debug logs does not work
 
    service rsyslog stop
    service rsyslog start
    chkconfig rsyslog on