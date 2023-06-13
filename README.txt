=== Connections Business Directory Education Level ===
Contributors: shazahm1@hotmail.com
Donate link: https://connections-pro.com/
Tags: addresses, address book, addressbook, bio, bios, biographies, business, businesses, business directory, business-directory, business directory plugin, directory plugin, directory widget, church, contact, contacts, connect, connections, directory, directories, hcalendar, hcard, ical, icalendar, image, images, list, lists, listings, member directory, members directory, members directories, microformat, microformats, page, pages, people, profile, profiles, post, posts, plugin, shortcode, staff, user, users, vcard, wordpress business directory, wordpress directory, wordpress directory plugin, wordpress business directory, education, education level, education levels, widget
Requires at least: 5.6
Tested up to: 6.2.2
Requires PHP: 7.0
Stable tag: 3.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Extension for the Connections Business Directory that adds the ability to add an education level to an entry.

== Description ==

This is an extension plugin for the [Connections Business Directory Plugin](http://wordpress.org/plugins/connections/) please be sure to install and active it before adding this plugin.

What does this plugin do? It adds the ability to add a education level to entries. The education levels are those that are recognized by the (US Census Bureau)[http://www.census.gov/hhes/socdemo/education/data/cps/2013/tables.html]. A filter has been provided to allow the choices of education levels to be adjusted to suit your needs.

The education level of an entry can optionally be shown as a content block within a template or with the supplied widget.

[Checkout the screenshots.](http://connections-pro.com/add-on/education-level/)

Here are other great extensions that enhance your expirence with the Connections Business Directory:

* [Business Hours](http://wordpress.org/plugins/connections-business-directory-hours/)
* [Toolbar](http://wordpress.org/plugins/connections-toolbar/)
* [Income Levels](http://wordpress.org/plugins/connections-business-directory-income-levels/)
* [Languages](http://wordpress.org/plugins/connections-business-directory-languages/)
* [Login](http://wordpress.org/plugins/connections-business-directory-login/)

== Installation ==

= Using the WordPress Plugin Search =

1. Navigate to the `Add New` sub-page under the Plugins admin page.
2. Search for `connections business directory education level`.
3. The plugin should be listed first in the search results.
4. Click the `Install Now` link.
5. Lastly click the `Activate Plugin` link to activate the plugin.

= Uploading in WordPress Admin =

1. [Download the plugin zip file](http://wordpress.org/plugins/connections-business-directory-education-levels/) and save it to your computer.
2. Navigate to the `Add New` sub-page under the Plugins admin page.
3. Click the `Upload` link.
4. Select Connections Business Directory Education Level zip file from where you saved the zip file on your computer.
5. Click the `Install Now` button.
6. Lastly click the `Activate Plugin` link to activate the plugin.

= Using FTP =

1. [Download the plugin zip file](http://wordpress.org/plugins/connections-business-directory-education-levels/) and save it to your computer.
2. Extract the Connections Business Directory Education Level zip file.
3. Create a new directory named `connections-business-directory-education-levels` directory in the `../wp-content/plugins/` directory.
4. Upload the files from the folder extracted in Step 2.
4. Activate the plugin on the Plugins admin page.

== Frequently Asked Questions ==

None yet....

== Screenshots ==

[Screenshots can be found here.](http://connections-pro.com/add-on/education-level/)

== Changelog ==

= 3.0.2 06/09/2023 =
* TWEAK: Deprecate the filter name `cn_education_level_options` in favor of `Connections_Directory/Education_Level/Options`.

= 3.0.1 06/09/2023 =
* BUG: Cast education level index to string when processing the CSV Export action.

= 3.0 06/09/2023 =
* NEW: Introduce the Entry Education Level Content Block.
* TWEAK: Make `Connections_Education_Levels::education()` public.
* TWEAK: Cast education level index to string.
* TWEAK: Use the Education Level Content Block to render the Entry education level.
* TWEAK: Deprecate `Connections_Education_Levels::block()`.
* TWEAK: Use the Education Level Content Block to render the Entry education level in the widget.
* OTHER: Correct misspellings.
* DEV: TRUE, FALSE and NULL must be lowercase.

= 2.0.2 05/07/2021 =
* OTHER: Correct misspelling.
* OTHER: Update `http` link to be `https`.
* OTHER: Update copyright year.
* I18N: Include German (Germany) translation.
* DEV: Correct code alignment.
* DEV: phpDoc correction.
* DEV: Update plugin header in README.txt.

= 2.0.1 07/18/2019 =
* BUG: Ensure empty string is returned if there is no data to export to prevent the developer notice from being exported.

= 2.0 07/18/2019 =
* FEATURE: Add support for CSV Import and Export of Education Level.
* TWEAK: Refactor plugin in singleton pattern.
* OTHER: Remove extra line return.
* OTHER: Set version as class constant.
* OTHER: Use static method to register widget instead of deprecated function `create_function()`.
* OTHER: Remove use of deprecated function `create_function()` when initiating the plugin.
* DEV: Update plugin header.
* DEV: phpDoc corrections.

= 1.0.4 05/26/2015 =
* BUG: Correct loading of translation files so they are used.
* BUG: Add missing text domains to a couple strings.
* BUG: Correct error notice text when Connections is not installed.
* TWEAK: Update logic which loads the translations.
* I18N: Update POT file.
* I18N: Include Swedish translation.
* DEV: Update .gitignore file.

= 1.0.3 05/05/2015 =
* BUG: Correct filter path for the languages filter.
* I18N: Add the POT file.
* TWEAK: Readme.txt installation tweaks.
* TWEAK: Add Languages to readme.
* OTHER: Bump tested to 4.2.

= 1.0.2 08/19/2014 =
* BUG: Do not display "Choose..." in the entry content when no level was chosen for the entry.

= 1.0.1 05/21/2014 =
* TWEAK: Add default option "Choose...".

= 1.0 05/12/2014 =
* Initial release.

== Upgrade Notice ==

= 1.0 =
Initial release.

= 2.0 =
It is recommended to back up before updating. Requires WordPress >= 4.7.12 and PHP >= 5.6.20 PHP version >= 7.1 recommended.

= 2.0.1 =
It is recommended to back up before updating. Requires WordPress >= 4.7.12 and PHP >= 5.6.20 PHP version >= 7.1 recommended.

= 2.0.2 =
It is recommended to back up before updating. Requires WordPress >= 5.1 and PHP >= 5.6.20 PHP version >= 7.2 recommended.

= 3.0 =
It is recommended to back up before updating. Requires WordPress >= 5.6 and PHP >= 7.0 PHP version >= 7.4 is recommended.

= 3.0.1 =
It is recommended to back up before updating. Requires WordPress >= 5.6 and PHP >= 7.0 PHP version >= 7.4 is recommended.

= 3.0.2 =
It is recommended to back up before updating. Requires WordPress >= 5.6 and PHP >= 7.0 PHP version >= 7.4 is recommended.
