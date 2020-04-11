#!/bin/bash

./node_modules/node-sass/bin/node-sass ./assets/css/main.scss main.css

./node_modules/postcss-cli/bin/postcss main.css --use autoprefixer --output style.css --no-map

rm -v main.css
