#!/bin/bash

# from command line arguments
NAME=$1
LOCATION_TMP=$2
LOCATION_STAGING=$3
LOCATION_LIVE=$4
GITHUB_REPO_NAME=$5
GITHUB_USER=$6
GITHUB_PASS=$7
LOCATION_TESTING_BASE=$8
LOCATION_STAGING_LAUNCH_FILES_BASE=$9

# prepared
LOG_FILE="$LOCATION_TMP/$NAME.log"

echo "CHECKOUT: Deleting staging" > "$LOG_FILE"
rm -rf "$LOCATION_STAGING"

echo "CHECKOUT: Downloading website files" > "$LOG_FILE"
# git clone git@github.com:$GITHUB_REPO_NAME.git $LOCATION_STAGING >> "$LOG_FILE"
echo "git clone https://$GITHUB_USER:$GITHUB_PASS@github.com/$GITHUB_REPO_NAME.git $LOCATION_STAGING" >> "$LOG_FILE"
git clone https://$GITHUB_USER:$GITHUB_PASS@github.com/$GITHUB_REPO_NAME.git $LOCATION_STAGING

if [  -d "$LOCATION_STAGING_LAUNCH_FILES_BASE/app" ]; then
  # Control will enter here if $DIRECTORY exists.
  # setup neccesary dirs for later
  mkdir "$LOCATION_STAGING_LAUNCH_FILES_BASE/app/tmp"
  echo -e "CHECKOUT \e[42m files are ready on staging \e[40m - READY" >> "$LOG_FILE"
else
  echo -e "CHECKOUT \e[101m PROBLEMS - tests are failing \e[40m please try again" >> "$LOG_FILE"
fi

#sleep 1
##ensure we have the latest db changes
#echo "2018 SQL being updated > mysql -u$3 -p$4 $2" > /var/log/upgrade
#pv /var/www/vhosts/updateCase.com/staging/app/Config/Schema/2018.sql | mysql -u$3 -p$4 $2
#echo "Finished" > /var/log/upgrade
