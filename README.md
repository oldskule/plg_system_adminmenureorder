# Admin Menu Reorder Plugin for Joomla

A simple system plugin for Joomla that allows you to reorder the administrator menu items in the sidebar.

## Features

- Reorder the main administrator menu items under the "System" dashboard.
- Simple drag-and-drop interface in the plugin settings to define the order.
- Add or remove menu items from the ordering list.
- Any menu items not in the defined order will be placed at the end of the menu.

## Requirements

- Joomla! 4.x or 5.x

## Installation

1.  Download the latest version of the plugin as a ZIP file.
2.  In your Joomla administrator panel, go to **System** -> **Install** -> **Extensions**.
3.  Upload the ZIP file to install the plugin.
4.  Once installed, go to **System** -> **Manage** -> **Plugins**.
5.  Search for "System - Admin Menu Reorder" and make sure the plugin is enabled.

## Configuration

1.  Go to **System** -> **Manage** -> **Plugins**.
2.  Search for "System - Admin Menu Reorder" and click on the title to edit its settings.
3.  In the **Menu Item Order** section, you will see a list of menu titles.
4.  You can drag and drop the items to change their order.
5.  Click the "+" button to add a new menu item title to the list.
6.  Click the "-" button to remove a menu item from the list.
7.  Click **Save & Close** when you are done.

The new menu order will be applied immediately to the sidebar menu.

## How it Works

This plugin injects a small piece of JavaScript into the administrator dashboard that reorders the menu items on the client-side based on the order you define in the settings. It is lightweight and does not make any changes to the database other than storing its own parameters.

## License

This plugin is licensed under the [GNU General Public License version 2 or later](https://www.gnu.org/licenses/gpl-2.0.html).
