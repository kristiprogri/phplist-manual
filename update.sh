#!/bin/bash

rm -f ch*.xhtml
wget objavi.booktype.pro/?book=phplist\&server=booki.flossmanuals.net\&mode=epub -O phpList_manual_$(date +%Y%m%d).epub
unzip -of phpList_manual_$(date +%Y%m%d).epub
wget objavi.booktype.pro/?book=phplist\&server=booki.flossmanuals.net\&mode=web -O phpList_manual_$(date +%Y%m%d).pdf

