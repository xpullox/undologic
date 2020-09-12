# upload update_test.sh file
scp scripts/update_test.sh undologic@apps.undologic.com:/home/undologic/private/.
#logon to server and run file
ssh undologic@apps.undologic.com "cd /home/undologic/private && chmod +x ./update_test.sh && ./update_test.sh"
#open firefox new tab with link
"C:\Program Files\Firefox Developer Edition\firefox.exe" -new-tab http://portaltest.undologic.s1009.sureserver.com/client/back-end/