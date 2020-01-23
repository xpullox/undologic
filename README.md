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

Fix the errors on the screen


