# updateCase-boilerPlate
UpdateCase.com project base - Manage and launch your project with Docker and Ansible

### Step 1: Create new Git hub account
Logon to your git hub account and create a new empty project

### Step 2: Clone that account to your computer
Use Php storm (or terminal) to checkout the github files to your computer. You will now have an empty project.

### Step 3: Purchase layout and add source files
Before we start any programming purchase the clients chosen layout and add the raw source
files into the git account, Later the programming will be able to move this into the cakePHP structure. 

### Step 4: Add Ansible / Docker
You can run a simple command to download the files into your project. 
1. Then you can commit into your project separate from this codebase
2. In the future if you want to upgrade to the latest version simply download and overwrite 'roles'. You might need to modify your site.yml
3. Use your terminal and navigate to the base of your project files and run:

#### ALL MODULES (Ansible, Docker, libraries, etc)
CAUTION: this will replace 'readme' 'ansible' 'docker' if they already exist in your project

```
svn export https://github.com/undoLogic/updateCase-boilerPlate/trunk/ . --force
```

#### Export ONLY ansible (optional)

```
svn export https://github.com/undoLogic/updateCase-boilerPlate/trunk/ansible ansible/.
```

#### Export ONLY docker (optional)

```
svn export https://github.com/undoLogic/updateCase-boilerPlate/trunk/docker docker/.
```

#### Export library files only
Included in this boiler plate is basic libraries for handling:
- Switching between languages in your application
- Basic securing your application (this is only meant as the first step and you MUST increase the security later)
- Automated Database interactions

```$xslt
svn export https://github.com/undoLogic/updateCase-boilerPlate/trunk/libraries/cakePHP/2/. libraries/cakePHP/2/. --force
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

Initialization (Once per computer installation only)
```
curl "https://phar.phpunit.de/phpunit-3.7.38.phar" -O
chmod +x phpunit-3.7.38.phar
mv phpunit-3.7.38.phar /usr/local/bin/phpunit.phar
```

Install composer (first time only)
```
brew install composer
```

Ensure your composer.json file in /src includes 
```
"require-dev": {
    "phpunit/phpunit": "^3.7"
},
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
Change GitIgnore to match the number of updateCase variant number you are using
Remove app/tmp
-> create a file 'empty' (This will ensure git saves the directory)

### Step 8: Add Layout
Move the layout from the root (that was added at step 3) and into the cakePHP structure
- WEBROOT/modules/layoutName
Now integrate into (Views/Layouts/default.ctp) 
- Add variable in App_controller in the beforeFilter()
```
$this->set('baseLayout', $this->webroot.'modules'.DS.'layoutName'.DS);
```

Now in your view we need to link to the modules path
-> anywhere you see 'src="assets......' will instead be 'src="<?= $baseLayout; ?>assets......'
-> This also applies to href, url etc

```
<img src="assets/img.jpg"/>
```
will become
```
<img src="<?= $baseLayout; ?>assets/img.jpg"/>
```

IMPORTANT: Make sure you do NOT change href='#' as this will cause problems if you add "....$base; ?>#...."

### Step 9: Bake Models (if required)
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

### Step 10: Connect UpdateCase Module
Our system was developed on the notion that changing text and replacing images should be completed by staff WITHOUT technical experience and all other 
updates should be completed by technical staff. The reason paying a technical programming to fix spelling errors not only is wasting money and time. 
The programmer will prefer to handle more complicated upgrades and will get more satisfaction. On the other hand a non-technical staff can fix spelling 
errors without the ability to break the site will be very satisfied.
- Logon to UpdateCase.com and download the latest version of the plugin into app/webroot
- Follow all the easy instructions within the UpdateCase software to integrate into the site
- You are simply adding a library call on all text / image locations so they will be managed from UpdateCase
- All content is pulled into your site as a FLAT JSON FILE, meaning all content is local and NOT connected to UpdateCase. UpdateCase can be cancelled and this 
website can be moved to a new hosting and continued to run. However moving forward all text / image changes will need to be done via programming only.



### Step 11: Create all your visual pages (concept ONLY)
Build up your navigation and build your site
- Create all the concept pages in the 'Pages' controller
- Using the display function so you only have to create the pages and you do NOT need to create a controller/action for each page (this will compare after approval)
- Name all your pages in this format: prefix-controller-action.ctp
eg client_users_edit
This will only allow 'client' user_types in the Users controller / model using the edit action in the future
-> This allows to prepare and concept out which pages get the correct prefix in advance. 

### Step 12: Approve
Approve all the visual changes with your client BEFORE starting any programming, database development, etc. Nothing is as bad then when you have done work 
that needs to be re-started or radically changed because the concept was not approved. 
At this stage any changes can be easily completed and this helps the client brainstorm with you to create a great intuitive software. 

### Step 13: Programming
Now that all the visuals are approved and all the concepts that need to be programmed have been visualized, the programming should now convert
the visual pages into fully working systems that may interact with a database, external api, etc.

Create most pages with MVC (MODEL-VIEW-CONTROLLER)
-> This is fast to setup and most client actually prefer regular single page loading.

However... as soon as any page requires complicated programming immediately implement AngularJS (API style development)
- This will force you to create a solid API structure that will keep your code of good quality moving forward. 
- Create a model that will get the data you require from the database
- IMPORTANT: Create a Functional test to get this data from your Model / DB
- Test driven development is not much harder to setup and when it is running future modifications are very easy to implament
- After the functional test is complete then create the controller (API END POINT)
- Use Postman to test getting the data OR use CakePHP Tests (RequestAction)
- Now that you have a solid API you can now integrate this feature into your code with AngularJS

IMPORTANT: You should name all of your functions / methods the exact same between all controllers / models / views. you can prepend words to fit into your 
logic, but with the same name you can easily diagnose issues and find references efficiently. 

### Step 14:  
At this point you have a fully functional docker running with a custom website all that is left is a way to automate the publishing to your Staging / LIVE locations. 
Connect Ansible into your pipeline
- Each feature is developed in a branch
- On completion the changes are committed / pushed to that branch
- A pull request is created into MASTER
- Manually if MASTER is working a RELEASE is created 
- Automated system take the release / test and if success push to LIVE

### Step 15: Folder organization with version letter
All folders (elements, css, js, etc) need to have a letter indicating the version. 
This letter is also the same as the current layout. 
Css files also connect to this letter version name: styles-A.css 
Elements folder should have a directory with the version letter Elements/A/files...
This setup allows to do quick A/B testing by setting which version letter is active in the beforeFilter

### Step 16: Efficient integration of new scripts
In order to efficiently integrate new modules, 
you should store all source files in 'modules/NAME' within the webroot
1. Test that the script works before you integrate into the cakePHP code
2. Create a new page WITHOUT using the layout and ensure the script works (linking all scripts to the modules directory)
3. After you have confirmed it is working in modules and a blank page, next integrate the code into the project using the layout
4. After it is all working if you want you can refactor the scripts

### Step 17: Logging
Logging needs to HELP support and troubleshooting NOT only your development. 
What does that mean, it means create levels of logs. 
-- Highlevel: should outlines which functions / methods are being accessed and general state
-- Debug: this can have detailed info which can fill the screen that developers use. So you can put a stop point and look at that state to continue development. 
