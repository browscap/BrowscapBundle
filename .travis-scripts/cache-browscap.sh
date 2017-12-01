#!/bin/bash
set -e

if [ ! -f "$TRAVIS_BUILD_DIR/Resources/browscap.ini" ]; then
  mkdir -p $TRAVIS_BUILD_DIR/Resources
  wget http://browscap.org/stream?q=Full_PHP_BrowsCapINI -O $TRAVIS_BUILD_DIR/Resources/browscap.ini
else
  echo "Using cached browscap.ini"
fi
