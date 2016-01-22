<?php

namespace TMCms\Modules\Example;

use TMCms\Admin\Menu;
use TMCms\HTML\BreadCrumbs;
use TMCms\HTML\Cms\CmsFormHelper;
use TMCms\HTML\Cms\CmsTable;
use TMCms\Modules\ModuleManager;

ModuleManager::requireModule('groups');

Menu::getInstance()
    ->addSubMenuItem('form')
;


class CmsExample
{
    public function _default()
    {
        echo BreadCrumbs::getInstance()
            ->addCrumb(__('All Items'))
        ;
        
        $items = new ExampleEntityRepository();

        echo CmsTable::getInstance()
            ->addData($items)
        ;
    }

    public function form()
    {
        $data = new ExampleEntity();

        // No params are required in the form, you may remove any
        echo CmsFormHelper::outputForm(ModuleExample::$tables['items'], [
            'data' => $data, // Can be simple key-value array or Entity
            'combine' => true, // Auto-generate all fields from DB table
            'unset' => [
                'group_id' // Field that should not be shown if "combine" auto-generated fields
            ],
            'action' => '&do=_form', // Url to submit post data
            'button' => 'Add Item', // Text on submit button
            'cancel' => true, // Show Cancel button
            'field_key_prefix' => 'my_prefix', // Prefix for every field, may be required for custom scripts or inset forms
            'fields' => [ // Field to generate (overwrites "combine" auto-generated fields)
                'title', // Usual text field
                'subtitle', // Usual text field
                'text' => [ // Field that required extra params
                    'rows' => 10, // Height of textarea
                    'type' => 'textarea', // Not required if have "rows",
                    'multilng' => true, // Create field for every available languages (Field must be in $translation_field in appropriate Entity)
                    'html' => true, // Sanitize value,
                    'backup' => true, // Show recover panel
                    'help' => 'Some visible text on hover', // Show ? sign with tooltip
                    'hint' => 'Some visible text all time', // Show text under field
                    'edit' => 'wysiwyg', // Show visual editor,
                    'validate' => [
                        'require', // Required to fill in any text
                        'is_digit', // Check text is digit only
                        'alphanum', // Check text is digit and letters
                        'url', // Check text is valid link
                        'email', // Check text is valid email
                    ]
                ],
                'group_id' => [ // Input "name" attribute
                    'title' => 'Group', // Field title in form
                    'options' => [1 => 'Group 1', 2 => 'Group 2'], // Supply with option pairs
                    'type' => 'select', // Not required if have "options"
                    'selected' => 2, // Selected option key,
                    'multiple' => true, // Convert to multiselect
                ],
                'linked_to_items' => [
                    'options' => [1 => 'First', 2 => 'Second'],
                    'type' => 'multiselect',
                ],
                'redirect_to' => [
                    'edit' => 'pages', // Show editor with site Structure
                ],
                'image' => [
                    'edit' => 'files', // Show editor with Filemanager
                    'reload' => true, // Reload current page after Filemanager is closed
                    'path' => DIR_PUBLIC_URL . 'images', // Open this path by default
                    'allowed_extensions' => 'jpg,jpeg,png', // Allow only these files to be uploaded during this editing
                ],
                'is_admin' => [ // Will be converted to title "Is admin", because 'title' is not supplied
                    'checked' => true, // Checked or not
                    'type' => 'checkbox', // Not required if have "checked"
                ],
                'notes' => [
                    'type' => 'textarea',
                    'edit' => 'wysiwyg_widget', // Wrap with simple inline editor
                ],
                'allowed_to' => [
                    'type' => 'checkbox_list',
                    'checked' => [1, 2],
                    'options' => ['delete' => 'Delete items', 'create' => 'Create Items', 'other' => 'Something else']
                ],
                'date' => [
                    'type' => 'datetime', // Timestamp value will be converted to Y-m-d,
                ],
                'pass' => [
                    'type' => 'password', // Will show *** instead of letters
                    'required' => true, // Validate that field have any value
                    'readonly' => true, // Can not edit, may be useful for edit pages
                    'maxlength' => 16, // Maximum length of value in field
                ],
                'preview' => [
                    'type' => 'row', // Simple html row with label,
                    'html' => 'Her is separator title', // Text to show in row
                ],
                'generate_pass' => [
                    'type' => 'random', // Text field with button to generate random string
                ],
                'contact_email' => [
                    'type' => 'email', // Email validated field
                ],
                'height' => [
                    'type' => 'number', // Number validated field with arrows +/-
                    'min' => 2, // Minimum value
                    'max' => 200, // Maximum value
                    'step' => 11, // On step
                ],
                'client_name' => [
                    'type' => 'datalist', // Text field with tooltip
                    'options' => ['John', 'Joanna', 'Andrew']
                ],
                'token' => [
                    'type' => 'hidden', // Field is not shown, but is included in POST
                ],
                'invoice' => [
                    'type' => 'file', // Upload file
                ],
            ]
        ]);
    }
}