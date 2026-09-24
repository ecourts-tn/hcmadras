<?php

namespace App\Controllers;

use App\Models\Document as DocumentModel;

/**
 * Legacy: downloads_grid.php / admin/download.php / admin/view_pdf.php.
 */
class Document extends BaseController
{
    public function download(int $id)
    {
        $row = model(DocumentModel::class)->getWithFile($id);

        if (! $row || empty($row['doc_pdf_file'])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response
            ->setContentType('application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="document_' . $id . '.pdf"')
            ->setBody($row['doc_pdf_file']);
    }
}
