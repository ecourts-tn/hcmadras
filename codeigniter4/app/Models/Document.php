<?php

namespace App\Models;

/**
 * Legacy: admin/function/doc_fun.php (class DOCFUN).
 * Tables: mhc_document + document_files (doc_pdf_file blob per document).
 */
class Document extends BaseModel
{
    protected $table      = 'mhc_document';
    protected $primaryKey = 'doc_id';
    protected $allowedFields = [
        'doc_title', 'doc_size', 'doc_lan', 'doc_f_date', 'doc_to_date',
        'doc_order', 'doc_bench', 'doc_new_icon', 'doc_show_page', 'doc_icon',
        'display', 'mhc_user', 'order_type',
    ];

    public function activeList(): array
    {
        return $this->where('display', 'Y')
                    ->orderBy('doc_order', 'DESC')
                    ->findAll();
    }

    public function getWithFile(int $id): ?array
    {
        $row = $this->find($id);
        if (! $row) {
            return null;
        }
        $file = db_connect('default')
            ->table('document_files')
            ->where('document_id', $id)
            ->get()->getRowArray();
        if ($file) {
            $row['doc_pdf_file'] = $file['doc_pdf_file'];
        }
        return $row;
    }

    public function saveFile(int $documentId, string $pdfData): void
    {
        db_connect('default')->table('document_files')->insert([
            'document_id' => $documentId,
            'doc_pdf_file' => $pdfData,
        ]);
    }
}
