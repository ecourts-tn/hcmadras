<?php

namespace App\Controllers\Admin;

/**
 * Legacy: admin/doc_add.php / doc_edit.php / doc_del.php + DOCFUN class.
 */
class Document extends BaseCrud
{
    protected string $modelClass = \App\Models\Document::class;
    protected string $viewPrefix = 'admin/document';
    protected string $itemLabel  = 'Document';
    protected array $validationRules = [
        'doc_title' => 'required|max_length[300]',
    ];
}
