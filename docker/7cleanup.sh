#!/bin/bash

#cleaning
docker volume ls -qf dangling=true | xargs -r docker volume rm