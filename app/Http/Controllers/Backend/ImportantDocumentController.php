<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\ImportantDocument;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ImportantDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $document = ImportantDocument::all();
        return view('backend.important_documents.index', compact('document'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $formType = 'create';
        return view('backend.important_documents.create', compact('formType'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
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
        return view('backend.important_documents.create', compact('document', 'formType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ImportantDocument $document)
    {
        // file optional, কারণ edit এ নতুন ফাইল না দিলেও চলবে
        $request->validate([
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
