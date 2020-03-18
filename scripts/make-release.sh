#!/bin/bash
set -e

OUTPUT_FILE="versions/mokime.zip"

if [ ! -d  "versions" ]; then
  mkdir -v "versions"
fi

if [ -e "${OUTPUT_FILE}" ]; then
  rm -v "${OUTPUT_FILE}"
fi

echo "# Optimizing JS..."

node_modules/uglify-js/bin/uglifyjs assets/js/mokime.js --output=assets/js/mokime.min.js --compress --mangle

echo "# Optimizing assets..."

find "assets/img" -regex '\(.*jpeg\|.*.jpg\)' -exec node_modules/jpegoptim-bin/vendor/jpegoptim -m90 --strip-all {} \;
find "assets/img" -iname "*.png" -exec node_modules/optipng-bin/vendor/optipng -o7 -strip all {} \;
find "assets/img" -iname "*.svg" -exec node_modules/svgo/bin/svgo {} \;

zip -9 -rqq "${OUTPUT_FILE}" ../mokime \
    -x="*docs/*" \
    -x="*README.md*" \
    -x="*.json*" \
    -x="*.idea*" \
    -x="*.git/*" \
    -x="*versions*" \
    -x="*.gitignore*" \
    -x="*node_modules/*" \
    -x="*scripts/*"

du -hs "${OUTPUT_FILE}"
md5sum "${OUTPUT_FILE}"
