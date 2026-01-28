# Developer's readme

## References
* Theme structure handbook [https://developer.wordpress.org/themes/core-concepts/theme-structure/](https://developer.wordpress.org/themes/core-concepts/theme-structure/)
* Dashicon [https://developer.wordpress.org/resource/dashicons/](https://developer.wordpress.org/resource/dashicons/)

## First dev/First install
* Run command `npm install` if there is no **node_modules** folder.

## After first install

### Node packages
* Run command `npm outdated` to check if Node packages is outdated.
* To update, run command `npm update`.
    * To update package version in code, run command `wpdev writeVersions` and check that all PHP files are still valid syntax by compare to files in folder **.backup**.
    * To build files into folder **assets** that is ready for publish, run command `npm run build`.

### Before commit
* Update theme's version number in **style.css**, **readme.txt**.
* Run command `npm run pack` to pack files into zip and store in folder **.dist**.
