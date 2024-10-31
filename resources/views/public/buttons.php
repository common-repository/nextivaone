<?php declare(strict_types=1);

use Tribe\NextivaOne\Settings\Button_Settings;
use Tribe\NextivaOne\Template;

$is_call_button = in_array(
	$button_actions,
	[
		Template::ACTIONS[ Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_CALL_TEXT ],
		Template::ACTIONS[ Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_CALL ] ,
		Template::ACTIONS[ Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_CALL_MESSAGE ] ,
		Template::ACTIONS[ Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_CALL_TEXT_MESSAGE ] ,
	]
);

echo $is_call_button ? sprintf(
	'<span><a href="tel:%s" class="nextiva-one__button" tabindex="0"><span class="icon">%s</span><span class="text">%s</span></a></span>',
	esc_attr( $phone_number ),
	'<svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="object-fit contain"><path d="M13.6421 12.7048L12.1146 14.6148C9.74769 13.2242 7.77531 11.2518 6.38464 8.88482L8.29464 7.35732C8.51854 7.17815 8.67678 6.92986 8.74462 6.65124C8.81247 6.37262 8.7861 6.07937 8.66964 5.81732L6.92839 1.89607C6.80352 1.61508 6.58291 1.38756 6.3059 1.25409C6.02888 1.12062 5.71347 1.08987 5.41589 1.16732L2.10089 2.02607C1.79169 2.10714 1.5229 2.29867 1.34532 2.56446C1.16775 2.83025 1.09369 3.15189 1.13714 3.46857C1.71876 7.61075 3.63312 11.451 6.59081 14.4087C9.5485 17.3663 13.3887 19.2807 17.5309 19.8623C17.8475 19.906 18.169 19.832 18.4347 19.6544C18.7003 19.4767 18.8916 19.2078 18.9721 18.8986L19.8321 15.5848C19.9096 15.2872 19.8788 14.9718 19.7454 14.6948C19.6119 14.4178 19.3844 14.1972 19.1034 14.0723L15.1821 12.3311C14.9201 12.2149 14.6271 12.1886 14.3486 12.2562C14.0701 12.3238 13.8217 12.4815 13.6421 12.7048V12.7048Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
	',
	$button_labels['call']
) : '';

$is_text_button = in_array(
	$button_actions,
	[
		Template::ACTIONS[ Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_CALL_TEXT ],
		Template::ACTIONS[ Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_TEXT ] ,
		Template::ACTIONS[ Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_CALL_TEXT_MESSAGE ] ,
		Template::ACTIONS[ Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_TEXT_MESSAGE ] ,
	]
);

echo ( $is_text_button ) ? sprintf(
	'<span><a href="sms:%s" class="nextiva-one__button" tabindex="0"><span class="icon">%s</span><span class="text">%s</span></a></span>',
	esc_attr( $phone_number ),
	'<svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="object-fit contain"><path d="M18.625 2.375H2.375C1.685 2.375 1.125 2.935 1.125 3.625V13.625C1.125 14.315 1.685 14.875 2.375 14.875H6.125V19.875L11.9587 14.875H18.625C19.315 14.875 19.875 14.315 19.875 13.625V3.625C19.875 2.935 19.315 2.375 18.625 2.375Z" stroke="white" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></svg>',
	$button_labels['text']
) : '';

$is_message_button = in_array(
	$button_actions,
	[
		Template::ACTIONS[ Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_TEXT_MESSAGE ],
		Template::ACTIONS[ Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_CALL_TEXT_MESSAGE ] ,
		Template::ACTIONS[ Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_CALL_MESSAGE ] ,
		Template::ACTIONS[ Button_Settings::NEXTIVA_ONE_BUTTON_ACTION_MESSAGE ] ,
	]
);

echo ( $is_message_button ) ? sprintf(
	'<span><button type="button" class="nextiva-one__button" tabindex="0" data-js="%s"><span class="icon">%s</span><span class="text">%s</span></button></span>',
	'nexone-contact-form-toggle',
	'<svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg" class="object-fit contain"><path d="M13.6 13.6998H2.4C1.6272 13.6998 1 13.1622 1 12.4998V4.4998C1 3.8374 1.6272 3.2998 2.4 3.2998H13.6C14.3728 3.2998 15 3.8374 15 4.4998V12.4998C15 13.1622 14.3728 13.6998 13.6 13.6998Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M1 4.5L8 8.5L15 4.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
	$button_labels['message']
) : '';
