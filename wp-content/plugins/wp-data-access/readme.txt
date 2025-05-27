=== WP Data Access – App, Table, Form, Chart & Map Builder plugin ===
Contributors: peterschulznl, maxxschulz, kimmyx, freemius
Tags: table builder plugin, form builder plugin, tables, data management, charts
Tested up to: 6.8
Requires PHP: 7.0
Stable tag: 5.5.40
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A data-driven App Builder with an intuitive Table Builder, a customizable Form Builder, and interactive maps and charts — available in 35 languages

== Description ==
A powerful data-driven **App Builder** with an intuitive **Table Builder**, a highly customizable **Form Builder** and **interactive Map and Chart support**. Apps can operate on both the **back-end** and **front-end**, with simple **authorization management based on WordPress user and role principles**. The **App Builder** supports **35 languages** to localize apps.

== App Builder ==
> A data-driven Rapid Application Development tool featuring **Builders**, **Managers**, and **Wizards** for effortless app creation and **Hooks** for ultimate customization.

* **Table Builder**
  * Many powerful static and dynamic **filtering options**
  * **Real-time, updatable computed fields**
  * **Real-time aggregations** for up-to-the-minute insights
  * **Integrate charts** for robust data analysis
  * **JavaScript hooks** to customize layout and behavior
  * A **Lookup Wizard** to create lookups in a snap
  * Edit data instantly with **inline editing**
  * Export to **PDF, CSV, JSON, XML, SQL, and Excel**
  * **WordPress media library** integration
* **Form Builder**
  * **Grid-based forms** for streamlined data management
  * **Multi-level master-detail relationships**
  * A **Lookup Wizard** to create lookups in a snap
  * A **Computed Field Wizard** to implement **custom fields**
  * **JavaScript hooks** to add custom business rules
  * **JavaScript hooks** to perform custom validations
  * **JavaScript hooks** to customize layout
  * Interactive client-side **validations based on database constraints**
  * Access the **WordPress media library** for enhanced functionality
* **Chart Builder**
  * **Google Charts** integration
  * Create **charts** from **SQL queries**
  * Interactively adjustable **charts configuration**
  * **Print/export charts**
* **Map Builder**
  * **Google Maps** integration
  * **Visualize location data** using **SQL queries**
  * Interactively adjustable **search radius**
  * Customizable **marker content and layout**
* **Theme Builder**
  * **Customize app layout seamlessly**
* **App Manager**
  * **Authorization management based on WordPress user and role principles**
  * Make app available from **back-end dashboard menu**
  * Add app to **front-end** using shortcodes
  * **Safe mode** support (to temporarily disable hooks)
* **Build dynamic, data-driven apps** for both **front-end** and **back-end**
* **Run apps in 35 languages** to reach a global audience
* **Connect to local and remote databases**
* **Real-time build and run capabilities**

== Data Explorer ==
> Take control of your data with our intuitive, **GUI-driven Data Explorer** that lets you seamlessly **manage both local and remote databases right from your WordPress dashboard**.

* Effortlessly **manage data across local and remote databases**
* **Global search and replace** across multiple databases and tables
* [Easily **import SQL and CSV files**, with ZIP support for handling large datasets](https://wpdataaccess.com/docs/data-explorer-manage/imports-sql-csv/)
* [**Export data in various formats**, including SQL, CSV, JSON, and XML—even for large tables](https://wpdataaccess.com/docs/data-explorer-actions/actions/)
* Perform essential **table actions** like rename, copy, truncate, drop, optimize, and alter
* [Unlock **advanced table and column options**, such as geolocation, inline editing, and enhanced search](https://wpdataaccess.com/docs/data-explorer-settings/table-and-view-settings/)
* **Transform data management from complex to effortless with a tool designed for both flexibility and precision**

== SQL Query Builder ==
> **Run SQL queries directly within WordPress.**

* [Execute multiple SQL queries with **tabbed workflows** for seamless multitasking](https://wpdataaccess.com/docs/sql-query-builder/query-builder-tutorials/)
* **Save and reuse queries** for data tables and charts
* **Built-in safeguards to protect WordPress tables** and data integrity
* [Ready to optimize? Explore the intuitive **Visual Query Builder** for easy query creation, even without SQL expertise](https://wpdataaccess.com/docs/sql-query-builder/visual-query-builder/)

== Premium Data Services ==
> **Effortlessly connect, sync, and manage remote databases and data files.**

* **Seamlessly compatible with all plugin features**
* [Premium Remote Connection Wizard for fast, no-fuss setup](https://wpdataaccess.com/docs/remote-connection-wizard/remote-wizard/)
  * **Remote Databases**: Connect to SQL Server, Oracle, PostgreSQL, MariaDB, MySQL, and MS Access (file-based)
  * **Remote Data Files**: Sync with CSV, JSON, and XML files for dynamic updates (e.g., Google Sheets sync)

== Plugin Settings ==
> Detailed settings for **managing the user interface and behavior**.

* Tailor your experience with a wide range of detailed settings to control both the user interface and functionality of the plugin

== Legacy Tools ==
> Will be replaced by the **App Builder**.

* Available until at least december 2026
* Use to maintain old solutions
* Use **App Builder** for new projects

== Dashboards and Widgets ==
> Customizable widgets for dashboards (back-end), webpages (front-end), and external websites. **(functionality will be moved to App Builder)**

* Centralized data management
* Share data widgets anywhere
* Give specific users and user groups access to locked dashboards
* Support for user-created dashboards
* Cost-effective Business Intelligence solution

== Useful Links ==
- [Plugin Website](https://wpdataaccess.com/)
- [Documentation](https://wpdataaccess.com/documentation/)

== Installation ==
(1) Upload the WP Data Access plugin to your WordPress site
(2) Activate the plugin
(3) Navigate to the WP Data Access menu

And you're all set!

== Changelog ==

= 5.5.40 =
* Released 2025-04-18
* Added: Previous and next row buttons to data entry form
* Added: Map integration to Table Builder
* Added: View maps and charts besides each other in header or footer dock
* Added: Spy popup to default where clause
* Added: Slovenian language support
* Added: Parameter support to chart apps
* Added: Parameter support to map apps
* Changed: Media parameters to optional
* Changed: Powered by hidden by default (added tooltip to UI)
* Fixed: Map height incorrect when run from shortcode
* Fixed: Column filter default not working with server-side processing
* Fixed: Chart data columns expecting length
* Fixed: Images not shown correctly on Safari (macOS and iOS)
* Fixed: Incorrect table height on Safari (macOS and iOS)
* Fixed: Numeric and null values not handle correctly in CSV + JSON export

= 5.5.37 =
* Released 2025-04-02
* Added: New app type MAP
* Added: Root property control to setColumnStyle
* Added: Type-checking to reducers and actions
* Added: Support for spatial columns in tables and forms
* Added: Support for multiple custom shortcode parameters
* Improved: Replaced textarea with CodeMirror for SQL editing
* Fixed: Vulnerability shortcode parameter filter field
* Fixed: Chart Builder menu uses old format
* Fixed: Add column data type to all requests
* Fixed: Added null values to Query Builder CSV export
* Fixed: Shortcode arguments not processed
* Fixed: Missing table header border

= 5.5.36 =
* Released 2025-03-17
* Added: Form hooks
* Added: Builtins to table and form hooks
* Added: OK and CANCEL buttons to full-screen code editor
* Added: Allow hiding title bar on web page via shortcode parameter
* Added: Table hook postQuery
* Added: Allow empty value selection from drop-down list (client-side processing only)
* Fixed: Table hook onAppOpen not working
* Fixed: Slovak app language falls back to English
* Fixed: Removed unused buttons from actions menu

= 5.5.35 =
* Released 2025-02-24
* Added: Key icon to primary key fields
* Improved: Layout hook settings
* Fixed: Allow hiding mandatory fields that have a default value
* Fixed (with limitations): Media library window shows behind modal form window
* Fixed: Changing grid settings requires reload
* Fixed: Table footer not visible in full-screen mode

= 5.5.34 =
* Released 2025-02-17
* Updated: Documentation links
* Fixed: Charts showing Chart Builder icon for non-admin users
* Fixed: Row export to SQL not working from Data Explorer
* Fixed: Builder icon visibility fails  with multiple shortcodes on same page
* Fixed: Start app in fullscreen mode

= 5.5.33 =
* Released 2025-02-06
* Added: Element ID's to improve end-to-end testing
* Added: Autocompletion to column filter
* Improved: Add metadata server side to improve app load time on public pages
* Improved: Skip LOV rest api call with client-side processing
* Improved: State management large table support
* Improved: State management server/client-side processing
* Fixed: Invalid row count after insert and delete with server-side processing
* Fixed: Invalid row count update with search panes and server-side processing
* Fixed: Invalid row count on search with client side processing
* Fixed: Multi-select column filter and search panes not working with client-side processing
* Fixed: Search panes for lookups not working with client-side processing

= 5.5.32 =
* Released 2025-01-27
* Added: Chart configuration to Table Settings
* Added: Chart integration with data table
* Added: Link to online roadmap
* Improved: On open form jump, to form top
* Improved: Hints on copy and export app
* Removed: Hooks, Charts and Theme from Data Explorer menu
* Fixed: Predefined search builder criteria not working
* Fixed: Column Filters shown twice when HEADER selected
* Fixed: Cannot use multiple URL parameters in where clause
* Fixed: Popup height incorrect in Firefox
* Fixed: Column filter update performs server request with client-side processing
* Fixed: Column filter update not seeing empty string with server-side processing
* Fixed: Column sorting performs server request with client-side processing
* Fixed: Pagination update performs server request with client-side processing
* Fixed: Inline-editing in Data Explorer returns Error 400
* Updated: Freemius SDK

= 5.5.31 =
* Released 2025-01-16
* Added: Allow user to interactively change table column order
* Added: Show | hide table header and footer
* Added: Sticky header and footer
* Added: Limit input size textarea
* Added: Redirect user after registration completed
* Added: Labels and hints to attachment/upload fields
* Added: Open form in modal window
* Added: Aggregation calculation hint text
* Added: Install function wpda_get_wp_user_id() from Data Explorer - Manage Databases
* Fixed: Alignment of several types of input fields
* Fixed: Client-Side processing not working in Data Explorer
* Fixed: Date fields not localized in PDF export
* Fixed: Import detail apps not working with MySQL V8
* Fixed: Undefined rest api action causes Data Explorer crash
* Fixed: Empty theme settings panel shown for relationships
* Fixed: External CSS overwrites fieldset and legend styles
* Fixed: Missing super-admin capabilities
* Fixed: Blocked aria-hidden on an element because its descendant retained focus

= 5.5.30 =
* Released 2025-01-02
* Fixed: PDF export not working with inline editing enabled columns

= 5.5.29 =
* Released 2024-12-31
* Added: Client-Side processing
* Added: Export all rows (client-side processing)
* Added: Duration input element for storing durations up to 99 hours in the MySQL time format
* Added: Hide powered by label in PDF footer
* Fixed: Math function requires two values
* Fixed: Computed field output in PDF

= 5.5.25 =
* Released 2024-12-28
* Fixed: Lookups blank in PDF
* Fixed: Handle local storage exceptions

= 5.5.24 =
* Released 2024-12-24
* Added: New onAppOpen and onAppClose hooks
+ Added: Requery table programmatically
* Improved: PDF export and user interface
* Fixed: Expanded rows not closed on page change
* Fixed: Aggregation decimals
* Fixed: NO_TABLE_OPTIONS is deprecated in MySQL V8

= 5.5.23 =
* Released 2024-12-18
* Added: Enable|disable embedded HTML in text columns
* Added: Customizable height for multi line text fields
* Added: Default user adjustable column filter value
* Fixed: Cannot save legacy tool status with free version
* Fixed: Lovs not unescaping HTML characters
* Fixed: Lookups not unescaping HTML characters
* Fixed: Input font sizing not working
* Fixed: When adding a new row, dropdown fields that set to be non-editable or hidden still appear visible and editable
* Fixed: Date localization UK not working correctly
* Fixed: Selection checkboxes visibility not toggled when fullscreen toggled
* Fixed: Plain text hyperlink not processed correctly
* Fixed: App type search not working when text search is empty
* Fixed: Form not showing if default where contains error
* Fixed: Give a proper console error when table lookup fails
* Fixed: 1:1 relationship issues
* Fixed: Search & replace gives no results for remote databases
* Fixed: Invalid hyperlink format throws error and shows blank screen
* Fixed: Change order direction handling
* Changed: Builder menu structure to accommodate more menu items
* Changed: Math library to reduce bundle size
* Optimized: Client bundle
* Optimized: Store handling
* Optimized: Lazy load language files
* Updated: Freemius SDK

= 5.5.22 =
* Released 2024-11-28
* Added: Table component reference to table hooks
* Added: Parameter pp-page to jump to specific page on page load
* Added: Allow inline editing with row update disabled
* Added: Save button to table header for inline updates
* Added: Hide auto-increment columns during insert if visibility = off
* Fixed: Missing form column code causes fatal error
* Fixed: WPDAVAR and WDPATMP no longer working in SQL Query Builder
* Fixed: Insert fails when primary key contains and auto_increment and additional columns
* Fixed: Global search not working in free version
* Fixed: Less than character not unescaped
* Fixed: Lookup wizard update does not update related tables and columns
* Changed: Freemius SDK integration
* Optimized: Bundles and store

= 5.5.20 =
* Released 2024-11-15
* Fixed: Apply + OK buttons not working after closing Form Builder
* Fixed: Null value validation not triggered on update
* Fixed: All legacy tools removed from toolbar

= 5.5.19 =
* Released 2024-11-15
* Added: Enable | Disable legacy tools from tool guide page
* Added: Allow server side default values on insert
* Moved: Dashboards and Charts menu items to legacy tools section
* Fixed: Tool guide header too wide on small devices
* Fixed: Hidden elements using dashboard space
* Fixed: Trailing comma causing error with PHP7
* Fixed: Selector returns different results when called with same arguments
* Fixed: Join Builder and Relation Builder button access

= 5.5.17 =
* Released 2024-11-07
* Added: Charts to App Builder
* Added: Rename database feature
* Added: Allow computed fields in forms as own element (instead of inside an input element)
* Added: Tip to improve performance on first table load
* Improved: Usability builder column icons
* Fixed: Pagination issue, next button not clickable on second page
* Fixed: Fields with inline editing enabled reflect first row value when second row is filtered
* Fixed: Column header to wide when inline search in header is enabled
* Fixed: Default full screen not defined
* Fixed: Row count issue with large table support
* Fixed: Missing mandatory column does not show error on insert
* Fixed: Passing incorrect form mode
* Fixed: Disable inline editing for parent ID column
* Fixed: Populating M2M list returns unknown column in field list
* Fixed: Insert M2M form using auto increment column
* Fixed: Lookup relation tables returning bad request
* Fixed: Mandatory columns not in forms prevent saving data
* Updated: Freemius SDK

= 5.5.16 =
* Released 2024-10-16
* Added: Registration form
* Added: Save view selection in App Builder
* Added: Cascading app deletion
* Added: Allow user to show | hide table columns
* Optimized: Hook editor updates to prevent unnecessary re-renders
* Changed: Bulk action column selection showing labels instead of column names
* Fixed: Join and relation table settings not saved correctly
* Fixed: Class names for styles not applied to lookup fields
* Fixed: XML export not processing null values correctly
* Fixed: App copy missing multi-level relationships
* Fixed: App export missing multi-level relationships
* Fixed: App export missing WordPress table prefix
* Fixed: App copy Data App missing detail apps
* Fixed: App export Data App missing detail apps
* Fixed: Responsiveness of data tables also set to scroll for views
* Fixed: Column filter layout when field layout is filled
* Fixed: Default detail panel overflow on mobile devices
* Fixed: Media button labels in Form Builder DELETE and SELECT not translated
* Fixed: Disable column render hook for computed fields
* Fixed: Border radius first line App Builder and Data Explorer incorrect
* Fixed: Color button labels in header
* Fixed: Border radius incorrect App Builder and Data Explorer
* Fixed: Null pointer exception on toLowerCase
* Fixed: Handle references to deleted apps
* Fixed: Cannot open table builder for data explorer
* Fixed: Show more button relation table
* Fixed: Cleanup relation table references on cancel
* Fixed: Column filter processing join and relation table columns
* Fixed: App crashes when filter is changed on detail table
* Fixed: Special characters added to column label end are moved to the front in detail view
* Fixed: Searchbox highlight replicating selected values
* Fixed: Last column disappears when it is invisible and a computed field is added
* Removed: Refresh icon from table table when inline editing is enabled
* Removed: Copy/export data apps (copy only real containers)
* Removed: Redundant free code from premium version (does not affect free version)
* Updated: Opt-in icons
* Updated: Freemius SDK

= 5.5.14 =
* Released 2024-09-17
* Added: Manage relationships from Table Builder and Form Builder
* Added: Selectable density state to App Builder and Data Explorer
* Added: Force aggregations to use column localization settings
* Added: Start apps in full screen mode
* Fixed: Reapply theme settings to app after switching
* Fixed: App Builder record lists subtract 1 day from date fields
* Fixed: Fatal error when disabling full lookup on startup
* Fixed: Column border missing in table and form builder
* Fixed: Lookup value substitution not working correctly when lookup return just one value
* Fixed: Computed field duplicated when applied multiple times on creation
* Fixed: Menu item not focusable
* Fixed: Row selection checkbox shown above row action icons when scrolling
* Fixed: Hidden columns shown when responsiveness is set to scrollbar
* Changed: Row selection column no longer pinned
* Changed: Show icon buttons on toolbar instead of buttons on small devices
* Changed: App Builder layout
* Updated: Freemius SDK

== Changelog ==
= 5.5.13 =
* Released 2024-09-08
* Fixed: Events on computed fields lost
* Fixed: Textarea padding
* Fixed: Responsive column hiding
* Fixed: Padding right TH, TD
* Fixed: Table overflow issues

= 5.5.12 =
* Released 2024-09-05
* Fixed: Relation table not shown when using artificial primary key
* Fixed: Relation table join condition missing table names
* Fixed: Date not localized
* Fixed: Explicitly set background fixed columns
* Fixed: Removed migration message from Data Designer toolbar
* Fixed: Auto complete internal key mismatch
* Fixed: Image size in data table
* Added: Export to PDF icon to detail panel
* Added: Column selection in bulk actions exports
* Added: A number of hooks to customize data table layout and behaviour
* Changed: Detail panel layout
* Changed: App Builder layout
* Changed: Data Explorer layout

= 5.5.11 =
* Released 2024-08-22
* Fixed: Super admin cannot access sub site
* Fixed: Divi styling issues
* Fixed: Elementor styling issues
* Fixed: Cannot read properties of null (reading 'toLocaleLowerCase')
* Fixed: Full screen data app not showing table correctly
* Fixed: Inline auto save columns not saving properly
* Fixed: Cannot use % character in where clause lookups
* Fixed: Pagination rows per page setting not updated
* Fixed: M:M relationships losing primary key values
* Added: View Data Apps structure in App Builder
* Added: Copy shortcode to App Builder actions
* Added: App actions menu to the App Builder
* Added: Pagination display options: top, bottom, or both
* Added: Support for thousand and decimal separators in numeric input fields
* Added: Enhanced language support for date, time, and numeric fields
* Added: CodeMirror integration for writing computed field implementations
* Added: JavaScript and HTML support to Code Mirror
* Added: Hint to old table and form builders to prevent confusion
* Added: Inline data viewing with a detail panel
* Added: WordPress and plugin table information to the Data Explorer
* Changed: Builder resizing behaviour
* Removed: View row id from data table
* Removed: App foreign key constraints
* Updated: Freemius SDK

= 5.5.9 =
* Released 2024-07-30
* Fixed: Localization not available for date columns
* Fixed: Increase specificity table style
* Fixed: Form Builder icon always visible for master-detail relationships
* Fixed: Highlighting not working if inline HTML is enabled
* Fixed: React findDOMNode is deprecated in StrictMode
* Fixed: Invalid data type on column filter
* Fixed: Cannot reorder details
* Fixed: Cannot add column filter for hidden columns
* Fixed: Relationship display type updates not detected
* Fixed: App Manager asking for confirmation after shortcode generation
* Fixed: Inline field settings not applied
* Fixed: Undefined table settings on multi level master-detail
* Fixed: App pages on back-end missing CSS styling
* Moved: Changelog to readme (making it available online)
* Added: New app type "app container" to bundle apps into one main app
* Added: Apps to repository backup and restore
* Added: Tool replacement info.
* Added: Premium color gold to plugin menu icon.
* Added: Tool guide page also containing FAQs
* Added: Let import container wait until all databases are loaded
* Added: Added lookup placeholders to computed fields
* Added: Custom shortcode parameter support
* Added: Make computed field label in Form editable from columns list
* Added: Container ID to increase CSS specificity
* Added: Classname pp-fullscreen to body element when entering full screen mode

= 5.5.7 =
* Released 2024-07-16
* Fixed: Adding a search pane to a column with lookup requires a full table reload
* Fixed: Page scrolls down when keys f, s, t, v pressed in search boxes
* Fixed: Autocomplete not correctly showing for lookup columns with field layout set to filled or standard
* Fixed: Null value in LOV returns an empty list item
* Fixed: Filter mode 'between inclusive' for datetime not working correctly (same results as inclusive)
* Improved: Language files loaded moved to JSON format and loaded at runtime to improve performance
* Improved: Many textual improvements (hints, examples, labels)
* Improved: Uniformized layout and style of all field types and modes
* Improved: Computed field calculations and display
* Added: Several CSS classes for custom styling
* Added: Customize column filters width
* Added: Customize column filters ordering
* Added: Customize default page size
* Added: Customize available page sizes
* Added: Search panes
* Added: Cascading searches for lookups and lovs
* Added: Custom color picker to theme settings
* Added: HTML and JS support to computed fields
* Added: URL parameter support
* Added: Shortcode parameter support
* Added: Ability to disable full screen mode
* Added: Workaround for app preview not loading styles in Divi Visual Builder (showing no preview message instead)
* Updated: Freemius SDK

= 5.5.6 =
* Released 2024-07-02
* Fixed: Lookup search
* Fixed: User can hide column filter by clicking on filter icon even when hiding is disabled
* Fixed: Filter match highlight
* Added: Shortcode parameter to disable builders on front-end
* Added: Show column filters in table column header
* Added: Lookups missing to export
* Added: Computed fields to export
* Added: Filter match highlight to lookup columns
* Added: Column alignment to PDF export
* Added: PDF orientation and style selection
* Added: Full app localization (containing 35 languages)
* Added: Export apps
* Updated: Freemius SDK

= 5.5.5 =
* Released 2024-06-20
* Post fix: Copy app not copying details
* Post fix: New record added twice for m:m relationship
* Fixed: Force user to select at least one column on app creation or update
* Fixed: Force user to select at least one column on lookup creation or update
* Fixed: Force user to select at least one column on relationship creation or update
* Fixed: Plugin does not register lookup changes
* Fixed: Empty detail blocks visible on master insert
* Fixed: Wrong (local) date in data table (converted to UTC)
* Fixed: Row selection toggled on inline editing fields
* Fixed: Builder buttons on detail form visible to non admins
* Fixed: Media Library window appears behind the form when triggered
* Changed: Export table or app name instead of app id
* Added: Copy app link and icon
* Added: Bulk actions for views
* Added: M:m relation to App Builder
* Added: Kill token property to chart widget

= 5.5.4 =
* Released 2024-05-28
* Fixed: Lookup values not shown in exports
* Fixed: Export to pdf adds an empty column
* Fixed: Details not shown to non admin users
* Fixed: View action for tables without primary key and views
* Fixed: Table cell colors incorrect with multiple apps on one page
* Fixed: WordPress media library usage not working on insert
* Fixed: Rename view not working
* Fixed: Drop view not working
* Fixed: Link tooltips in Data Explorer not completely visible
* Fixed: Media type update not working
* Fixed: Server side updates not synced on client
* Fixed: Sending non-updatable fields to server
* Fixed: Column filters empty and not empty not working with lookups
* Fixed: Column positioning not working with full screen master-detail
* Fixed: Reduce margin bottom of error panel in Data Explorer
* Added: Alter table action to new Data Explorer
* Added: Change PDS refresh interval to new Data Explorer
* Added: Manage databases to Data Explorer
* Added: Premium Data Services access to new Data Explorer
* Added: Change font size of input fields, labels and hints
* Added: Monitor updates in App Manager
* Added: Refresh columns button to App Manager
* Added: Adjustable elevation to app containers
* Added: Use WordPress date and time format in tables
* Added: Sync root app theme with detail app theme in real time
* Added: SQL and ZIP file import to Data Explorer
* Added: Bulk actions to Data Explorer
* Added: Elevation to Papers, Cards and App Bars
* Added: Persistent search criteria in Data Explorer and App Builder

= 5.5.3 =
* Released 2024-05-15
* Improved: Column filter support
* Improved: Several builder hints
* Improved: App responsiveness
* Fixed: Cannot use view in lookups
* Fixed: Master-detail key issue
* Fixed: Database column default constraints not used
* Fixed: Lookups not used in global search
* Fixed: Multi select drop down list not working
* Fixed: Position apps list when opening App Builder
* Fixed: Error on column filter change
* Fixed: Cannot open computed field accordion
* Fixed: Column filter between not working
* Fixed: JSON parse error in Data Explorer

= 5.5.2 =
* Released 2024-05-08
* Added: Inherited font family from page
* Added: Show more|less button
* Added: Column default value
* Added: Master-detail display type
* Added: Inline HTML support to table cells
* Added: Examples to setting blocks
* Improved: Relationship configuration
* Improved: Lookup configuration
* Fixed: Date/time localization not working
* Fixed: Prefill parent data in child component
* Fixed: Lookup not respecting required constraint

= 5.5.1 =
* Released 2024-04-19
* Added: 1:1 and 1:n relationships to App Builder
* Fixed: Added client version number to prevent caching old client files
* Fixed: Geomap not working with block-based themes (Ian)
* Updated: Freemius SDK

= 5.5.0 =
* Released 2024-04-18
* Added: Pre-release new App Builder
* Fixed: URL parameter % usage

= 5.4.0 =
* Released 2024-01-25
* Added: Pre-release new Data Explorer
* Added: REST API drop-down multi-select inline search
* Added: REST API drop-down inline search
* Changed: REST API inline search and estimated row count
* Updated: Freemius SDK

= < 5.4.0 =
* See changelog.txt in plugin folder