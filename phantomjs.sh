

cp out.png out-$(date +"%Y%m%d%H%M").png

~/Installed/phantomjs/phantomjs ~/Installed/phantomjs/rasterize.js "$1" out.png 1024px
