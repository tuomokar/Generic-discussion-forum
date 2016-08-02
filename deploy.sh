#!/bin/bash

# In which directory the command is run
DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )

source $DIR/config/environment.sh

echo "Moving files to the 'users' server"
rsync -z -r $DIR/app $DIR/assets $DIR/config $DIR/lib $DIR/sql $DIR/vendor $DIR/index.php $DIR/composer.json $USERNAME@users.cs.helsinki.fi:htdocs/$PROJECT_FOLDER

echo "Ready!"

echo "Running command php composer.phar dump-autoload..."
ssh $USERNAME@users.cs.helsinki.fi "
cd htdocs/$PROJECT_FOLDER
php composer.phar dump-autoload
exit"

echo "Ready! Your application is now ready at $USERNAME.users.cs.helsinki.fi/$PROJECT_FOLDER"
