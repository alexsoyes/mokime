#!/bin/bash
set -e

if [ "$1" == "" ]; then
  echo 'You must specify a version number.'
  exit 0;
fi

OUTPUT_FILE="versions/mokime.$1.zip"

if [ -e "${OUTPUT_FILE}" ]; then
  rm -v "${OUTPUT_FILE}"
fi

cd ..
zip -9 -rqq "${OUTPUT_FILE}" . \
    -x="*docs/*" \
    -x="*README.md*" \
    -x="*.json*" \
    -x="*.git/*" \
    -x="*.gitignore*" \
    -x="*node_modules/*" \
    -x="*scripts/*"

du -hs "${OUTPUT_FILE}"
md5sum "${OUTPUT_FILE}"