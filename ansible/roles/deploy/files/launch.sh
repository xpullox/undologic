#!/bin/bash

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

echo "LAUNCHING: Preparing" >> "$LOG_FILE"

cd "$LOCATION_TESTING_BASE"

echo "rsync -av --omit-dir-times --no-perms $LOCATION_STAGING/. $LOCATION_LIVE/." >> "$LOG_FILE"

if ../Console/cake test app AllTests | grep -q 'OK ('; then
  #passed tests
  rsync -av --omit-dir-times --no-perms $LOCATION_STAGING/. $LOCATION_LIVE/.
  echo -e "LAUNCHING: Launched: \e[42m TESTS PASSED and proejct is LIVE - \e[40m - READY" >> "$LOG_FILE"
else
  #tests are failing
  echo -e "LAUNCHING: problems cannot launch: \e[101m PROBLEMS - tests are failing \e[40m please try again" >> "$LOG_FILE"
fi
