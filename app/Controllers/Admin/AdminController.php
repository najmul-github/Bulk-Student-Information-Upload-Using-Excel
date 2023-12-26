<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
        $students = new StudentModel();
        $data['students'] = $students->findAll();
        return view('admin/students', $data);
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
        return redirect()->to('/admin/file/upload')->with('error', 'File upload failed!');
    }
    
    public function upload()
    {
        $file = $this->request->getFile('excelFile');

        if ($file && $file->isValid() && in_array($file->getExtension(), ['xlsx', 'xls'])) {
            // Load the uploaded Excel file using PHPSpreadsheet
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getTempName());
            // Get the first worksheet
            $worksheet = $spreadsheet->getActiveSheet();

            // Get the highest row and column numbers
            $highestRow = $worksheet->getHighestRow();
            // $highestColumn = $worksheet->getHighestColumn();

            // Iterate through rows
            for ($row = 2; $row <= $highestRow; ++$row) {
                // Fetch row data
                $rowData = $worksheet->rangeToArray('A' . $row . ':G' . $row, null, true, false);

                // Accessing individual columns from the row data
                $fullName = $rowData[0][0];
                $email = $rowData[0][1];
                $userName = $rowData[0][2];
                $status = $rowData[0][3];
                $remarks = $rowData[0][4];
                // Validate student information
                $isValid = $this->validateStudentData($fullName, $email, $status);
                if ($isValid) {
                    // Process valid student information
                    $this->processStudentData($fullName, $email, $userName, $status, $remarks,);
                } else {
                    // Log failed records
                    $this->logFailedRecord($fullName, $email, $userName, $status, $remarks);
                }
            }

            // Redirect or display success message
            return redirect()->to('/admin/students')->with('success', 'File uploaded successfully!');
        } else {
            // Handle invalid file upload
            return redirect()->to('/admin/file/upload')->with('error', 'Invalid file format or no file uploaded.');
    
        }
    }

    public function validateStudentData($fullName, $email, $status)
    {
        // Example validation rules; customize as per your requirements
        if (empty($fullName) || empty($email) || empty($status)) {
            return false;
        }

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        // Validate other fields

        return true; // Data is valid
    }

    public function processStudentData($fullName, $email, $userName, $status, $remarks)
    {
        // Perform database operations (insert/update) based on the retrieved data
        $data = [
            'full_name' => $fullName,
            'email' => $email,
            'user_name' => $userName,
            'status' => $status,
            'remarks' => $remarks,
        ];
        
        $student  = new StudentModel();
        $student->save($data);
    }

    public function logFailedRecord($fullName, $email, $userName, $status, $remarks)
    {
        // Log failed records to a file or database for reference
        // Example: Save failed records to a log file

        $logData = "Failed Record: Name - $fullName, Email - $email, User Name - $userName\n";
        // Append other fields to $logData as needed

        // Example: Save $logData to a log file
        $logFilePath = WRITEPATH . 'logs/upload_failed_records.log';
        file_put_contents($logFilePath, $logData, FILE_APPEND);
    }


}


?>