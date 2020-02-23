#!/bin/bash

./node_modules/node-sass/bin/node-sass ./assets/css/main.scss main.css

./node_modules/postcss-cli/bin/postcss main.css --use autoprefixer -o style.css

rm -v main.css