<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends Controller
{
    public function exportToExcel()
    {
        // Query to fetch data
        $query = "SELECT * FROM personal";
        // $result = $->query($query);

        // if (!$result) {
        //     die("Error executing query: " . $connection->error);
        // }

        // Create a new Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header row
        $columns = ['ID', 'Name', 'icNum', 'citizen', 'gender', 'dob', 'pob', 'address', 'address2', 'city', 'postcode', 'state', 'email', 'phoneNum']; // Replace with your table columns
        $columnIndex = 1;

        foreach ($columns as $column) {
            $sheet->setCellValueByColumnAndRow($columnIndex++, 1, $column);
        }

        // Add data rows
        $rowIndex = 2;

        while ($row = $result->fetch_assoc()) {
            $columnIndex = 1;
            foreach ($row as $value) {
                $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $value);
            }
            $rowIndex++;
        }

        // Set headers for download
        $fileName = "export_" . date('Y-m-d') . ".xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        // Write file to output
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
