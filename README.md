# updateCase-boilerPlate
UpdateCase.com project base - Manage and launch your project with Docker and Ansible

### Step 1: Create new Git hub account
Logon to your git hub account and create a new empty project

### Step 2: Clone that account to your computer
Use Php storm (or terminal) to checkout the github files to your computer. You will now have an empty project.

### Step 3: Add Ansible / Docker
You can run a simple command to download the files into your project. 
1. Then you can commit into your project separate from this codebase
2. In the future if you want to upgrade to the latest version simply download and overwrite 'roles'. You might need to modify your site.yml
3. Use your terminal and navigate to the base of your project files and run:

#### ALL MODULES (Ansible, Docker, library, etc)
CAUTION: this will replace 'readme' 'ansible' 'docker' if they already exist in your project

```
svn export https://github.com/undoLogic/updateCase-boilerPlate/trunk/ . --force
```

#### Export ONLY ansible

```
svn export https://github.com/undoLogic/updateCase-boilerPlate/trunk/ansible ansible/.
```

#### Export ONLY docker

```
svn export https://github.com/undoLogic/updateCase-boilerPlate/trunk/docker docker/.
```

#### Export library files only
Included in this boiler plate is basic libraries for handling:
- Switching between languages in your application
- Basic securing your application (this is only meant as the first step and you MUST increase the security later)
- Automated Database interactions

```$xslt
svn export https://github.com/undoLogic/updateCase-boilerPlate/trunk/libraries/cakePHP/2/Controller/Component/. src/app/Controller/Component/. --force
```

### Step 4: Install Ansible / Docker (FIRST TIME ONLY)

```angular2
brew install ansible
```

```angular2
@todo ADD DOCKER BREW CASK function here 
```

### Step 5: Add CakePHP 2.x
You are now ready to add your source files

#### CakePHP 2.x
This downloads the raw project from CakePHP and will place all files into 'src' directory. 

### 2.x version
```angular2
svn export https://github.com/cakephp/cakephp/branches/2.x
mv 2.x src 
```

#### Import our boiler plate on top of a fresh cakePHP install with standard settings
```angular2
rsync -av libraries/cakePHP/2/. src/app/.
```

### Step 6: Startup docker / test project
Look into the docker folder
Right click '2startDocker.sh' OR '3restartDocker.sh'

Navigate to
```angular2
http://localhost/src
```

First time cleanup and preparation
- Fix any errors (src/app/Config/core.php - security salt, etc)
- Uncomment date_default_timezone_set('UTC');
- Ensure gitignore is correct to prevent any large files from being uploaded

### Step 7: Adding functional testing
Allows to setup automated testing to ensure your important functions in your project behave the same before launch. 
This allows for rapid development. 

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

### gitignore
modify the file in /src
remove the app/tmp
-> put an empty file there


### Step 8: Add Layout
Download your preferred Bootstrap layout and add all the source files to WEBROOT/modules/layoutName

Update your layout in CakePHP (Views/Layouts/default.ctp) with the main view from your layout

Use $base (as a variable in App_controller) to link all the scripts to the original location of the layout (in modules) and place this at the top of all VIEW pages

```
<?php $base = $this->webroot.'modules/layoutName/'; ?>
```

Now in your view, anywhere you see 'src=assets' will instead be 'src=<?= $base; ?>assets'
-> This also applies to href, url etc

```
<img src="assets/img.jpg"/>
```
would become
```
<img src="<?= $base; ?>assets/img.jpg"/>
```

NOTE: Make sure you do not change href='#' to href='<?= $base; ?>#" as this will cause problems

### Step 9: Create all your visual pages
Build up your navigation and build your site

### Step 10: Approve
Approve all the visual changes with your client BEFORE starting any programming. Nothing is as bad then when you have done work 
that needs to be re-started or radically changed because the concept was not approved.

### Step 11: Programming
Now that all the visuals are approved and all the concepts that need to be programmed have been visualized, the programming should now convert
the visual pages into fully working systems that may interact with a database, external api, etc.

We recommend the following workflow 
- First enable your views by using CakePHP basic functionality. This gets your pages up and running quickly and fully working

However as soon as any page requires complicated programming immediately implement AngularJS
- This will force you to create a solid API structure that will keep your code of good quality moving forward. 
- Create a model that will get the data you require from the database
- IMPORTANT: Create a Functional test to get this data from your Model / DB
- Test driven development is not much harder to setup and when it is running future modifications are very easy to implament
- After the functional test is complete then create the controller (API END POINT)
- Use Postman to test getting the data OR use CakePHP Tests (RequestAction)
- Now that you have a solid API you can now integrate this feature into your code with AngularJS

IMPORTANT: You should name all of your functions / methods the exact same between all controllers / models / views. you can prepend words to fit into your 
logic, but with the same name you can easily diagnose issues and find references efficiently. 

### Step 11b: Bake Models
The models are created by using BAKE

in the terminal navigate to the base directory of your project

Login to your docker shell

```angular2
cd docker
docker ps
# find the 'web' 
docker exec -it docker_web_1 bash 
# You are now logged into the docker 
cd /var/www/vhosts/website.com/
cd www
cd app (cd /path/to/app)
./Console/cake bake
```

### Step 12: Connect UpdateCase Module
Our system was developed on the notion that changing text and replacing images should be completed by staff WITHOUT technical experience and all other 
updates should be completed by technical staff. The reason paying a technical programming to fix spelling errors not only is wasting money and time. 
The programmer will prefer to handle more complicated upgrades and will get more satisfaction. On the other hand a non-technical staff can fix spelling 
errors without the ability to break the site will be very satisfied.
- Logon to UpdateCase.com and download the latest version of the plugin into app/webroot
- Follow all the easy instructions within the UpdateCase software to integrate into the site
- You are simply adding a library call on all text / image locations so they will be managed from UpdateCase
- All content is pulled into your site as a FLAT FILE, meaning all content is local and NOT connected to UpdateCase. UpdateCase can be cancelled and this 
website can be moved to a new hosting and continued to run. However moving forward all text / image changes will need to be done via programming only.

### Step 13:  
At this point you have a fully functional docker running with a custom website all that is left is a way to automate the publishing to your Staging / LIVE locations. 
Connect Ansible into your pipeline
- Each feature is developed in a branch
- On completion the changes are committed / pushed to that branch
- A pull - request is created into MASTER
- Manually if MASTER is working a RELEASE is created 
- Automated system take the release / test and if success push to LIVE

### Step 14: Folder organization with version letter
All folders need to have a letter indicating the version. 
This letter is also the same as the current layout. 
Css files also connect to this letter version name: styles-A.css 
Elements folder should have a directory with the verion letter Elements/A/files...
This setup allows to do quick A/B testing by setting which version letter is active in the beforeFilter

### Step 15: Efficient integration of new scripts
In order to efficiently integrate new modules, 
you should store all source files in 'modules/NAME' within the webroot
1. Test that the script works before you integrate into the cakePHP code
2. Create a new page WITHOUT using the layout and ensure the script works (linking all scripts to the modules directory)
3. After you have confirmed it is working in modules and a blank page, next integrate the code into the project using the layout
4. After it is all working if you want you can refactor the scripts
