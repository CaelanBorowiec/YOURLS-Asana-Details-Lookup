### Asana Details Plugin Overview

This plugin integrates [**YOURLS**](http://yourls.org/) with the task/project management software [**Asana**](https://asana.com/product). The plugin provides a method for YOURLS to retrieve task titles and other data from Asana when it would ordinarily only see a login screen.

#### Setup:

An Asana API "Personal Access Token" must be created for YOURLS. You may wish to do this with an Asana account dedicated to YOURLS. Note that the account used **must** be able to access the Asana projects/tasks that are being queried.  
Please review this page on [**how to create a Persona Access Token**](https://asana.com/guide/help/api/api#gl-access-tokens).

After you have created a personal access token, please add it to your YOURLS config in the format: _$asanaPAT="yourtoken";_

#### Existing Features

- Task name to link title.

#### Planned Features

- Project name to link title.

#### Credits

- Plugin created by [Caelan Borowiec](https://github.com/CaelanBorowiec)
- GitHub user [ajimix](https://github.com/ajimix), for their [asana-api-php-class](https://github.com/ajimix/asana-api-php-class)
