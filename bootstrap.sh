#!/bin/bash

source config/environment.sh

echo "Creating project file"
ssh $USERNAME@users.cs.helsinki.fi "
cd htdocs
touch favicon.ico
mkdir $PROJECT_FOLDER
cd $PROJECT_FOLDER
touch .htaccess
echo 'RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [QSA,L]' > .htaccess
exit"

echo "Ready!"

echo "Moving files to the 'users' server..."
scp -r app config lib vendor sql assets index.php composer.json $USERNAME@users.cs.helsinki.fi:htdocs/$PROJECT_FOLDER

echo "Valmis!"

echo "Setting access permissions and installing Composer..."
ssh $USERNAME@users.cs.helsinki.fi "
chmod -R a+rX htdocs
cd htdocs/$PROJECT_FOLDER
curl -sS https://getcomposer.org/installer | php
php composer.phar install
exit"

echo "Ready! Your application is now ready at $USERNAME.users.cs.helsinki.fi/$PROJECT_FOLDER"
