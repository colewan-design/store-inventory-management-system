<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class PdfController extends Controller
{
    public function generateGateLogsPdf()
    {
        // Load data from the database or other sources for all gate logs
        $gatelogs = DB::table('gates')->get();
        $html = '<h1>Student Gate Logs</h1>';
        $html .= '<table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 20px;">';
        $html .= '<tr style="background-color: #d9edf7;"><th style="border: 1px solid black; padding: 10px;">Student ID</th><th style="border: 1px solid black; padding: 10px;">Status</th><th style="border: 1px solid black; padding: 10px;">Date and Time</th></tr>';
    
        foreach ($gatelogs as $log) {
            $html .= '<tr>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $log->student_id. '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $log->status . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $log->dateTime . '</td>';
            
            $html .= '</tr>';
        }
        
        $html .= '</table>';
    
        // Generate the PDF using mPDF
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
    
        // Return the PDF as a response
        return response($mpdf->Output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="gate_logs.pdf"'
        ]);
    }

    public function generatePdfAttendance()
    {
        $selectedAttendanceStudent = request('student');

        $attendances = DB::table('attendances')
            ->where('student_id', $selectedAttendanceStudent)
            ->get();
 
            $student = DB::table('students')
            ->where('account_id', $selectedAttendanceStudent)
            ->first();
        
        // Start building the HTML for the attendance report
        $html = '<h1>Attendance Report</h1>';

        // Build the header section for the student's details
        $html .= '<h2>' . $student->first_name . ' ' . $student->last_name . '</h2>';
      

        $html .= '<table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 20px;">';
        $html .= '<tr style="background-color: #d9edf7;"><th style="border: 1px solid black; padding: 10px;">Date</th><th style="border: 1px solid black; padding: 10px;">Attendance</th></tr>';

        foreach ($attendances as $attendance) {
            $html .= '<tr>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $attendance->date . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $attendance->status . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';

        // Generate the PDF using mPDF
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);

        // Return the PDF as a response
        return response($mpdf->Output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="attendance_report.pdf"'
        ]);
    }

    public function generatePdfTranscriptRecords()
    {
        // Get the selected student from the request
        $selectedStudent = request('student');

        // Fetch the student data from the database
        $student = DB::table('students')
            ->where('account_id', $selectedStudent)
            ->first();

        // Fetch the student's grades from the database
        $grades = DB::table('student_grades')
            ->where('student_id', $selectedStudent)
            ->get();

        // Start building the HTML for the transcript
        $html = '<h1>Transcript of Records</h1>';

        // Build the header section for the student's details
        $html .= '<h2>' . $student->first_name . ' ' . $student->last_name . '</h2>';
        $html .= '<p><strong>Email:</strong> ' . $student->email . '</p>';
        $html .= '<p><strong>Address:</strong> ' . $student->address . '</p>';
        $html .= '<p><strong>Gender:</strong> ' . $student->gender . '</p>';
        $html .= '<p><strong>Contact Number:</strong> ' . $student->contact_number . '</p>';
        $html .= '<p><strong>Date of Birth:</strong> ' . $student->student_birthdate . '</p>';
        $html .= '<p><strong>Level:</strong> ' . $student->level . '</p>';
        $html .= '<p><strong>Section:</strong> ' . $student->section . '</p>';

        // Initialize the total average variable
        $totalAverage = 0;
                $html .= '<table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 20px;">';
                $html .= '<tr style="background-color: #d9edf7;"><th style="border: 1px solid black; padding: 10px;">Subject</th><th style="border: 1px solid black; padding: 10px;" colspan="4">Grades</th></tr>';
                $html .= '<tr><td></td><th style="border: 1px solid black; padding: 10px;">First Grading</th><th style="border: 1px solid black; padding: 10px;">Second Grading</th><th style="border: 1px solid black; padding: 10px;">Third Grading</th><th style="border: 1px solid black; padding: 10px;">Fourth Grading</th></tr>';
        
                foreach ($grades as $grade) {
                    // Fetch the subject name from the subjects table
                    $subject = DB::table('subjects')
                        ->where('subject_id', $grade->subject_id)
                        ->first();
                
                    // Calculate the average for the subject
                    $subjectAverage = ($grade->first_grading + $grade->second_grading + $grade->third_grading + $grade->fourth_grading) / 4;
                
                    // Add the subject average to the total average variable
                    $totalAverage += $subjectAverage;
                
                    $html .= '<tr>';
                    $html .= '<td style="border: 1px solid black; padding: 10px;">' . $subject->subject_name . '</td>';
                    $html .= '<td style="border: 1px solid black; padding: 10px;">' . $grade->first_grading . '</td>';
                    $html .= '<td style="border: 1px solid black; padding: 10px;">' . $grade->second_grading . '</td>';
                    $html .= '<td style="border: 1px solid black; padding: 10px;">' . $grade->third_grading . '</td>';
                    $html .= '<td style="border: 1px solid black; padding: 10px;">' . $grade->fourth_grading . '</td>';
                    $html .= '</tr>';
                }
                        // Calculate the final average
                $finalAverage = $totalAverage / count($grades);

               

        
        $html .= '</table>';
        
 // Append the final average to the HTML output
 $html .= '<p><strong>Final Average:</strong> ' . $finalAverage . '</p>';
        // Generate the PDF using mPDF
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);

        // Return the PDF as a response
        return response($mpdf->Output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="students_summary_' . $student->section . '.pdf"'
        ]);
    }

    public function generatePdfLeastStudentsPerSection(Request $request)
    {
        $section = $request->input('section');

        // Load data from the database or other sources for students in the specified section
        $students = DB::table('students')->where('section', $section)->get();
        $students = $students->sortBy(function ($student) {
            $grades = DB::table('student_grades')->where('student_id', $student->account_id)->first();
            $average = ($grades->first_grading + $grades->second_grading + $grades->third_grading + $grades->fourth_grading) / 4;
            return $average;
        })->take(10);

        $html = '<h1>Least Performing Students</h1>';
        $html .= '<table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 20px;">';
        $html .= '<tr style="background-color: #d9edf7;"><th style="border: 1px solid black; padding: 10px;">Student ID</th><th style="border: 1px solid black; padding: 10px;">Subject ID</th><th style="border: 1px solid black; padding: 10px;">First Grading</th><th style="border: 1px solid black; padding: 10px;">Second Grading</th><th style="border: 1px solid black; padding: 10px;">Third Grading</th><th style="border: 1px solid black; padding: 10px;">Fourth Grading</th><th style="border: 1px solid black; padding: 10px;">Average Grade</th></tr>';
        
        foreach ($students as $student) {
            $grades = DB::table('student_grades')->where('student_id', $student->account_id)->first();
            $average = ($grades->first_grading + $grades->second_grading + $grades->third_grading + $grades->fourth_grading) / 4;
            $html .= '<tr>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->account_id . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $grades->subject_id . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $grades->first_grading . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $grades->second_grading . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $grades->third_grading . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $grades->fourth_grading . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $average . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';

        // Generate the PDF using mPDF
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);

        // Return the PDF as a response
        return response($mpdf->Output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="students_summary_'.$section.'.pdf"'
        ]);
    }
    public function generatePdfTopStudentsPerSection(Request $request)
    {
        $section = $request->input('section');

        // Load data from the database or other sources for students in the specified section
        $students = DB::table('students')->where('section', $section)->get();
        $students = $students->sortByDesc(function ($student) {
            $grades = DB::table('student_grades')->where('student_id', $student->account_id)->first();
            $average = ($grades->first_grading + $grades->second_grading + $grades->third_grading + $grades->fourth_grading) / 4;
            return $average;
        })->take(10);

        $html = '<h1>Top Performing Students</h1>';
        $html .= '<table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 20px;">';
        $html .= '<tr style="background-color: #d9edf7;"><th style="border: 1px solid black; padding: 10px;">Student ID</th><th style="border: 1px solid black; padding: 10px;">Subject ID</th><th style="border: 1px solid black; padding: 10px;">First Grading</th><th style="border: 1px solid black; padding: 10px;">Second Grading</th><th style="border: 1px solid black; padding: 10px;">Third Grading</th><th style="border: 1px solid black; padding: 10px;">Fourth Grading</th><th style="border: 1px solid black; padding: 10px;">Average Grade</th></tr>';
        
        foreach ($students as $student) {
            $grades = DB::table('student_grades')->where('student_id', $student->account_id)->first();
            $average = ($grades->first_grading + $grades->second_grading + $grades->third_grading + $grades->fourth_grading) / 4;
            $html .= '<tr>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->account_id . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $grades->subject_id . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $grades->first_grading . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $grades->second_grading . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $grades->third_grading . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $grades->fourth_grading . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $average . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';

        // Generate the PDF using mPDF
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);

        // Return the PDF as a response
        return response($mpdf->Output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="top_students_per_section_'.$selectedTopStudentsSection.'.pdf"'
        ]);
    }
    public function generatePdf()
    {
        // Load data from the database or other sources for all students
        $students = DB::table('students')->get();
        $html = '<h1>Student Summary Report</h1>';
        $html .= '<table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 20px;">';
        $html .= '<tr style="background-color: #d9edf7;"><th style="border: 1px solid black; padding: 10px;">Name</th><th style="border: 1px solid black; padding: 10px;">Email</th><th style="border: 1px solid black; padding: 10px;">Address</th><th style="border: 1px solid black; padding: 10px;">Gender</th><th style="border: 1px solid black; padding: 10px;">Contact Number</th><th style="border: 1px solid black; padding: 10px;">Date of Birth</th><th style="border: 1px solid black; padding: 10px;">Level</th><th style="border: 1px solid black; padding: 10px;">Section</th></tr>';
    
        foreach ($students as $student) {
            $html .= '<tr>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->email . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->address . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->gender . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->contact_number . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->student_birthdate . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->level . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->section . '</td>';
            $html .= '</tr>';
        }
        
        $html .= '</table>';
    
        // Generate the PDF using mPDF
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
    
        // Return the PDF as a response
        return response($mpdf->Output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="students_summary.pdf"'
        ]);
    }
    public function generateProfilePdf(Request $request)
    {
        $account_id = $request->query('account_id');
        // Load data from the database or other sources for all students
        $students = DB::table('students')->where('account_id', $account_id)->get();
    
        // Build the HTML table with the filtered student data
        $html = '<h1>Student Profile</h1>';
        $html .= '<table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 20px;">';
        $html .= '<tr style="background-color: #d9edf7;"><th style="border: 1px solid black; padding: 10px;">Name</th><th style="border: 1px solid black; padding: 10px;">Email</th><th style="border: 1px solid black; padding: 10px;">Address</th><th style="border: 1px solid black; padding: 10px;">Gender</th><th style="border: 1px solid black; padding: 10px;">Contact Number</th><th style="border: 1px solid black; padding: 10px;">Date of Birth</th><th style="border: 1px solid black; padding: 10px;">Level</th><th style="border: 1px solid black; padding: 10px;">Section</th></tr>';
    
        foreach ($students as $student) {
            $html .= '<tr>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->email . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->address . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->gender . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->contact_number . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->student_birthdate . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->level . '</td>';
            $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->section . '</td>';
            $html .= '</tr>';
        }
    
        $html .= '</table>';
    
        // Generate the PDF using mPDF
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
    
        // Return the PDF as a response
        return response($mpdf->Output(), 200, [        'Content-Type' => 'application/pdf',        'Content-Disposition' => 'inline; filename="students_summary.pdf"'    ]);
    }
    


    public function generatePdfPerSection(Request $request)
        {
            $section = $request->input('section'); // Get the section from the request
            
            // Load data from the database or other sources for students in the specified section
            $students = DB::table('students')->where('section', $section)->get();
            $html = '<h1>Student Summary Report</h1>';
            $html .= '<table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 20px;">';
            $html .= '<tr style="background-color: #d9edf7;"><th style="border: 1px solid black; padding: 10px;">Name</th><th style="border: 1px solid black; padding: 10px;">Email</th><th style="border: 1px solid black; padding: 10px;">Address</th><th style="border: 1px solid black; padding: 10px;">Gender</th><th style="border: 1px solid black; padding: 10px;">Contact Number</th><th style="border: 1px solid black; padding: 10px;">Date of Birth</th><th style="border: 1px solid black; padding: 10px;">Level</th><th style="border: 1px solid black; padding: 10px;">Section</th></tr>';
        

            foreach ($students as $student) {
                $html .= '<tr>';
                $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name . '</td>';
                $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->email . '</td>';
                $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->address . '</td>';
                $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->gender . '</td>';
                $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->contact_number . '</td>';
                $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->student_birthdate . '</td>';
                $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->level . '</td>';
                $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->section . '</td>';
                $html .= '</tr>';
            }

            $html .= '</table>';

            // Generate the PDF using mPDF
            $mpdf = new Mpdf();
            $mpdf->WriteHTML($html);

            // Return the PDF as a response
            return response($mpdf->Output(), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="students_summary_'.$section.'.pdf"'
            ]);
        }
        public function generatePdfPerFilter(Request $request)
        {
            $selectedInputs = $request->only(['section', 'age', 'dropout', 'gender', 'address']); // Get selected filters from the request
            
            // Load data from the database or other sources for students in the specified section
            $query = DB::table('students');

            if ($request->has('section')) {
                $query->where('section', $request->input('section'));
            }

            if ($request->has('age')) {
                $query->where('age', $request->input('age'));
            }

            if ($request->has('dropout')) {
                $query->where('dropout', $request->input('dropout'));
            }

            if ($request->has('gender')) {
                $query->where('gender', $request->input('gender'));
            }

            if ($request->has('address')) {
                $query->where('address', $request->input('address'));
            }

            $students = $query->get();

            $html = '<h1>Student Summary Report</h1>';
            $html .= '<table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-bottom: 20px;">';
            $html .= '<tr style="background-color: #d9edf7;"><th style="border: 1px solid black; padding: 10px;">Name</th><th style="border: 1px solid black; padding: 10px;">Email</th><th style="border: 1px solid black; padding: 10px;">Address</th><th style="border: 1px solid black; padding: 10px;">Gender</th><th style="border: 1px solid black; padding: 10px;">Contact Number</th><th style="border: 1px solid black; padding: 10px;">Date of Birth</th><th style="border: 1px solid black; padding: 10px;">Level</th><th style="border: 1px solid black; padding: 10px;">Section</th></tr>';
        

            foreach ($students as $student) {
                $html .= '<tr>';
                $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name . '</td>';
                $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->email . '</td>';
                $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->address . '</td>';
                $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->gender . '</td>';
                $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->contact_number . '</td>';
                $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->student_birthdate . '</td>';
                $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->level . '</td>';
                $html .= '<td style="border: 1px solid black; padding: 10px;">' . $student->section . '</td>';
                $html .= '</tr>';
            }

            $html .= '</table>';

            // Generate the PDF using mPDF
            $mpdf = new Mpdf();
            $mpdf->WriteHTML($html);

            // Return the PDF as a response
            return response($mpdf->Output(), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="students_summary_'.$section.'.pdf"'
            ]);
        }

}
