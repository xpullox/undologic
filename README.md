# updateCase-boilerPlate
UpdateCase.com project base - Manage and launch your project with Docker and Ansible

### Howto
Create a directory - eg 'src' in the root and place your project files there. Outside of this directory will be all the 
different technologies to manage the system (ansible, docker, etc)

### Step 1: Create new Git hub account
Logon to your git hub account and create a new emtpy project

### Step 2: Clone that account to your computer
Use Php storm to checkout the github files. You will now have an empty project
or terminal git clone .....

### Step 3: Add Ansible / Docker
You can run a simple command to download the files into your project. 
1. Then you can commit into your project separate from this codebase
2. In the future if you want to upgrade to the latest version simply download and overwrite 'roles'. You might need to modify your site.yml
3. Use your terminal and navigate to the base of your project files and run:

#### ALL MODULES
CAUTION: this will replace 'readme' 'ansible' 'docker' if you would rather NOT replace these use the single commands below
```
svn export https://github.com/undoLogic/updateCase-boilerPlate/trunk/ . --force
```

#### ONLY ansible

```
svn export https://github.com/undoLogic/updateCase-boilerPlate/trunk/ansible ansible/.
```

#### ONLY docker

```
svn export https://github.com/undoLogic/updateCase-boilerPlate/trunk/docker docker/.
```

### Step 4: Add CakePHP 2.x
You are now ready to add your source files

#### CakePHP 2.x
This downloads the raw project from CakePHP and will place all files into 'src' directory. 

```
wget https://github.com/cakephp/cakephp/archive/2.10.20.zip
```
If you do NOT have wget, you can manually download the files using your browser
https://github.com/cakephp/cakephp/archive/2.10.20.zip

```
unzip 2.10.20.zip
mv cakephp-2.10.20 src
```

### Step 5: Startup docker / test project
Right click '2startDocker.sh' OR '3restartDocker.sh'

Navigate to
http://localhost/src

Fix the errors on the screen in src/app/Config/core.php
- Change the security salt, etc
- uncomment date_default_timezone_set('UTC');

### Step 6: Using included libraries
Included in this boiler plate is basic libraries for handling:
- Switching between languages in your application
- Basic securing your application (this is only meant as the first step and you MUST increase the security later)
- Automated Database interactions

```$xslt
svn export https://github.com/undoLogic/updateCase-boilerPlate/trunk/libraries/cakePHP/2/Controller/Component/. src/app/Controller/Component/. --force
```

### Step 7: Adding functional testing
Allows to setup automated testing to ensure your important functions in your project behave the same before launch. 
This allows for rapid development. NOTE: This is NOT unit testing

```
curl "https://phar.phpunit.de/phpunit-3.7.38.phar" -O
chmod +x phpunit-3.7.38.phar
mv phpunit-3.7.38.phar /usr/local/bin/phpunit.phar

```

Ensure your composer.json file in /src has 
```
"require-dev": {
    "phpunit/phpunit": "^3.7"
},
```

Install composer
```
brew install composer
```

Install based on the composer file
```angular2
cd src
composer install
```

You should now be able to navigate and start building your tests
```angular2
localhost/src/test.php
```

To Create a TEST: create a file in /src/app/Test/Case/Model/PageTest.php
```angular2
<?php

App::uses('Controller', 'Controller');
App::uses('CakeRequest', 'Network');
App::uses('CakeResponse', 'Network');
App::uses('ComponentCollection', 'Controller');

class PageTest extends CakeTestCase
{
    //add fixtures later when connecting database models
    public $fixtures = array(
        //'app.Quote',
    );

    function testGetConditionsSearch() {
        $this->assertEquals(1, 1, "This will pass");
        //$this->assertEquals(1, 0, "This will FAIL");
    }
}
```
