<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ImportantDocument;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImportantDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $document = ImportantDocument::with('user')->get();
        $user = User::select('id', 'name')->get();
        return view('backend.important_documents.index', compact('document', 'user'));
    }

    public function userDocumentsPdf(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $selectedUser = User::select('id', 'name')->findOrFail($request->user_id);
        $document = ImportantDocument::where('user_id', $selectedUser->id)->get();

        $pdf = Pdf::loadView('backend.important_documents.user_documents_pdf', compact('document', 'selectedUser'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('documents_'.$selectedUser->id.'.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $formType = 'create';
        $user = User::select('id', 'name')->get();
        return view('backend.important_documents.create', compact('formType','user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,png'
        ]);
        try {
            $data = $request->except('file');

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/documents'), $filename);
                $data['file'] = $filename;
            }

            ImportantDocument::create($data);

            $this->notice::success('Data successfully Updated');
            return redirect()->route('document.index');

        } catch (\Exception $e) {
            // dd($e->getMessage());
            $this->notice::error('Something went wrong! Please try again');

            return redirect()
                ->route('document.create')
                ->withInput();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(ImportantDocument $importantDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ImportantDocument $document)
    {
        // dd($document);
        $formType = 'edit';
        $user = User::select('id', 'name')->get();
        return view('backend.important_documents.create', compact('document', 'formType', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ImportantDocument $document)
    {
        // file optional, কারণ edit এ নতুন ফাইল না দিলেও চলবে
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png'
        ]);

        try {
            // $document = ImportantDocument::findOrFail($id);

            // form data (file বাদ দিয়ে)
            $data = $request->except('file');

            // যদি নতুন ফাইল আসে
            if ($request->hasFile('file')) {

                // 🔥 1. পুরোনো ফাইল delete করো
                if (!empty($document->file)) {
                    $oldPath = public_path('uploads/documents/' . $document->file);

                    if (File::exists($oldPath)) {
                        File::delete($oldPath);
                    }
                }

                // 🔥 2. নতুন ফাইল upload করো
                $file = $request->file('file');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/documents'), $filename);

                // 🔥 3. নতুন নাম DB তে বসাও
                $data['file'] = $filename;
            }

            // 🔥 4. ডাটা update
            $document->update($data);

            $this->notice::success('Data successfully Updated');
            return redirect()->route('document.index');

        } catch (\Exception $e) {
            // dd($e->getMessage());
            $this->notice::error('Something went wrong! Please try again');

            return redirect()
                ->route('document.edit', $document->id)
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImportantDocument $importantDocument)
    {
        try {
            $importantDocument->delete();

            $this->notice::success('Data successfully Deleted');
            return redirect()->route('document.index');
        } catch (\Exception $e) {
            $this->notice::error('Something went wrong! Please try again');
            return redirect()->route('document.index');
        }
    }
}
