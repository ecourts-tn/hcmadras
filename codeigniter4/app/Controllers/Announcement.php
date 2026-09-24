<?php

namespace App\Controllers;

use App\Models\Announcement as AnnouncementModel;

/**
 * Legacy: announcement_grid.php + announcement_pdf.php.
 */
class Announcement extends BaseController
{
    public function index()
    {
        $this->data['announcements'] = model(AnnouncementModel::class)->activeList();

        return view('layouts/main', $this->data)
            . view('cms/announcements', $this->data)
            . view('layouts/footer', $this->data);
    }

    /** Stream the PDF blob stored in announcement_file.an_pdf. */
    public function pdf(int $id)
    {
        $row = model(AnnouncementModel::class)->getWithFile($id);

        if (! $row || empty($row['an_pdf'])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response
            ->setContentType('application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="announcement_' . $id . '.pdf"')
            ->setBody($row['an_pdf']);
    }
}
