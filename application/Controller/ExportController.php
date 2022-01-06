<?php

namespace Application\Controller;

use Application\Model\TimeEntryCollection;
use Avolutions\Controller\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportController extends Controller
{
    private TimeEntryCollection $timeEntryCollection;

    public function __construct(TimeEntryCollection $timeEntryCollection)
    {
        $this->timeEntryCollection = $timeEntryCollection;
    }

    public function indexAction()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->getColumnDimension('A')->setWidth(11);
        $sheet->getColumnDimension('B')->setWidth(11);
        $sheet->getColumnDimension('C')->setWidth(33);
        $sheet->getColumnDimension('D')->setWidth(190);

        $sheet->getStyle('A:B')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('A:A')->getAlignment()->setVertical(Alignment::VERTICAL_TOP);
        $sheet->getStyle('A1:D1')->getFont()->setBold( true );
        // set column style to 2 decimal places
        $sheet->getStyle('B')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        $data = [
            ['Datum', 'Dauer (in h)', 'Aufgabe/Projekt/Kunde', 'Beschreibung']
        ];
        $timeEntries = $this->timeEntryCollection->orderBy('date')->getAll();

        $lastDate = null;
        $newDateRows = [];
        $rows = count($timeEntries);
        $row = 0;

        foreach ($timeEntries as $timeEntry) {
            $date = $timeEntry->date;
            $formattedDate = '';
            if ($date !== $lastDate) {
                $formattedDate = date('d.m.Y', strtotime($date));
                $newDateRows[] = $row + 2;
            }

            $data[] = [
                $formattedDate,
                $timeEntry->duration/3600,
                $timeEntry->Task->taskNo . ' ' . $timeEntry->Task->name,
                $timeEntry->description
            ];

            $lastDate = $date;
            $row++;
            if ($row === $rows) {
                $newDateRows[] = $row + 2;
            }
        }

        $sheet->fromArray($data);

        // merge date cells
        $startRow = 2;
        foreach ($newDateRows as $newDateRow) {
            // Do not merge single rows
            if (($newDateRow - $startRow) > 1) {
                $startCell = 'A' . $startRow;
                $endCell = 'A' . ($newDateRow - 1);
                $sheet->mergeCells($startCell .':'. $endCell);
            }
            $startRow = $newDateRow;
        }

        // Set sum cells
        $sumCells = [
            'A' . ($rows + 2),
            'B' . ($rows + 2)
        ];

        $sheet->setCellValue($sumCells[0], "SUMME");
        $sheet->setCellValue($sumCells[1], '=SUM(B1:B' . $rows + 1 . ')');
        $style = [
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'fff3f3f3']
            ],
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'ff3f3f3f']
            ]
        ];
        $sheet->getStyle($sumCells[0])->applyFromArray($style)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle($sumCells[1])->applyFromArray($style);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="file.xlsx"');
        $writer->save('php://output');
    }
}