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

# prepared
LOG_FILE="$LOCATION_TMP/$NAME.log"

echo "TESTING: starting" >> "$LOG_FILE"

# testing
cd "$LOCATION_TESTING_BASE"
echo "cd $LOCATION_TESTING_BASE" >> "$LOG_FILE"

if ../Console/cake test app AllTests | grep -q 'OK ('; then
  #passed tests
  echo -e "TESTING: \e[42m TESTS PASSED - \e[40m - READY" >> "$LOG_FILE"
else
  #tests are failing
  echo -e "TESTING: \e[101m PROBLEMS - tests are failing \e[40m please try again" >> "$LOG_FILE"
fi