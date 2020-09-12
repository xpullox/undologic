# this will update the test server
# echo "" is for windows compatability
# rm current dir
cd /home/undologic/www/portaltest && echo ""
rm -rf client/* && echo ""
# pause
sleep 5 && echo ""
#export new files
svn export --force --no-auth-cache --username USERNAME_CHANGE --password PASSWORD_CHANGE https://@github.com/undologic/projectBrowser/trunk /home/undologic/www/portaltest/client && echo ""
# figure out how to do git export in the future as it is faster
# git checkout-index -a -f --prefix=/destination/path/
