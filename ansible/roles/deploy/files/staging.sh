#!/bin/bash

# from command line arguments
NAME=$1
LOCATION_TMP=$2
LOCATION_STAGING=$3
LOCATION_LIVE=$4
GITHUB_REPO_NAME=$5
GITHUB_USER=$6
GITHUB_PASS=$7

# prepared
LOG_FILE="$LOCATION_TMP/$NAME.log"

echo "CHECKOUT: Deleting staging" > "$LOG_FILE"
rm -rf "$LOCATION_STAGING"

echo "CHECKOUT: Downloading website files" > "$LOG_FILE"

echo "git clone https://$GITHUB_USER:$GITHUB_PASS@github.com/$GITHUB_REPO_NAME.git $LOCATION_STAGING" >> "$LOG_FILE"
git clone https://$GITHUB_USER:$GITHUB_PASS@github.com/$GITHUB_REPO_NAME.git $LOCATION_STAGING

if [  -d "$LOCATION_STAGING/app" ]; then
  # Control will enter here if $DIRECTORY exists.

  # setup neccesary dirs for later
  mkdir "$LOCATION_STAGING/app/tmp"

  echo -e "CHECKOUT \e[42m files are ready on staging \e[40m - READY" >> "$LOG_FILE"
else
  echo -e "CHECKOUT \e[101m PROBLEMS - tests are failing \e[40m please try again" >> "$LOG_FILE"
fi