<?php

$finder = Symfony\Component\Finder\Finder::create()
    ->in([
        __DIR__ . '/src',
    ])
    ->exclude('vendor')
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'], 
        'binary_operator_spaces' => true,
        'blank_line_before_statement' => [
            'statements' => [
                'return',
                'throw',
                'try',
                'if',
                'switch',
                'foreach',
                'while',
                'for',
                'do',
                'declare',
            ],
        ],
        'cast_spaces' => true, 
        'concat_space' => ['spacing' => 'one'], 
        'declare_equal_normalize' => true, 
        'function_declaration' => ['closure_function_spacing' => 'none'], 
        'indentation_type' => true, 
        'line_ending' => true, 
        'lowercase_cast' => true, 
        'method_argument_space' => [
            'on_multiline' => 'ensure_fully_multiline',
            'keep_multiple_spaces_after_comma' => false,
        ],
        'no_extra_blank_lines' => [
            'tokens' => [
                'extra',
                'throw',
                'return',
                'continue',
                'break',
                'parenthesis_brace_block',
                'square_brace_block',
                'curly_brace_block',
                'extra',
                'use',
            ],
        ],
        'no_spaces_around_offset' => true, 
        'no_trailing_whitespace' => true, 
        'no_unused_imports' => true, 
        'ordered_imports' => ['sort_algorithm' => 'alpha'], 
        'phpdoc_no_package' => false, 
        'phpdoc_scalar' => true, 
        'phpdoc_summary' => false, 
        'phpdoc_to_comment' => false, 
        'phpdoc_trim' => true, 
        'phpdoc_var_without_name' => true, 
        'single_quote' => true,
        'space_after_semicolon' => true,
        'standardize_not_equals' => true,
        'switch_case_semicolon_to_colon' => true,
        'switch_case_space' => true, 
        'yoda_style' => false, 

    ])
    ->setFinder($finder);
