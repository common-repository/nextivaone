# Plugin Settings

Once the plugin is activated, you should be greeted with a large banner telling you "NextivaOne for Wordpress has been added!". This banner is located under `./resources/views/admin/banner.php`. Clicking the "Setup Plugin" button in this banner will bring you to the plugin settings page. Alternatively, you can click the "NextivaOne" menu option in the left side WP admin menu items.

Upon landing on this page, you should see a banner at the top of the screen. This banner is only visible until the first time the user saves the plugin settings. After this, the banner is no longer visible.

## Your Nextiva Phone Number

This setting is the bread and butter of the plugin. If filled in (in the correct format), it will display the frontend widget, with all the other settings applied. If the phone number is not set, the widget will not display on the frontend. This field has format validation (format subject to change).

## Intro Text

This setting applies the content applied within to the frontend widget just above the action buttons (call and text buttons). This field escapes HTML, but any text content can be applied in this field.

## Widget Label

This setting updates the label of the widget button / widget title on the frontend. This field also escapes HTML but any short amount of content can be displayed here.

## Widget Label Align

When the widget is opened, this field determines where the label should be placed. 
- If set to "Left", the widget label will align close to the Nextiva logo icon on the left. 
- If set to "Right", the widget label will align close to the close icon ("X") on the right. 
- If set to "Center" the widget label should align in the center of the two icons.

## Button Action(s)

This setting determines what actions should be available on the frontend widget. On the settings page, this setting also determines what fields should appear in the "Button Label(s)" setting.
- If set to "Call and Text", both the "Call" and "Text" button should appear in the widget.
- If set to "Call", only the "Call" button should appear in the widget.
- If set to "Text", only the "Text" button should appear in the widget.

## Button Label(s)

This setting determines the content of the "Call" and "Text" buttons in the widget. Depending on the "Button Action(s)" setting, either the "Call Button", "Text Button" or both will appear here. The frontend will escape HTML from these fields, but any text can be entered here.

## Widget Fonts

This setting determines if the widget should use plugin fonts, or if it should inherit the theme fonts.
- If set to "Plugin fonts", the widget will use "Motiva Sans" for all of it's font choices on the frontend.
- If set to "Theme default fonts", the widget will use the currently selected theme's fonts on the frontend.

## Button Type

This setting determines whether or not the widget should be fixed positioned on the screen, or if it should use a shortcode to display in a specific spot.
- If set to "Sticky", the widget will be fixed to the screen and it's location will be determined by the "Button Position" setting.
- If set to "Static", the widget will only display if the `[nextiva_one]` shortcode is used. 

## Button Position

This setting is only visible if the "Button Type" setting is set to "Sticky". This setting determines where on the viewport the widget should display.
- If set to "Bottom Right", the widget should display in the bottom right of the viewport.
- If set to "Bottom Left", the widget should display in the bottom left of the viewport.
- If set to "Bottom Center", the widget should display in the bottom center of the viewport.
- If set to "Full-Width", the widget will display at the bottom of the viewport, except it will span the full width of the viewport.

## Show Button

This setting is only visible if the "Button Type" setting is set to "Sticky". This setting determines where the widget should show. 
- If set to "On all pages", the widget should show on all pages of the website.
- If set to "On homepage only", the widget should only show on the homepage (the page set to "front page").

## Pop-Up Style

This setting determines how the expanded widget should display.
- If set to "Slide-in drawer", the widget will expand in it's currently set location to show all content.
- If set to "Modal window", the expanded widget will display an overlay (modal) that takes over the whole screen.

## Responsive Behavior

This setting determines what devices the widget should display on.
- If set to "Show on all devices", the widget will display on all devices (all widths).
- If set to "Show only on mobile", the widget will only display on small devices (under a specific width).
