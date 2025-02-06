<?php

if (!function_exists('customHelperFunction')) {
    if (!function_exists('renderCategoryOptions')) {
        function renderCategoryOptions($category, $selectedCategoryId = null, $prefix = '') {
            $html = '<option value="' . $category->id . '" ' . ($selectedCategoryId == $category->id ? 'selected' : '') . '>' . $prefix . $category->name . '</option>';
            if ($category->children->isNotEmpty()) {
                foreach ($category->children as $child) {
                    $html .= renderCategoryOptions($child, $selectedCategoryId, $prefix . $category->name . ' > ');
                }
            }
            return $html;
        }
    }
    
}
