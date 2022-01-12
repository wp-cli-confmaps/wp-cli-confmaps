=== ConfigMaps for WP-CLI ===
Contributors: bostjanskufcajese
Donate link: https://github.com/bostjan
Tags: options, configuration management, configuration, settings, wp-cli
Requires at least: 5.8
Tested up to: 5.8
Stable tag: 1.0.0
Requires PHP: 7.4
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
 
Configuration management for your wp_options table. Generate config maps, track them with git and apply them across all your WordPress environments.



== Description ==

Questions:
- Do you like to stay on top of your WordPress configuration that is stored in `wp_options` table in your database?
- Do you like tracking configuration changes with git?
If your answer is "yes", then this plugin might be for you.

Here is a TL;DR description of ConfigMaps plugin:
- This plugin manages options in `wp_options` table
- It supports efficient nested option handling
- Desired option values are defined in "config maps", which are PHP files stored on your filesystem (and NOT in `wp_options`)
- Your first config map can be quickly generated from content in your `wp_options` table
- When multiple config maps are used, their content is merged and then merged config map is applied to the database
- Config map files can be updated with fresh values from the database (i.e. after you've used admin interface to configure your new plugin)



== Installation ==

Requirements:
- Shell access to your WordPress installation
- [WP-CLI](https://wp-cli.org/)

Installation steps:
1. Install the plugin code
2. Activate the plugin
3. Generate your first config map file
4. Configure your config map set



== First steps ==

After you've installed the code and activated the plugin, it's time to generate your first config map.
To do so, SSH into your WordPress instance, change directory to the root of your WordPress and use the following command:
```
wp configmaps generate --from-db --output=configmap-common.php
```
This will generate an initial config map for you in a file named `configmap-common.php`.

Now add the following configuration to an appropriate place (i.e. `wp-settings.php`):
```php
define('WP_CLI_CONFIGMAPS', [
    'common' => ABSPATH . 'configmaps-common.php',
]);
```
All done.

From here, continue to the "Usage" section, or read a more detailed configuration+usage instructions [here](https://github.com/wp-cli-configmaps/wp-cli-configmaps/blob/master/README.md).



== Usage ==

After you've installed and configured your new plugin, here are the basic usage commands.

To verify that your `wp_options` content matches what you've defined in your config map(s):
```
wp configmaps apply --dry-run
```

To apply changes defined in your config maps to the `wp-options` table:
```
wp configmaps apply --commit
```

To update your config maps with values currently stored in your `wp-options` table:
```
wp configmaps update
```

You'll most likely want to use [git](https://git-scm.com/) to track changes to settings stored in your `wp_options` table.



== Frequently Asked Questions  ==

**Q: Is there a GUI?**

A: No. For GUI-based `wp_options` configuration management, use [WP-CFM](https://wordpress.org/plugins/wp-cfm/).



== Development and support ==

Code repository for ConfigMaps for WordPress CLI plugin is [hosted on GitHub](https://github.com/wp-cli-configmaps/wp-cli-configmaps).
Issues can be reported [over there too](https://github.com/wp-cli-configmaps/wp-cli-configmaps/issues).
[Pull requests](https://github.com/wp-cli-configmaps/wp-cli-configmaps/issues) are welcome.



== Changelog ==

Changelog is available [here](https://github.com/wp-cli-configmaps/wp-cli-configmaps/blob/master/CHANGES.md).
