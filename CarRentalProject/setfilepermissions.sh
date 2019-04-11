# change file permissions to 644
find ./ -type f -exec chmod 664 {} \;
find ./ -type d -exec chmod 751 {} \;
chmod +x setfilepermissions.sh
