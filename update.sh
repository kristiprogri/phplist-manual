#!/bin/bash

rm -f ch*.xhtml
wget objavi.booktype.pro/?book=phplist\&license=CC-BY-SA\&server=booki.flossmanuals.net\&mode=epub -O phpList_manual_$(date +%Y%m%d).epub
unzip -o phpList_manual_$(date +%Y%m%d).epub
wget objavi.booktype.pro/?book=phplist\&server=booki.flossmanuals.net\&license=CC-BY-SA\&mode=web -O phpList_manual_web_$(date +%Y%m%d).pdf
wget objavi.booktype.pro/?book=phplist\&server=booki.flossmanuals.net\&license=CC-BY-SA\&mode=openoffice -O phpList_manual_$(date +%Y%m%d).odt
wget objavi.booktype.pro/?book=phplist\&server=booki.flossmanuals.net\&license=CC-BY-SA\&mode=newspaper -O phpList_manual_pdf_$(date +%Y%m%d).pdf
wget objavi.booktype.pro/?book=phplist\&server=booki.flossmanuals.net\&license=CC-BY-SA\&mode=book -O phpList_manual_book_$(date +%Y%m%d).pdf

