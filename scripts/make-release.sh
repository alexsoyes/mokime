#!/bin/bash
set -e

OUTPUT_FILE="mokime/versions/mokime.zip"

if [ ! -d  "versions" ]; then
  mkdir -v "versions"
fi

npm install

echo "# Optimizing assets..."

find "assets/img" -regex '\(.*jpeg\|.*.jpg\)' -exec node_modules/jpegoptim-bin/vendor/jpegoptim -m90 --strip-all {} \;
find "assets/img" -iname "*.png" -exec node_modules/optipng-bin/vendor/optipng -o7 -strip all {} \;
find "assets/img" -iname "*.svg" -exec node_modules/svgo/bin/svgo {} \;

cd ..

zip -9 -rqq "${OUTPUT_FILE}" mokime \
    -x="*docs/*" \
    -x="*assets/scss/*" \
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
