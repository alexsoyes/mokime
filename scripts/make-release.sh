#!/bin/bash
set -e

OUTPUT_FILE="versions/mokime.zip"

if [ -e "${OUTPUT_FILE}" ]; then
  rm -v "${OUTPUT_FILE}"
fi

zip -9 -rqq "${OUTPUT_FILE}" . \
    -x="*docs/*" \
    -x="*README.md*" \
    -x="*.json*" \
    -x="*.git/*" \
    -x="*versions*" \
    -x="*.gitignore*" \
    -x="*node_modules/*" \
    -x="*scripts/*"

du -hs "${OUTPUT_FILE}"
md5sum "${OUTPUT_FILE}"