<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::with('category')->paginate('10');
        return view('admin.faqs.index', compact('faqs'));
    }
public function list()
{
//    $faqs =Faq::all();
    // Fetch FAQs where category_id has no parent in faq_categories table
    $faqs = Faq::whereNotExists(function ($query) {
        $query->select(DB::raw(1))
              ->from('faq_categories')
              ->whereColumn('faq_categories.id', 'faqs.category_id') // Assuming faq_categories.id is the category_id in faqs table
              ->whereNotNull('faq_categories.parent_id');
    })->get();

    return view('user.support.asked-question', compact('faqs'));
}

    public function category()
    {
        $categories = FaqCategory::whereNotNull('parent_id')->with('children')->get();
        $categoriesAll = FaqCategory::all();

        return view('user.support.categories', compact('categories', 'categoriesAll'));
    }
    public function create($id = null)
    {
        $categories = faqcategory::with('children')->whereNull('parent_id')->get();
        $faq = $id ? Faq::findOrFail($id) : null;
        return view('admin.faqs.manage', compact('categories', 'faq'));
    }

    public function store(Request $request)
{
    $request->validate([
        'question' => 'required|string|max:255',
        'answer' => 'required|string',
        'category_id' => 'required',
    ]);

    try {
        // Create FAQ
        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'category_id' => $request->category_id,
        ]);

        flashy()->message('FAQ created successfully.','');

        return redirect()->route('admin.faqs.index'); // Redirect to FAQ index or another appropriate route
    } catch (\Exception $e) {
        // Handle any exceptions (e.g., database errors)
        // Log the error or handle it as appropriate
        flashy()->error('Failed to create FAQ.');

        return redirect()->back()->withInput(); // Redirect back to the form with input data
    }
}

    public function edit(Faq $faq)
    {
        $categories = FaqCategory::with('children')->whereNull('parent_id')->get();
        return view('admin.faqs.manage', compact('categories', 'faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $faq->update($request->all());
        flashy()->message('FAQ updated successfully.','');

        return redirect()->route('admin.faqs.edit',$faq->id);
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        flashy()->message('FAQ deleted successfully.','');

        return redirect()->route('admin.faqs.index');
    }
    public function category_question($id)
    {
        $decodedId = base64_decode($id);
           // Ensure the ID is valid
           if ($decodedId === false || !is_numeric($decodedId)) {
            // Handle the error (e.g., return an error response or redirect)
            abort(404, 'Invalid ID');
        }

        // Fetch the FAQs based on the decoded ID
        $faqs = Faq::where('category_id', $decodedId)->get();
        // return $faqs;
        return view('user.support.category-question', compact('faqs'));
    }
}
