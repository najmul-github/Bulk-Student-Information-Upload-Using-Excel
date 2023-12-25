<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AdminController extends BaseController
{
    public function index()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/admin/login');
        }

        // Load the admin dashboard view
        return view('admin/dashboard');
    }

    public function getStudents() {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/admin/login');
        }
        return view('admin/students');
    }
    
    public function showUploadForm()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/admin/login');
        }
        // Load the upload form view
        return view('admin/upload_excel');
    }

    public function uploadExcel()
    {
        // Check if the file is uploaded successfully
        if ($this->request->getFile('excelFile')->isValid()) {
            // Process the uploaded file, handle Excel data
            // Your logic to handle the uploaded Excel file goes here
            
            // Example: Get the uploaded file details
            $excelFile = $this->request->getFile('excelFile');
            $fileName = $excelFile->getName();

            // Move the uploaded file to a directory
            $excelFile->move(WRITEPATH . 'uploads', $fileName);

            // Process the file data (insert to database, etc.)
            // ...

            // Redirect or show success message
            return redirect()->to('/admin')->with('success', 'Excel file uploaded successfully!');
        }

        // If file upload fails, redirect back to the upload form with an error message
        return redirect()->to('/admin/upload')->with('error', 'File upload failed!');
    }
}


?>