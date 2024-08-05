<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\IOFactory;

class LuckyDrawController extends Controller
{
    public function showForm()
    {
        return view('lucky-draw');
    }

    public function addParticipant(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $participants = Session::get('participants', []);
        $participants[] = ['name' => $request->name];
        Session::put('participants', $participants);

        return redirect()->back()->with('success', 'Participant added successfully.');
    }

    public function pickWinner()
    {
        $participants = Session::get('participants', []);

        if (empty($participants)) {
            return redirect('/participants')->with('error', 'No participants found.');
        }

        $winner = $participants[array_rand($participants)];

        // Clear session data
        Session::forget('participants');

        return view('winner', ['winner' => $winner['name']]);
    }

    public function uploadCsv(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|file|mimes:xlsx,xls,csv,txt',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Invalid file format.');
        }

        $file = $request->file('csv_file');
        $path = $file->getRealPath();

        try {
            $spreadsheet = IOFactory::load($path);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            if (count($rows) > 0) {
                $header = array_map('trim', $rows[0]);
                unset($rows[0]);

                if (in_array('name', $header)) {
                    $participants = [];
                    foreach ($rows as $row) {
                        $participantData = array_combine($header, $row);
                        if (!empty($participantData['name'])) {
                            $participants[] = ['name' => $participantData['name']];
                        }
                    }
                    Session::put('participants', $participants);
                    return redirect('/participants')->with('success', 'CSV file uploaded successfully.');
                } else {
                    return redirect()->back()->with('error', 'Invalid CSV format. Header does not contain "name".');
                }
            } else {
                return redirect()->back()->with('error', 'CSV file is empty.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error processing CSV file: ' . $e->getMessage());
        }
    }

    public function showParticipants(Request $request)
    {
        $perPage = $request->get('per_page', 20);
        $participants = collect(Session::get('participants', []));
        $paginatedParticipants = $participants->paginate($perPage);

        return view('participants', compact('paginatedParticipants'));
    }
}
    