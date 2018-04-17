# Git-guide
1. Open Terminal/Command prompt and navigate to where you want the project folder (e.g Desktop)
2. Type `git clone https://github.com/Markusdreyer/webprosjekt_02.git`
3. Navigate inside the cloned _webprosjekt_02_ folder (e.g `cd webprosjekt_02`)
4. Type `git init`to initialize a local repository
5. Create an empty text file with your name (e.g markus.txt) inside the cloned _webprosjekt_02_ folder
6. Type `git add . `in Terminal/Command prompt to add the file.
	* `git add`also works with specific filename like `git add markus.txt` the `. `adds all new files.
5. Type `git commit -m “description of what has been added/changed”`
6. Finally type `git push -u origin master `and login with your github credentials